<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8080/api/admin/payments');
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

        $response = Http::post('http://localhost:8080/api/admin/payment', $data);
        return redirect('/admin/withdraw');
    }
}
