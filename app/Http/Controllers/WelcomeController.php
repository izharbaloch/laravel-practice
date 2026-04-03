<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    // day 1
    // public function index()
    // {
    //     $name = request('name', 'Guest');
    //     return $name
    //         ? "Welcome, {$name}!"
    //         : "Welcome, Guest!";
    // }

    // day 2
    public function index()
    {
        $name = request('name', 'Guest');
        $name = "<b>izhar</b>";
        return view('welcome', [
            'name' => $name,
        ]);
    }

    // day 3 and day 4
    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Submission::create([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Form submitted successfully! Name: ' . $request->input('name'));

    }
}
