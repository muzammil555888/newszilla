<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Gate;

class UserController extends Controller
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
        
        $user_types = [];
        $user;
        if (Gate::allows('isAdmin')) {
            $user_types = ['user' => 'User', 'author' => 'Author', 'manager' => 'Manager', 'admin' => 'Admin'];
            $users = User::orderByDesc('created_at')->paginate(20);
        } elseif (Gate::allows('isManager')) {
            $user_types = ['user' => 'User', 'author' => 'Author', 'manager' => 'Manager'];
            $users = User::where('type', '<>', 'admin')->orderByDesc('created_at')->paginate(20);
        }
        return view('dashboard.user.index')->with(['users' => $users, 'user_types' => $user_types]);
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

        redirect('/user');
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

        redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(Gate::allows('isUser')) {
            return back();
        }

        $user = User::find(auth()->user()->id)->first();
        return view('dashboard.user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        $user = User::find(auth()->user()->id)->first();
        return view('dashboard.user.show')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        $user = User::where('slug', $slug)->first();
        $user->type = $request->input('type');
        
        if ($user->save()) {
            return redirect('/user')->with('success', 'User Type Changed');
        } else {
            return back()->with('error', 'Failed To Change User Type');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('isUser') || Gate::allows('isAuthor')) {
            return back();
        }

        //
    }

    public function updateprofile (Request $request, $slug)
    {
        if(Gate::allows('isUser')) {
            return back();
        }

        $this->validate($request, [
            'name'  =>  'required|max:255|min:3',
            'designation' => 'max:255',
            'user_description' => 'max:255',
            'address' => 'max:255',
            'city' => 'max:255',
            'state' => 'max:255'
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
            $destinationPath = public_path('/uploads/users');
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
            $fileNameToStore = 'NULL';
        }

        $user = User::where('slug', $slug)->first();
        $user->slug = Str::slug($request->input('name'), '-').'-'.time();
        $user->name = $request->input('name');
        if ($request->hasFile('image')) {
            if (\File::exists(public_path('/uploads/users/'.$user->image))) {
                \File::delete(public_path('/uploads/users/'.$user->image));
            }
            $user->image = $fileNameToStore;
        }
        $user->designation = $request->input('designation');
        $user->gender = $request->input('gender');
        $user->description = $request->input('user_description');
        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->state = $request->input('state');

        if ($user->save()) {
            return redirect('/user/show')->with('success', 'User Updated');
        } else {
            return back()->with('error', 'Failed To Update User');
        }
    }
}
