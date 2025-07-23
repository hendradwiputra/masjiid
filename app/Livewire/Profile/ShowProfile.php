<?php

namespace App\Livewire\Profile;

use Livewire\Component;

class ShowProfile extends Component
{
    public $title = 'Profile Overview';
    public $subtitle = 'Perbaharui profil anda untuk memastikan informasi yang akurat dan terkini.';

    public function render()
    {
        return view('livewire.profile.show-profile');
    }
}
