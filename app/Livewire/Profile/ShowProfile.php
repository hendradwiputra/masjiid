<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Profiles;

class ShowProfile extends Component
{
    #[Title('Profile Overview')] 

    public $pageTitle = 'Detail lokasi & kontak';
    public $subTitle = 'Update profil untuk memastikan informasi yang akurat dan terkini.';
    public Profiles $profile;
    public $logo, $name, $address, $description, $contact_no;
   
    public function mount()
    {
        
        $this->profiles = Profiles::first();

        if ($this->profiles) {
            $this->logo = $this->profiles->logo;
            $this->name = $this->profiles->name;
            $this->address = $this->profiles->address;
            $this->description = $this->profiles->description;
            $this->contact_no = $this->profiles->contact_no;
        }
        
    }
        
    public function render()
    {
        return view('livewire.profile.show-profile');
    }
}
