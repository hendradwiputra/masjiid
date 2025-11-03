<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

class Slideshow extends Component
{
    #[Title('Masjiid')]

    public $slides = [];

    public function mount()
    {
        
        $this->slides = [
            [
                'component' => 'slide.praytime-slide',
                'duration' => 20000, // 15 seconds default if no prayer status
            ]
        ];
    }

    public function render()
    {
        return view('livewire.slideshow', [
            'slides' => $this->slides
        ]);
    }
}
