<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
       return view('categories.index', compact('categories'));
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parents = Category::whereNull('parent_id')->get();
        return view('categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        
        $data = $request->validated();
        $slug = Str::slug($data['name']);
        if(Category::where('slug', $slug)->exists()) {
           $slug = $slug . '-' . time();
        }
        $data['slug'] = $slug;
        $category = Category::create($data);

         if($request->hasFile('image')){
           
           $image = $request->file('image');
            $path = $image->store('categories', 'public');
            $category->update([
                'image' => $path,
            ]);
            
        }


        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
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
        $category = Category::findOrFail($id);
        $parents = Category::whereNull('parent_id')->get();
        return view('categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        //
        $category = Category::findOrFail($id);
        $data = $request->validated();
        $slug = Str::slug($data['name']);
        if(Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
           $slug = $slug . '-' . time();
        }
        $data['slug'] = $slug;
        $category->update($data);

       if($request->hasFile('image')){
    // Purani image delete karo
    if($category->image){
        Storage::disk('public')->delete($category->image);
    }
    
    $path = $request->file('image')->store('categories', 'public');
    $category->update(['image' => $path]);
}

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

         $category = Category::findOrFail($id);
        if($category->image) {
            // Delete the old image from storage
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
