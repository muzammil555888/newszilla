<?php

namespace App\Http\Controllers\Dashboard;

use App\Video;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Gate;

class VideoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }
        
        $videos = Video::orderByDesc('created_at')->get();
        return view('dashboard.video.create')->with('videos', $videos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        return redirect('/video');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        $this->validate($request, [
            'title'  =>  'required|max:255|min:3',
            'status' => 'boolean',
            'video_url'   =>  'required|url',
            'description'   =>  'min:10'
        ]);

        $slugToStore = Str::slug($request->input('title'), '-').'-'.time();

        $video = new Video;
        $video->user_id = auth()->user()->id;
        $video->slug = $slugToStore;
        $video->title = $request->input('title');
        $video->status = $request->input('status');
        $video->url = this.embedVideoURL($request->input('video_url'));
        $video->description = $request->input('description');

        if ($video->save()) {
            return redirect()->back()->with('success', 'Video Created');
        } else {
            return back()->with('error', 'Failed To Create Video');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return redirect('/video');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return redirect('/video');

        // if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
        //     return back();
        // }

        // $video = Video::where('slug', $slug)->first();
        // $videos = Video::orderByDesc('created_at')->get();
        // return view('dashboard.video.edit')->with(['video' => $video, 'videos' => $videos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        return redirect('/video');
        
        // if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
        //     return back();
        // }

        // $this->validate($request, [
        //     'title'  =>  'required|max:255|min:3',
        //     'status' => 'boolean',
        //     'video_url'   =>  'required|url',
        //     'description'   =>  'min:10'
        // ]);

        // $slugToStore = Str::slug($request->input('title'), '-').'-'.time();

        // $video = Video::where('slug', $slug)->first();
        // $video->user_id = auth()->user()->id;
        // $video->slug = $slugToStore;
        // $video->title = $request->input('title');
        // $video->status = $request->input('status');
        // $video->url = $request->input('video_url');
        // $video->description = $request->input('description');

        // if ($video->save()) {
        //     return redirect('/video')->with('success', 'Video Created');
        // } else {
        //     return back()->with('error', 'Failed To Create Video');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        $video = Video::where('slug', $slug)->first();

        if ($video->delete()) {
            return redirect()->back()->with('success', 'Video Deleted');
        } else {
            return back()->with('error', 'Failed To Delete Video');
        }
    }

    function embedVideoURL($url) {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id ;
    }
}
