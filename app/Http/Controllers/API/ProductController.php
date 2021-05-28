<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('category', 'subCategory', 'brand', 'stock')
        ->orderBy('created_at', 'DESC')->paginate(10);
        return response()->json($product, 200);
    }

    public function getSubCategories($id)
    {
        $subCategory = SubCategory::where('category_id', $id)->get();
        return response()->json($subCategory, 200);
    }

    public function getSearchResult(Request $request)
    {
        // dd($request->get('query'));
        $request->validate([
            'query' => 'required|min:1',
        ],[
            'query.required' => 'you must have enter at least one character'
        ]);
        
        $item = $request->get('query');
        $searchReasult = Product::where('name', 'LIKE', '%'.$item.'%')->get();
        return response()->json($searchReasult, 200);
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
            'sub_category_id' => 'required',
            'name' => 'required|min:2|max:50',
            'buy_price' => 'numeric|min:1',
            'sell_price' => 'numeric|min:1',
            'quantity' => 'numeric|min:1',
            'description' => 'required|min:10'
        ],[
            'category_id.required' => 'Category must be selected.',
            'sub_category_id.required' => 'Subcategory must be selected.'
        ]);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->buy_price = $request->buy_price;
        $product->sell_price = $request->sell_price;
        $product->description = $request->description;
        if ($product->save()) {
            $stock = new Stock();
            $stock->product_id = $product->id;
            $stock->bought_quantity = $request->quantity;
            $stock->in_stock = $request->quantity;
            $stock->save();
            return response()->json($product, 200);
        }
        else{
            return response()->json($product, 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
