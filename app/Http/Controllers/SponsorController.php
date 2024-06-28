<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class SponsorController extends Controller
{


    public function index(){
        $idUser = Cookie::get('authUser');
        $currentSponsor = Http::post('http://localhost:8080/api/sponsor/currentSponsor',['id'=>$idUser]);
        $currentSponsor = json_decode($currentSponsor);

        $transactions = Http::post('http://localhost:8080/api/transactions/sponsor',['id'=>$currentSponsor->id]);
        $transactions = json_decode($transactions);

        $reports = Http::get('http://localhost:8080/api/reports');
        $reports = json_decode($reports);

        $reportDone = [];
        foreach($reports as $report){
            if($report->transaction->id_sponsor == $currentSponsor->id){
                array_push($reportDone, $report);
            }
        }


        $proposalIn = [];

        foreach($transactions as $transaction){
            if ($transaction->id_status == 1) {
                array_push($proposalIn,$transaction);
            }
        }

        $history = [];

        foreach($transactions as $transaction){
            if($transaction->id_user == $currentSponsor->id && ($transaction->id_status == 2 || $transaction->id_status == 3)){
                array_push($history,$transaction);
            }

            if (count($history) >= 4) {
                break;
            }
        }
 // return $history;
        return view('sponsor.dashboard',[
            'report' => $reportDone,
            'proposalIn' => $proposalIn,
            'history' => $history,
        ]);
    }


    public function indexAddSponsor()
    {
        $categories = Http::get('http://localhost:8080/api/categories');
        $responseCat = json_decode($categories);

        // Ini masih pake eloquent harusnya dari api
        $authUser = User::where('id', Cookie::get('authUser'))->first();


        $isFirst = Sponsor::where('id_user', $authUser->id)->get();

        if (count($isFirst) != 0) {
            return redirect("/sponsor/dashboard");
        } else {
            return view("sponsor.addSponsor", [
                'authUser' => $authUser,
                'categories' => $responseCat
            ]);
        }
    }


    public function store(Request $request)
    {

        $file = $request->file('image');
        $fileName = $request->idUser . '.' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('image'), $fileName);
        $filePath = 'image/' . $fileName;


        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "description" => $request->description,
            "address" => $request->address,
            "id_category" => $request->category,
            "max_submission_date" => $request->maxSubmissionDate,
            "image" => $filePath,
            "id_user" => $request->idUser
        ];


        $response = Http::post("http://localhost:8080/api/sponsor", $data);

        if ($response->getStatusCode() == 201) {
            return redirect('/sponsor/dashboard');
        } else {
            return redirect('/auth/sponsor');
        }
    }

    public function indexSearchSponsor(Request $request)
    {

        $id_category = $request->id_category;
        $str = $request->str;



        $categories = Http::get("http://localhost:8080/api/categories");


        if ($id_category == null && $str == null) {
            $response = Http::get('http://localhost:8080/api/sponsors');
        } else if ($str != null) {
            $response = Http::post('http://localhost:8080/api/sponsor/search', ['str' => $str]);
        } else {
            $response = Http::post(
                'http://localhost:8080/api/sponsor/categories',
                [
                    'id_category' => $id_category
                ]
            );
        }
        return view('event.sponsor', [
            'categories' => json_decode($categories),
            'data' => json_decode($response),
        ]);
    }
}
