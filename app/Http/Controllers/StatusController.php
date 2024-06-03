<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class StatusController extends Controller
{
    public function index(){

        $token =  Cookie::get('token');
        $trans = Http::withToken($token)->get('http://localhost:8080/api/transactions');

        return view('event.status',[
            'transactions' => json_decode($trans)
        ]);
    }
}
