<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\BenefitLevel;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $data = Transaction::with('event', 'sponsor', 'status', 'level')->where('id_user', $user->id)->get();

        return response()->json($data);
    }

    public function indexSponsor(Request $request)
    {
        $transactions = Transaction::with('event', 'sponsor', 'status', 'level')->where('id_sponsor', $request->id)->get();

        return response()->json($transactions);
    }

    public function indexAdmin(Request $request)
    {
        $transactions = Transaction::with('event', 'sponsor', 'status', 'level')->get();

        return response()->json($transactions);
    }


    public function show($id)
    {
        $transaction = Transaction::with('event', 'sponsor', 'status', 'level')->findOrFail($id);

        return response()->json($transaction);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = [
            'id_event' => $request->id_event,
            'id_sponsor' => $request->id_sponsor,
            'id_user' => $user->id,
            'id_status' => 1,
            'id_payment_status' => 1,
            'id_withdraw_status' => 1,
        ];

        $data = Transaction::create($data);

        return response()->json($data);
    }


    public function update(Request $request)
    {
        try {
            // Validasi panjang comment
            if (strlen($request->comment) < 15) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Teks pesan kurang dari 15 karakter'
                ], 422);
            }

            if (strlen($request->comment) > 255) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Teks pesan lebih dari 255 karakter'
                ], 422);
            }

            $id = $request->id;
            $data = [];

            // Handle Penerimaan Proposal (id_status = 2)
            if ($request->id_status == 2) {
                // Validasi benefit harus dipilih
                if (!$request->id_level) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Benefit belum dipilih'
                    ], 422);
                }

                $data = [
                    'id' => $id,
                    'id_status' => $request->id_status,
                    'id_level' => $request->id_level,
                    'comment' => $request->comment,
                ];

                // Update slot benefit
                $level = BenefitLevel::where('id', $request->id_level)->first();
                if ($level->slot <= 0) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Slot benefit tidak tersedia'
                    ], 422);
                }

                $level->update([
                    'slot' => $level->slot - 1,
                ]);
            }
            // Handle Penolakan Proposal (id_status = 3)
            else if ($request->id_status == 3) {
                $data = [
                    'id' => $id,
                    'id_status' => $request->id_status,
                    'comment' => $request->comment,
                ];
            }

            // Update transaction
            $trans = Transaction::findOrFail($id);
            $trans->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Respon telah terkirim'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
