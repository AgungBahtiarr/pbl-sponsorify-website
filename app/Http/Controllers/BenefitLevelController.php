<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBenefitLevelRequest;
use App\Http\Requests\UpdateBenefitLevelRequest;
use App\Models\BenefitLevel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BenefitLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        

        return response()->json([
            'success' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBenefitLevelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BenefitLevel $benefitLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BenefitLevel $benefitLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBenefitLevelRequest $request, BenefitLevel $benefitLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BenefitLevel $benefitLevel)
    {
        //
    }
}
