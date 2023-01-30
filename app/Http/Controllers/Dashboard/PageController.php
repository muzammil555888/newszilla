<?php

namespace App\Http\Controllers\Dashboard;

use App\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Gate;

class PageController extends Controller
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
        
        $pages = Page::orderByDesc('created_at')->get();
        return view('dashboard.page.create')->with('pages', $pages);
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

        return redirect('/page');
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
            'description'   =>  'min:10'
        ]);

        // Handle File Upload
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'image|max:5000'
            ]);
            // Get File Name
            $image = $request->file('image');
            // Get Filename with Extension
            $fileNameWithExt = $image->getClientOriginalName();
            // Get Just File Name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get Just Extension
            $fileExt = $request->file('image')->getClientOriginalExtension();
            // File Name To Store
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
         
            // Set File Destination
            $destinationPath = public_path('/uploads/pages');
            // Create Directory If Not Exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 755, true);
            }

            // Resize And Save File
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$fileNameToStore);

        } else {
            $fileNameToStore = NULL;
        }

        $slugToStore = Str::slug($request->input('title'), '-').'-'.time();

        $page = new Page;
        $page->user_id = auth()->user()->id;
        $page->slug = $slugToStore;
        $page->title = $request->input('title');
        $page->status = $request->input('status');
        $page->image = $fileNameToStore;
        $page->description = $request->input('description');

        if ($page->save()) {
            return redirect()->back()->with('success', 'Page Created');
        } else {
            return back()->with('error', 'Failed To Create Page');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        return view('dashboard.page.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        $page = Page::where('slug', $slug)->first();
        $pages = Page::orderByDesc('created_at')->get();
        return view('dashboard.page.edit')->with(['page' => $page, 'pages' => $pages]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        $page = Page::where('slug', $slug)->first();

        if ($page->delete()) {
            return redirect()->back()->with('success', 'Page Deleted');
        } else {
            return back()->with('error', 'Failed To Delete Page');
        }
    }
}
