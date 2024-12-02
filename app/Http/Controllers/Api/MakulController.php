<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Makul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MakulController extends Controller
{
    public function create(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|unique:makuls,kode',
            'nama_matkul' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Membuat mata kuliah baru
        $makul = Makul::create([
            'kode' => $request->kode,
            'nama_matkul' => $request->nama_matkul,
            'sks' => $request->sks,
        ]);

        return response()->json([
            'data' => $makul,
            'message' => 'Makul created successfully',
        ], 201);
    }

    public function read()
    {
        // Mengambil semua data mata kuliah
        $makuls = Makul::all();

        return response()->json([
            'data' => $makuls,
            'message' => 'Makul data fetched successfully',
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode' => 'string|unique:makuls,kode,' . $id,
            'nama_matkul' => 'string|max:255',
            'sks' => 'integer|min:1|max:6',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Mencari mata kuliah berdasarkan ID
        $makul = Makul::find($id);
        if (!$makul) {
            return response()->json([
                'message' => 'Makul not found',
            ], 404);
        }

        // Update data mata kuliah
        $makul->update($request->only(['kode', 'nama_matkul', 'sks']));

        return response()->json([
            'data' => $makul,
            'message' => 'Makul updated successfully',
        ]);
    }

    public function delete($id)
    {
        // Mencari mata kuliah berdasarkan ID
        $makul = Makul::find($id);
        if (!$makul) {
            return response()->json([
                'message' => 'Makul not found',
            ], 404);
        }

        // Menghapus data mata kuliah
        $makul->delete();

        return response()->json([
            'message' => 'Makul deleted successfully',
        ]);
    }
}