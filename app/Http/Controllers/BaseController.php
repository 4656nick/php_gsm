<?php

namespace App\Http\Controllers;

use App\Http\Requests\BaseRequest;
use App\Models\Base;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bases = Base::with('garages')->get();
        return Inertia::render('Base/Index', compact('bases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BaseRequest $request)
    {
        Base::create($request->validated());
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Base  $base
     * @return \Illuminate\Http\Response
     */
    public function update(BaseRequest $request, Base $base, $id)
    {
        $base = Base::find($id);
        $base->update($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Base  $base
     * @return \Illuminate\Http\Response
     */
    public function destroy(Base $base, $id)
    {
        $base = Base::find($id);
        $base->delete();
        return redirect()->back();
    }
}