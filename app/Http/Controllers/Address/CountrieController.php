<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use App\Models\Countrie;
use Illuminate\Http\Request;

class CountrieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Countrie::all();
        return view('pages.address.countrie.index', [
            'countries' => $countries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Countrie::all();
        return view('pages.address.countrie.create', [
            'countries' => $countries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Countrie::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return redirect()->route('countries.index')->with(['success' => 'success']);
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
        $countrie = Countrie::find($id);
        return view('pages.address.countrie.edit', [
            'countrie' => $countrie
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Countrie $countrie)
    {
        $countrie = Countrie::find($request->id);
        $countrie->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('countries.index')->with(['success' => 'Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Countrie::destroy($request->id);
        return redirect()->back()->with(['warning' => 'Delete']);
    }
}
