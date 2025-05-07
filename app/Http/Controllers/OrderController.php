<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request) {
        return view('pages.orders.index');
    }

    public function create() {
        return view('pages.orders.create');
    }
}
