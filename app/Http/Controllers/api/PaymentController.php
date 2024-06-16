<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();

        $sponsors = Sponsor::with('category')->where('id_user',$user->id)->first();

        $sponsors = json_decode($sponsors);

        $transactions = Transaction::with('event','sponsor','status')->where('id_sponsor',$sponsors->id)->get();

        return response()->json($transactions);
    }
}
