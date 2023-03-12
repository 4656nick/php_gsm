<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Models\Statement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function firstQuery()
    {
        $statements = Statement::where('garage_id', '=', 1)->where('fuel_id', '=', 1)->with('fuel', 'garage')->get();
        return Inertia::render('Dashboard', compact('statements'));
    }

    public function thirdQuery()
    {
        $statements = Statement::all();
        $fuels = Fuel::with('statements')->get();
        return Inertia::render('Dashboard/Dashboard', compact('statements', 'fuels'));
    }
}