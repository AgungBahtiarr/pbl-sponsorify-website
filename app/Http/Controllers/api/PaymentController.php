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
    public function index(Request $request) {
        $user = Auth::user();

        $sponsors = Sponsor::with('category')->where('id_user',$user->id)->first();

        $sponsors = json_decode($sponsors);

        $transactions = Transaction::with('event','sponsor','status')->where('id_sponsor',$sponsors->id)->get();

        return response()->json($transactions);
    }

    public function indexWithdraw(){
        $user = Auth::user();

        $event = Event::where('id_user', $user->id)->first();

        $transactions = Transaction::with('event','sponsor','status')->where('id_event',$event->id)->get();

        return response()->json($transactions);
    }


    public function storeWd(Request $request){
        $id = $request->id;
        $data = [
            'no_rek' => $request->no_rek,
            'bank_name' => $request->bank_name,
            'account_name'=> $request->account_name,
            'id_withdraw_status' => $request->id_withdraw_status
        ];

        $transaction = Transaction::findOrFail($id);
        $transaction->update($data);

        return response()->json($data);
    }

    public function payNow(Request $request){
        $trans = Transaction::findOrFail($request->id);
        $trans->update([
            'id_payment_status' => $request->id_payment_status,
        ]);

        return response()->json($trans);
    }

    public function indexPaymentAdmin(){
        $trans = Transaction::with('event','sponsor','status')->where('id_payment_status','2')->get();

        return response()->json($trans);
    }

    public function indexWithdrawAdmin(){
        $trans = Transaction::with('event','sponsor','status')->where('id_withdraw_status','2')->get();
        return response()->json($trans);
    }

    public function confirmPaymentAdmin(Request $request){

        $data = [
            'id_payment_status' => $request->id_payment_status,
        ];

        $tran = Transaction::findOrFail($request->id);
        $tran->update($data);

        return response()->json($tran);
    }


    public function confirmWithdrawAdmin(Request $request){
        $data = [
            'id_withdraw_status' => $request->id_withdraw_status,
        ];

        $tran = Transaction::findOrFail($request->id);
        $tran->update($data);

        return response()->json($tran);
    }
}
