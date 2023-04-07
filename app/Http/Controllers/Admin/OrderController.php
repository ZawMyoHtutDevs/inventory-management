<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        $orders = Order::orderby('created_at', 'desc')->get();

            
        return view('admin.orders.index', compact('orders'));
    }
    public function show($id)
    {
                
        $order = Order::findOrFail($id);


        return view('admin.orders.detail', compact('order'));
    }
}
