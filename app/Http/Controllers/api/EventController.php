<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\BenefitLevel;
use App\Models\Event;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class EventController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $events = Event::where('id_user', $user->id)->get();

        return response()->json($events, 200);
    }


    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
            'location' => $request->location,
            'proposal' => $request->proposal,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'id_user' => $request->id_user,
            'image' => $request->image,
        ];

        try {
            $event = Event::create($data);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        }

        return response()->json($event, 201);
    }


    public function show($id)
    {
        $event = Event::with('user')->findOrFail($id);

        return response()->json($event);
    }
}
