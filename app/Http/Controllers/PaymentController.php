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

        return view('sponsor.payment',[
            'data' => $response
        ]);
    }

    public function indexWithdraw(){
        return view('event.Withdraw');
    }
}
