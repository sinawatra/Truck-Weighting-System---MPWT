<?php

namespace App\Http\Controllers;

use App\Models\WeightRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WeightRecordController extends Controller
{
    /**
     * Cache lifetime for read endpoints, in seconds. Writes flush the tag,
     * so this is only a safety-net expiry.
     */
    private const CACHE_TTL = 3600;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $records = Cache::tags('weight-records')->remember(
            'weight-records.index',
            self::CACHE_TTL,
            fn () => WeightRecord::all()
        );

        return response()->json([
            "data" => $records
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
        Cache::tags('weight-records')->flush();

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

        Cache::tags('weight-records')->flush();

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

        Cache::tags('weight-records')->flush();

        return response()->json([
            "message" => "Weight record deleted successfully"
        ]);
    }
}
