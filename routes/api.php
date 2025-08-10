<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\packagesController;
use App\Http\Controllers\vehicleController;

Route::get('list/packages', [packagesController::class,'jsonData']); 
Route::get('list/vehicles', [vehicleController::class,'jsonData']); 

Route::get('list/packages/{id}', [packagesController::class,'jsonDataDetail']);
Route::get('list/vehicles/{id}', [vehicleController::class,'jsonDataDetail']); 