<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sold;

class SoldController extends Controller
{
    public function fetchAllSales(){
        $sales = Sold::with('product', 'user')->orderBy('created_at', 'DESC')->get();
        return $sales;
    }

    public function filterSales(Request $request){
        $filterRecords = Sold::with('product', 'user')->where('date', '>=', $request->from)->where('date', '<=', $request->to)->get();
        return response()->json($filterRecords, 200);
    }
}
