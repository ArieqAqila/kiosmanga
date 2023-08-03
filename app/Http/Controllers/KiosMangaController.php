<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\Manga;
use App\Models\VolManga;
use App\Models\Mangaka;
use App\Models\Genre;
use App\Models\GenreManga;
use App\Models\Penerbit;
use App\Models\Keranjang;

use App\Exceptions\InvalidRequest;
use App\Models\Pembelian;
use App\Models\Transaksi;
use Xendit\Xendit;

class KiosMangaController extends Controller
{

    /**
     * Displaying data to homepage
     */
    public function homePage()
    {
        $fantasyMangas = Manga::whereHas('genreManga.genre', function ($query) {
            $query->where('nama_genre', 'Fantasy');
        })->get();


        $mysteryMangas = Manga::whereHas('genreManga.genre', function ($query) {
            $query->where('nama_genre', 'Mystery');
        })->get();

        $romanceMangas = Manga::whereHas('genreManga.genre', function ($query) {
            $query->where('nama_genre', 'Romance');
        })->get();

        $comedyMangas = Manga::whereHas('genreManga.genre', function ($query) {
            $query->where('nama_genre', 'Comedy');
        })->get();

        return view('Frontend.Pages.Home', [            
            'fantasyMangas' => $fantasyMangas,
            'mysteryMangas' => $mysteryMangas,
            'romanceMangas' => $romanceMangas,
            'comedyMangas' => $comedyMangas,
        ]);
    }

    /**
     * Filtering data based on certain point.
     */
    public function listManga(Request $request)
    {
        $namaGenre = $request->input('genre');
        $namaMangaka = $request->input('mangaka');
        $namaPenerbit = $request->input('penerbit');

        $mangasQuery = Manga::query();

        if (!empty($namaGenre)) {
            $mangasQuery->whereHas('genreManga.genre', function ($query) use ($namaGenre) {
                $query->where('nama_genre', $namaGenre);
            })->paginate(20);
        }
    
        if (!empty($namaMangaka)) {
            $mangasQuery->whereHas('mangaka', function ($query) use ($namaMangaka) {
                $query->where('nama_mangaka', $namaMangaka);
            })->paginate(20);
        }

        if (!empty($namaPenerbit)) {
            $mangasQuery->whereHas('penerbit', function ($query) use ($namaPenerbit) {
                $query->where('nama_penerbit', $namaPenerbit);
            })->paginate(20);
        }

        $mangas = $mangasQuery->paginate(20);

        return view('Frontend.Pages.listManga', compact('mangas'));
    }

    /**
     * User Library.
     */
    public function libraryPage(Request $request)
    {
        $myMangaList = Pembelian::where('id_user', Auth::user()->id_user)->paginate(20);

        return view('Frontend.Pages.library', compact('myMangaList'));
    }

    /**
     * Showing all manga volume.
     */
    public function listVol($slugManga)
    {
        $manga = Manga::mangaSlugFind($slugManga);
        $volMangas = VolManga::where('id_manga', $manga->id_manga)->paginate(20);

        return view('Frontend.Pages.listVolManga', compact('volMangas', 'manga'));
    }

    /**
     * Showing manga details.
     */
    public function detailManga($slugVol)
    {
        $volume = VolManga::volSlugFind($slugVol);
        $recommendationManga = Manga::whereHas('genreManga.genre', function ($query) use($volume) {            
            foreach ($volume->manga->genreManga as $genreManga) {
                $query->orWhere('nama_genre', $genreManga->genre->nama_genre);
            }  
        })->inRandomOrder()->get();

        

        
        return view('Frontend.Pages.detailVolManga', compact('volume', 'recommendationManga'));
    }

    /**
     * Authentication func.
     */
    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->isAdmin) {
                return redirect()->intended('/admin/manga');
            } else {
                return redirect()->intended('/');
            }
        }

        return back()->withErrors(['message' => 'Username atau Password salah!']);
    }

    /**
     * Logging out func.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('home')->with('success', 'Berhasil Logout!');
    }

    /**
     * User Cart func.
     */
    public function listKeranjang()
    {
        $cartList = Keranjang::where('id_user', Auth::user()->id_user)->where('status', 'NOT PURCHASED')->get();

        $subtotal = Keranjang::where('id_user', Auth::user()->id_user)->where('status', 'NOT PURCHASED')->sum('harga');
        $total = $subtotal + ($subtotal * 0.2);

        return view('Frontend.Pages.keranjang', compact('cartList', 'total'));
    }

    /**
     * User Cart Add Items func.
     */
    public function addToKeranjang($slugVol)
    {
        $volManga = VolManga::where('slug_vol', $slugVol)->first();
        $newItem = new Keranjang([
            'id_vol' => $volManga->id_vol,
            'id_user' => Auth::user()->id_user,
            'harga' => $volManga->harga,
            'status' => 'NOT PURCHASED',
        ]);
        $newItem->save();

        return redirect()->back();
    }

    /**
     * User Cart Remove func.
     */
    public function hapusItemsKeranjang(Request $request)
    {
        $keranjangIds = $request->input('keranjangIds');
        if ($keranjangIds) {
            Keranjang::whereIn('id_keranjang', $keranjangIds)->delete();

            return redirect()->back();
        }
        
        abort(404);
    }


    function bacaManga($slugVol, $page){
        $volManga = VolManga::where('slug_vol', $slugVol)->first();
        $pembelian = Pembelian::where('id_user', Auth::user()->id_user)->where('id_vol', $volManga->id_vol)->exists();

        $judul = $volManga->manga->judul_manga;

        if (!$pembelian) {
            abort(404);
        }

        return view('Frontend.Pages.bacaManga', compact('page', 'judul'));
    }


    /* ADMIN SECTION */

    function dashboardAdmin() {
        $totalTransaksi = Transaksi::all()->count();
        $totalPembelian = Pembelian::all()->count();
        $totalPengguna = User::all()->count();

        $apiKey = env('XENDIT_API_KEY');
        Xendit::setApiKey($apiKey);

        try {
            $balance = \Xendit\Balance::getBalance('CASH');

            return view('Backend.Pages.dashboard', compact('totalTransaksi', 'totalPembelian', 'totalPengguna', 'balance'));
        } catch (\Xendit\Exceptions\ApiException $e) {
            
            abort(404);
        }
    }
}