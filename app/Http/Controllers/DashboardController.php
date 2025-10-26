<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalSellers = Seller::count();
        $latestProduct = Product::latest()->first();

        return view('dashboard', compact('totalProducts', 'totalSellers', 'latestProduct'));
    }
}
