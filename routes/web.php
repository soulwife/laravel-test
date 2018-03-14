<?php

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

use Illuminate\Http\Request;


Route::get('/', function () {
    $quests = \App\Quest::all();

    return view('welcome', ['quests' => $quests]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/submit', function () {
    return view('submit');
});


Route::post('/submit', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'url' => 'required|url|max:255',
        'description' => 'required|max:255',
    ]);

    $quest = tap(new App\Quest($data))->save();

    return redirect('/');
});