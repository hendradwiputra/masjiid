<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Praytimes\Show;
use App\Livewire\Praytimes\Timer;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;
use App\Livewire\Profile\ShowProfile;
use App\Livewire\Dashboard;
use App\Livewire\Praytimes\ShowPraytimes;

Route::get('/', Show::class);

Route::get('/timer', Timer::class);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
    Route::get('/profile', ShowProfile::class)->name('profile');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/praytimes', ShowPraytimes::class)->name('praytimes');
});