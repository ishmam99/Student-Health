<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeRequest;
use App\Models\Notice;
use Illuminate\Http\RedirectResponse;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::paginate($this->itemPerPage);
        $this->putSL($notices);
        return view('backend.notice.index', compact('notices'));
    }

    public function create()
    {
        return view('backend.notice.create');
    }

    public function store(NoticeRequest $request): RedirectResponse
    {
        Notice::create($request->validated());
        return redirect()->route('notice.index')->with('success', 'Notice Created Successfully.');
    }

    public function edit(Notice $notice)
    {
        return view('backend.notice.edit', compact('notice'));
    }

    public function update(NoticeRequest $request, Notice $notice): RedirectResponse
    {
        $notice->update($request->validated());
        return redirect()->route('notice.index')->with('success', 'Notice updated successfully.');
    }

    public function destroy(Notice $notice): RedirectResponse
    {
        $notice->delete();
        return back()->with('success', 'Notice deleted successfully.');
    }
}
