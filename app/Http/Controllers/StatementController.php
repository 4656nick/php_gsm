<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatementRequest;
use App\Models\Base;
use App\Models\City;
use App\Models\Fuel;
use App\Models\Garage;
use App\Models\Sheet;
use App\Models\Statement;
use App\Models\Tanker;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statements = Statement::with('garage', 'fuel', 'tanker', 'sheet')->get();
        $tankers = Tanker::all();
        $sheets = Sheet::all();
        $fuels = Fuel::all();
        $garages = Garage::all();
        $bases = Base::all();
        $cities = City::all();
        return Inertia::render('Statement/Index', compact('statements', 'tankers', 'sheets', 'fuels', 'garages', 'bases', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatementRequest $request)
    {
        Statement::create($request->validated());
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Statement  $statement
     * @return \Illuminate\Http\Response
     */
    public function update(StatementRequest $request, Statement $statement, $id)
    {
        $statement = Statement::find($id);
        $statement->update($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Statement  $statement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statement $statement, $id)
    {
        $statement = Statement::find($id);
        $statement->delete();
        return redirect()->back();
    }

    public function signed($id)
    {
        $review = Statement::find($id);
        $review->is_signed = true;
        $review->save();
        return redirect()->back();
    }
}