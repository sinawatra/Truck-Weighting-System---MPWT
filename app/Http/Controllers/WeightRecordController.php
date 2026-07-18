<?php

namespace App\Http\Controllers;

use App\Models\WeightRecord;
use Illuminate\Http\Request;

class WeightRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            "data" => WeightRecord::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $weightRecord = WeightRecord::create([
            'truck_id' => $request->truck_id,
            'station_id' => $request->station_id,
            'weight' => $request->weight,
            'weight_type' => $request->weight_type
        ]);
        return response()->json([
            "message" => "Weight record created successfully",
            "data" => $weightRecord
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(WeightRecord $weightRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WeightRecord $weightRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WeightRecord $weightRecord)
    {
        //
        $weightRecord->update($request->all());
        return response()->json([
            "message" => "Weight record updated successfully",
            "data" => $weightRecord
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WeightRecord $weightRecord)
    {
        //
        WeightRecord::destroy($weightRecord->id);
        return response()->json([
            "message" => "Weight record deleted successfully"
        ]);
    }
}
