<?php

namespace App\Http\Controllers;

use App\Models\Mangaka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MangakaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mangakas = Mangaka::all();

        return view('Backend.Pages.mangaka', ['mangakas' => $mangakas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inNamaMangaka' => 'required|unique:mangaka,nama_mangaka'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Mangaka gagal ditambahkan!'
            ], 400);
        }

        $mangaka = Mangaka::create([
            'nama_mangaka' => $request->inNamaMangaka
        ]);
        if ($mangaka) {
            return response()->json([
                'success' => true,
                'message' => 'Mangaka berhasil ditambahkan!'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Mangaka gagal ditambahkan!'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mangaka $mangaka)
    {
        return response()->json([
            'success' => true,
            'message' => 'Berhasil load data Mangaka',
            'data' => $mangaka
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'editNamaMangaka' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Mangaka gagal ditambahkan!'
            ], 400);
        }

        $mangaka = Mangaka::findOrFail($id);
        if (!$mangaka) {
            return response()->json([
                'success' => true,
                'message' => 'Mangaka tidak ditemukan!'
            ], 404);
        }

        $mangaka->nama_mangaka = $request->editNamaMangaka;
        $mangaka->update();
        return response()->json([
            'success' => true,
            'message' => 'Mangaka berhasil diupdate!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mangaka $mangaka)
    {
        if (!$mangaka) {
            return response()->json([
                'success' => false,
                'message' => 'Mangaka tidak ada'
            ], 404);
        }

        $mangaka->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Mangaka berhasil dihapus!'
        ], 200);
    }
}
