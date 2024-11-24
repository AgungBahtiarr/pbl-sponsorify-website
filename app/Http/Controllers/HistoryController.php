<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class HistoryController extends Controller
{
    public function indexSponsor(){
        $idUser = Cookie::get('authUser');
        $currentSponsor = Http::post(env('API_URL').'/api/sponsor/currentSponsor',['id'=>$idUser]);
        $currentSponsor = json_decode($currentSponsor);

        $transactions = Http::post(env('API_URL').'/api/transactions/sponsor',['id'=>$currentSponsor->id]);
        $transactions = json_decode($transactions);
        $history = [];

        foreach($transactions as $transaction){
            if($transaction->id_user == $currentSponsor->id && ($transaction->id_status == 2 || $transaction->id_status == 3)){
                array_push($history,$transaction);
            }
        }

        // return $history;
        return view('sponsor.history',[
            'histories' => $history,
        ]);
    }
}
