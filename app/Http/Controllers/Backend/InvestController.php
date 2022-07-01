<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestRequest;
use App\Models\Invest;
use Illuminate\Http\Request;

class InvestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('hel');  
        $invests = Invest::paginate(10);
        return view('backend.investment-package.index', compact('invests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.investment-package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvestRequest $request)
    {
        $input = $request->all();
        Invest::create($input);
        return redirect(route('invest.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function show(Invest $invest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function edit(Invest $invest)
    {
        return view('backend.investment-package.edit', compact('invest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function update(InvestRequest $request, Invest $invest)
    {
        $input = $request->validated();
        $input['status'] = $request->status == "on" ? 1 : 0; 
        $invest->update($input);
        return redirect(route('invest.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invest $invest)
    {
        //
    }
}
