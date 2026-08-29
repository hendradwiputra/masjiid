<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Livewire\Forms\ProfileForm;
use App\Models\Profile;

new #[Title('Profil Masjid')] class extends Component
{
    use WithFileUploads;

    public ProfileForm $form;

    public function mount(?Profile $profile = null)
    {
        $profile ??= Profile::first();

        if ($profile !== null) {
            $this->form->setProfile($profile);
        }
    }

    public function save()
    {
        $this->form->store();

        session()->flash('success', 'Profil berhasil diperbarui.');

        return $this->redirect(request()->header('Referer'), navigate: true);
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts::dashboard');
    }
};
?>

<div>
    <form wire:submit="save">
        <div class="flex items-center justify-between mb-8">
            <x-page-title />

            <x-button type="submit" variant="primary" wire:loading.attr="disabled" size="md">
                <span class="in-data-loading:hidden">Simpan</span>
                <span class="not-in-data-loading:hidden">Menyimpan...</span>
            </x-button>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            {{-- Sidebar Info --}}
            <div class="lg:col-span-4">
                <div class="bg-white border border-blue-100 rounded-xl p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-900 mt-2 mb-4">
                        Logo Masjid
                    </h3>
                    <div class="text-center">
                        <!-- Logo Preview -->
                        <div class="w-30 h-30 border-2 bg-gray-300 border-gray-50 rounded-2xl">
                            <img src="{{ $form->logoUrl() }}" alt="{{ $form->name }} logo"
                                class="w-full h-full object-cover rounded-3xl p-2">
                        </div>

                        <input type="file" wire:model="form.logo"
                            accept="image/jpeg,image/png,image/gif,image/webp,image/svg+xml"
                            class="mt-4 block w-full text-sm text-gray-600 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-blue-100 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 p-2">
                        @error('form.logo')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <span wire:loading wire:target="form.logo" class="mt-2 block text-sm text-gray-600">
                            Mengunggah logo...
                        </span>

                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div class="lg:col-span-8 bg-white rounded-xl border border-gray-200 p-6 md:p-8">
                <div class="space-y-5">
                    <h3 class="text-lg font-bold text-gray-900">
                        Identitas Masjid
                    </h3>

                    {{-- Masjid Name --}}
                    <x-form-input label="Nama Masjid" type="text" wire:model="form.name"
                        placeholder="Masukkan nama masjid" :error="$errors->first('form.name')" />

                    {{-- Address --}}
                    <x-form-input label="Alamat" type="textarea" wire:model="form.address"
                        placeholder="Masukkan alamat masjid" :error="$errors->first('form.address')" />

                    {{-- Phone --}}
                    <x-form-input label="Nomor Telepon" type="text" wire:model="form.phone"
                        placeholder="Masukkan nomor telepon" :error="$errors->first('form.phone')" />

                </div>
            </div>
        </div>
        <div class="lg:col-span-12 mt-5">
            <x-timestamp created-by="{{ $form->profile?->createdBy?->name }}"
                created-at="{{ $form->profile?->created_at }}" updated-by="{{ $form->profile?->updatedBy?->name }}"
                updated-at="{{ $form->profile?->updated_at }}" />
        </div>
    </form>
</div>