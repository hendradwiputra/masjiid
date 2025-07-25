<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Logout;
use App\Livewire\Dashboard;
use App\Livewire\Praytimes\Show;
use App\Livewire\Praytimes\Timer;
use App\Livewire\Profile\ShowProfile;
use App\Livewire\Praytimes\ShowPraytimes;

Route::get('/', Show::class);

Route::get('/timer', Timer::class);

Route::group(['middleware' => 'guest'], function () {
    // Register
    Route::get('/register', Register::class)->name('register');
    // Login
    Route::get('/login', Login::class)->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    // Dashboard
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    // Profile
    Route::get('/profile', ShowProfile::class)->name('profile');
    // Praytimes
    Route::get('/praytimes', ShowPraytimes::class)->name('praytimes');
    // Logout
    Route::get('/logout', Logout::class)->name('logout');
}); 
