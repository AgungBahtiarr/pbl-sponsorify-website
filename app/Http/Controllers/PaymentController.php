<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function index(){
        $token = Cookie::get('token');

        $response = Http::withToken($token)->get('http://localhost:8080/api/payments');

        $response = json_decode($response);
        $data = [];

        foreach ($response as $item){
        if($item->id_status == 2 && ($item->id_payment_status == 1 || $item->id_payment_status == 2)){
        array_push($data,$item);
        }
        }

        return view('sponsor.payment',[
            'data' => $data,
        ]);
    }

    public function indexWithdraw(){
        $token =  Cookie::get('token');
        $response =  Http::withToken($token)->get('http://localhost:8080/api/withdraws');
        $response = json_decode($response);
        $transactions = [];

        foreach($response as $item){
            if($item->id_status == 2 && $item->id_payment_status == 3 && ($item->id_withdraw_status == 1 || $item->id)){
                array_push($transactions, $item);
            }
        }

        return view('event.Withdraw',[
            'data' => $transactions,
        ]);
    }

    public function storeWd(Request $request){
        $data = [
            'id' => $request->id,
            'no_rek' => $request->no_rek,
            'bank_name' => $request->bank_name,
            'account_name'=> $request->account_name,
            'id_withdraw_status' => 2,
        ];

        $response = Http::post('http://localhost:8080/api/withdraw',$data);

        return redirect('/event/withdraw');
    }

    public function payNow(Request $request){
        $data = [
            'id' => $request->id,
            'id_payment_status' => 2,
        ];

        $response = Http::post('http://localhost:8080/api/payment/payNow',$data);

        return redirect('https://sponsorify.lemonsqueezy.com/buy/65b8d897-5fe3-4242-94b0-3b133d354094');
    }
}
