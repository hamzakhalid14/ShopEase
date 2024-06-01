<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ordre-name' => 'required',
            'order-origin' => 'required',
            'order-price' => ['required', 'numeric']
        ]);
      $order = new Order(); 
        $order->name = $request->input('computer-name');
        $order->origin = $request->input('computer-origin');
        $order->price = $request->input('computer-price');;
        $order->save();
        return redirect()->route('orders.index');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_name' => 'required|max:255',
            'customer_email' => 'required|email',
            'customer_mobile' => 'required|numeric',
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update($request->all());
        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }
}
