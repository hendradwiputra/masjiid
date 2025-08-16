<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use App\Models\Profiles;
use Illuminate\Support\Facades\Storage;
use App\Events\LoadProfile;

class UpdateProfile extends Component
{
    use WithFileUploads;

    #[Title('Profile Overview')] 

    public $pageTitle = 'Profil';
    public $profiles;
    public $id, $logo, $name, $address, $description, $contact_no, $selected_theme, $created_at, $updated_at;
    public $newLogo;

    public function loadProfile()
    {
        $this->profiles = Profiles::first();

        if ($this->profiles) {
            $this->id = $this->profiles->id;
            $this->logo = $this->profiles->logo;
            $this->name = $this->profiles->name;
            $this->address = $this->profiles->address;
            $this->description = $this->profiles->description;
            $this->contact_no = $this->profiles->contact_no;
            $this->selected_theme = $this->profiles->selected_theme;
            $this->created_at = $this->profiles->created_at;
            $this->updated_at = $this->profiles->updated_at;
        }
    }
   
    public function mount()
    {
        $this->loadProfile();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'address' => '|string',
            'description' => 'nullable|string',
            'contact_no' => 'nullable|string|max:60',
            'selected_theme' => 'required|string',
            'newLogo' => 'nullable|image|max:2048',
        ];
    }

    public function update()
    {
        $this->validate();

        $profile = Profiles::firstOrNew(['id' => $this->id]);

        // Handle logo upload
        if ($this->newLogo) {
            // Delete old logo if exists
            if ($profile->logo) {
                $oldLogoPath = str_replace('storage/', 'public/', $profile->logo);
                Storage::delete($oldLogoPath);
            }
            
            // Store new logo
            $logoPath = $this->newLogo->store('public/images/logo');
            $profile->logo = str_replace('public/', 'storage/', $logoPath);
        }

        $profile->name = $this->name;
        $profile->address = $this->address;
        $profile->description = $this->description;
        $profile->contact_no = $this->contact_no;
        $profile->selected_theme = $this->selected_theme;
        $profile->save();

        // Refresh the data
        $this->mount();
        
    }

    public function getLogoUrlProperty()
    {
        if (!$this->logo) {
            return asset('storage/images/logo/mosque.png');
        }
        
        return Storage::exists(str_replace('storage/', 'public/', $this->logo)) 
            ? asset($this->logo) 
            : asset('storage/images/logo/mosque.png');
    }
    
    public function render()
    {
        return view('livewire.profile.update-profile');
    }
}
