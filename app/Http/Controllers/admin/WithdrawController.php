<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WithdrawController extends Controller
{
    public function index()
    {
        $response = Http::get(env("API_URL") . '/api/admin/withdraws');
        $response = json_decode($response);
        return view('admin.withdraw', [
            'datas' => $response,
        ]);
    }

    public function confirmWithdraw(Request $request)
    {
        $data = [
            'id' => $request->id,
            'id_withdraw_status' => $request->id_withdraw_status
        ];

        $response = Http::post(env("API_URL") . '/api/admin/withdraw', $data);

        if ($response->getStatusCode() == 404) {
            return redirect('/admin/withdraw')->with('error', 'Failed to confirm withdraw');
        } else {
            return redirect('admin/withdraw')->with('success', 'Success to confirm withdraw');
        }
    }
}
