<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ProvinceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProvinceController::class, 'index'])->name('province.index');
Route::post('/province/store', [ProvinceController::class, 'store'])->name('province.store');
Route::get('/provinces/{province}/edit', [ProvinceController::class, 'edit'])->name('province.edit');
Route::post('/provinces/{province}/update', [ProvinceController::class, 'update'])->name('province.update');
Route::delete('/provinces/{province}', [ProvinceController::class, 'destroy'])->name('province.delete');

Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::post('/cities/store', [CityController::class, 'store'])->name('cities.store');