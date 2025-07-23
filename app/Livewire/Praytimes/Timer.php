<?php

namespace App\Livewire\Praytimes;

use App\Models\Praytime;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Masjiid App - Timer')]
class Timer extends Component
{
    public function render()
    {
        $praytimes = $this->getPrayTimes();

        return view('livewire.praytimes.timer', compact('praytimes'));
    }

    protected function getPraytimes()
    {

        // Get the first profile from the database
        $praytimes = Praytime::first();

        return [
            'id' => $praytimes->id,  
            'sunrise_lock_duration' => $praytimes->sunrise_lock_duration,
            'prayer_lock_duration' => $praytimes->prayer_lock_duration,
            'jumuah_lock_duration' => $praytimes->jumuah_lock_duration,
            'sunrise_caption' => $praytimes->sunrise_caption,
            'prayer_caption' => $praytimes->prayer_caption,
            'adhan_caption' => $praytimes->adhan_caption,
            'adhan_duration' => $praytimes->adhan_duration,
            'iqomah_caption' => $praytimes->iqomah_caption,
        ];
    }
}
