<?php

namespace App\Http\Controllers;

use App\Http\Requests\TankerRequest;
use App\Models\Tanker;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TankerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tankers = Tanker::with('statements')->get();
        return Inertia::render('Tanker/Index', compact('tankers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TankerRequest $request)
    {
        Tanker::create($request->validated());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tanker  $tanker
     * @return \Illuminate\Http\Response
     */
    public function show(Tanker $tanker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tanker  $tanker
     * @return \Illuminate\Http\Response
     */
    public function update(TankerRequest $request, Tanker $tanker, $id)
    {
        $tanker = Tanker::find($id);
        $tanker->update($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tanker  $tanker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tanker $tanker, $id)
    {
        $tanker = Tanker::find($id);
        $tanker->delete();
        return redirect()->back();
    }
}