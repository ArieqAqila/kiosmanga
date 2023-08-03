<?php

namespace App\Http\Controllers;

use App\Models\VolManga;
use App\Models\Manga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class VolMangaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        $manga = Manga::where('slug_manga', $slug)->first();
        
        $volMangas = VolManga::where('id_manga', $manga->id_manga)->get();        

        return view('Backend.Pages.volManga', ['volMangas' => $volMangas, 'manga' => $manga]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'inVolKe' => 'required|numeric',
            'inDeskripsi' => 'required',
            'inBahasa' => 'required',
            'inJmlHal' => 'required|numeric',
            'inHarga' => 'required|numeric',
            'inVisualArt' => 'required|image|max:50000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'VolManga gagal ditambahkan!',
                'errors' => $validator->errors(),
            ], 400);
        }

        $manga = Manga::find($id);

        $volManga = new VolManga([
            'id_manga'=> $id,
            'vol_ke' => $request->inVolKe,
            'deskripsi' => $request->inDeskripsi,
            'bahasa' => $request->inBahasa,
            'jml_hal' => $request->inJmlHal,
            'harga' => $request->inHarga,
        ]);

        if ($request->hasFile('inVisualArt')) {
            $folderName = $manga->judul_manga;
            if (!Storage::exists($folderName)) {
                Storage::makeDirectory($folderName);
            }
            $path = public_path('images/visualArt/'.$manga->judul_manga);
            $file = $request->file('inVisualArt');
            $extension = $file->getClientOriginalExtension();
            $filename = md5(time()) . '.' . $extension;
            $file->move($path, $filename);
            $volManga->visual_art = $filename;
        }

        $volManga->slug_vol = strtolower($manga->slug_manga . '-' . $volManga->vol_ke);
        $volManga->save();

        return response()->json([
            'success' => true,
            'message' => 'VolManga berhasil ditambahkan!',
        ], 200);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VolManga $volManga)
    {
        $volManga->manga;
        return response()->json([
            'success' => true,
            'message' => 'Berhasil load data VolManga',
            'data' => $volManga
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'editVolKe' => 'required|numeric',
            'editDeskripsi' => 'required',
            'editBahasa' => 'required',
            'editJmlHal' => 'required|numeric',
            'editHarga' => 'required|numeric',
            'editVisualArt' => 'image|max:50000'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'VolManga gagal diupdate!',
                'errors' => $validator->errors(),
            ], 400);
        }

        $volManga = VolManga::findOrFail($id);
        if (!$volManga) {
            return response()->json([
                'success' => true,
                'message' => 'VolManga tidak ditemukan!'
            ], 404);
        }

        $manga = Manga::find($volManga->id_manga)->first();

        if ($request->hasFile('editVisualArt')) {
            $path = public_path('images/visualArt/'.$manga->judul_manga.'/');

            if ($volManga->visual_art != null) {
                $old_file = $path.$volManga->visual_art;
                unlink($old_file);
            }

            $file = $request->file('editVisualArt');
            $extension = $file->getClientOriginalExtension();
            $filename = md5(time()) . '.' . $extension;
            $file->move($path, $filename);
            $volManga->visual_art = $filename;
        }

        $volManga->vol_ke = $request->editVolKe;
        $volManga->deskripsi = $request->editDeskripsi;
        $volManga->bahasa = $request->editBahasa;
        $volManga->jml_hal = $request->editJmlHal;
        $volManga->harga = $request->editHarga;
        $volManga->update();
        return response()->json([
            'success' => true,
            'message' => 'VolManga berhasil diupdate!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VolManga $volManga)
    {
        if (!$volManga) {
            return response()->json([
                'success' => false,
                'message' => 'VolManga tidak ada'
            ], 404);
        }

        $volManga->delete();

        $manga = Manga::find($volManga->id_manga)->first();

        $visualArt = 'images/visualArt/'.$manga->judul_manga.'/'.$volManga->visual_art;
        
		if(file_exists($visualArt))
		{
		  unlink($visualArt);
		}

        return response()->json([
            'success' => true,
            'message' => 'Data VolManga berhasil dihapus!'
        ], 200);
    }
}
