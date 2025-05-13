<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/category', function () {
    return view('category');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/add', function () {
    return view('add-expense');
});
Route::get('/app', function () {
    return view('layouts.app');
});
