<?php

namespace App\Http\Controllers;

use App\Http\Requests\GarageRequest;
use App\Models\Base;
use App\Models\Garage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GarageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $garages = Garage::with('base', 'statements')->get();
        $bases = Base::all();
        return Inertia::render('Garage/Index', compact('garages', 'bases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GarageRequest $request)
    {
        Garage::create($request->validated());
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function update(GarageRequest $request, Garage $garage, $id)
    {
        $garage = Garage::find($id);
        $garage->update($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Garage $garage, $id)
    {
        $garage = Garage::find($id);
        $garage->delete();
        return redirect()->back();
    }
}