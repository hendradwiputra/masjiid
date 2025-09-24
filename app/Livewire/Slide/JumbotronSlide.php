<?php

namespace App\Livewire\Slide;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Cache;
use App\Models\Image;
use Carbon\Carbon;

class JumbotronSlide extends Component
{
    #[Title('Jumbotron')]
    public $randomImages = [];

    public function loadRandomImages()
    {
        $now = Carbon::now('Asia/Jakarta');

        $images = Image::where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now)
                    ->where('category', 3)
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
