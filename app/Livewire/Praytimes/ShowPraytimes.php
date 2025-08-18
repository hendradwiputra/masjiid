<?php

namespace App\Livewire\Praytimes;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Profiles;
use App\Models\Praytime;

class ShowPraytimes extends Component
{
    public $profiles;
    public $praytimes;
    public $imagePaths;

    #[Title('Masjiid')]

    protected function getProfiles()
    {
        $profiles = Profiles::first();
        
        return [
            'id' => $profiles->id,
            'logo' => $profiles->logo ? asset('storage/images/logo/' . $profiles->logo) : asset('storage/images/logo/mosque1.png'),
            'name' => $profiles->name,
            'address' => $profiles->address,
            'description' => $profiles->description,
            'contact_no' => $profiles->contact_no,
            'selected_theme' => $profiles->selected_theme,
        ];
    }

    protected function getPraytimes()
    {
        $praytimes = Praytime::first();

        return [
            'id' => $praytimes->id,
            'time_format' => $praytimes->time_format,
            'prayer_calc_method' => $praytimes->prayer_calc_method,
            'latitude' => $praytimes->latitude,
            'longitude' => $praytimes->longitude,
            'timezone' => $praytimes->timezone,
            'dst' => $praytimes->dst,
            'hijri_correction' => $praytimes->hijri_correction,
            'prayer1_alias' => $praytimes->prayer1_alias,
            'prayer2_alias' => $praytimes->prayer2_alias,
            'prayer3_alias' => $praytimes->prayer3_alias,
            'prayer4_alias' => $praytimes->prayer4_alias,
            'prayer5_alias' => $praytimes->prayer5_alias,
            'prayer6_alias' => $praytimes->prayer6_alias,
            'sunrise_lock_duration' => $praytimes->sunrise_lock_duration,
            'prayer_lock_duration' => $praytimes->prayer_lock_duration,
            'jumuah_lock_duration' => $praytimes->jumuah_lock_duration,
            'sunrise_caption' => $praytimes->sunrise_caption,
            'prayer_caption' => $praytimes->prayer_caption,
            'adhan_caption' => $praytimes->adhan_caption,
            'adhan_duration' => $praytimes->adhan_duration,
            'iqomah_caption' => $praytimes->iqomah_caption,
            'prayer1_iqomah_duration' => $praytimes->prayer1_iqomah_duration, 
            'prayer3_iqomah_duration' => $praytimes->prayer3_iqomah_duration,
            'prayer4_iqomah_duration' => $praytimes->prayer4_iqomah_duration,
            'prayer5_iqomah_duration' => $praytimes->prayer5_iqomah_duration,
            'prayer6_iqomah_duration' => $praytimes->prayer6_iqomah_duration, 
            'prayer1_correction' => $praytimes->prayer1_correction,  
            'prayer2_correction' => $praytimes->prayer2_correction, 
            'prayer3_correction' => $praytimes->prayer3_correction,  
            'prayer4_correction' => $praytimes->prayer4_correction, 
            'prayer5_correction' => $praytimes->prayer5_correction, 
            'prayer6_correction' => $praytimes->prayer6_correction, 
        ];
    }

    public function getRandomImages()
    {
    
        $imageDirectory = public_path('storage/images/upload');

        // Return empty array if directory doesn't exist
        if (!File::exists($imageDirectory)) {
            return [];
        }
        
        // Get all files from the directory
        $imageFiles = File::files($imageDirectory);
        
        // Filter only image files (optional but recommended)
        $images = array_filter($imageFiles, function($file) {
            return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
        });
        
        // Convert to relative paths for use in views
        return array_map(function($file) {
            return 'storage/images/upload/' . $file->getFilename();
        }, $images); // Use the filtered $images array here, not File::files()

    }

    public function loadData()
    {
        $this->profiles = $this->getProfiles();      
        $this->praytimes = $this->getPraytimes();
        $this->imagePaths = $this->getRandomImages();  
    }

    public function mount()
    {
        $this->loadData();    
    }

    public function render()
    {
        return view('livewire.praytimes.show-praytimes', [
            'profiles'   => $this->profiles,
            'praytimes'  => $this->praytimes,
            'imagePaths' => $this->imagePaths,
        ]);
    }
}
