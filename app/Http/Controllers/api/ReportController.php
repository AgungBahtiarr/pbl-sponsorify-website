<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Transaction;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $report = Report::with('transaction')->get();

        return response()->json($report);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        // Validasi input kosong (prioritas pertama)
        if (empty($request->report)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Link laporan wajib diisi'
            ], 422);
        }

        // Cek apakah sudah ada laporan (prioritas kedua)
        $existingReport = Report::where('id_transaction', $request->id_transaction)->first();
        if ($existingReport) {
            return response()->json([
                'status' => 'error',
                'message' => 'Laporan sudah pernah dikirim'
            ], 422);
        }

        // Validasi format link Google Drive (prioritas ketiga)
        if (!str_contains($request->report, 'drive.google.com')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Link harus dari Google Drive'
            ], 422);
        }

        // Cek status transaksi
        $transaction = Transaction::findOrFail($request->id_transaction);
        if ($transaction->id_status != 2) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak dapat mengirim laporan karena event belum diterima'
            ], 422);
        }

        // Simpan laporan
        $report = Report::create([
            'report' => $request->report,
            'id_transaction' => $request->id_transaction
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Laporan berhasil dikirim',
            'data' => $report
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
