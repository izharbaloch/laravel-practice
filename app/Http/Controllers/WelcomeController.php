<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $name = request('name', 'Guest');
        return $name
            ? "Welcome, {$name}!"
            : "Welcome, Guest!";
    }
}
