<?php

namespace App\Livewire\Praytimes;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Praytime;

class UpdatePraytimes extends Component
{
    #[Title('Praytimes')]

    public $pageTitle = '';
    public $praytime;
    public $id, $time_format, $prayer_calc_method, $latitude, $longitude, $dst, $timezone, $hijri_correction,
        $prayer1_alias, $prayer2_alias, $prayer3_alias, $prayer4_alias, $prayer5_alias, $prayer6_alias,
        $prayer1_correction, $prayer2_correction, $prayer3_correction, $prayer4_correction, $prayer5_correction, $prayer6_correction,
        $adhan_duration, 
        $prayer1_iqomah_duration, $prayer3_iqomah_duration, $prayer4_iqomah_duration, $prayer5_iqomah_duration, $prayer6_iqomah_duration,
        $sunrise_lock_duration, $prayer_lock_duration, $jumuah_lock_duration, $updated_at ;

    public $calc_method = [
        'MWL' => 'Muslim World League',
        'ISNA' => 'Islamic Society of North America (ISNA)',
        'Egypt' => 'Egyptian General Authority of Survey',
        'Makkah' => 'Umm Al-Qura University, Makkah',
        'Karachi' => 'University of Islamic Sciences, Karachi',
        'Tehran' => 'Institute of Geophysics, University of Tehran',
        'Jafari' => 'Shia Ithna-Ashari, Leva Institute, Qum',
        'Kemenag' => 'Kementerian Agama Indonesia',
        'Jakim' => 'Jabatan Kemajuan Islam Malaysia (JAKIM)',
        'Muis' =>'Majelis Ulama Islam Singapura (MUIS)'
    ];

    // Add your UTC here
    public $tz = [
        '0' => 'UTC +00:00',
        '1' => 'UTC +01:00',
        '2' => 'UTC +02:00',
        '3' => 'UTC +03:00',
        '7' => 'UTC +07:00',
        '8' => 'UTC +08:00',
        '8.30' => 'UTC +08:30',
        '8.45' => 'UTC +08:45',
        '9' => 'UTC +09:00',
    ];

    public function mount()
    {
        $this->praytime = Praytime::first();
        
        if ($this->praytime) {
            $this->id = $this->praytime->id;
            $this->latitude = $this->praytime->latitude;
            $this->longitude = $this->praytime->longitude;
            $this->dst = $this->praytime->dst;
            $this->timezone = $this->praytime->timezone;
            $this->time_format = $this->praytime->time_format;
            $this->prayer_calc_method = $this->praytime->prayer_calc_method;
            $this->hijri_correction = $this->praytime->hijri_correction;
            $this->prayer1_alias = $this->praytime->prayer1_alias;
            $this->prayer2_alias = $this->praytime->prayer2_alias;
            $this->prayer3_alias = $this->praytime->prayer3_alias;
            $this->prayer4_alias = $this->praytime->prayer4_alias;
            $this->prayer5_alias = $this->praytime->prayer5_alias;
            $this->prayer6_alias = $this->praytime->prayer6_alias;
            $this->prayer1_correction = $this->praytime->prayer1_correction;
            $this->prayer2_correction = $this->praytime->prayer2_correction;
            $this->prayer3_correction = $this->praytime->prayer3_correction;
            $this->prayer4_correction = $this->praytime->prayer4_correction;
            $this->prayer5_correction = $this->praytime->prayer5_correction;
            $this->prayer6_correction = $this->praytime->prayer6_correction;             
            $this->adhan_duration = $this->praytime->adhan_duration;              
            $this->prayer1_iqomah_duration = $this->praytime->prayer1_iqomah_duration;
            $this->prayer3_iqomah_duration = $this->praytime->prayer3_iqomah_duration;
            $this->prayer4_iqomah_duration = $this->praytime->prayer4_iqomah_duration;
            $this->prayer5_iqomah_duration = $this->praytime->prayer5_iqomah_duration;
            $this->prayer6_iqomah_duration = $this->praytime->prayer6_iqomah_duration;
            $this->sunrise_lock_duration = $this->praytime->sunrise_lock_duration;
            $this->prayer_lock_duration = $this->praytime->prayer_lock_duration;
            $this->jumuah_lock_duration = $this->praytime->jumuah_lock_duration;
            $this->updated_at = $this->praytime->updated_at->format('d M Y, h:i A');
        }
    }

    public function rules()
    {
        return [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'dst' => 'required|integer',
            'timezone' => 'required',
            'prayer_calc_method' => 'required',
            'hijri_correction' => 'required',
            'prayer1_alias' => 'required',
            'prayer2_alias' => 'required',
            'prayer3_alias' => 'required',
            'prayer4_alias' => 'required',
            'prayer5_alias' => 'required',
            'prayer6_alias' => 'required',
            'prayer1_correction' => 'required',
            'prayer2_correction' => 'required',
            'prayer3_correction' => 'required',
            'prayer4_correction' => 'required',
            'prayer5_correction' => 'required',
            'prayer6_correction' => 'required',            
            'adhan_duration' => 'required',
            'prayer1_iqomah_duration' => 'required',
            'prayer3_iqomah_duration' => 'required',
            'prayer4_iqomah_duration' => 'required',
            'prayer5_iqomah_duration' => 'required',
            'prayer6_iqomah_duration' => 'required',            
            'sunrise_lock_duration' => 'required',            
            'prayer_lock_duration' => 'required',            
            'jumuah_lock_duration' => 'required',            

        ];
    }

