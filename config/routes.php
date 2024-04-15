<?php

use Modules\Commerce\src\Category\Http\Controllers\CategoryController;
use Modules\Shared\RouterCustom\CustomClassLoader;
use Pecee\SimpleRouter\SimpleRouter as Route;

Route::setCustomClassLoader(new CustomClassLoader());
Route::post('/v1/api/categories', [CategoryController::class, 'postCategory'])->name('categories.create');
Route::get('/v1/api/categories', [CategoryController::class, 'getAllCategory'])->name('categories.create');
Route::start();