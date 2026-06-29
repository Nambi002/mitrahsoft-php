<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class OrderController extends Controller
{
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
                        ->latest()
                        ->paginate(5);

          $categories = Category::all();

        return view('orders.my-orders', compact('orders','categories'));
    }

    public function orderDetails($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        $categories = Category::all();

        return view('orders.details', compact('order','categories'));
    }

    public function adminOrders()
    {
        $orders = Order::with('user')
                        ->latest()
                        ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }
}

