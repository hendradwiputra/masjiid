<?php

namespace App\Livewire\Slide;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use App\Models\Image;

class JumbotronSlide extends Component
{
    public $randomImages = [];

    public function loadRandomImages()
    {
        $images = Image::where('category', 2)
                    ->inRandomOrder()
                    ->limit(10)
                    ->get();

        $this->randomImages = $images->map(function($image) {
            return asset('storage/' . $image->image_name);
        })->toArray();
    }

    public function mount()
    {
        $this->loadRandomImages();
    }

    public function render()
    {
        return view('livewire.slide.jumbotron-slide');
    }
}
