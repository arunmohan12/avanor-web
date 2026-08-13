<?php

use App\Http\Controllers\DeveloperController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\HomeController;


Route::view('/test', 'welcome')->name('welcome');


Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::get('/properties', [PropertyController::class, 'index'])
    ->name('properties.index');

Route::get('/developers/{developer:slug}', [DeveloperController::class, 'show'])
        ->name('developers.show');

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/privacy-policy', 'privacy')
    ->name('privacy-policy');
Route::view('/terms-and-conditions', 'termsandconditions')
    ->name('terms-and-conditions');

    Route::view('/property-details', 'properties.propertydetails')
    ->name('property-details');


    Route::get('/properties/{slug}', [PropertyController::class, 'show'])
    ->name('properties.show');