<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[PageController::class,'home'])->name('home');

Route::get('/about',[PageController::class,'about'])->name('about');

Route::get('/blog',[PageController::class,'blogIndex'])->name('blog');

Route::get('/blog/category/{category:slug}',[PageController::class,'blogByCategory'])->name('blog.category');

Route::get('/blog/{blog:slug}',[PageController::class,'blogShow'])->name('blog.details');

Route::get('/courses',[PageController::class,'courses'])->name('courses');

Route::get('/courses/details',[PageController::class,'courseDetails'])->name('courses.details');

