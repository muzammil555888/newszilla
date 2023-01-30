<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Gate;

class CategoryController extends Controller
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
        if (Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }
        
        return view('dashboard.category.create');
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

        return redirect('/category');
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
            'status' => 'boolean'
        ]);

        // Handle File Upload
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'image|max:2000'
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
            $destinationPath = public_path('/uploads/categories');
            // Create Directory If Not Exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 755, true);
            }

            // Resize And Save File
            $img = Image::make($image->getRealPath());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$fileNameToStore);

        } else {
            $fileNameToStore = NULL;
        }

        $slugToStore = Str::slug($request->input('title'), '-').'-'.time();
        
        $category = new Category;
        $category->slug = $slugToStore;
        $category->title = $request->input('title');
        $category->image = $fileNameToStore;
        $category->status = $request->input('status');

        if ($category->save()) {
            return redirect()->back()->with('success', 'Category Created');
        } else {
            return back()->with('error', 'Failed To Create Category');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        return redirect('/category');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        $category = Category::where('slug', $slug)->first();
        return view('dashboard.category.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        $this->validate($request, [
            'title'  =>  'required|max:255|min:3',
            'status' => 'boolean'
        ]);

        // Handle File Upload
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'image|max:2000'
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
            $destinationPath = public_path('/uploads/categories');
            // Create Directory If Not Exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 755, true);
            }

            // Resize And Save File
            $img = Image::make($image->getRealPath());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$fileNameToStore);

        } else {
            $fileNameToStore = NULL;
        }

        $slugToStore = Str::slug($request->input('title'), '-').'-'.time();
        
        $category = Category::where('slug', $slug)->first();
        $category->slug = $slugToStore;
        $category->title = $request->input('title');
        if ($request->hasFile('image')) {
            if (\File::exists(public_path('/uploads/categories/'.$category->image))) {
                \File::delete(public_path('/uploads/categories/'.$category->image));
            }
            $category->image = $fileNameToStore;
        }
        $category->status = $request->input('status');

        if ($category->save()) {
            return redirect('/category')->with('success', 'Category Created');
        } else {
            return back()->with('error', 'Failed To Create Category');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }
        // $category = Category::where('slug', $slug)->first();

        // if (\File::exists(public_path('/uploads/categories/'.$category->image))) {
        //     \File::delete(public_path('/uploads/categories/'.$category->image));
        // }

        // if ($category->delete()) {
        //     return redirect('/category')->with('success', 'Category Removed!');
        // } else {
        //     return back()->with('error', 'Failed To Remove Category!');
        // }
    }
}
