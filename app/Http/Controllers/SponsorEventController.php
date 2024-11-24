<?php

namespace App\Http\Controllers;

use App\Models\BenefitLevel;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class SponsorEventController extends Controller
{
    public function index()
    {
        $token = Cookie::get('token');
        $idAuthUSer = Cookie::get('authUser');
        $authUser = Http::withToken($token)->get(env('API_URL').'/api/authUser');
        $authUser = json_decode($authUser);

        $sponsor = Http::post(env('API_URL').'/api/sponsor/currentSponsor', ['id' => $idAuthUSer]);
        $sponsor = json_decode($sponsor);
        $transaction = Http::post(env('API_URL').'/api/transactions/sponsor', ['id' => $sponsor->id]);
        $transaction = json_decode($transaction);

        $transactionfix = [];
        foreach ($transaction as $item) {
            if ($item->id_status == 1) {
                array_push($transactionfix, $item);
            }
        };

        return view('sponsor.event', [
            'transactions' => $transactionfix,
        ]);
    }

    public function show($id)
    {
        $transaction = Http::get(env('API_URL').'/api/transaction/' . $id);
        $transaction = json_decode($transaction);
        $event = Http::get(env('API_URL').'/api/event/' . $transaction->event->id);



        $levels = BenefitLevel::where('id_event',  $transaction->event->id)->get();

        return view('sponsor.detailEvent', [
            'transaction' => $transaction,
            'event' => json_decode($event),
            'levels' => $levels
        ]);
    }
}
