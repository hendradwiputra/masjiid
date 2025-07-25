<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $pageTitle = 'Dashboard Overview';
    public $subTitle = 'Welcome to your dashboard';

    public function render()
    {
        return view('livewire.dashboard');
    }
}
