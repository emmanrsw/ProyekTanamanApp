<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transkasiModel;
use Illuminate\Support\Facades\Storage;

class transaksiController extends Controller{

        // Tambah Transaksi
        public function store(Request $request)
        {
            $request->validate([
                'idCust' => 'required|exists:customers,id', // Sesuaikan tabel customer jika berbeda
                'idKywn' => 'required|exists:karyawan,id', // Sesuaikan tabel karyawan jika berbeda
                'tglTJual' => 'required|date',
                'waktuTJual' => 'required|date_format:H:i:s',
                'metodeByr' => 'required|string',
                'statusTjual' => 'required|string',
            ]);
    
            $transaksi = transkasiModel::create([
                'idCust' => $request->idCust,
                'idKywn' => $request->idKywn,
                'tglTJual' => $request->tglTJual,
                'waktuTJual' => $request->waktuTJual,
                'metodeByr' => $request->metodeByr,
                'statusTjual' => $request->statusTjual,
            ]);
    
            return response()->json(['message' => 'Transaksi berhasil dibuat', 'data' => $transaksi], 201);
        }
    
        // Lihat Semua Transaksi
        public function index()
        {
            $transaksi = transkasiModel::all();
            return response()->json($transaksi);
        }
    
        // Update Status Transaksi
        public function updateStatus(Request $request, $idTJual)
        {
            $request->validate([
                'statusTjual' => 'required|string'
            ]);
    
            $transaksi = transkasiModel::findOrFail($idTJual);
            $transaksi->statusTjual = $request->statusTjual;
            $transaksi->save();
    
            return response()->json(['message' => 'Status transaksi berhasil diperbarui', 'data' => $transaksi]);
        }

}