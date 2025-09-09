<?php

namespace App\Livewire\Praytimes;

use App\Models\Praytime;
use App\Models\Notification;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Masjiid App - Timer')]
class Timer extends Component
{
    protected function getNotification()
    {
        $notification = Notification::first();

        return [
            'sunrise_caption' => $notification->sunrise_caption,
            'prayer_caption' => $notification->prayer_caption,
            'before_adhan_caption' => $notification->before_adhan_caption,
            'adhan_caption' => $notification->adhan_caption,            
            'iqomah_caption' => $notification->iqomah_caption,
            'jumuah_caption' => $notification->jumuah_caption
        ];
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
            'adhan_duration' => $praytimes->adhan_duration            
        ];
    }

    public function render()
    {
        $praytimes = $this->getPrayTimes();
        $notification = $this->getNotification();

        return view('livewire.praytimes.timer', compact('praytimes', 'notification'));
    }

}
