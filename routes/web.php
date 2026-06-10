<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('Homepage'))->name('Homepage');
Route::get('/login', fn() => view('login'))->name('login');
Route::get('/register', fn() => view('register'))->name('register');