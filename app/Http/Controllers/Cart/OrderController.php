<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $carts= Order::all();
        return view('pages.cart.index',[
            'carts' => $carts,
            'categories' => Categorie::all(),
            'products' => Product::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carts=Order::all();
        return view('temp.product-detail',[
            'carts'=>$carts,
            'categories'=>Categorie::all(),
            'products'=>Product::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $products=Order::where('product_id',$product->id)->get();
        $cart=Order::create([
            'customer_id'=>auth('customer')->user()->id,
            'user_id'=>1,
            'categorie_id'=>$request->categorie_id,
            'product_id'=>$request->product_id,
            'amount'=>$request->amount,
            'quantity'=>$request->quantity,
            'size'=>$request->size,
            'color'=>$request->color
        ]);
        $users=Customer::where('id','=',auth('customer')->user()->id)->get();
        $create_order=auth('customer')->user()->name;

        Notification::send($users, new Cart($cart->id, $create_order,$cart->product_id));

        return redirect()->route('home')->with([
            'success' => 'Add To Cart'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order=Order::find($id);
        return view('pages.cart.show',[
            'order'=>$order,
            'categories'=>Categorie::all(),
            'products'=>Product::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order=Order::find($id);
        return view('pages.cart.edit',[
            'order'=>$order,
            'categories'=>Categorie::all(),
            'products'=>Product::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {

        $order=Order::find($request->id);
        $order->update([
            'amount'=>$request->amount,
            'quantity'=>$request->quantity,
            'size'=>$request->size,
            'color'=>$request->color
        ]);
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order,Request $request)
    {
        Order::destroy($request->id);
        $order->notifications()->delete();
        return redirect()->route('orders.index')->with([
            'success'=>'DELETE'
        ]);
    }
}
