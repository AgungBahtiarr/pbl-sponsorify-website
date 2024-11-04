<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\BenefitLevel;
use App\Models\Event;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

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
        $request->header('Authorization');

        if (!$request->header('Authorization')) {
            return response('Unaunthenticatid', 403);
        }
        // Validasi data event
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'description' => 'required|string|min:10',
            'location' => 'required|string|regex:/^https:\/\/maps\.app\.goo\.gl\/[a-zA-Z0-9]{12,}$/',
            'proposal' => 'required', // max 20MB
            'start_date' => 'required|date|after:today',
            'id_user' => 'required|exists:users,id',
            'image' => 'required', // max 2MB

            // Validasi benefit levels
            'slot1' => 'required|integer|min:1',
            'fund1' => 'required|numeric|min:1',
            'slot2' => 'required|integer|min:1',
            'fund2' => 'required|numeric|min:1',
            'slot3' => 'required|integer|min:1',
            'fund3' => 'required|numeric|min:1',
            'slot4' => 'required|integer|min:1',
            'fund4' => 'required|numeric|min:1',
        ], [
            // Pesan error untuk event
            'name.required' => 'Nama event wajib diisi',
            'name.min' => 'Nama event minimal 3 karakter',
            'name.max' => 'Nama event maksimal 255 karakter',

            'email.required' => 'Email PIC wajib diisi',
            'email.email' => 'Format email tidak valid',

            'description.required' => 'Deskripsi event wajib diisi',
            'description.min' => 'Deskripsi minimal 10 karakter',

            'location.required' => 'Lokasi event wajib diisi',
            'location.regex' => 'Lokasi harus berupa link Google Maps yang valid',

            'proposal.required' => 'Proposal event wajib diupload',
            'proposal.mimes' => 'Proposal harus berformat PDF',
            'proposal.max' => 'Ukuran proposal maksimal 20MB',

            'start_date.required' => 'Tanggal mulai event wajib diisi',
            'start_date.date' => 'Format tanggal tidak valid',
            'start_date.after' => 'Tanggal event harus setelah hari ini',

            'image.required' => 'Poster event wajib diupload',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Poster harus berformat JPG atau PNG',
            'image.max' => 'Ukuran poster maksimal 2MB',

            // Pesan error untuk benefit levels
            'slot1.required' => 'Jumlah slot Platinum wajib diisi',
            'slot1.integer' => 'Jumlah slot harus berupa angka bulat',
            'slot1.min' => 'Jumlah slot minimal 1',

            'fund1.required' => 'Total pendanaan Platinum wajib diisi',
            'fund1.numeric' => 'Total pendanaan harus berupa angka',
            'fund1.min' => 'Total pendanaan minimal 1',

            'slot2.required' => 'Jumlah slot Gold wajib diisi',
            'slot2.integer' => 'Jumlah slot harus berupa angka bulat',
            'slot2.min' => 'Jumlah slot minimal 1',

            'fund2.required' => 'Total pendanaan Gold wajib diisi',
            'fund2.numeric' => 'Total pendanaan harus berupa angka',
            'fund2.min' => 'Total pendanaan minimal 1',

            'slot3.required' => 'Jumlah slot Silver wajib diisi',
            'slot3.integer' => 'Jumlah slot harus berupa angka bulat',
            'slot3.min' => 'Jumlah slot minimal 1',

            'fund3.required' => 'Total pendanaan Silver wajib diisi',
            'fund3.numeric' => 'Total pendanaan harus berupa angka',
            'fund3.min' => 'Total pendanaan minimal 1',

            'slot4.required' => 'Jumlah slot Bronze wajib diisi',
            'slot4.integer' => 'Jumlah slot harus berupa angka bulat',
            'slot4.min' => 'Jumlah slot minimal 1',

            'fund4.required' => 'Total pendanaan Bronze wajib diisi',
            'fund4.numeric' => 'Total pendanaan harus berupa angka',
            'fund4.min' => 'Total pendanaan minimal 1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $eventData = [
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
            // Create event
            $event = Event::create($eventData);

            // Create benefit levels
            $benefitLevels = [
                [
                    'id_event' => $event->id,
                    'level' => 'platinum',
                    'slot' => $request->slot1,
                    'fund' => $request->fund1,
                ],
                [
                    'id_event' => $event->id,
                    'level' => 'gold',
                    'slot' => $request->slot2,
                    'fund' => $request->fund2,
                ],
                [
                    'id_event' => $event->id,
                    'level' => 'silver',
                    'slot' => $request->slot3,
                    'fund' => $request->fund3,
                ],
                [
                    'id_event' => $event->id,
                    'level' => 'bronze',
                    'slot' => $request->slot4,
                    'fund' => $request->fund4,
                ]
            ];

            foreach ($benefitLevels as $level) {
                BenefitLevel::create($level);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Event created successfully',
                'data' => $event
            ], 201);
        } catch (QueryException $e) {
            if (isset($event)) {
                Event::destroy($event->id);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create event',
                'error' => $e->getMessage()
            ]);
        }
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
