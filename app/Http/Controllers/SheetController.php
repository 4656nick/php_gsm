<?php

namespace App\Http\Controllers;

use App\Http\Requests\SheetRequest;
use App\Models\City;
use App\Models\Sheet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sheets = Sheet::with('city')->get();
        $cities = City::all();
        return Inertia::render('Sheet/Index', compact('sheets', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SheetRequest $request)
    {
        Sheet::create($request->validated());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function show(Sheet $sheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function update(SheetRequest $request, Sheet $sheet, $id)
    {
        $sheet = Sheet::find($id);
        $sheet->update($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sheet $sheet, $id)
    {
        $sheet = Sheet::find($id);
        $sheet->delete();
        return redirect()->back();
    }
}