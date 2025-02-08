<?php

use App\Http\Controllers\AnnouncedPollingUnitResultController;
use App\Http\Controllers\AuthControllertController;
use App\Http\Controllers\PollingUnitController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AnnouncedPollingUnitResultController::class,'index'])->name('pu.search');

// Route::get('/', [AuthControllertController::class,'authenticate'])->name('pu.search');
Route::get('/signup', [AuthControllertController::class,'signup'])->name('auth.signup');
Route::get('/login', [AuthControllertController::class,'login'])->name('auth.login');
Route::get('/pu-search', [AnnouncedPollingUnitResultController::class,'autocomplete'])->name('pu.results');
Route::get('/pu-results/', [AnnouncedPollingUnitResultController::class,'show'])->name('pu.results.show');
Route::get('/pu-results/{pu}/edit', [AnnouncedPollingUnitResultController::class,'edit'])->name('pu.results.edit');
Route::put('/pu-results/{pu}', [AnnouncedPollingUnitResultController::class,'update'])->name('pu.results.update');
Route::post('/pu-results-delete', [AnnouncedPollingUnitResultController::class,'destroy'])->name('pu.results.destroy');
// getSummedResults 
Route::get('/polling-unit/create', [PollingUnitController::class,'create'])->name('pu.create'); 
Route::get('/polling-unit/results', [PollingUnitController::class,'results'])->name('polling-unit.results');
Route::post('/polling-unit/store', [PollingUnitController::class,'store'])->name('pu.store');
Route::get('/pu-results/summed-results', [AnnouncedPollingUnitResultController::class,'getSummedResults'])->name('pu.results.summed');