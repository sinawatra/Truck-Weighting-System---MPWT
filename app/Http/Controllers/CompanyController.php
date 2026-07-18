<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            "data" => Company::all()
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
        $company = Company::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
        return response()->json([
            "message" => "Company created successfully",
            "data" => $company
        ], 201);    
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
        $company->update($request->all());
        return response()->json([
            "message" => "Company updated successfully",
            "data" => $company
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
        Company::destroy($company->id);
        return response()->json([   
            "message" => "Company deleted successfully"
        ]);
    }
}
