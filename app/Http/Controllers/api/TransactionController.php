<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(){
        $user = Auth::user();

        $data = Transaction::with('event','sponsor','status')->where('id_user', $user->id)->get();

        return response()->json($data);
    }

    public function store(Request $request){
        $user = Auth::user();


        $data = [
            'id_event' => $request->id_event,
            'id_sponsor' => $request->id_sponsor,
            'id_user' => $user->id,
            'id_status' => 1
        ];

        $data = Transaction::create($data);

        return response()->json($data);
    }
}
