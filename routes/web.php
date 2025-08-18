<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Logout;
use App\Livewire\Dashboard;
use App\Livewire\Praytimes\ShowPraytimes;
use App\Livewire\Praytimes\Timer;
use App\Livewire\Profile\UpdateProfile;
use App\Livewire\Praytimes\UpdatePraytimes;
use App\Livewire\Text\AddAndEditText;
use App\Livewire\Upload\ShowUploads;

Route::get('/', ShowPraytimes::class);

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
    Route::get('/profile', UpdateProfile::class)->name('profile');
    // Praytimes
    Route::get('/praytimes', UpdatePraytimes::class)->name('praytimes');
    // Add and Edit Text
    Route::get('/add-and-edit-text', AddAndEditText::class)->name('add-and-edit-text');
    // Uploads
    Route::get('/upload', ShowUploads::class)->name('upload');
    // Logout
    Route::get('/logout', Logout::class)->name('logout');
}); 
