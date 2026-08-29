<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Livewire\Forms\PrayertimesForm;
use App\Models\Prayertimes;

new #[Title('Atur Waktu Sholat')] class extends Component
{
    public PrayertimesForm $form;
    public bool $shouldDetectTimezone = false;

    public $tabs = ['Pengaturan', 'Tampilan', 'Perhitungan', 'Peringatan'];

    public array $timezones = [];

    public $dst = [
        '0' => '0',
        '1' => '1',
    ];

    public $default_prayernames = ['fajr', 'sunrise', 'dhuhr', 'asr', 'maghrib', 'isha'];
        
    public function mount(?Prayertimes $prayertimes = null): void
    {
        $this->timezones = $this->buildTimezones();
        $prayertimes ??= Prayertimes::first();

        if ($prayertimes !== null) {
            $this->form->setPrayertimes($prayertimes);
        } else {
            $this->shouldDetectTimezone = true;
        }
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts::dashboard');
    }

    public function getCurrentLocation()
    {
        $this->dispatch('getLocation');
    }

    public function setLocation($latitude, $longitude)
    {
        $this->form->latitude = (float) $latitude;
        $this->form->longitude = (float) $longitude;
        
        session()->flash('message', 'Lokasi berhasil didapatkan!');
        $this->dispatch('locationUpdated', ['latitude' => $latitude, 'longitude' => $longitude]);
    }

    public function setTimezone(string $timezone): void
    {
        $this->form->timezone = $timezone;
    }

    private function buildTimezones(): array
    {
        $timezones = [];

        for ($minutes = -720; $minutes <= 840; $minutes += 15) {
            $hours = $minutes / 60;
            $absoluteMinutes = abs($minutes);
            $sign = $minutes < 0 ? '-' : '+';
            $label = sprintf('UTC %s%02d:%02d', $sign, intdiv($absoluteMinutes, 60), $absoluteMinutes % 60);

            $timezones[(string) $hours] = $label;
        }

        return $timezones;
    }

    public function save()
    {
        $this->form->store();

        session()->flash('success', 'Profil berhasil diperbarui.');

        return $this->redirect(request()->header('Referer'), navigate: true);
    }
    
};
?>
<form wire:submit="save">
    <div class="flex items-center justify-between mb-8">
        <x-page-title />

        <x-button type="submit" variant="primary" wire:loading.attr="disabled" size="md">
            <span class="in-data-loading:hidden">Simpan</span>
            <span class="not-in-data-loading:hidden">Menyimpan...</span>
        </x-button>
    </div>
    <div x-data="{ activeTab: 'tab1' }">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-4">
                <div
                    class="text-xs font-medium tracking-wider bg-white border border-gray-200 rounded-xl p-3 sticky top-6">
                    <nav class="space-y-1">

                        @foreach ($tabs as $index => $tabName)
                        <button type="button" @click="activeTab = 'tab{{ $index + 1 }}'" :class="{ 
        'bg-blue-100 text-blue-700': activeTab === 'tab{{ $index + 1 }}',
        'hover:bg-white text-gray-800 ': activeTab !== 'tab{{ $index + 1 }}'
    }" class="w-full text-left uppercase px-5 py-3 border border-blue-100 rounded-lg transition-all flex items-center gap-3">
                            <span>{{ ucfirst($tabName) }}</span>
                        </button>
                        @endforeach

                    </nav>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-8 bg-white">
                @php
                $tabStyle = 'rounded-xl border border-gray-200 p-8';
                $titleStyle = 'text-lg font-bold text-gray-800';
                @endphp

                <div x-show="activeTab === 'tab1'" class="{{ $tabStyle }}">
                    <h3 class="{{ $titleStyle }} mb-6">Pengaturan Dasar</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Latitude --}}
                        <x-form-input label="Garis Lintang" type="text" wire:model="form.latitude"
                            placeholder="Masukkan garis lintang" :error="$errors->first('form.latitude')" />

                        {{-- Longitude --}}
                        <x-form-input label="Garis Bujur" type="text" wire:model="form.longitude"
                            placeholder="Masukkan garis bujur" :error="$errors->first('form.longitude')" />
                    </div>

                    <div class="w-full flex justify-end mb-4">
                        <x-button type="button" variant="secondary" size="md" wire:click="getCurrentLocation">
                            <span class="in-data-loading:hidden">Gunakan Lokasi Saat Ini</span>
                            <span class="not-in-data-loading:hidden">Mendapatkan lokasi...</span>
                        </x-button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <x-form-input type="select" label="Zona Waktu" wire:model="form.timezone"
                            :error="$errors->first('form.timezone')">
                            @foreach ($timezones as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-form-input>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <x-form-input type="select" label="Day Light Saving" wire:model="form.dst"
                            :error="$errors->first('form.dst')">
                            @foreach ($dst as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-form-input>
                    </div>
                </div>

                <div x-show="activeTab === 'tab2'" class="{{ $tabStyle }}">
                    <h3 class="{{ $titleStyle }} mb-6">Koreksi Nama & Waktu Sholat</h3>

                    @foreach($default_prayernames as $index => $prayerName)
                    <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-3">
                        <x-form-input type="text" label="{{ ucfirst($prayerName) }}"
                            wire:model.live="form.prayer_names.{{ $index }}"
                            :error="$errors->first('form.prayer_names.'.$index)" />

                        <x-form-input type="select" label="Koreksi {{ ucfirst($prayerName) }}"
                            wire:model.live="form.prayer_correction.{{ $index }}"
                            :error="$errors->first('form.prayer_correction.'.$index)">
                            @for($i = -15; $i <= 15; $i++) <option value="{{ $i }}">{{ $i > 0 ? '+'.$i : $i }} menit
                                </option>
                                @endfor
                        </x-form-input>
                    </div>
                    @endforeach

                    <div x-show="activeTab === 'tab3'" class="{{ $tabStyle }}">
                        <h3 class="{{ $titleStyle }}">Metode Perhitungan</h3>


                    </div>

                    <div x-show="activeTab === 'tab4'" class="{{ $tabStyle }}">
                        <h3 class="{{ $titleStyle }}">Notifikasi</h3>


                    </div>

                </div>


            </div>

            <div class="lg:col-span-12 mt-5">
                <x-timestamp created-by="{{ $form->prayertimes?->createdBy?->name }}"
                    created-at="{{ $form->prayertimes?->created_at }}"
                    updated-by="{{ $form->prayertimes?->updatedBy?->name }}"
                    updated-at="{{ $form->prayertimes?->updated_at }}" />
            </div>
        </div>
</form>

@script
<script>
    @if ($shouldDetectTimezone)
        const timezoneOffset = -new Date().getTimezoneOffset() / 60;
        $wire.setTimezone(String(timezoneOffset));
    @endif

    $wire.on('getLocation', () => {
        if (!navigator.geolocation) {
            window.alert('Browser Anda tidak mendukung pengambilan lokasi.');
            return;
        }

        navigator.geolocation.getCurrentPosition(
            ({ coords }) => $wire.setLocation(coords.latitude, coords.longitude),
            () => window.alert('Lokasi tidak dapat diambil. Pastikan izin lokasi sudah diberikan.'),
            { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
        );
    });
</script>
@endscript