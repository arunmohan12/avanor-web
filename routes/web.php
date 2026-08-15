<?php

use App\Http\Controllers\DeveloperController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\LeadController;




Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::get('/properties', [PropertyController::class, 'index'])
    ->name('properties.index');

    Route::get('/developers/{slug}', [DeveloperController::class, 'show'])
    ->name('developers.show');

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/privacy-policy', 'privacy')
    ->name('privacy-policy');
Route::view('/terms-and-conditions', 'termsandconditions')
    ->name('terms-and-conditions');

Route::get('/blogs', [BlogController::class, 'index'])
    ->name('blogs');


    Route::get('/blogs/{slug}', [BlogController::class, 'show'])
    ->name('blogs.show');

Route::get('/properties/{slug}', [PropertyController::class, 'show'])
    ->name('properties.show');
    Route::get('/sitemap.xml', [SitemapController::class, 'index'])
    ->name('sitemap');

    Route::get('/developer', [DeveloperController::class, 'index'])
    ->name('developer.index');

    Route::post('/leads', [LeadController::class, 'store'])
    ->name('leads.store');

    Route::view('/enquiry', 'leads.form')
    ->name('leads.form');

    Route::post('/enquiry', [LeadController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('leads.store');