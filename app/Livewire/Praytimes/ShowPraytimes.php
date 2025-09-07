<?php

namespace App\Livewire\Praytimes;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        return Cache::remember('profile', 300, function () {
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
                'id' => $profile->id ?? null,
                'name' => $profile->name ?? 'Nama Masjid',
                'address' => $profile->address ?? 'Alamat Masjid',
                'description' => $profile->description ?? 'Informasi tentang masjid',
                'contact_no' => $profile->contact_no ?? 'no handphone',
                'selected_theme' => $profile->selected_theme ?? 'theme1',
                'image_id' => $profile->image_id ?? null,
                'image_name' => $image_name,
            ];
        });
    }

    public function getPraytimes()
    {
        return Cache::remember('praytimes', 300, function () {
            $praytimes = Praytime::first();

            return [
                'id' => $praytimes->id ?? null,
                'time_format' => $praytimes->time_format ?? '12h',
                'prayer_calc_method' => $praytimes->prayer_calc_method ?? 'Kemenag',
                'latitude' => $praytimes->latitude ?? '3.67026',
                'longitude' => $praytimes->longitude ?? '98.59399',
                'timezone' => $praytimes->timezone ?? '7',
                'dst' => $praytimes->dst ?? '0',
                'hijri_correction' => $praytimes->hijri_correction ?? '0',
                'prayer1_alias' => $praytimes->prayer1_alias ?? 'fajr',
                'prayer2_alias' => $praytimes->prayer2_alias ?? 'sunrise',
                'prayer3_alias' => $praytimes->prayer3_alias ?? 'dhuhr',
                'prayer4_alias' => $praytimes->prayer4_alias ?? 'asr',
                'prayer5_alias' => $praytimes->prayer5_alias ?? 'maghrib',
                'prayer6_alias' => $praytimes->prayer6_alias ?? 'isha',
                'sunrise_lock_duration' => $praytimes->sunrise_lock_duration ?? '10',
                'prayer_lock_duration' => $praytimes->prayer_lock_duration ?? '10',
                'jumuah_lock_duration' => $praytimes->jumuah_lock_duration ?? '20',
                'sunrise_caption' => $praytimes->sunrise_caption ?? null,
                'prayer_caption' => $praytimes->prayer_caption ?? null,
                'adhan_caption' => $praytimes->adhan_caption ?? null,
                'adhan_duration' => $praytimes->adhan_duration ?? null,
                'iqomah_caption' => $praytimes->iqomah_caption ?? null,
                'prayer1_iqomah_duration' => $praytimes->prayer1_iqomah_duration ?? '3', 
                'prayer3_iqomah_duration' => $praytimes->prayer3_iqomah_duration ?? '3',
                'prayer4_iqomah_duration' => $praytimes->prayer4_iqomah_duration ?? '3',
                'prayer5_iqomah_duration' => $praytimes->prayer5_iqomah_duration ?? '3',
                'prayer6_iqomah_duration' => $praytimes->prayer6_iqomah_duration ?? '3', 
                'prayer1_correction' => $praytimes->prayer1_correction ?? '0',  
                'prayer2_correction' => $praytimes->prayer2_correction ?? '0', 
                'prayer3_correction' => $praytimes->prayer3_correction ?? '0',  
                'prayer4_correction' => $praytimes->prayer4_correction ?? '0', 
                'prayer5_correction' => $praytimes->prayer5_correction ?? '0', 
                'prayer6_correction' => $praytimes->prayer6_correction ?? '0', 
            ];
        });
    }

    protected function loadRandomImages()
    {
        $images = Image::where('category', 2)
                    ->inRandomOrder()
                    ->limit(10)
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
