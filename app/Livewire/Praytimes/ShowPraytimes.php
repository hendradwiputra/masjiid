<?php

namespace App\Livewire\Praytimes;

use Livewire\Component;

class ShowPraytimes extends Component
{
    public $title = 'Pray Times Overview';
    public $subtitle = 'Atur waktu shalat berdasarkan lokasi Anda. Pastikan titik kordinat Anda akurat untuk hasil yang tepat.';
    
    public function render()
    {
        return view('livewire.praytimes.show-praytimes');
    }
}
