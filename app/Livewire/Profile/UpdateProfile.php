<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Profile;

class UpdateProfile extends Component
{
    
    #[Title('Profile Overview')] 

    public $profile;
    public $id, $logo, $name, $address, $description, $contact_no, $selected_theme, $created_at, $updated_at;
    public $newLogo;

    public function loadProfile()
    {
        $this->profile = Profile::first();

        if ($this->profile) {
            $this->id = $this->profile->id;
            $this->logo = $this->profile->logo;
            $this->name = $this->profile->name;
            $this->address = $this->profile->address;
            $this->description = $this->profile->description;
            $this->contact_no = $this->profile->contact_no;
            $this->selected_theme = $this->profile->selected_theme;
            $this->created_at = $this->profile->created_at;
            $this->updated_at = $this->profile->updated_at->format('d M Y, h:i A');
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

        $profile = Profile::firstOrNew(['id' => $this->id]);

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
        $profile->updated_at = now();
        $profile->save();
        
        // Refresh the data
        $this->mount();

        session()->flash('message', 'Data berhasil disimpan.');

        return $this->redirect(request()->header('Referer'), navigate: true);

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
