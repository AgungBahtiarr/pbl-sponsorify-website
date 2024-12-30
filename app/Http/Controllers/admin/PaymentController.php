<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function index()
    {
        $response = Http::get(env("API_URL") . '/api/admin/payments');
        $response = json_decode($response);

        return view('admin.payment', [
            'datas' => $response
        ]);
    }

    public function confirmPayment(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required|integer|exists:transactions,id', // Validasi ID transaksi
            'id_payment_status' => 'required|integer|in:1,2,3', // Validasi status pembayaran
        ]);

        // Ambil transaksi berdasarkan ID
        $transaction = Transaction::find($request->id);

        // Cek apakah transaksi ditemukan
        if (!$transaction) {
            return response()->json([
                'error' => 'Transaction not found'
            ], 404);
        }

        // Cek jika pembayaran sudah dikonfirmasi sebelumnya
        if ($transaction->id_payment_status == 3) { // Jika status sudah 3 (sudah dibayar)
            return response()->json([
                'error' => 'Payment already confirmed'
            ], 400);
        }

        // Update status pembayaran
        $transaction->id_payment_status = $request->id_payment_status;
        $transaction->save();

        // Kembalikan respons sukses
        return response()->json([
            'message' => 'Payment confirmed successfully',
            'id_payment_status' => $transaction->id_payment_status,
        ], 200);
    }
}
