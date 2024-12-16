<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Sponsor;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $sponsors = Sponsor::with('category')->where('id_user', $user->id)->first();

        $sponsors = json_decode($sponsors);

        $transactions = Transaction::with('event', 'sponsor', 'status', 'level')->where('id_sponsor', $sponsors->id)->get();

        return response()->json($transactions);
    }

    public function indexWithdraw()
    {
        $user = Auth::user();

        // $event = Event::where('id_user', $user->id)->first();

        $transactions = Transaction::with('event', 'sponsor', 'status', 'level')->get();

        return response()->json($transactions);
    }


    public function storeWd(Request $request)
    {
        try {
            // Validasi semua field tidak boleh kosong
            if (empty($request->no_rek) || empty($request->bank_name) || empty($request->account_name)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Semua field wajib diisi'
                ], 422);
            }

            // Validasi nomor rekening
            if (strlen($request->no_rek) < 10) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nomor rekening minimal 10 karakter'
                ], 422);
            }
            if (strlen($request->no_rek) > 15) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nomor rekening maksimal 15 karakter'
                ], 422);
            }

            // Validasi nama bank
            if (strlen($request->bank_name) < 3) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nama bank minimal 3 karakter'
                ], 422);
            }
            if (strlen($request->bank_name) > 20) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nama bank maksimal 20 karakter'
                ], 422);
            }

            // Validasi bank terdaftar
            $validBanks = [
                'BCA',
                'BNI',
                'BRI',
                'MANDIRI',
                'BTN',
                'CIMB NIAGA',
                'DANAMON',
                'PERMATA',
                'OCBC NISP',
                'MAYBANK',
                'BANK SYARIAH INDONESIA',
                'MEGA',
                'BTPN',
                'SINARMAS',
                'BJB',
                'BANK SYARIAH INDO'
            ];

            if (!in_array(strtoupper($request->bank_name), $validBanks)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bank tidak terdaftar'
                ], 422);
            }

            // Validasi nama pengguna
            if (strlen($request->account_name) < 3) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nama pengguna minimal 3 karakter'
                ], 422);
            }
            if (strlen($request->account_name) > 50) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nama pengguna maksimal 50 karakter'
                ], 422);
            }

            $transaction = Transaction::findOrFail($request->id);
            $transaction->update([
                'no_rek' => $request->no_rek,
                'bank_name' => strtoupper($request->bank_name),
                'account_name' => $request->account_name,
                'id_withdraw_status' => $request->id_withdraw_status
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menyimpan data pencairan',
                'data' => $transaction
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }


    public function payNow(Request $request)
    {
        $trans = Transaction::findOrFail($request->id);
        $trans->update([
            'id_payment_status' => $request->id_payment_status,
        ]);

        return response()->json($trans);
    }

    public function indexPaymentAdmin()
    {
        $trans = Transaction::with('event', 'sponsor', 'status', 'payment', 'level')->where('id_payment_status', '2')->get();

        return response()->json($trans);
    }

    public function indexWithdrawAdmin()
    {
        $trans = Transaction::with('event', 'sponsor', 'status', 'withdraw', 'level')->where('id_withdraw_status', '2')->get();
        return response()->json($trans);
    }

    public function confirmPaymentAdmin(Request $request)
    {
        $data = [
            'id_payment_status' => $request->id_payment_status,
            'payment_date' => now()
        ];
        $tran = Transaction::findOrFail($request->id);
        $tran->update($data);

        return response()->json($tran);
    }


    public function confirmWithdrawAdmin(Request $request)
    {
        $data = [
            'id_withdraw_status' => $request->id_withdraw_status,
            'withdraw_date' => now()
        ];

        $tran = Transaction::findOrFail($request->id);
        $tran->update($data);

        return response()->json($tran);
    }
}
