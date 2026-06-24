<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        $orders = Order::all();
        $todayOrders = Order::whereDate('created_at', today())->count();
        return view('admin.dashboard', compact('orders', 'todayOrders'));
    }
}
