<?php

use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function(){
    return view('welcome');
});

Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
