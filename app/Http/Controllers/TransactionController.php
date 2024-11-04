<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{

    public function indexDetail($id)
    {
        $token =  Cookie::get('token');
        $events = Http::withToken($token)->get('http://localhost:8080/api/events');
        $idSponsor = $id;

        $sponsor = Http::get('http://localhost:8080/api/sponsor/' . $id);

        return view('event.detail', [
            'events' => json_decode($events),
            'idSponsor' => $idSponsor,
            'sponsor' => json_decode($sponsor)
        ]);
    }
    public function store(Request $request)
    {
        $data = [
            'id_event' => $request->id_event,
            'id_sponsor' => $request->id_sponsor,
        ];
        $token =  Cookie::get('token');
        $trans = Http::withToken($token)->post('http://localhost:8080/api/transaction', $data);

        return redirect('/event/sponsors/');
    }

    public function update(Request $request)
{
    try {
        // Validasi panjang pesan
        if (strlen($request->comment) < 15) {
            return redirect('/event/detail')
                ->with('error', 'Teks pesan kurang dari 15 karakter');
        }

        $data = [
            'id' => $request->id,
            'id_status' => $request->id_status,
            'comment' => $request->comment,
            'id_level' => $request->id_level
        ];

        $response = Http::patch('http://localhost:8080/api/transaction', $data);

        if ($response->successful()) {
            if ($request->id_status == 2) { // Terima proposal
                return redirect('/sponsor/payment')
                    ->with('success', 'Respon telah terkirim');
            } else { // Tolak proposal
                return redirect('/event/detail')
                    ->with('success', 'Respon telah terkirim');
            }
        }

        return redirect('/event/detail')
            ->with('error', $response->json()['message'] ?? 'Terjadi kesalahan');

    } catch (\Exception $e) {
        return redirect('/event/detail')
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
}
