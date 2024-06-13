<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $report = Report::with('transaction')->get();

        return response()->json($report);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'report' => $request->report,
            'id_transaction' => $request->id_transaction
        ];

        $report = Report::create($data);

        return response()->json($report);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
