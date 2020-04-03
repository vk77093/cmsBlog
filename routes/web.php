<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blog\PostController;

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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/welcome2', 'WelcomeController@indexSearch')->name('welcomeSearch');
Route::get('/blog/posts{post}',[PostController::class,'show'])->name('blog.show');
Route::get('/blog/category/{category}',[PostController::class,'category'])->name('blog.category');
Route::get('/blog/tag/{tag}',[PostController::class,'tag'])->name('blog.tag');
Auth::routes();


Route::middleware(['auth'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/category', 'CategoryController');
    Route::get('/category/{category}/delete', 'CategoryController@destroy2')->name('delete');
    Route::resource('/post', 'PostController');
    Route::get('/trash', 'PostController@trash');
    Route::resource('/tag', 'TagController');
});
Route::middleware(['auth','admin'])->group(function(){
    Route::get('user', 'UserController@index')->name('user.index');
    Route::post('user/{user}/make-admin','UserController@makeAdmin')->name('user.make-admin');
    Route::get('user/edit-profile','UserController@edit')->name('user.edit-profile');
    Route::put('user/{user}/update-profile','UserController@update')->name('user.update-profile');
});


