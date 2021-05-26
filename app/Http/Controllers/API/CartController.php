<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Sold;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request();
        $user = $request->User();
        $cartProducts = Cart::with('product', 'brand')
        ->where('user_id', $user->id)->get();
        return response()->json($cartProducts, 200);
    }

    public function sellProduct(Request $request){
        // dd($request->all());
        $cardData = $request->all();
        foreach ($cardData as $value) {
            $product = $value['product'];
            $quantity = $value['quantity'];
            $stock = Stock::find($product['id']);
            // dd($value['id']);
            $stock->in_stock = $stock->in_stock - $quantity;
            if ($stock->save()) {
                $sold = new Sold();
                $sold->user_id = $value['user_id'];
                $sold->product_id = $product['id'];
                $sold->date = Carbon::now()->format('Y-m-d');
                $sold->quantity = $value['quantity'];
                if ($sold->save()) {
                    $cart = Cart::find($value['id']);
                    $cart->delete();
                }
            }
        }
        return response()->json($stock, 200);
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
        $user = $request->user();
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->product_id = $request->id;
        $cart->brand_id = $request->brand_id;
        $cart->quantity = $request->quantity;
        $cart->total = ($request->sell_price * $request->quantity);
        $cart->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
