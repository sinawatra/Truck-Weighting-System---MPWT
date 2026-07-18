<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response() -> json([ "data" =>  Station::all()]);
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
        $station = Station::create([
            "station_code" => $request->station_code,
            "name" => $request-> name,
            "location" => $request -> location,
            'latitude'=> $request -> latitude,
            'longitude'=> $request -> longtitute,
            'machine_code'=> $request -> machine_code,
            'status' => $request -> status,
            'description' => $request -> decription
        ]);

         return response()->json([
                "message" => "Station created successfully",
                "data" => $station
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Station $station, $id)
    {
        //
         return response()->json([
            "data" => Station::find($id)
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Station $station)
    {
         }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        $station = Station::findOrFail($id);
        if (!$station) {
            return response()->json([
                "message" => "station not found"
                ], 404);
        }

        $station->update([
            "station_code" => $request->station_code,
            "name" => $request-> name,
            "location" => $request -> location,
            'latitude'=> $request -> latitude,
            'longitude'=> $request -> longtitute,
            'machine_code'=> $request -> machine_code,
            'status' => $request -> status,
            'description' => $request -> decription
        ]);

        return response()->json([
            "message" => "Station updated successfully",
            "data" => $station
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
      public function destroy(Station $station)
    {
        //
        Station::destroy($station->id);
        return response()->json([   
            "message" => "Station deleted successfully"
        ]);
    }
}
