<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('temp.index',[
            'categories'=>Categorie::all(),
            'products'=>Product::all(),
            'order'=>Order::all(),
            'customers'=>Customer::all()
        ]);
    }

    public function selection(){
        return view('auth.selection');
    }

    public function create()
    {
        return view('temp.cart',[
            'product'=>Product::all(),
            'categories'=>Categorie::all()
        ]);
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
        $categorie=Categorie::find($id);
        return view('temp.product-detail',[
            'categorie'=>$categorie,

        ]);
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
