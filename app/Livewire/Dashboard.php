<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $title = 'Dashboard Overview';
    public $subtitle = 'Welcome to your dashboard';

    public function render()
    {
        return view('livewire.dashboard');
    }
}
