<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StationController extends Controller
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
        $stations = Cache::tags('stations')->remember(
            'stations.index',
            self::CACHE_TTL,
            fn () => Station::all()
        );

        return response()->json(["data" => $stations]);
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

        Cache::tags('stations')->flush();

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
        $found = Cache::tags('stations')->remember(
            "stations.show.{$id}",
            self::CACHE_TTL,
            fn () => Station::find($id)
        );

         return response()->json([
            "data" => $found
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

        Cache::tags('stations')->flush();

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

        Cache::tags('stations')->flush();

        return response()->json([
            "message" => "Station deleted successfully"
        ]);
    }
}
