<?php

namespace App\Http\Controllers;

use App\Models\transaksiModel;
use Illuminate\Http\Request;
use App\Models\transkasiModel;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{

    public function show()
    {
        return view('transaksi');
    }


    public function bayar(Request $request)
    {
        // Logika pembayaran
        // Misalnya, menyimpan data transaksi ke database
        // $request->input('amount'); // Contoh input jumlah pembayaran

        return redirect()->route('transaksi.show')->with('success', 'Pembayaran berhasil!');
    }


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

        $transaksi = transaksiModel::create([
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
        $transaksi = transaksiModel::all();
        return response()->json($transaksi);
    }

    // Update Status Transaksi
    public function updateStatus(Request $request, $idTJual)
    {
        $request->validate([
            'statusTjual' => 'required|string'
        ]);

        $transaksi = transaksiModel::findOrFail($idTJual);
        $transaksi->statusTjual = $request->statusTjual;
        $transaksi->save();

        return response()->json(['message' => 'Status transaksi berhasil diperbarui', 'data' => $transaksi]);
    }
}
