<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Logout;
use App\Livewire\Profile\UpdateProfile;
use App\Livewire\Praytimes\Timer;
use App\Livewire\Praytimes\UpdatePraytimes;
use App\Livewire\Notification\UpdateNotification;
use App\Livewire\RunningText\ShowRunningText;
use App\Livewire\Image\UploadImage;
use App\Livewire\Image\SlideImages;
use App\Livewire\Image\CreateSlideImage;
use App\Livewire\Image\EditSlideImage;
use App\Livewire\Image\SlideImagesJumbotron;
use App\Livewire\Image\CreateSlideImagesJumbotron;
use App\Livewire\Slide\PraytimeSlide;
use App\Livewire\Slide\JumbotronSlide;
use App\Livewire\Slideshow;

Route::get('/', PraytimeSlide::class);
//Route::get('/', Slideshow::class);

Route::get('/timer', Timer::class);

// Slide
Route::get('/praytime-slide', PraytimeSlide::class)->name('praytime-slide');
Route::get('/jumbotron-slide', JumbotronSlide::class)->name('jumbotron-slide');

Route::group(['middleware' => 'guest'], function () {
    // Register
    Route::get('/register', Register::class)->name('register');
    
    // Login
    Route::get('/login', Login::class)->name('login');

});

Route::group(['middleware' => 'auth'], function () {

    // Profile
    Route::get('/settings/profile', UpdateProfile::class)->name('profile');

    // Praytimes
    Route::get('/settings/praytimes', UpdatePraytimes::class)->name('praytimes');

    // Notification
    Route::get('/settings/notification', UpdateNotification::class)->name('notification');

    // Running Teks
    Route::get('/running-text', ShowRunningText::class)->name('running-text');

    // Images
    Route::get('/upload-image', UploadImage::class)->name('upload-image');
    Route::get('/slide-images', SlideImages::class)->name('slide-images');
    Route::get('/slide-images/create', CreateSlideImage::class)->name('slide-images.create');
    Route::get('/slide-images/{id}/edit', EditSlideImage::class)->name('slide-images.edit');

    Route::get('/slide-jumbotron', SlideImagesJumbotron::class)->name('slide-images-jumbotron');
    Route::get('/slide-jumbotron/create', CreateSlideImagesJumbotron::class)->name('slide-images-jumbotron.create');

    // Logout
    Route::get('/logout', Logout::class)->name('logout');
    
}); 