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
        $id = $request->id;
        $data = [];
        if ($request->id_status == 2) {
            $data = [
                'id' => $id,
                'id_status' => $request->id_status,
                'id_level' => $request->id_level,
                'total_fund' => $request->total_fund,
                'comment' => $request->comment,
            ];

            $level = BenefitLevel::where('id', $request->id)->first();
            $slot = $level->slot;
            $slot = (int)$slot;
            $slot = $slot - 1;
            $level->update([
                'slot' =>  $slot,
            ]);
        } else if ($request->id_status == 3) {
            $data = [
                'id' => $id,
                'id_status' => $request->id_status,
                'comment' => $request->comment,
            ];
        }

        $trans = Transaction::findOrFail($id);
        $trans->update($data);

        return response()->json($trans);
    }
}
