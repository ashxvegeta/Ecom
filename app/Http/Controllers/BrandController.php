<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $brands = Brand::all();
        return view('brands.index', compact('brands'));
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

        $brand = Brand::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);    
        // Product Images
        if($request->hasFile('logo')){

            $image = $request->file('logo');
            $path = $image->store('brands', 'public');
            $brand->update([
                'logo' => $path,
            ]);
            
        }
        return redirect()->route('brands.create')->with('success', 'Brand created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

       
        $brands = Brand::findOrFail($id);
        return view('brands.show', compact('brands'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $brands = Brand::findOrFail($id);
        

        return view('brands.edit', compact('brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, string $id)
    {
        //
        $brand = Brand::findOrFail($id);
        $brand->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        // Product Images



        if($request->hasFile('logo')){
        
            if($brand->logo) {
                // Delete the old image from storage
                Storage::disk('public')->delete($brand->logo);
            }

            $image = $request->file('logo');
            $path = $image->store('brands', 'public');
            $brand->update([
                'logo' => $path,
            ]);
            
        }

return redirect()->route('brands.edit', $brand->id)->with('success', 'Brand updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $brand = Brand::findOrFail($id);
        if($brand->logo) {
            // Delete the old image from storage
            Storage::disk('public')->delete($brand->logo);
        }
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
