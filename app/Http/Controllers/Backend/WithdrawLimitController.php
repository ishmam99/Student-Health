<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WithdrawLimit;
use Illuminate\Http\Request;

class WithdrawLimitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdraw_limits = WithdrawLimit::paginate(10);
        return view('backend.withdraw-limit.index', compact('withdraw_limits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param  \App\Models\WithdrawLimit  $withdrawLimit
     * @return \Illuminate\Http\Response
     */
    public function show(WithdrawLimit $withdrawLimit)
    {
        return view('backend.withdraw-limit.edit', compact('withdrawLimit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WithdrawLimit  $withdrawLimit
     * @return \Illuminate\Http\Response
     */
    public function edit(WithdrawLimit $withdrawLimit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WithdrawLimit  $withdrawLimit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WithdrawLimit $withdrawLimit)
    {
        $withdrawLimit->amount = $request->amount;
        $withdrawLimit->update();
        return back()->with('success', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WithdrawLimit  $withdrawLimit
     * @return \Illuminate\Http\Response
     */
    public function destroy(WithdrawLimit $withdrawLimit)
    {
        //
    }
}
