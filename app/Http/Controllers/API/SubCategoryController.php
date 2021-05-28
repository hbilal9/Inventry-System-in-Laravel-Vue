<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategory::with('category')
        ->orderBy('created_at', 'DESC')->paginate(10);
        $categories = Category::orderBy('created_at', 'DESC')
        ->get();
        return response()->json([
            'subCategories' => $subCategories,
            'categories' => $categories,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|min:2|max:50|unique:categories'
        ],[
            'category_id.required' => 'Parent category must be selected.'
        ]);

        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;
        if ($subCategory->save()) {
            return response()->json($subCategory, 200);
        }
        else{
            return response()->json($subCategory, 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|min:2|max:50|unique:categories'
        ],[
            'category_id.required' => 'Parent category must be selected.'
        ]);
        
        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;
        if($subCategory->save()){
            return response()->json($subCategory, 200);
        }
        else{
            return response()->json($subCategory, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        if($subCategory->delete()){
            return response()->json($subCategory, 200);
        }
        else{
            return response()->json($subCategory, 500);
        }
    }
}
