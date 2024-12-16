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
        // Mengambil data transaksi berdasarkan ID
        $transactionResponse = Http::get(env('API_URL').'/api/transaction/' . $id);
        $transaction = json_decode($transactionResponse->body());

        // Cek jika transaksi tidak ditemukan atau data transaksi null
        if (!$transaction || !isset($transaction->event)) {
            return view('sponsor.detaileventnotfound'); // Tampilkan halaman not found
        }

        // Mengambil data event berdasarkan ID yang ada di transaksi
        $eventResponse = Http::get(env('API_URL').'/api/event/' . $transaction->event->id);
        $event = json_decode($eventResponse->body());

        // Jika event tidak ditemukan atau data event kosong
        if (!$event) {
            return view('sponsor.detaileventnotfound'); // Tampilkan halaman not found
        }

        // Mengambil data levels yang terkait dengan event
        $levels = BenefitLevel::where('id_event', $transaction->event->id)->get();

        // Menampilkan detail event
        return view('sponsor.detailEvent', [
            'transaction' => $transaction,
            'event' => $event,
            'levels' => $levels
        ]);
    }
}
