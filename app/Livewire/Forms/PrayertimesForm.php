<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\Models\Prayertimes;
use App\Models\User;

class PrayertimesForm extends Form
{
    public ?Prayertimes $prayertimes = null;

    #[Validate]
    public ?float $latitude = null;

    #[Validate]
    public ?float $longitude = null;

    #[Validate]
    public string $timezone = '';

    #[Validate]
    public string $dst = '0';

    #[Validate]
    public array $prayer_names = ['fajr', 'sunrise', 'dhuhr', 'asr', 'maghrib', 'isha'];

    #[Validate]
    public array $prayer_correction = [0, 0, 0, 0, 0, 0];

    #[Validate]
    public string $time_format = '';


    public function rules(): array
    {
        $rules = [
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'timezone'           => 'required',
            'dst'                => 'required',
            'prayer_names'       => 'required|array|size:6',
            'prayer_correction.*'=> 'nullable',
        ];

        foreach (range(0, 5) as $index) {
            $rules["prayer_names.$index"] = 'required|string';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'latitude.required' => 'Latitude wajib diisi.',
            'latitude.numeric' => 'Latitude harus berupa angka.',
            'latitude.between' => 'Latitude harus antara -90 dan 90.',
            'longitude.required' => 'Longitude wajib diisi.',
            'longitude.numeric' => 'Longitude harus berupa angka.',
            'longitude.between' => 'Longitude harus antara -180 dan 180.',
            'timezone.required' => 'Timezone harus diisi.',            
            'dst.required' => 'Daylight saving time harus diisi.',
            'prayer_names.required' => 'Nama sholat wajib diisi.',
            'prayer_names.array' => 'Nama sholat harus berupa daftar.',
            'prayer_names.size' => 'Enam nama sholat wajib diisi.',
            'prayer_names.*.required' => 'Nama sholat harus diisi.',
            'prayer_names.*.string' => 'Nama sholat harus berupa teks.',
            'prayer_correction.*.required' => 'Koreksi waktu sholat harus diisi.',
            
        ];
    }

    public function setPrayertimes(Prayertimes $prayertimes): void
    {
        $this->prayertimes = $prayertimes;
        $this->latitude = $prayertimes->latitude;
        $this->longitude = $prayertimes->longitude;
        $this->timezone = $prayertimes->timezone;
        $this->dst = $prayertimes->dst;
        $this->prayer_names = $prayertimes->prayer_names ?? $this->prayer_names;
        $this->prayer_correction = $this->withDefaultPrayerCorrections($prayertimes->prayer_correction);

    }

    public function store(): void
    {
        $this->prayer_correction = $this->withDefaultPrayerCorrections($this->prayer_correction);
        $this->validate();

        $data = [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'timezone' => $this->timezone,
            'dst' => $this->dst,
            'prayer_names' => $this->prayer_names,
            'prayer_correction' => $this->prayer_correction,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id()

        ];

        if ($this->prayertimes) {
            $this->prayertimes->update($data);
        } else {
            $this->prayertimes = Prayertimes::create($data);
        }
    }

    private function withDefaultPrayerCorrections(?array $corrections): array
    {
        $corrections = array_pad($corrections ?? [], 6, 0);

        return array_map(
            static fn ($correction) => $correction === null || $correction === '' ? 0 : $correction,
            array_slice($corrections, 0, 6)
        );
    }
}
