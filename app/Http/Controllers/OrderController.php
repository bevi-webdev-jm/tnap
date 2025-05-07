<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request) {
        return view('pages.orders.index');
    }

    public function create() {
        return view('pages.orders.create');
    }

    public function show($id) {
        $order = Order::findOrFail(decrypt($id));

        return view('pages.orders.show')->with([
            'order' => $order
        ]);
    }
}
