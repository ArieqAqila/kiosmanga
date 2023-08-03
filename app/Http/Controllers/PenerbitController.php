<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penerbits = Penerbit::all();

        return view('Backend.Pages.Penerbit', ['penerbits' => $penerbits]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inNamaPenerbit' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Penerbit gagal ditambahkan!'
            ], 400);
        }

        $penerbit = Penerbit::create([
            'nama_penerbit' => $request->inNamaPenerbit
        ]);
        if ($penerbit) {
            return response()->json([
                'success' => true,
                'message' => 'Penerbit berhasil ditambahkan!'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Penerbit gagal ditambahkan!'
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penerbit $penerbit)
    {
        return response()->json([
            'success' => true,
            'message' => 'Berhasil load data Penerbit',
            'data' => $penerbit
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'editNamaPenerbit' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Penerbit gagal ditambahkan!'
            ], 400);
        }

        $penerbit = Penerbit::findOrFail($id);
        if (!$penerbit) {
            return response()->json([
                'success' => true,
                'message' => 'Penerbit tidak ditemukan!'
            ], 404);
        }

        $penerbit->nama_penerbit = $request->editNamaPenerbit;
        $penerbit->update();
        return response()->json([
            'success' => true,
            'message' => 'Penerbit berhasil diupdate!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penerbit $penerbit)
    {
        if (!$penerbit) {
            return response()->json([
                'success' => false,
                'message' => 'Penerbit tidak ada'
            ], 404);
        }

        $penerbit->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Penerbit berhasil dihapus!'
        ], 200);
    }
}
