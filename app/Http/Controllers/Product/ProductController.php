<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Categorie;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use AttachFilesTrait;

    public function index()
    {
        $products=Product::all();
        $products=Product::paginate(5);
        return view('pages.product.index',[
            'products'=>$products,
            'categories'=>Categorie::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.product.create',[
            'categories'=>Categorie::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$request->file('image')->getClientOriginalName(),
            'price'=>$request->price,
            'discount_price'=>$request->discount_price,
            'categorie_id'=>$request->categorie_id
        ]);
        $this->uploadFile($request,'image','upload_attachments');

        session()->flash('success','The Product Add success');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories=Categorie::all();
        $product=Product::find($id);
        return view('temp.product-detail',[
            'product'=>$product,
            'categories'=>$categories,
            'products'=>Product::all(),
            'carts'=>Order::all(),
            'customer'=>Customer::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=Product::find($id);
        return view('pages.product.edit',[
            'product'=>$product,
            'categories'=>Categorie::all()

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product=Product::find($request->id);
        $product->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'discount_price'=>$request->discount_price,
        ]);
        if($request->hasFile('image')){
            $this->deleteFile($product->image);

            $this->uploadFile($request,'image','upload_attachments');
            $image_new = $request->file('image')->getClientOriginalName();
            $product->image = $product->image !== $image_new ? $image_new : $product->image;
        }

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->deleteFile($request->file_name);
        $product=Product::find($request->id);
        $product->destroy($request->id);
        return redirect()->back()->with([
            'success'=>'Product DELETE'
        ]);
    }
}
