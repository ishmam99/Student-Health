<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::paginate(10);
        return view('backend.club.index', compact('clubs'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Club $club)
    {
        //
    }

    public function edit(Club $club)
    {
        //
    }

    public function update(Request $request, Club $club)
    {
        //
    }

    public function destroy(Club $club)
    {
        //
    }
}
