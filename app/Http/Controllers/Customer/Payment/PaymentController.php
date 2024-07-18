<?php

namespace App\Http\Controllers\Customer\Payment;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Citie;
use App\Models\Countrie;
use App\Models\Order;
use App\Models\Product;
use App\Models\State;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('temp.paypal',[
            'categories'=>Categorie::all(),
            'countries'=>Countrie::all(),
            'cities'=>Citie::all(),
            'states'=>State::all(),
            'products'=>Product::all(),
            'orders'=>Order::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
