<?php

namespace App\Http\Controllers\Customer\Address;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Citie;
use App\Models\Countrie;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\Product;
use App\Models\State;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer_address= CustomerAddress::all();
        return view('temp.checkout',[
            'customer_address' => $customer_address,
            'categories' => Categorie::all(),
            'countries' => Countrie::all(),
            'cities' => Citie::all(),
            'states' => State::all(),
            'products' => Product::all(),
            'orders' => Order::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer_address= CustomerAddress::all();
        return view('temp.checkout',[
            'customer_address' => $customer_address,
            'categories' => Categorie::all(),
            'countries' => Countrie::all(),
            'cities' => Citie::all(),
            'states' => State::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        CustomerAddress::create([
            'customer_id' => $request->customer_id,
            'countrie_id' => $request->countrie_id,
            'state_id' => $request->state_id,
            'citie_id' => $request->citie_id,
            'address_title' => $request->address_title,
            'default_address' => $request->default_address,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'po_box' => $request->po_box,
        ]);
        return redirect()->back()->with([
            'success' => 'The Address Created Successfully'
        ]);
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
