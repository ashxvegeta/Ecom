<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        
        // $brand = Brand::create([
        //     'name' => $request->name,
        //     'status' => $request->status,
        // ]);    
        // // Product Images
        // if($request->hasFile('logo')){

        //     $image = $request->file('logo');
        //     $path = $image->store('brands', 'public');
        //     $brand->update([
        //         'logo' => $path,
        //     ]);
            
        // }
        // return redirect()->route('brands.create')->with('success', 'Brand created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
