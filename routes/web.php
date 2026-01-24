<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 🔍 Refined (Expert version – yaad rakhna)

// Closure route → chhoti cheezon / quick testing ke liye

// Controller → jab:

// logic zyada ho

// code reusable ho

// project grow kar raha ho

// 👉 Rule of thumb:

// Route = traffic police 🚦
// Controller = brain 🧠

// day 2

// closure route
// Route::get('/welcom', function () {
//     return "Welcom for day 1";
// });

// controller route
// Route::get('/welcome', [WelcomeController::class, 'index']);



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
