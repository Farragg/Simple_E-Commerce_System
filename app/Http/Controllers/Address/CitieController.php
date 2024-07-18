<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use App\Models\Citie;
use App\Models\State;
use Illuminate\Http\Request;

class CitieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = Citie::all();

        return view('pages.address.citie.index', [
            'cities' => $cities,
            'states' => State::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = Citie::all();

        return view('pages.address.citie.create', [
            'cities' => $cities,
            'states' => State::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Citie::create([
            'name' => $request->name,
            'status' => $request->status,
            'state_id' => $request->state_id
        ]);
        return redirect()->route('cities.index')->with(['success' => 'This City Created Successfully']);
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
        $citie=Citie::find($id);
        return view('pages.address.citie.edit',[
            'citie'=>$citie,
            'state'=>State::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $citie= Citie::find($request->id);
        $citie->update([
            'name' => $request->name,
            'status' => $request->status
        ]);
        return redirect()->route('cities.index')->with([
            'success'=>'This City Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Citie::destroy($request->id);
        return redirect()->back()->with([
            'warning'=>'This City Deleted Successfully'
        ]);
    }
}
