<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
// use Image;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// App Controllers Routes
Route::get('/', 'App\HomeController')->name('home');
Route::get('/home', 'App\HomeController')->name('home');
// Category Posts Route
Route::get('/ct/{slug}', 'App\AppController@categoryPosts');
// Post Route
Route::get('/pt/{slug}', 'App\AppController@post');
// Pages Route
Route::get('/pg/{slug}', 'App\AppController@page');

// Dashboard Controllers Routes
Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');
Route::resource('category', 'Dashboard\CategoryController');
Route::resource('post', 'Dashboard\PostController');
Route::resource('video', 'Dashboard\VideoController');
Route::resource('page', 'Dashboard\PageController');
Route::resource('user', 'Dashboard\UserController');

// Dashboard Custom Routes
Route::get('/myblogposts', 'Dashboard\PostController@myblogposts')->name('myblogposts');
Route::post('/updateprofile/{slug}', 'Dashboard\UserController@updateprofile')->name('updateprofile');
Route::get('/userposts/{slug}', 'Dashboard\PostController@userPosts')->name('userposts');

// Pages
View::composer(['*'], function($view) {
    $pages = App\Page::orderByDesc('created_at')->get();
    $view->with('pages', $pages);
});

// Categories
View::composer(['*'], function($view) {
    $categories = App\Category::orderByDesc('created_at')->get();
    $view->with('categories', $categories);
});

// Latest 30 News
View::composer(['*'], function($view) {
    $latestThirtyNews = App\Post::orderByDesc('created_at')->where('type', 0)->limit(30)->get();
    $view->with('latestThirtyNews', $latestThirtyNews);
});

// Featured 12 News
View::composer(['*'], function($view) {
    $featuredTenNews = App\Post::orderByDesc('created_at')->where('type', 1)->limit(10)->get();
    $view->with('featuredTenNews', $featuredTenNews);
});

// Covid19 Api
View::composer(['*'], function($view) {
    // $covid19 = Http::get('https://api.covid19api.com/world/total');
    // $view->with('covid19', $covid19->json());
});

// CK Editor To Upload Image
Route::post('/ckeditor/upload', function (Request $request) {
    // Handle File Upload
    if ($request->hasFile('upload')) {
        // Get File Name
        $image = $request->file('upload');
        // Get Filename with Extension
        $fileNameWithExt = $image->getClientOriginalName();
        // Get Just File Name
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        // Get Just Extension
        $fileExt = $request->file('upload')->getClientOriginalExtension();
        // File Name To Store
        $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;

        $request->file('upload')->move(public_path('/uploads/ckeditor'), $fileNameToStore);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('uploads/ckeditor/'.$fileNameToStore);
        $msg = 'Image Upload Successfully';
        $response = "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg');</script>";

        @header('Content-type: text/html; charset-utf-8');
        echo $response;
    }



    // try {
    //     if ($this->request->hasFiles() == true) {
    //         $errors = []; // Store all foreseen and unforseen errors here
    //         $fileExtensions = ['jpeg','jpg','png','gif','svg'];
    //         $uploadDirectory = "../CkEditor5";
    //         $Y = date("Y");
    //         $M = date("m");
    //         foreach ($this->request->getUploadedFiles() as $file) {
    //             if (in_array($file->getExtension(), $fileExtensions)) {
    //                 if($file->getSize() < 2000000) {
    //                     if (!file_exists($uploadDirectory.$Y)) {
    //                         mkdir($uploadDirectory.$Y, 0777, true);
    //                     }
    //                     if (!file_exists($uploadDirectory.$Y.'/'.$M)) {
    //                         mkdir($uploadDirectory.$Y.'/'.$M, 0777, true);
    //                     }
    //                     $namenew = md5($file->getName().time()).'.'.$file->getExtension();
    //                     $uploadDirectory .= $Y.'/'.$M.'/'; 
    //                     $file->moveTo($uploadDirectory.$namenew);
    //                 } else {
    //                     $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
    //                 }
    //             } else {
    //                 $errors[] = "This file extension is not allowed. Please upload a JPEG ,svg,gif,,jpg,PNG file";
    //             }
    //             if(empty($errors)) {   
    //                 echo '{ 
    //                     "uploaded": true, 
    //                     "url": "http://127.0.0.1:8000/CkEditor5/'.$Y.'/'.$M.'/'.$namenew.'"
    //                 }';
    //             }
    //             else {
    //                 echo '{
    //                 "uploaded": false,
    //                 "error": {
    //                     "message": "could not upload this image1 error 1"
    //                 }';
    //             }
    //         }
    //     } else {
    //         echo '{
    //         "uploaded": false,
    //         "error": {
    //             "message": "could not upload this image1 error 2"
    //         }';
    //     }
    // } catch (\Exception $e) {
    //     echo '{
    //     "uploaded": false,
    //     "error": {
    //         "message": "could not upload this image0"
    //     }';
    // }
})->name('ckeditor.upload');
