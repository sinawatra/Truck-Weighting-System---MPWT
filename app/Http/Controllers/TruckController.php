<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response() -> json([
            "data" =>  Truck::all()]);
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
        $truck = Truck::create([
                'plate_number' => $request->plate_number,
                'driver_name' => $request->driver_name,
                'car_model' => $request->car_model,
                'weight' => $request->weight,
        ]);
        return response()->json([
                "message" => "Truck created successfully",
                "data" => $truck
        ], 201);
            
    }

    //     public function store(Request $request)
    // {
    //     $truck = Truck::create($request->all());

    //     return response()->json($truck);
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            "data" => Truck::find($id)
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Truck $truck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $truck = Truck::findOrFail($id);
        if (!$truck) {
                return response()->json([
                    "message" => "Truck not found"
                ], 404);
        }

        $truck->update([
            'plate_number' => $request->plate_number,
            'driver_name' => $request->driver_name,
            'car_model' => $request->car_model,
            'weight' => $request->weight,
        ]);

        return response()->json([
            "message" => "Truck updated successfully",
            "data" => $truck
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Truck $truck)
    {
        //
        Truck::destroy($truck->id);
        return response()->json([   
            "message" => "Truck deleted successfully"
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'plate_number' => 'sometimes|string',
            'driver_name' => 'sometimes|string',
            'car_model' => 'sometimes|string',
            'weight' => 'sometimes|numeric',
        ]);

        $query = Truck::with('company');

        if ($request->filled('plate_number')) {
            $query->where('plate_number', 'like', '%' . $request->input('plate_number') . '%');
        }

        if ($request->filled('driver_name')) {
            $query->where('driver_name', 'like', '%' . $request->input('driver_name') . '%');
        }

        if ($request->filled('car_model')) {
            $query->where('car_model', 'like', '%' . $request->input('car_model') . '%');
        }

        if ($request->filled('weight')) {
            $query->where('weight', $request->input('weight'));
        }

        $trucks = $query->get();

        return response()->json([
            'message' => 'Search completed successfully',
            'count' => $trucks->count(),
            'data' => $trucks,
        ]);
    }
}
