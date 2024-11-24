<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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

        foreach ($reports as $report) {
            if ($report->transaction->id_user == $authUser) {
                array_push($myreports, $report);
            }
        }


        $fixreports = [];

        foreach ($myreports as $report) {
            foreach ($events as $event) {
                if ($report->transaction->id_event == $event->id) {
                    array_push($fixreports, [$report, $event]);
                }
            }
        }

        //return $fixreports;
        return view('event.dashboard', [
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

    public function storeFormSatu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'description' => 'required|string|min:10',
            'location' => 'required|regex:/^https:\/\/maps\.app\.goo\.gl\/[a-zA-Z0-9]{12,}$/',
            'venue_name' => 'required|string|min:5|max:100',
            'start_date' => 'required|date|after:today',
            'proposal' => 'required|file|mimes:pdf|max:20480',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name.required' => 'Nama acara wajib diisi',
            'name.min' => 'Nama event minimal 3 karakter',
            'name.max' => 'Nama acara maksimal 255 karakter',


            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',

            'description.required' => 'Deskripsi acara wajib diisi',
            'description.min' => 'Deskripsi minimal 10 karakter',

            'location.required' => 'Alamat wajib diisi',
            'location.regex' => 'Format link Google Maps tidak valid',

            'venue_name.required' => 'Nama Venue acara wajib diisi',
            'venue_name.min' => 'Nama Venue event minimal 5 karakter',
            'venue_name.max' => 'Nama Venue acara maksimal 100 karakter',

            'start_date.required' => 'Tanggal mulai wajib diisi',
            'start_date.date' => 'Format tanggal tidak valid',
            'start_date.after' => 'Tanggal event tidak boleh di masa lalu',

            'proposal.required' => 'Proposal wajib diunggah',
            'proposal.mimes' => 'File proposal harus berformat PDF',
            'proposal.max' => 'Ukuran file proposal maksimal 20MB',

            'image.required' => 'Poster acara wajib diunggah',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'File poster harus berformat JPG atau PNG',
            'image.max' => 'Ukuran file poster maksimal 2MB'
        ]);

        if ($validator->fails()) {
            $errMessage = "";

            $errors = $validator->errors();
            foreach ($errors->all() as $error) {
                $errMessage .= $error . ' ';
            }

            return redirect('/event/formSatu')
                ->withErrors(['message' => $errMessage])
                ->withInput();
        }

        try {
            $idUser = Cookie::get('authUser');

            if (!$idUser) {
                return redirect('/event/formSatu')->withErrors(['message' => 'User tidak terautentikasi']);
            }

            // Proses file proposal
            $file = $request->file('proposal');
            $fileName = $idUser . '.' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('proposal'), $fileName);
            $filePath = 'proposal/' . $fileName;

            // Proses file gambar
            $image = $request->file('image');
            $imageName = $idUser . '.' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $imageName);
            $imagePath = 'image/' . $imageName;

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'description' => $request->description,
                'location' => $request->location,
                'venue_name' => $request->venue_name,
                'proposal' => $filePath,
                'start_date' => $request->start_date,
                'id_user' => $idUser,
                'image' => $imagePath,
            ];

            $request->session()->put('formSatu', $data);

            return redirect('/event/formDua');
        } catch (\Exception $e) {
            // Hapus file yang sudah diupload jika ada error
            if (isset($filePath) && file_exists(public_path($filePath))) {
                unlink(public_path($filePath));
            }
            if (isset($imagePath) && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            return redirect('/event/formSatu')
                ->withErrors(['message' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }


    public function storeEvent(Request $request)
    {

        $token = Cookie::get('token');
        $validator = Validator::make($request->all(), [
            'fund1' => 'required|numeric|min:100000',
            'fund2' => 'required|numeric|min:100000',
            'fund3' => 'required|numeric|min:100000',
            'fund4' => 'required|numeric|min:100000',
            'slot1' => 'required|integer|min:1',
            'slot2' => 'required|integer|min:1',
            'slot3' => 'required|integer|min:1',
            'slot4' => 'required|integer|min:1',
        ], [
            'fund1.required' => 'Total pendanaan Platinum wajib diisi',
            'fund1.numeric' => 'Total pendanaan Platinum harus berupa angka',
            'fund1.min' => 'Total pendanaan Platinum minimal Rp. 100.000',

            'fund2.required' => 'Total pendanaan Gold wajib diisi',
            'fund2.numeric' => 'Total pendanaan Gold harus berupa angka',
            'fund2.min' => 'Total pendanaan Gold minimal Rp. 100.000',

            'fund3.required' => 'Total pendanaan Silver wajib diisi',
            'fund3.numeric' => 'Total pendanaan Silver harus berupa angka',
            'fund3.min' => 'Total pendanaan Silver minimal Rp. 100.000',

            'fund4.required' => 'Total pendanaan Bronze wajib diisi',
            'fund4.numeric' => 'Total pendanaan Bronze harus berupa angka',
            'fund4.min' => 'Total pendanaan Bronze minimal Rp. 100.000',

            'slot1.required' => 'Jumlah slot Platinum wajib diisi',
            'slot1.integer' => 'Jumlah slot Platinum harus berupa angka bulat',
            'slot1.min' => 'Jumlah slot Platinum minimal 1',

            'slot2.required' => 'Jumlah slot Gold wajib diisi',
            'slot2.integer' => 'Jumlah slot Gold harus berupa angka bulat',
            'slot2.min' => 'Jumlah slot Gold minimal 1',

            'slot3.required' => 'Jumlah slot Silver wajib diisi',
            'slot3.integer' => 'Jumlah slot Silver harus berupa angka bulat',
            'slot3.min' => 'Jumlah slot Silver minimal 1',

            'slot4.required' => 'Jumlah slot Bronze wajib diisi',
            'slot4.integer' => 'Jumlah slot Bronze harus berupa angka bulat',
            'slot4.min' => 'Jumlah slot Bronze minimal 1'
        ]);

        if ($validator->fails()) {
            $errMessage = "";

            $errors = $validator->errors();
            foreach ($errors->all() as $error) {
                $errMessage .= $error . ' ';
            }
            return redirect("/event/formDua")
                ->withErrors(["message" => $errMessage])
                ->withInput();
        }

        $formSatu = $request->session()->get('formSatu');
        if (!$formSatu) {
            return redirect('/event/formSatu')
                ->withErrors(['message' => 'Silahkan isi data event terlebih dahulu']);
        }

        try {

            $formDua = [
                'fund1' => $request->fund1,
                'slot1' => $request->slot1,
                'fund2' => $request->fund2,
                'slot2' => $request->slot2,
                'fund3' => $request->fund3,
                'slot3' => $request->slot3,
                'fund4' => $request->fund4,
                'slot4' => $request->slot4
            ];

            $data = array_merge($formSatu, $formDua);

            $response = Http::withToken($token)->post('http://localhost:8080/api/event', $data);


            if ($response->status() == 201) {
                $request->session()->forget('formSatu');
                return redirect('/event/my_event')->with('success', 'Event berhasil dibuat');
            } else {
                return redirect('/event/formSatu')
                    ->withErrors(['message' => 'Terjadi kesalahan saat membuat event'])
                    ->withInput();
            }
        } catch (\Exception $e) {
            return redirect('/event/formSatu')
                ->withErrors(['message' => 'Terjadi kesalahan'])
                ->withInput();
        }
    }

    public function indexFormSatu()
    {
        return view('event.form.form1');
    }

    public function indexFormDua()
    {
        return view('event.form.form2');
    }

    public function destroy($id)
    {
        $response = Http::delete('http://localhost:8080/api/event/' . $id);

        // return $response;
        return redirect('/event/my_event');
    }
}
