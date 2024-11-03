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
            'id_user' => $request->id_user,
            'image' => $request->image,
        ];

        try {
            $event = Event::create($data);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        }


        $benefitPlatinum = [
            'id_event' => $event->id,
            'level' => 'platinum',
            'slot' => $request->slot1,
            'fund' => $request->fund1,
        ];

        $benefitGold = [
            'id_event' => $event->id,
            'level' => "gold",
            'slot' => $request->slot2,
            'fund' => $request->fund2,
        ];

        $benefitSliver = [
            'id_event' => $event->id,
            'level' => 'silver',
            'slot' => $request->slot3,
            'fund' => $request->fund3,
        ];

        $benefitBronze = [
            'id_event' => $event->id,
            'level' => 'bronze',
            'slot' => $request->slot4,
            'fund' => $request->fund4,
        ];


        $levels = [$benefitPlatinum, $benefitGold, $benefitSliver, $benefitBronze];

        foreach ($levels as $level) {
            try {
                BenefitLevel::create($level);
            } catch (QueryException $e) {
                return response()->json($e, 400);
            }
        }


        return response()->json($event, 201);
    }


    public function show($id)
    {
        $event = Event::with('user')->findOrFail($id);

        return response()->json($event);
    }


    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event) {
            $benefits = BenefitLevel::where('id_event', $event->id)->get();
            if ($benefits) {
                foreach ($benefits as $benefit) {
                    $benefit->delete();
                }
            }
        }

        $event->delete();


        return response()->json($event);
    }
}
