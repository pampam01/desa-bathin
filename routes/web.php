<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('backend.admin.dashboard');
})->name('dashboard');

Route::get('/news', function () {
    return view('backend.admin.news.index');
})->name('news.index');

Route::get('/news/create', function () {
    return view('backend.admin.news.create');
})->name('news.create');

Route::get('/complaints', function () {
    return view('backend.admin.news.create');
})->name('complaints.index');

Route::get('/complaints/create', function () {
    return view('backend.admin.news.create');
})->name('complaints.pending');

Route::get('/users', function () {
    return view('backend.admin.news.create');
})->name('users.index');

Route::get('/users/create', function () {
    return view('backend.admin.news.create');
})->name('users.create');
