<?php

namespace App\Livewire\Praytimes;

use Livewire\Component;

class ShowPraytimes extends Component
{
    public $pageTitle = 'Pray Times Overview';
    public $subTitle = 'Atur waktu shalat berdasarkan lokasi Anda. Pastikan titik kordinat Anda akurat untuk hasil yang tepat.';
    
    public function render()
    {
        return view('livewire.praytimes.show-praytimes');
    }
}
