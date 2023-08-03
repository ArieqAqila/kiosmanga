<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pembelian;
use App\Models\Transaksi;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('Backend.Pages.User', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inNamaUser' => 'required|max:50',
            'inEmail' => 'required|unique:users,email',
            'inUsername' => 'required|unique:users,username|max:15',
            'inPassword' => 'required|max:12',
            'inNotelp' => 'required',
            'inTglLahir' => 'required',
            'inFotoProfile' => 'required|image|max:20000',
            'inIsAdmin' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'User gagal ditambahkan!',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = new User;

        if ($request->hasFile('inFotoProfile')) {
            $path = public_path()."\images\profile\\";
            $file = $request->file('inFotoProfile');
            $extension = $file->getClientOriginalExtension();
            $filename = md5(time()). '.' .$extension;
            $file->move($path, $filename);
            $user->foto_profile = $filename;
        }

        $user->nama_user = $request->inNamaUser;
        $user->email = $request->inEmail;
        $user->username = $request->inUsername;
        $user->password = hash::make($request->inPassword);
        $user->notelp = $request->inNotelp;
        $user->tgl_lahir = $request->inTglLahir;
        $user->isAdmin = $request->inIsAdmin;
        $user->save();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan!'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User gagal ditambahkan!'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return response()->json([
            'success' => true,
            'message' => 'Berhasil load data User',
            'data' => $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'editNamaUser' => 'required|max:50',
            'editEmail' => 'required|unique:users,email,'.$user->id_user.',id_user',
            'editUsername' => 'required|unique:users,username,'.$user->id_user.',id_user|max:15',
            'editPassword' => 'max:12',
            'editNotelp' => 'required',
            'editTglLahir' => 'required',
            'editFotoProfile' => 'image|max:20000',
            'editIsAdmin' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'User gagal diupdate!',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!$user) {
            return response()->json([
                'success' => true,
                'message' => 'User tidak ditemukan!'
            ], 404);
        }

        if ($request->hasFile('editFotoProfile')){
            $path = public_path()."\images\profile\\";

            if ($user->foto_profile != null) {
                $old_file = $path.$user->foto_profile;
                unlink($old_file);
            }

            $file = $request->file('editFotoProfile');
            $extension = $file->getClientOriginalExtension();
            $filename = md5(time()). '.' .$extension;
            $file->move($path, $filename);
            $user->foto_profile = $filename;
        }

        $user->nama_user = $request->editNamaUser;
        $user->email = $request->editEmail;
        $user->username = $request->editUsername;
        if ($request->input('editPassword') !== null) {
            $user->password = hash::make($request->editPassword);
        };
        $user->notelp = $request->editNotelp;
        $user->tgl_lahir = $request->editTglLahir;
        $user->isAdmin = $request->editIsAdmin;
        $user->update();
        
        return response()->json([
            'success' => true,
            'message' => 'User berhasil diupdate!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ada'
            ], 404);
        }

        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data User berhasil dihapus!'
        ], 200);
    }



    /* FrontEnd Handling Request */


    /**
     * 
     */
    function profilePage(){
        $purchasedManga = Pembelian::where('id_user', Auth::user()->id_user)->count();
        $listTransaction = Transaksi::where('id_user', Auth::user()->id_user)->count();
        $listCart = Keranjang::where('id_user', Auth::user()->id_user)->where('status', 'NOT PURCHASED')->count();

        return view('Frontend.Pages.editProfile', compact('purchasedManga', 'listTransaction', 'listCart'));
    }


    /**
     * 
     */
    function daftar(Request $request){
        $validator = Validator::make($request->all(), [
            'namaLengkap' => 'required|max:30',
            'username' => 'required|min:6|max:15|unique:users,username',
            'email' => 'required|unique:users,email',           
            'password' => 'required|min:6|max:20',
            'konfirmasiPassword' => 'required|same:password',
            'noTelp' => 'required|min:12|max:13',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User([
            'nama_user' => $request->namaLengkap,
            'username' => $request->username,
            'email' => $request->email,         
            'password' => hash::make($request->password),
            'isAdmin' => 0,
            'notelp' => $request->noTelp,
        ]);   
        $user->save();
        
        return redirect()->route('login-page');
    }


    /**
     * 
     */
    function ubahBiodata(Request $request, $username) {
        $validator = Validator::make($request->all(), [
            'ubahUsername' => 'max:15|unique:users,username',
            'ubahNama' => 'max:50',
            'ubahEmail' => 'unique:users,email',           
            'profilePic' => 'image|mimes:jpeg,jpg,png|max:10000'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $user = User::where('username', $username)->first();
        $user->username = $request->ubahUsername ?? $user->username;
        $user->nama_user = $request->ubahNama ?? $user->nama_user;
        $user->tgl_lahir = $request->ubahTglLahir ?? $user->tgl_lahir;
        $user->email = $request->ubahEmail ?? $user->email;
        $user->notelp = $request->ubahNoTelp ?? $user->notelp;

        if ($request->hasFile('profilePic')){
            $path = public_path()."\images\profile\\";

            if ($user->foto_profile != null) {
                $old_file = $path.$user->foto_profile;
                unlink($old_file);
            }

            $file = $request->file('profilePic');
            $extension = $file->getClientOriginalExtension();
            $filename = md5(time()). '.' .$extension;
            $file->move($path, $filename);
            $user->foto_profile = $filename;
        }

        $user->update();

        return back()->with('success', 'Biodata diperbarui!');
    }


    /**
     * 
     */
    function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'newPassword' => ['required', 'min:6', 'max:15', 'different:currentPassword'],
            'confirmNewPassword' => ['required', 'same:newPassword']
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['resetPasswordError' => 'Reset password invalid!'])->withInput();
        }


        $authUser = Auth::user();
        $user = User::where('id_user', $authUser->id_user)->first();
        $currentPassword = $user->password;

        if (!Hash::check($request->currentPassword, $currentPassword)) {
            return redirect()->back()->withErrors(['currentPassword' => 'Password tidak sama'])->withInput();
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return back()->with('resetPasswordSuccess', 'Password berhasil direset!');
    }


    /**
     * 
     */
    function lupaPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $user = User::where('email', $request->email)->first();

        if (empty($user)) {
            abort(404);
        }

        return view('Frontend.Pages.lupa_password.form_reset_password');
    }
}
