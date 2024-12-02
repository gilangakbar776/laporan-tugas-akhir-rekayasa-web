<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    public function create(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|unique:dosens,nip',
            'nama' => 'required|string|max:255',
            'mata_kuliah' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Membuat dosen baru
        $dosen = Dosen::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'mata_kuliah' => $request->mata_kuliah,
        ]);

        return response()->json([
            'data' => $dosen,
            'message' => 'Dosen created successfully',
        ], 201);
    }

    public function read()
    {
        // Mengambil semua data dosen
        $dosens = Dosen::all();

        return response()->json([
            'data' => $dosens,
            'message' => 'Dosen data fetched successfully',
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nip' => 'string|unique:dosens,nip,' . $id,
            'nama' => 'string|max:255',
            'mata_kuliah' => 'string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Mencari dosen berdasarkan ID
        $dosen = Dosen::find($id);
        if (!$dosen) {
            return response()->json([
                'message' => 'Dosen not found',
            ], 404);
        }

        // Update data dosen
        $dosen->update($request->only(['nip', 'nama', 'mata_kuliah']));

        return response()->json([
            'data' => $dosen,
            'message' => 'Dosen updated successfully',
        ]);
    }

    public function delete($id)
    {
        // Mencari dosen berdasarkan ID
        $dosen = Dosen::find($id);
        if (!$dosen) {
            return response()->json([
                'message' => 'Dosen not found',
            ], 404);
        }

        // Menghapus data dosen
        $dosen->delete();

        return response()->json([
            'message' => 'Dosen deleted successfully',
        ]);
    }
}