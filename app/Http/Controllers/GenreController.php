<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();

        return view('Backend.Pages.Genre', ['genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inNamaGenre' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Genre gagal ditambahkan!'
            ], 400);
        }

        $genre = Genre::create([
            'nama_genre' => $request->inNamaGenre
        ]);
        if ($genre) {
            return response()->json([
                'success' => true,
                'message' => 'Genre berhasil ditambahkan!'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Genre gagal ditambahkan!'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return response()->json([
            'success' => true,
            'message' => 'Berhasil load data Genre',
            'data' => $genre
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'editNamaGenre' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Genre gagal ditambahkan!'
            ], 400);
        }

        $genre = Genre::findOrFail($id);
        if (!$genre) {
            return response()->json([
                'success' => true,
                'message' => 'Genre tidak ditemukan!'
            ], 404);
        }

        $genre->nama_genre = $request->editNamaGenre;
        $genre->update();
        return response()->json([
            'success' => true,
            'message' => 'Genre berhasil diupdate!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre tidak ada'
            ], 404);
        }

        $genre->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Genre berhasil dihapus!'
        ], 200);
    }
}
