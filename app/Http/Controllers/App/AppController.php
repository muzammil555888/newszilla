<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Page;

class AppController extends Controller
{
    public function categoryPosts($slug)
    {
        $category_id = Category::where('slug', $slug)->pluck('id')->first();
        $posts = Post::orderByDesc('created_at')->where('category_id', $category_id)->simplePaginate(20);
        return view('app.blog.index')->with('posts', $posts);
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $post->views += 1;
        $post->save();
        return view('app.blog.show')->with('post', $post);
    }
    
    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return view('app.page')->with('page', $page);
    }
}
