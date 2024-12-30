<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function index()
    {
        $response = Http::get(env("API_URL") . '/api/admin/payments');
        $response = json_decode($response);

        return view('admin.payment', [
            'datas' => $response
        ]);
    }

    public function confirmPayment(Request $request)
    {
        $data = [
            'id' => $request->id,
            'id_payment_status' => $request->id_payment_status
        ];

        $response = Http::post(env("API_URL") . '/api/admin/payment', $data);

        if ($response->getStatusCode() == 404) {
            return redirect('/admin/payment')->with('error', 'Failed to confirm payment');
        } else {
            return redirect('/admin/withdraw');
        }
    }
}
