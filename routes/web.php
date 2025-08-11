<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\App\AddPackage;
use App\Http\Controllers\packagesController;
use App\Http\Controllers\vehicleController;
use App\Livewire\VehicleApp;


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


    //vehicle routes
    Route::get('vehicles', vehicleApp::class)->name('vehicles'); //livewire app to show add vehicle view
    Route::post('vehicles/save', [vehicleController::class,'save'])->name('vehicles.save')->middleware('role:admin');; //save vehicle
    Route::get('vehicles/toogleavailability/{id}',[vehicleController::class,'toogleAvailability'])->name('vehicles.toggleavailability'); //toggle availability of vehicle
    Route::get('vehicles/delete/{id}', [vehicleController::class,'delete'])->name('vehicles.delete')->middleware('role:admin');; //delete vehicle
    Route::get('vehicles/payment/preview/{id}', [vehicleController::class,'paymentPreview'])->name('vehicles.payment.preview'); //preview payment for vehicle

    // travel packages routes
    Route::get('packages', AddPackage::class)->name('packages'); //livewire app to show add package view
    Route::get('packages/delete/{id}', [packagesController::class,'delete'])->name('delete')->middleware('role:admin');; //delete package
    Route::post('packages.save', AddPackage::class)->name('save')->middleware('role:admin');; //controller to handle package saving
    
    //users
    Volt::route('users','users')->name('users')->middleware('role:admin');
    Volt::route('users/add','')->name('addusers')->middleware('role:admin');;
});

require __DIR__.'/auth.php';
