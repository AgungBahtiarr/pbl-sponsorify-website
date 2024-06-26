<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sponsors = Sponsor::with('category')->get();
        // $sponsors = Sponsor::with('category')->paginate(1);

        return response()->json($sponsors);
    }

    public function currentSponsor(Request $request){
        $sponsors = Sponsor::with('category')->where('id_user',$request->id)->first();
        return response()->json($sponsors);
    }

    public function indexCategory(Request $request){
        $id_category = $request->id_category;

        $sponsors = Sponsor::with('category')->where('id_category',$id_category)->get();

        return response()->json($sponsors);
    }

    public function search(Request $request){
        $str = $request->str;
        $data = Sponsor::with('category')->where('name', 'like', '%' . $str . '%')->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "description"=> $request->description,
            "address" => $request->address,
            "id_category" => $request->id_category,
            "max_submission_date" => $request->max_submission_date,
            "image"=> $request->image,
            "id_user" => $request->id_user
        ];

        try {
            $sponsor = Sponsor::create($data);
        } catch (QueryException $e) {
            return response()->json($e,400);
        }
        return response()->json($sponsor,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sponsor = Sponsor::with('category')->findOrFail($id);

        return response()->json($sponsor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }
}
