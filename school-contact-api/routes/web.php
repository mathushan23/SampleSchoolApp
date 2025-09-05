<?php

use Illuminate\Support\Facades\Route;

// Optional: Default Laravel home page
Route::get('/', function () {
    return view('welcome');
});

// Catch-all route for React SPA
Route::get('/{any}', function () {
    return view('app'); // your React index.html in resources/views/app.blade.php
})->where('any', '.*');
