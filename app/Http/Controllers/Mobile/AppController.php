<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Post;

class AppController extends Controller
{
    // Categories & News
    public function categories ()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function allNews ()
    {
        $news = Post::orderByDesc('created_at')->get();
        return response()->json($news);
    }

    // Category News
    public function categoryNews ($slug)
    {
        $category_id = Category::where('slug', $slug)->pluck('id')->first();
        $news = Post::orderByDesc('created_at')->where('category_id', $category_id)->get();
        return response()->json($news);
    }
    
    public function categoryFourNews ($slug)
    {
        $category_id = Category::where('slug', $slug)->pluck('id')->first();
        $news = Post::orderByDesc('created_at')->where('category_id', $category_id)->limit(4)->get();
        return response()->json($news);
    }
    
    public function categorySingleNews ($slug)
    {
        $category_id = Category::where('slug', $slug)->pluck('id')->first();
        $news = Post::orderByDesc('created_at')->where('category_id', $category_id)->first();
        return response()->json($news);
    }
    
    // Latest, Featured & Breaking News
    public function latestNews ()
    {
        $latestNews = Post::orderByDesc('created_at')->where('featured', 0)->limit(8)->get();
        return response()->json($latestNews);
    }
    
    public function featuredNews ()
    {
        $featuredNews = Post::orderByDesc('created_at')->where('featured', 1)->limit(8)->get();
        return response()->json($featuredNews);
    }
    
    public function breakingNews ()
    {
        $breakingNews = Post::orderByDesc('created_at')->where('featured', 1)->limit(8)->get();
        return response()->json($breakingNews);
    }

    // News
    public function news ($slug)
    {
        $news = Post::where('slug', $slug)->first();
        $news->views += 1;
        $news->save();
        return response()->json($news);
    }
}
