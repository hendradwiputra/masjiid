<?php

namespace App\Livewire\Slide;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Cache;

use App\Models\Image;
use App\Models\Praytime;
use Carbon\Carbon;

class JumbotronSlide extends Component
{
    #[Title('Jumbotron')]
    
    public $randomImages = [];
    public $praytimes;

    public function loadRandomImages()
    {
        $now = Carbon::now('Asia/Jakarta');

        $images = Image::inRandomOrder()
                    ->limit(5)
                    ->get();

        $this->randomImages = $images->map(function($image) {
            return asset('storage/' . $image->image_name);
        })->toArray();
    }

    public function getPraytimes()
    {
        return Cache::remember('praytimes', 300, function () {
            $praytimes = Praytime::first() ?? new Praytime();

            // Sanitize fields to prevent JSON issues
            $sanitized = [
                'id' => $praytimes->id ?? null,
                'time_format' => htmlspecialchars($praytimes->time_format ?? '24h', ENT_QUOTES, 'UTF-8'),
                'prayer_calc_method' => htmlspecialchars($praytimes->prayer_calc_method ?? 'Kemenag', ENT_QUOTES, 'UTF-8'),
                'latitude' => htmlspecialchars($praytimes->latitude ?? '3.67026', ENT_QUOTES, 'UTF-8'),
                'longitude' => htmlspecialchars($praytimes->longitude ?? '98.59399', ENT_QUOTES, 'UTF-8'),
                'timezone' => htmlspecialchars($praytimes->timezone ?? '7', ENT_QUOTES, 'UTF-8'),
                'dst' => htmlspecialchars($praytimes->dst ?? '0', ENT_QUOTES, 'UTF-8'),
                'prayer1_alias' => htmlspecialchars($praytimes->prayer1_alias ?? 'fajr', ENT_QUOTES, 'UTF-8'),
                'prayer2_alias' => htmlspecialchars($praytimes->prayer2_alias ?? 'sunrise', ENT_QUOTES, 'UTF-8'),
                'prayer3_alias' => htmlspecialchars($praytimes->prayer3_alias ?? 'dhuhr', ENT_QUOTES, 'UTF-8'),
                'prayer4_alias' => htmlspecialchars($praytimes->prayer4_alias ?? 'asr', ENT_QUOTES, 'UTF-8'),
                'prayer5_alias' => htmlspecialchars($praytimes->prayer5_alias ?? 'maghrib', ENT_QUOTES, 'UTF-8'),
                'prayer6_alias' => htmlspecialchars($praytimes->prayer6_alias ?? 'isha', ENT_QUOTES, 'UTF-8'),
                'sunrise_lock_duration' => htmlspecialchars($praytimes->sunrise_lock_duration ?? '25', ENT_QUOTES, 'UTF-8'),
                'prayer_lock_duration' => htmlspecialchars($praytimes->prayer_lock_duration ?? '15', ENT_QUOTES, 'UTF-8'),
                'jumuah_lock_duration' => htmlspecialchars($praytimes->jumuah_lock_duration ?? '40', ENT_QUOTES, 'UTF-8'),
                'sunrise_caption' => htmlspecialchars($praytimes->sunrise_caption ?? 'waktu terlarang untuk sholat', ENT_QUOTES, 'UTF-8'),
                'prayer_caption' => htmlspecialchars($praytimes->prayer_caption ?? 'waktu sholat', ENT_QUOTES, 'UTF-8'),
                'adhan_caption' => htmlspecialchars($praytimes->adhan_caption ?? 'waktu nya adzan', ENT_QUOTES, 'UTF-8'),
                'adhan_duration' => htmlspecialchars($praytimes->adhan_duration ?? '3', ENT_QUOTES, 'UTF-8'),
                'iqomah_caption' => htmlspecialchars($praytimes->iqomah_caption ?? 'menuju iqomah', ENT_QUOTES, 'UTF-8'),
                'prayer1_iqomah_duration' => htmlspecialchars($praytimes->prayer1_iqomah_duration ?? '3', ENT_QUOTES, 'UTF-8'),
                'prayer3_iqomah_duration' => htmlspecialchars($praytimes->prayer3_iqomah_duration ?? '3', ENT_QUOTES, 'UTF-8'),
                'prayer4_iqomah_duration' => htmlspecialchars($praytimes->prayer4_iqomah_duration ?? '3', ENT_QUOTES, 'UTF-8'),
                'prayer5_iqomah_duration' => htmlspecialchars($praytimes->prayer5_iqomah_duration ?? '0', ENT_QUOTES, 'UTF-8'),
                'prayer6_iqomah_duration' => htmlspecialchars($praytimes->prayer6_iqomah_duration ?? '3', ENT_QUOTES, 'UTF-8'),
                'prayer1_correction' => htmlspecialchars($praytimes->prayer1_correction ?? '0', ENT_QUOTES, 'UTF-8'),
                'prayer2_correction' => htmlspecialchars($praytimes->prayer2_correction ?? '0', ENT_QUOTES, 'UTF-8'),
                'prayer3_correction' => htmlspecialchars($praytimes->prayer3_correction ?? '0', ENT_QUOTES, 'UTF-8'),
                'prayer4_correction' => htmlspecialchars($praytimes->prayer4_correction ?? '0', ENT_QUOTES, 'UTF-8'),
                'prayer5_correction' => htmlspecialchars($praytimes->prayer5_correction ?? '0', ENT_QUOTES, 'UTF-8'),
                'prayer6_correction' => htmlspecialchars($praytimes->prayer6_correction ?? '0', ENT_QUOTES, 'UTF-8'),
            ];

            \Log::info('Fetched praytimes data:', [$sanitized]);

            return $sanitized;

        });
    }

    public function loadData()
    {
        $this->loadRandomImages();
        $this->praytimes = $this->getPraytimes();
    }

    public function mount()
    {
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.slide.jumbotron-slide', [
            'praytimes' => $this->praytimes
        ]);
    }
}
