<?php

namespace App\Http\Controllers\Categorie;

use App\Http\Controllers\Controller;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    use AttachFilesTrait;

    public function index()
    {
        $categories = Categorie::all();
        return view('pages.category.index',[
            'categories'=>$categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.category.create');
    }


    public function store(Request $request)
    {
        Categorie::create([
            'name' => $request->name,
            'image' => $request->file('image')->getClientOriginalName(),
        ]);
        $this->uploadFile($request, 'image', 'upload_attachments');
        return redirect()->route('categorie.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products=Product::where('categorie_id',$id)->get();
        return view('temp.product-list',[

            'products'=>$products,
            'categories'=>Categorie::all(),
            'showProduct'=>Product::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categorie= Categorie::find($id);
        return view('pages.category.edit',[
            'categorie' => $categorie
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        $categorie=Categorie::find($request->id);
        $categorie->update([
            'name'=>$request->name
        ]);

        if($request->hasFile('image')){
            $this->deleteFile($categorie->image);

            $this->uploadFile($request,'image','upload_attachments');
            $image_new = $request->file('image')->getClientOriginalName();
            $categorie->image = $categorie->image !== $image_new ? $image_new : $categorie->image;
        }
        return redirect()->route('categorie.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->deleteFile($request->file_name);
        $categorie=Categorie::find($request->id);
        $categorie->destroy($request->id);
        return redirect()->back();
    }
}
