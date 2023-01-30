<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Post;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $categories = Category::orderByDesc('created_at')->get();
        $singleCategoryNews = [];
        foreach ($categories as $category) {
            $post = Post::orderByDesc('created_at')->where('category_id', $category->id)->first();
            if (!empty($post)) {
                $singleCategoryNews[$category->title] = $post;
            }
        }

        $categoryNews = [];
        foreach ($categories as $category) {
            $post = Post::orderByDesc('created_at')->where('category_id', $category->id)->limit(12)->get();
            if (!empty($post)) {
                $categoryNews[$category->title] = $post;
            }
        }

        $dta = [
            'breakingNews' => Post::orderByDesc('created_at')->where('type', 2)->first(),
            'featuredNews' => Post::orderByDesc('created_at')->where('type', 1)->limit(2)->get(),
            'latestNews' => Post::orderByDesc('created_at')->where('type', 0)->limit(2)->get(),
            'singleCategoryNews' => $singleCategoryNews,
            'categoryNews' => $categoryNews
        ];

        return view('app.home')->with($dta);
    }
}
