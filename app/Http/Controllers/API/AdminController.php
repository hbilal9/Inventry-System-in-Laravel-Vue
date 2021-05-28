<?php

namespace App\Http\Controllers\API;

use App\Models\Sold;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function getDashboard(){
        $currentDate = Carbon::now()->format('Y-m-d');
        $sevenDays = Carbon::now()->subDays(7)->format('Y-m-d');
        $allStocks = Stock::all();
        $lastSevenDays = Sold::where('date', '>=', $sevenDays)->where('date', '<=', $currentDate)
        ->get();
        $todaySales = Sold::where('date', '=', $currentDate)->get();
        $employees = User::where('role', '!=', 'admin')->get();
        $getLatestSales = Sold::with('product')->orderBy('created_at', 'DESC')->paginate(5);
        return response()->json([
            'allStocks' => $allStocks,
            'todaySales' => $todaySales,
            'employees' => $employees->count(),
            'lastSevenDays' => $lastSevenDays,
            'latestSales' => $getLatestSales,
        ]);
    }
    
}
