<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use App\Models\Countrie;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states= State::all();
        return view('pages.address.state.index', [
            'states' => $states,
            'countries' => Countrie::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states= State::all();
        return view('pages.address.state.create', [
            'states' => $states,
            'countries' => Countrie::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        State::create([
            'name'=>$request->name,
            'countrie_id'=>$request->countrie_id
        ]);
        return redirect()->route('states.index')->with([
            'success'=>'This Stated Created Successfully'
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
        $state=State::find($id);
        return view('pages.address.state.edit',[
            'state'=>$state
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $state=State::find($request->id);
        $state->update([
            'name'=>$request->name,
        ]);
        return redirect()->route('states.index')->with([
            'success'=>'This State Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        State::destroy($request->id);

        return redirect()->back()->with([
            'warning' => 'This State Deleted Successfully'
        ]);
    }
}
