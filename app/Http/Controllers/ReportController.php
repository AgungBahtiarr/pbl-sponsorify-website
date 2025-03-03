<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;


class ReportController extends Controller
{
    public function indexEvent(){
        $token =  Cookie::get('token');
        $trans = Http::withToken($token)->get(env('API_URL').'/api/transactions');
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

    public function storeEvent(Request $request)
    {
        $data = [
            'report' => $request->report,
            'id_transaction' => $request->id_transaction
        ];

        $response = Http::post(env('API_URL').'/api/report', $data);
        $result = json_decode($response->body());

        // Redirect dengan pesan yang sesuai
        if ($response->successful()) {
            return redirect('/event/report')->with('success', $result->message);
        } else {
            return redirect('/event/report')->with('error', $result->message);
        }
    }

    public function indexSponsor(){
        $token = Cookie::get('token');
        $idUser = Cookie::get('authUser');
        $response = Http::withToken($token)->get(env('API_URL').'/api/reports');
        $response = json_decode($response);
        $currentSponsor = Http::post(env('API_URL').'/api/sponsor/currentSponsor',['id'=>$idUser]);
        $currentSponsor = json_decode($currentSponsor);
        $reports = [];
        $trans = [];
        $data = [];
        $transactions = Http::post(env('API_URL').'/api/transactions/sponsor',['id'=>$currentSponsor->id]);
        $transactions = json_decode($transactions);

        foreach($response as $item){
            if ($item->transaction->id_sponsor == $currentSponsor->id) {
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


        return view('sponsor.report',[
            'data' => $data,
        ]);
    }
}
