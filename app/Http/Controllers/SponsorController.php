<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class SponsorController extends Controller
{


    public function index(){
        return view('sponsor.dashboard');
    }

    public function indexAddSponsor(){
        $categories = Http::get('http://localhost:8080/api/categories');
        $responseCat = json_decode($categories);

        $authUser = User::where('id', Cookie::get('authUser'))->first();


        $isFirst = Sponsor::where('id_user', $authUser->id)->get();

        if ($isFirst) {
            return view("sponsor.addSponsor",[
                'authUser'=> $authUser,
                'categories' => $responseCat
            ]);
        }else {
            return redirect("/sponsor/dashboard");
        }

    }


    public function store(Request $request){

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "description"=> $request->description,
            "address" => $request->address,
            "id_category" => $request->category,
            "max_submission_date" => $request->maxSubmissionDate,
            "image"=> $request->image,
            "id_user" => $request->idUser
        ];


        $response = Http::post("http://localhost:8080/api/sponsor",$data);

        if ($response->getStatusCode() == 201) {
            return redirect('/sponsor/dashboard');
        }else{
            return redirect('/auth/sponsor');
        }
    }
}
