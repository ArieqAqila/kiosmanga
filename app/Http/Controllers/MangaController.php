<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Mangaka;
use App\Models\Penerbit;
use App\Models\Genre;
use App\Models\GenreManga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MangaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mangas = Manga::all();
        $mangakas = Mangaka::all();
        $penerbits = Penerbit::all();
        $genres = Genre::all();

        return view('Backend.Pages.Manga', ['mangas' => $mangas, 'mangakas' => $mangakas, 'penerbits' => $penerbits, 'genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inJudulManga' => 'required|max:100',
            'inJudulMangaJapanese' => 'required|max:100',
            'inMangaka' => 'required',
            'inPenerbit' => 'required',
            'inJumlahVolume' => 'required',
            'inTglTersedia' => 'required',            
            'inGenre' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Manga gagal ditambahkan!',
                'errors' => $validator->errors()
            ], 422);
        }

        $newManga = new Manga([
            'judul_manga' => $request->inJudulManga,
            'judul_jepang' => $request->inJudulMangaJapanese,
            'id_mangaka' => $request->inMangaka,
            'id_penerbit' => $request->inPenerbit,
            'jml_vol' => $request->inJumlahVolume,
            'tgl_tersedia' => $request->inTglTersedia,
            'slug_manga' => 'hehe'
        ]);
        
        $newManga->save();
        
        $selectedGenres = $request->inGenre;
        
        foreach ($selectedGenres as $genre) {
            $newGenreManga = new GenreManga([
                'id_manga' => $newManga->id_manga,
                'id_genre' => $genre,
            ]);

            $newGenreManga->save();
        }

        $newManga->slug_manga = strtolower(preg_replace("/[\s,'-]+/", "-", $newManga->judul_manga));
        $newManga->save();

        return response()->json([
            'success' => true,
            'message' => 'Manga berhasil ditambahkan!'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manga $manga)
    {
        $manga->genreManga;
        return response()->json([
            'success' => true,
            'message' => 'Berhasil load data Manga',
            'data' => $manga,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manga $manga)
    {
        $validator = Validator::make($request->all(), [
            'editJudulManga' => 'required|max:100',
            'editJudulMangaJapanese' => 'required|max:100',
            'editMangaka' => 'required',
            'editPenerbit' => 'required',
            'editJumlahVolume' => 'required',
            'editTglTersedia' => 'required',            
            'editGenre' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Manga gagal diupdate!',
                'errors' => $validator->errors()
            ], 422);
        }

        $manga->judul_manga = $request->editJudulManga;
        $manga->judul_jepang = $request->editJudulMangaJapanese;
        $manga->id_mangaka = $request->editMangaka;
        $manga->id_penerbit = $request->editPenerbit;
        $manga->jml_vol = $request->editJumlahVolume;
        $manga->tgl_tersedia = $request->editTglTersedia;
        $manga->save();

        $manga->slug_manga = strtolower(preg_replace("/[\s,'-]+/", "-", $manga->judul_manga));
        $manga->save();

        $selectedGenres = $request->editGenre;
        $existingGenres = $manga->genreManga->pluck('id_genre')->toArray();

        $addGenres = array_diff($selectedGenres, $existingGenres);
        $removeGenres = array_diff($existingGenres, $selectedGenres);

        foreach ($addGenres as $idGenre) {
            $newGenreManga = new GenreManga([
                'id_manga' => $manga->id_manga,
                'id_genre' => $idGenre,
            ]);

            $newGenreManga->save();
        }

        foreach ($removeGenres as $genre_id) {
            $deleteGenreManga = GenreManga::where('id_manga', $manga->id_manga)
                ->where('id_genre', $genre_id)
                ->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Manga berhasil diupdate!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manga $manga)
    {
        if (!$manga) {
            return response()->json([
                'success' => false,
                'message' => 'Manga tidak ada'
            ], 404);
        }

        $manga->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Manga berhasil dihapus!'
        ], 200);
    }
}