    protected $messages = [
        'latitude.required' => 'Garis lintang harus diisi.',
        'latitude.numeric' => 'Garis lintang harus berupa angka.',
        'longitude.required' => 'Garis bujur harus diisi.',
        'longitude.numeric' => 'Garis lintang harus berupa angka.',
        'dst.required' => 'Mohon diisi.',
        'dst.numeric' => 'Gunakan format angka.',
        'timezone.required' => 'Timezone harus diisi.',
        'prayer_calc_method.required' => 'Pilih metode perhitungan.',
        'hijri_correction.required' => 'Mohon diisi.',
        'prayer1_alias.required' => 'Mohon diisi.',
        'prayer2_alias.required' => 'Mohon diisi.',
        'prayer3_alias.required' => 'Mohon diisi.',
        'prayer4_alias.required' => 'Mohon diisi.',
        'prayer5_alias.required' => 'Mohon diisi.',
        'prayer6_alias.required' => 'Mohon diisi.',
        'prayer1_correction.required' => 'Mohon diisi.',
        'prayer2_correction.required' => 'Mohon diisi.',
        'prayer3_correction.required' => 'Mohon diisi.',
        'prayer4_correction.required' => 'Mohon diisi.',
        'prayer5_correction.required' => 'Mohon diisi.',
        'prayer6_correction.required' => 'Mohon diisi.',
        'adhan_duration.required' => 'Mohon diisi.',
        'prayer1_iqomah_duration.required' => 'Mohon diisi.',
        'prayer3_iqomah_duration.required' => 'Mohon diisi.',
        'prayer4_iqomah_duration.required' => 'Mohon diisi.',
        'prayer5_iqomah_duration.required' => 'Mohon diisi.',
        'prayer6_iqomah_duration.required' => 'Mohon diisi.',
        'sunrise_lock_duration.required' => 'Mohon diisi.',            
        'prayer_lock_duration.required' => 'Mohon diisi.',            
        'jumuah_lock_duration.required' => 'Mohon diisi.',  
    ];

    public function update()
    {
        $this->validate();

        $praytime = Praytime::firstOrNew(['id' => $this->id]);

        $praytime->latitude = $this->latitude;
        $praytime->longitude = $this->longitude;
        $praytime->dst = $this->dst;
        $praytime->timezone = $this->timezone;
        $praytime->prayer_calc_method = $this->prayer_calc_method;
        $praytime->time_format = $this->time_format;
        $praytime->hijri_correction = $this->hijri_correction;
        $praytime->prayer1_alias = $this->prayer1_alias;
        $praytime->prayer2_alias = $this->prayer2_alias;
        $praytime->prayer3_alias = $this->prayer3_alias;
        $praytime->prayer4_alias = $this->prayer4_alias;
        $praytime->prayer5_alias = $this->prayer5_alias;
        $praytime->prayer6_alias = $this->prayer6_alias;
        $praytime->prayer1_correction = $this->prayer1_correction;
        $praytime->prayer2_correction = $this->prayer2_correction;
        $praytime->prayer3_correction = $this->prayer3_correction;
        $praytime->prayer4_correction = $this->prayer4_correction;
        $praytime->prayer5_correction = $this->prayer5_correction;
        $praytime->prayer6_correction = $this->prayer6_correction;        
        $praytime->adhan_duration = $this->adhan_duration;
        $praytime->prayer1_iqomah_duration = $this->prayer1_iqomah_duration;
        $praytime->prayer3_iqomah_duration = $this->prayer3_iqomah_duration;
        $praytime->prayer4_iqomah_duration = $this->prayer4_iqomah_duration;
        $praytime->prayer5_iqomah_duration = $this->prayer5_iqomah_duration;
        $praytime->prayer6_iqomah_duration = $this->prayer6_iqomah_duration;
        $praytime->sunrise_lock_duration = $this->sunrise_lock_duration;
        $praytime->prayer_lock_duration = $this->prayer_lock_duration;
        $praytime->jumuah_lock_duration = $this->jumuah_lock_duration;
        $praytime->updated_at = now();
        
        $praytime->save();

        $this->mount();

        $this->dispatch('praytimesUpdated');
        session()->flash('message', 'Data berhasil disimpan.');

        return $this->redirect(request()->header('Referer'), navigate: true);

    }
    
    public function render()
    {
        return view('livewire.praytimes.update-praytimes');
    }
}
