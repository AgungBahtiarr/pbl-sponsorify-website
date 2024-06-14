<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class HistoryController extends Controller
{
    public function index(){
        $token = Cookie::get('token');
        $idUser = Cookie::get('authUser');
        $response = Http::withToken($token)->get('http://localhost:8080/api/reports');
        $response = json_decode($response);
        $currentSponsor = Http::post('http://localhost:8080/api/sponsor/currentSponsor',['id'=>$idUser]);
        $currentSponsor = json_decode($currentSponsor);
        $reports = [];
        $trans = [];
        $data = [];
        $transactions = Http::post('http://localhost:8080/api/transactions/sponsor',['id'=>$currentSponsor->id]);
        $transactions = json_decode($transactions);
        foreach($response as $item){
            if ($item->transaction->id_user == $currentSponsor->id) {
                array_push($reports, $item);
            }
        }

            foreach($reports as $report){
            foreach($transactions as $tran){
                if($report->id_transaction == $tran->id && $tran->id_status != 3){
                    //array_push($trans,$tran);
                    array_push($data,[$report,$tran]);
                }
                }
        }
        return view('sponsor.history',[
            'data' => $data,
        ]);
    }
}
