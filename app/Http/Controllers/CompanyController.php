<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CompanyController extends Controller
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
        $companies = Cache::tags('companies')->remember(
            'companies.index',
            self::CACHE_TTL,
            fn () => Company::all()
        );

        return response()->json([
            "data" => $companies
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
        Cache::tags('companies')->flush();

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

        Cache::tags('companies')->flush();

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

        Cache::tags('companies')->flush();

        return response()->json([
            "message" => "Company deleted successfully"
        ]);
    }
}
