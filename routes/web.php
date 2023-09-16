<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/create-request', [ApplicationController::class, 'createRequestForm'])->name('create.request.form');
    Route::post('/create-request', [ApplicationController::class, 'generateRequest'])->name('create.request');
    Route::post('/generatePDF', [RequestController::class, 'generatePDF'])->name('generatePDF');
    Route::get('/admin/option', 'UserController@adminOption')->name('admin.option.route');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/new-user', [UserController::class, 'create'])->name('new-user.create');
    Route::post('/teams', 'TeamController@store')->name('teams.store');
    Route::get('/generate-pdf/{id}', 'AppController@generatePDF')->name('generate.pdf');
    Route::get('/generate-pdf/{id}', [ApplicationController::class, 'generatePDF'])->name('generate.pdf');
    Route::post('/verify-password-and-approve/{id}', 'ApplicationController@verifyPasswordAndApprove')->name('verify.password.approve');
});
