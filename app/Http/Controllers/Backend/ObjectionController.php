<?php

namespace App\Http\Controllers\Backend;

use App\Models\Objection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ObjectionController extends Controller
{
    public function index()
    {
        $objections = Objection::with('user')->where('status', Objection::PENDING)->paginate(5);
        return view('backend.objection.index', compact('objections'));
    }

    public function approve()
    {
        $objections = Objection::with('user')->whereIn('status', [Objection::APPROVE, Objection::CANCEL])->paginate(5);
        return view('backend.objection.approve', compact('objections'));
    }

    public function update(Request $request, Objection $objection)
    {
        $input = $request->all();
        $objection->update($input);
        return back()->with('success', 'Approve Successfully');
    }
}
