<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\App\AddPackage;
use App\Http\Controllers\packagesController;

//for api

Route::get('api/list/packages', [packagesController::class,'jsonData']); //livewire app to show add package view



// end of api
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');




Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('packages', AddPackage::class)->name('packages'); //livewire app to show add package view
    Route::post('packages.save', AddPackage::class)->name('save'); //controller to handle package saving
    });

require __DIR__.'/auth.php';
