<?php

namespace App\Livewire\Slide;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Profile;
use App\Models\Praytime;
use App\Models\Image;
use App\Models\SlideImage;
use App\Models\RunningText;
use Carbon\Carbon;

class PraytimeSlide extends Component
{
    public $profile;
    public $praytimes;
    public $randomImages = [];
    public $logo;
    public $tickerText = '';

    #[Title('Masjiid')]

    public function getprofile()
    {
        return Cache::remember('profile', 300, function () {
            
            $profile = Profile::with('image')->first();
            
            $image_name = $profile->image?->image_name;
            
            // Sanitize fields to prevent JSON issues
            $sanitized = [
                'id' => $profile->id ?? null,
                'name' => htmlspecialchars($profile->name ?? 'Nama Masjid', ENT_QUOTES, 'UTF-8'),
                'address' => htmlspecialchars($profile->address ?? 'Alamat Masjid', ENT_QUOTES, 'UTF-8'),
                'description' => htmlspecialchars($profile->description ?? 'Informasi tentang masjid', ENT_QUOTES, 'UTF-8'),
                'contact_no' => htmlspecialchars($profile->contact_no ?? 'no handphone', ENT_QUOTES, 'UTF-8'),
                'selected_theme' => htmlspecialchars($profile->selected_theme ?? 'theme1', ENT_QUOTES, 'UTF-8'),
                'image_id' => $profile->image_id ?? null,
                'image_name' => $image_name,
            ];
            
            \Log::info('Fetched profile data:', [$sanitized]);

            return $sanitized;
        });
    }

    public function getPraytimes()
    {
        return Cache::remember('praytimes', 300, function () {
            $praytimes = Praytime::first() ?? new Praytime(); // Fallback to empty model

            // Sanitize fields to prevent JSON issues
            $sanitized = [
                'id' => $praytimes->id ?? null,
                'time_format' => htmlspecialchars($praytimes->time_format ?? '24h', ENT_QUOTES, 'UTF-8'),
                'prayer_calc_method' => htmlspecialchars($praytimes->prayer_calc_method ?? 'Kemenag', ENT_QUOTES, 'UTF-8'),
                'latitude' => htmlspecialchars($praytimes->latitude ?? '3.67026', ENT_QUOTES, 'UTF-8'),
                'longitude' => htmlspecialchars($praytimes->longitude ?? '98.59399', ENT_QUOTES, 'UTF-8'),
                'timezone' => htmlspecialchars($praytimes->timezone ?? '7', ENT_QUOTES, 'UTF-8'),
                'dst' => htmlspecialchars($praytimes->dst ?? '0', ENT_QUOTES, 'UTF-8'),
                'hijri_correction' => htmlspecialchars($praytimes->hijri_correction ?? '0', ENT_QUOTES, 'UTF-8'),
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

    protected function loadRandomImages()
    {
        $this->randomImages = Cache::remember('slide_images_random', 300, function () {
            $now = Carbon::now('Asia/Jakarta');
            $slideImages = SlideImage::with('image')
                ->where('status_id', 1)
                ->where('start_date', '<=', $now)
                ->where('end_date', '>=', $now)
                ->inRandomOrder()
                ->limit(5)
                ->get();

            $allRecords = [];
            try {
                $allRecords = $slideImages->map(function($slideImage) {
                    return [
                        'id' => $slideImage->id,
                        'title' => $slideImage->title,
                        'content' => $slideImage->content,
                        'author' => $slideImage->author,
                        'title_type' => gettype($slideImage->title),
                        'content_type' => gettype($slideImage->content),
                        'author_type' => gettype($slideImage->author),
                        'image_name' => $slideImage->image?->image_name,
                    ];
                })->toArray();
            } catch (\Exception $e) {
                \Log::error('Error mapping SlideImage records: ' . $e->getMessage(), ['records' => $allRecords]);
            }
            \Log::info('All SlideImage records:', $allRecords);

            $images = $slideImages->map(function($slideImage) {
                if ($slideImage->image && $slideImage->image->image_name) {
                    $title = is_array($slideImage->title) ? (is_array($slideImage->title[0]) ? json_encode($slideImage->title) : $slideImage->title[0] ?? '') : $slideImage->title;
                    $content = is_array($slideImage->content) ? (is_array($slideImage->content[0]) ? json_encode($slideImage->content) : $slideImage->content[0] ?? '') : $slideImage->content;
                    $author = is_array($slideImage->author) ? (is_array($slideImage->author[0]) ? json_encode($slideImage->author) : $slideImage->author[0] ?? '') : $slideImage->author;

                    return [
                        'url' => asset('storage/' . $slideImage->image->image_name),
                        'fullscreen_mode' => $slideImage->fullscreen_mode,
                        'title' => htmlspecialchars($title ?? '', ENT_QUOTES, 'UTF-8'),
                        'content' => htmlspecialchars($content ?? '', ENT_QUOTES, 'UTF-8'),
                        'author' => htmlspecialchars($author ?? '', ENT_QUOTES, 'UTF-8'),
                    ];
                }
                return null;
            })->filter()->toArray();

            if (empty($images)) {
                $fallbackImages = Image::inRandomOrder()
                    ->limit(5)
                    ->get();

                $images = $fallbackImages->map(function($image) {
                    return [
                        'url' => asset('storage/' . $image->image_name),
                        'fullscreen_mode' => 0,
                        'title' => '',
                        'content' => '',
                        'author' => '',
                    ];
                })->toArray();
            }

            \Log::info('Random images fetched:', ['images' => $images]);
            return $images;
        });
    }

    public function refreshImages()
    {
        $this->loadRandomImages();
    }

    public function updateTickerText()
    {
        $this->tickerText = Cache::remember('ticker_text', 300, function () {
            // Ensure timezone is WIB (Asia/Jakarta)
            $now = Carbon::now('Asia/Jakarta');
            \Log::info('Current time in WIB:', ['now' => $now->toDateTimeString()]);

            // Fetch active announcements
            $announcements = RunningText::where('status_id', 1)
                ->where('start_date', '<=', $now)
                ->where('end_date', '>=', $now)
                ->pluck('announcement')
                ->toArray();
            
            \Log::info('Fetched announcements:', ['announcements' => $announcements, 'count' => count($announcements)]);
            
            // Combine announcements into a single string
            if (!empty($announcements)) {
                
                return implode(' • ', array_map('htmlspecialchars', $announcements));
            } else {
                return 'No active announcements';
            }
        });
    }

    public function loadData()
    {
        $this->profile = $this->getprofile();      
        $this->praytimes = $this->getPraytimes();
        $this->loadRandomImages();
        $this->updateTickerText();
    }

    public function mount()
    {
        $this->loadData();    
    }

    public function render()
    {
        return view('livewire.slide.praytime-slide', [
            'profile'   => $this->profile,
            'praytimes' => $this->praytimes,
            'tickerText' => $this->tickerText,
            'randomImages' => $this->randomImages,
        ]);
    }
}