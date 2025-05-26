<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $todaysSales = Order::whereDate('created_at', now()->toDateString())->sum('total_amount');
        $tillDatesale = Order::sum('total_amount');
        return view('admin.welcome_dashboard', compact('totalUsers', 'totalOrders', 'deliveredOrders', 'todaysSales','tillDatesale'));
    }
}
