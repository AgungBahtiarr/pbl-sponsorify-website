<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    public function index()
    {
        $token = Cookie::get('token');
        $authUser = Cookie::get('authUser');
        $transactions = Http::withToken($token)->get('http://localhost:8080/api/transactions');
        $transactions = json_decode($transactions);

        $events = Http::withToken($token)->get('http://localhost:8080/api/events');
        $events = json_decode($events);
        $reports = Http::get('http://localhost:8080/api/reports');
        $reports = json_decode($reports);


        $myreports = [];

        foreach($reports as $report){
            if ($report->transaction->id_user == $authUser) {
                array_push($myreports,$report);
            }
        }


        $fixreports = [];

        foreach($myreports as $report){
            foreach($events as $event){
                if ($report->transaction->id_event == $event->id) {
                    array_push($fixreports,[$report,$event]);
                }
            }
        }

//return $fixreports;
        return view('event.dashboard',[
            'transactions' => $transactions,
            'reports' => $fixreports,
        ]);
    }

    public function indexMyEvent()
    {

        $token =  Cookie::get('token');
        $events = Http::withToken($token)->get('http://localhost:8080/api/events');
        if ($events === null) {
            $events = [];
        } else {
            $events = json_decode($events);
        }


        return view('event.my_event', [
            'events' => $events
        ]);
    }

    public function storeEvent(Request $request)
    {
        $idUser = Cookie::get('authUser');

        $file = $request->file('proposal');
        $fileName = $idUser . '.' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('proposal'), $fileName);
        $filePath = 'proposal/' . $fileName;

        $image = $request->file('image');
        $imageName = $idUser . '.' . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('image'), $imageName);
        $imagePath = 'image/' . $imageName;

        $location = $request->desa . ' ' . $request->kecamatan . ' ' . $request->kabupaten;

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
            'location' => $location,
            'proposal' => $filePath,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'id_user' => $idUser,
            'image' => $imagePath,
        ];

        $response = Http::post('http://localhost:8080/api/event', $data);

        return redirect('/event/my_event');
    }
}
