<?php

use modules\Commerce\src\Category\Http\Controllers\CategoryController;
use modules\Shared\RouterCustom\CustomClassLoader;
use Pecee\SimpleRouter\SimpleRouter as Route;

Route::setCustomClassLoader(new CustomClassLoader());
Route::post('/v1/api/categories', [CategoryController::class, 'postCategory'])->name('categories.create');
Route::start();