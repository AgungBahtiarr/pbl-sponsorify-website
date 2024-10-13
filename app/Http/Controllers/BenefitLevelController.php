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
        $benefitPlatinum = [
            'id_event' => $request->id_event,
            'level' => $request->level1,
            'slot' => $request->slot1,
            'fund' => $request->fund1,
        ];

        $benefitGold = [
            'id_event' => $request->id_event,
            'level' => $request->level2,
            'slot' => $request->slot2,
            'fund' => $request->fund2,
        ];

        $benefitSliver = [
            'id_event' => $request->id_event,
            'level' => $request->level3,
            'slot' => $request->slot3,
            'fund' => $request->fund3,
        ];

        $benefitBronze = [
            'id_event' => $request->id_event,
            'level' => $request->level4,
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
