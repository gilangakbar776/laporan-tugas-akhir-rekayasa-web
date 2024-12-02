<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function create(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nim' => 'required|string|unique:mahasiswas,nim',
            'nama' => 'required|string|max:255',
            'usia' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Membuat mahasiswa baru
        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'usia' => $request->usia,
            'jurusan' => $request->jurusan,
        ]);

        return response()->json([
            'data' => $mahasiswa,
            'message' => 'Mahasiswa created successfully',
        ], 201);
    }

    public function read()
    {
        // Mengambil semua data mahasiswa
        $mahasiswas = Mahasiswa::all();

        return response()->json([
            'data' => $mahasiswas,
            'message' => 'Mahasiswa data fetched successfully',
        ]);
    }

    public function update(Request $request, $id)
    {
    // Cek apakah data mahasiswa ada
    $mahasiswa = Mahasiswa::find($id);
    if (!$mahasiswa) {
        return response()->json([
            'message' => 'Mahasiswa not found',
        ], 404);
    }

    // Validasi input
    $validator = Validator::make($request->all(), [
        'nim' => 'nullable|string|unique:mahasiswas,nim,' . $id,
        'nama' => 'nullable|string|max:255',
        'usia' => 'nullable|string|max:255',
        'jurusan' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Update data satu per satu jika ada
    if ($request->has('nim')) {
        $mahasiswa->nim = $request->nim;
    }
    if ($request->has('nama')) {
        $mahasiswa->nama = $request->nama;
    }
    if ($request->has('usia')) {
        $mahasiswa->usia = $request->usia;
    }
    if ($request->has('jurusan')) {
        $mahasiswa->jurusan = $request->jurusan;
    }

    // Simpan perubahan
    $mahasiswa->save();

    return response()->json([
        'data' => $mahasiswa,
        'message' => 'Mahasiswa updated successfully',
    ]);
    } 

    public function delete($id)
    {
        // Mencari mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return response()->json([
                'message' => 'Mahasiswa not found',
            ], 404);
        }

        // Menghapus data mahasiswa
        $mahasiswa->delete();

        return response()->json([
            'message' => 'Mahasiswa deleted successfully',
        ]);
    }
}