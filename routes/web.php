<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// day 2

// 🟢 Step 1: Simple GET Route
Route::get('/welcom', function () {
    return "Welcom for day 2";
});

// 🟢 Step 2: Route with Parameter
Route::get('/user/{name}', function ($name) {
    return "hello" . $name;
});

// 🟢 Step 3: Optional Parameter
Route::get('/user/{name?}', function ($name = "Defaul Name") {
    return "My name is:" . $name;
});

// 🟢 Step 4: Named Route
Route::get('/dashboard', function () {
    return 'Welcome to Dashboard';
})->name('dashboard');

Route::get('/go-to-dashboard', function () {
    return redirect()->route('dashboard');
});

// 🟢 Step 5: POST Route with Form
Route::get('/form', function () {
    return view('form');
});
Route::post('/submit', function (Request $request) {
    return "name:". $request->username;
});
