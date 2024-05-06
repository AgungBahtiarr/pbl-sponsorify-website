<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    public function index(){
        return view('event.dashboard');
    }

    public function indexMyEvent(){

        $token =  Cookie::get('token');


        $events = Http::withToken($token)->get('http://localhost:8080/api/events');

        return view('event.my_event',[
            'events' => json_decode($events)
        ]);
    }

    public function storeEvent(Request $request){
        $idUser = Cookie::get('authUser');

        $file = $request->file('proposal');
        $fileName = $idUser . '.' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('proposal'), $fileName);
        $filePath = 'proposal/' . $fileName;

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'proposal' => $filePath,
            'start_date' => $request->start_date,
            'id_user' => $idUser
        ];

        $response = Http::post('http://localhost:8080/api/event',$data);

        return redirect('/event/my_event');
    }
}
