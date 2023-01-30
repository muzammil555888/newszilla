<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Video;
use Gate;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Gate::allows('isUser')) {
            return redirect('/');
        }
        
        $dta = [
            'totalusers'    =>  User::get()->count(),
            'totalposts'    =>  Post::get()->count(),
            'mytotalposts'    =>  Post::where('user_id', auth()->user()->id)->get()->count(),
            'totalvideos'    =>  Video::get()->count()
        ];
        return view('dashboard.index')->with($dta);
    }
}
