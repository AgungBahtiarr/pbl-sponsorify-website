<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SponsorEventController extends Controller
{
    public function index(){
        return view('sponsor.event');
    }



    public function show(){
        return view('sponsor.detailEvent');
    }
}
