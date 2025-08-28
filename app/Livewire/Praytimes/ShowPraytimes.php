<?php

namespace App\Livewire\Praytimes;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\Praytime;
use App\Models\Image;

class ShowPraytimes extends Component
{
    public $profile;
    public $praytimes;
    public $randomImages = [];
    public $logo;

    #[Title('Masjiid')]

    public function getprofile()
    {
        $profile = Profile::first();

        $image_name = null;
        if ($profile?->image_id) {
            $image = Image::find($profile->image_id);
            $image_name = $image?->image_name;
            if (!$image) {
                \Log::warning("Invalid image_id {$profile->image_id} found in profile ID {$profile->id}");
            }
        }
        
        return [
            'id' => $profile->id,
            'name' => $profile->name,
            'address' => $profile->address,
            'description' => $profile->description,
            'contact_no' => $profile->contact_no,
            'selected_theme' => $profile->selected_theme,
            'image_id' => $profile->image_id,
            'image_name' => $image_name,
        ];

    }

    public function getPraytimes()
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

    protected function loadRandomImages()
    {
        $images = Image::where('category', 2)
                    ->inRandomOrder()
                    ->get();

        $this->randomImages = $images->map(function($image) {
            return asset('storage/' . $image->image_name);
        })->toArray();
    }

    public function refreshImages()
    {
        $this->loadRandomImages();
    }

    public function loadData()
    {
        $this->profile = $this->getprofile();      
        $this->praytimes = $this->getPraytimes();
        $this->loadRandomImages();
    }

    public function mount()
    {
        $this->loadData();    
    }

    public function render()
    {
        return view('livewire.praytimes.show-praytimes', [
            'profile'   => $this->profile,
            'praytimes'  => $this->praytimes,
            
        ]);
    }
}
