<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use App\Post;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Gate;

class PostController extends Controller
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
        
        if(Gate::allows('isAuthor')) {
            return redirect('/myblogposts')->with('success', 'Post Updated');
        }
        
        $posts = Post::orderByDesc('created_at')->simplePaginate(32);
        $totalPosts = Post::count();
        return view('dashboard.post.index')->with(['posts' => $posts, 'totalPosts' => $totalPosts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('isUser')) {
            return back();
        }

        $post_categories = Category::orderByDesc('created_at')->pluck
        ('title', 'slug');
        return view('dashboard.post.create')->with('post_categories', $post_categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::allows('isUser')) {
            return back();
        }

        $this->validate($request, [
            'post_title'  =>  'required|max:255|min:3',
            'description' => 'required|min:10',
            'tags' => 'required|min:3'
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
            $destinationPath = public_path('/uploads/posts');
            // Create Directory If Not Exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 755, true);
            }

            // Resize And Save File
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$fileNameToStore);

        } else {
            $fileNameToStore = NULL;
        }

        $category_id = Category::where('slug', $request->input('category'))->pluck('id')->first();
        $slugToStore = Str::slug($request->input('post_title'), '-').'-'.time();

        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->category_id = $category_id;
        $post->views = 0;
        $post->slug = $slugToStore;
        $post->title = $request->input('post_title');
        $post->type = $request->input('type');
        $post->description = $request->input('description');
        $post->tags = $request->input('tags');
        $post->image = $fileNameToStore;

        if ($post->save()) {
            return redirect('/myblogposts')->with('success', 'Post Created');
        } else {
            return back()->with('error', 'Failed To Create Post');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if(Gate::allows('isUser')) {
            return back();
        }

        $post = Post::where('slug', $slug)->first();
        return view('dashboard.post.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if(Gate::allows('isUser')) {
            return back();
        }

        $post = Post::where('slug', $slug)->first();
        $post_categories = Category::orderByDesc('created_at')->pluck
        ('title', 'slug');
        $category_slug = Category::where('id', $post->category_id)->pluck('slug');
        return view('dashboard.post.edit')->with(['post' => $post, 'post_categories' => $post_categories, 'category_slug' => $category_slug]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        if(Gate::allows('isUser')) {
            return back();
        }

        $this->validate($request, [
            'post_title'  =>  'required|max:255|min:3',
            'description' => 'required|min:10',
            'tags' => 'required|min:3'
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
            $destinationPath = public_path('/uploads/posts');
            // Create Directory If Not Exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 755, true);
            }

            // Resize And Save File
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$fileNameToStore);

        } else {
            $fileNameToStore = NULL;
        }

        $category_id = Category::where('slug', $request->input('category'))->pluck('id')->first();
        $slugToStore = Str::slug($request->input('post_title'), '-').'-'.time();

        $post = Post::where('slug', $slug)->first();
        $post->category_id = $category_id;
        $post->slug = $slugToStore;
        $post->title = $request->input('post_title');
        $post->type = $request->input('type');
        $post->description = $request->input('description');
        $post->tags = $request->input('tags');
        if ($request->hasFile('image')) {
            if (\File::exists(public_path('/uploads/posts/'.$post->image))) {
                \File::delete(public_path('/uploads/posts/'.$post->image));
            }
            $post->image = $fileNameToStore;
        }

        if ($post->save()) {
            return redirect('/myblogposts')->with('success', 'Post Updated');
        } else {
            return back()->with('error', 'Failed To Update Post');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        if(Gate::allows('isUser')) {
            return back();
        }

        $post = Post::where('slug', $slug)->first();

        if (\File::exists(public_path('/uploads/posts/'.$post->image))) {
            \File::delete(public_path('/uploads/posts/'.$post->image));
        }

        if ($post->delete()) {
            return redirect('/myblogposts')->with('success', 'Post Updated');
        } else {
            return back()->with('error', 'Failed To Update Post');
        }
    }

    public function myblogposts ()
    {
        if(Gate::allows('isUser')) {
            return back();
        }

        $posts = Post::where('user_id', auth()->user()->id)->orderByDesc('created_at')->simplePaginate(32);
        $totalPosts = Post::where('user_id', auth()->user()->id)->count();
        return view('dashboard.post.index')->with(['posts' => $posts, 'totalPosts' => $totalPosts]);
    }

    public function userPosts($slug)
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        $user_id = User::where('slug', $slug)->pluck('id')->first();
        $posts = Post::where('user_id', $user_id)->orderByDesc('created_at')->simplePaginate(20);
        $totalPosts = Post::where('user_id', $user_id)->count();
        return view('dashboard.post.index')->with(['posts' => $posts, 'totalPosts' => $totalPosts]);
    }
}
