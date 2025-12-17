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
use App\Models\AppSetting;
use Carbon\Carbon;

class PraytimeSlide extends Component
{
    public $profile;
    public $praytimes;
    public $randomImages = [];
    public $logo;
    public $prayerIcons;
    public $tickerText = '';
    public $fullscreenMode;
    public $appSetting;

    #[Title('Masjiid')]    

    public function getprofile()
    {
        return Cache::remember('profile', 300, function () {
            
            $profile = Profile::with('image')->first();
            
            $file_name = $profile->image?->file_name;
            
            // Sanitize fields to prevent JSON issues
            $sanitized = [
                'id' => $profile->id ?? null,
                'name' => htmlspecialchars($profile->name ?? 'Nama Masjid', ENT_QUOTES, 'UTF-8'),
                'address' => htmlspecialchars($profile->address ?? 'Alamat Masjid', ENT_QUOTES, 'UTF-8'),
                'description' => htmlspecialchars($profile->description ?? 'Informasi tentang masjid', ENT_QUOTES, 'UTF-8'),
                'contact_no' => htmlspecialchars($profile->contact_no ?? 'no handphone', ENT_QUOTES, 'UTF-8'),
                'selected_theme' => htmlspecialchars($profile->selected_theme ?? 'theme1', ENT_QUOTES, 'UTF-8'),
                'image_id' => $profile->image_id ?? null,
                'file_name' => $file_name,
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

    public function getPrayerIcons()
    {
        return [
                    1 => '
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.75"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="h-10 w-10"
                            >
                            <path d="M3 13h1" />
                            <path d="M20 13h1" />
                            <path d="M5.6 6.6l.7 .7" />
                            <path d="M18.4 6.6l-.7 .7" />
                            <path d="M8 13a4 4 0 1 1 8 0" />
                            <path d="M3 17h18" />
                            <path d="M7 20h5" />
                            <path d="M16 20h1" />
                            <path d="M12 5v-1" />
                        </svg>',
                    
                    2 => '
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.75"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="h-10 w-10"
                            >
                            <path d="M3 17h1m16 0h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7m-9.7 5.7a4 4 0 0 1 8 0" />
                            <path d="M3 21l18 0" />
                            <path d="M12 9v-6l3 3m-6 0l3 -3" />
                        </svg>',
                    
                    3 => '
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.75"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="h-10 w-10"
                            >
                            <path d="M14.828 14.828a4 4 0 1 0 -5.656 -5.656a4 4 0 0 0 5.656 5.656z" />
                            <path d="M6.343 17.657l-1.414 1.414" />
                            <path d="M6.343 6.343l-1.414 -1.414" />
                            <path d="M17.657 6.343l1.414 -1.414" />
                            <path d="M17.657 17.657l1.414 1.414" />
                            <path d="M4 12h-2" />
                            <path d="M12 4v-2" />
                            <path d="M20 12h2" />
                            <path d="M12 20v2" />
                        </svg>',
                    
                    4 => '
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.75"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="h-10 w-10"
                        >
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M4 12h.01" />
                        <path d="M12 4v.01" />
                        <path d="M20 12h.01" />
                        <path d="M12 20v.01" />
                        <path d="M6.31 6.31l-.01 -.01" />
                        <path d="M17.71 6.31l-.01 -.01" />
                        <path d="M17.7 17.7l.01 .01" />
                        <path d="M6.3 17.7l.01 .01" />
                    </svg>',
                    
                    5 => '
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.75"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="h-10 w-10"
                            >
                            <path d="M3 17h1m16 0h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7m-9.7 5.7a4 4 0 0 1 8 0" />
                            <path d="M3 21l18 0" />
                            <path d="M12 3v6l3 -3m-6 0l3 3" />
                        </svg>',
                    
                    6 => '
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.75"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="h-10 w-10"
                            >
                            <path d="M3 16h18" />
                            <path d="M3 20h18" />
                            <path d="M8.296 16c-2.268 -1.4 -3.598 -4.087 -3.237 -6.916c.443 -3.48 3.308 -6.083 6.698 -6.084v.006h.296c-1.991 1.916 -2.377 5.03 -.918 7.405c1.459 2.374 4.346 3.33 6.865 2.275a6.888 6.888 0 0 1 -2.777 3.314" />
                        </svg>'
                ];
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
                ->limit(15) // Increased limit slightly for variety
                ->get();

            $mediaItems = $slideImages->map(function ($slideImage) {
                $image = $slideImage->image;

                if (!$image || !$image->file_name) {
                    return null;
                }

                // Determine media type from model
                $type = $image->isVideo() ? 'video' : 'image';

                // Safely extract title/content/author (in case stored as JSON or array accidentally)
                $title = $this->safeString($slideImage->title);
                $content = $this->safeString($slideImage->content);
                $author = $this->safeString($slideImage->author);

                return [
                    'url'             => asset('storage/' . $image->file_name),
                    'type'            => $type,                    // ← Critical for JS to know it's video/image
                    'fullscreen_mode' => (bool) $slideImage->fullscreen_mode,
                    'title'           => htmlspecialchars($title, ENT_QUOTES, 'UTF-8'),
                    'content'         => htmlspecialchars($content, ENT_QUOTES, 'UTF-8'),
                    'author'          => htmlspecialchars($author, ENT_QUOTES, 'UTF-8'),
                ];
            })->filter()->values()->toArray();

            // Fallback if no active slide images
            if (empty($mediaItems)) {
                \Log::info('No active slide images found, using fallback default image.');

                $mediaItems = [[
                    'url'             => asset('storage/images/upload/default-image.webp'),
                    'type'            => 'image',
                    'fullscreen_mode' => false,
                    'title'           => '',
                    'content'         => '',
                    'author'          => '',
                ]];
            }

            \Log::info('Final media items for randomizer:', $mediaItems);

            return $mediaItems;
        });
    }

    /**
     * Helper to safely convert possible array/JSON to string
     */
    private function safeString($value): string
    {
        if (is_null($value)) return '';
        if (is_string($value)) return $value;
        if (is_array($value) || is_object($value)) {
            // If it's JSON stored by mistake, try to decode first element
            if (is_array($value) && count($value) > 0) {
                $first = $value[0];
                if (is_array($first) && isset($first['value'])) {
                    return $first['value'];
                }
                return is_string($first) ? $first : '';
            }
            return '';
        }
        return (string) $value;
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
            $announcements = RunningText::orderBy('created_at')
                ->where('status_id', 1)
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

    public function getAppSeting()
    {
        return Cache::remember('app_setting', 300, function () {

            $appSetting = AppSetting::first();
            \Log::info('Fetched app setting:', ['app_setting' => $appSetting]);

            // Convert to array + ensure defaults
            return [
                'ticker_speed'     => $appSetting?->ticker_speed ?? 60,     // Changed default to 60 for consistency
                'ticker_direction' => $appSetting?->ticker_direction ?? 'horizontal',
            ];

            return $appSetting;
        });   
    }

    public function loadData()
    {
        $this->profile = $this->getprofile();      
        $this->praytimes = $this->getPraytimes();
        $this->prayerIcons = $this->getPrayerIcons();
        $this->loadRandomImages();
        $this->updateTickerText();
        $this->appSetting = $this->getAppSeting();
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
            'prayerIcons' => $this->prayerIcons,
            'appSetting' => $this->appSetting,
            //'videoPath'    => $this->videoPath,
        ]);
    }
}