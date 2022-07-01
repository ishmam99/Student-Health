<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Models\WatchedVideo;
// use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Throwable;

class VideoController extends Controller
{
    public function index()
    {
        // dd('hello world');
        // $videos = Video::with('media')->get();
        // return view('backend.video.index', compact('videos'));
        $videos = WatchedVideo::paginate(10);
        return view('backend.video.index', compact('videos'));
        // $data = $this->apiResponse(200, 'Video watched count.', $videos);
        // dd($videos);
    }

    public function create()
    {
        return view('backend.video.create');
    }

    public function store(VideoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($validated['status'] == 'on') {
            $validated['status'] = 1;
        }

        try {
            parse_str(parse_url($request->get('link'), PHP_URL_QUERY), $vars);
            $validated['youtube_uid'] = $vars['v'];
        } catch (Throwable $th) {
            return back()->withInput()->with('error', 'Invalid Youtube URL. Try again.');
        }

        $video = Video::create($validated);

        if ($request->hasFile('thumbnail')) {
            $video->addMedia($request->file('thumbnail'))->toMediaCollection('thumbnail');
        }

        return redirect()->route('video.index')->with('success', 'Video Created.');
    }

    public function edit(Video $video)
    {
        return view('backend.video.edit', compact('video'));
    }

    public function update(VideoRequest $request, Video $video): RedirectResponse
    {
        $validated = $request->validated();

        if ($validated['status'] == 'on') {
            $validated['status'] = 1;
        }

        try {
            parse_str(parse_url($request->get('link'), PHP_URL_QUERY), $vars);
            $validated['youtube_uid'] = $vars['v'];
        } catch (Throwable $th) {
            return back()->withInput()->with('error', 'Invalid Youtube URL. Try again.');
        }

        $video->update($validated);

        if ($request->hasFile('thumbnail')) {
            $video->addMedia($request->file('thumbnail'))->toMediaCollection('thumbnail');
        }

        return redirect()->route('video.index')->with('success', 'Video Updated.');
    }

    public function destroy(Video $video): RedirectResponse
    {
        $video->delete();
        return back()->with('success', 'Deleted Successfully.');
    }
}
