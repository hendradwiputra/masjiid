<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Logout;
use App\Livewire\Dashboard;
use App\Livewire\Profile\UpdateProfile;
use App\Livewire\Praytimes\Timer;
use App\Livewire\Praytimes\UpdatePraytimes;
use App\Livewire\Notification\UpdateNotification;
use App\Livewire\Notification\ShowRunningText;
use App\Livewire\Image\UploadImage;
use App\Livewire\Slide\PraytimeSlide;
use App\Livewire\Slide\JumbotronSlide;
use App\Livewire\DisplayCycle;

Route::get('/', DisplayCycle::class);

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

    // Notification
    Route::get('/notification', UpdateNotification::class)->name('notification');

    // Running Teks
    Route::get('/running-text', ShowRunningText::class)->name('running-text');

    // Slide
    Route::get('/praytime-slide', PraytimeSlide::class)->name('praytime-slide');
    Route::get('/jumbotron-slide', JumbotronSlide::class)->name('jumbotron-slide');

    // Uploads
    Route::get('/upload-image', UploadImage::class)->name('upload-image');

    // Logout
    Route::get('/logout', Logout::class)->name('logout');
    
}); 