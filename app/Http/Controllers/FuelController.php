<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuelRequest;
use App\Models\Fuel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fuels = Fuel::with('statements')->get();
        return Inertia::render('Fuel/Index', compact('fuels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FuelRequest $request)
    {
        Fuel::create($request->validated());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function show(Fuel $fuel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function update(FuelRequest $request, Fuel $fuel, $id)
    {
        $fuel = Fuel::find($id);
        $fuel->update($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fuel $fuel, $id)
    {
        $fuel = Fuel::find($id);
        $fuel->delete();
        return redirect()->back();
    }
}