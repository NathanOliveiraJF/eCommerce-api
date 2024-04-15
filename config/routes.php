<?php

use Commerce\Category\Http\Controllers\CategoryController;
use Commerce\Shared\DI\ClassLoader;
use Pecee\SimpleRouter\SimpleRouter as Route;

Route::setCustomClassLoader(new ClassLoader());
Route::post('/v1/api/categories', [CategoryController::class, 'postCategory'])->name('categories.create');
Route::get('/v1/api/categories', [CategoryController::class, 'getAllCategory'])->name('categories.findAll');
Route::get('/v1/api/categories/{id}', [CategoryController::class, 'getCategory'])->name('categories.find');
Route::start();