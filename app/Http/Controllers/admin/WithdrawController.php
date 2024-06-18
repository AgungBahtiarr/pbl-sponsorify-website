<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WithdrawController extends Controller
{
    public function index(){
        $response = Http::get('http://localhost:8080/api/admin/withdraws');
        $response = json_decode($response);
        return view('admin.withdraw',[
            'datas' => $response,
        ]);
    }

    public function confirmWithdraw(Request $request){
        $data = [
            'id' => $request->id,
            'id_withdraw_status' => $request->id_withdraw_status
        ];

        $response = Http::post('http://localhost:8080/api/admin/withdraw',$data);

        return redirect('admin/withdraw');
    }
}
