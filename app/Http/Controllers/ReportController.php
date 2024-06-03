<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;


class ReportController extends Controller
{
    public function index(){
        $token =  Cookie::get('token');
        $trans = Http::withToken($token)->get('http://localhost:8080/api/transactions');
        $trans = json_decode($trans);
        $data = [];
        foreach ($trans as $item ) {
          if ($item->id_status == 2) {
            $data[] = $item;
          }
        };

        return view('event.report',[
            'data' => $data
        ]);
    }
}
