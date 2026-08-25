<?php

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Form Pengguna')] class extends Component
{
    public UserForm $form;

    public function mount(?User $user = null)
    {
        if ($user) {
            $this->form->setUser($user);
        }
    }

    public function save()
    {
        if ($this->form->user) {
            $this->form->update();
            session()->flash('success', 'Akun berhasil diperbarui');
        } else {
            $this->form->store();
            session()->flash('success', 'Akun berhasil ditambahkan');
        }

        return $this->redirect(route('settings.users'), navigate: true);
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts::dashboard'); 
    }
};
?>

<div class="max-w-4xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Sidebar Info --}}
        <div class="lg:col-span-1">
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-6 sticky top-6">
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-white rounded-full shadow-md flex items-center justify-center mx-auto mb-4">
                        <x-heroicon-o-camera class="w-15 h-15" />
                    </div>
                    <h4 class="font-semibold text-gray-900">
                        {{ $form->user ? 'Edit Profil' : 'Akun Baru' }}
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        {{ $form->user ? 'Perbarui akun pengguna' : 'Buat akun baru' }}
                    </p>
                    @if($form->user)
                    <div class="mt-4 p-3 bg-blue-100 rounded-lg">
                        <p class="text-xs text-blue-800">
                            <i class="fas fa-clock mr-1"></i>
                            Terakhir diupdate: {{ $form->user->updated_at->diffForHumans() }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Form --}}
        <div class="lg:col-span-2">
            <form wire:submit="save" class="bg-white rounded-xl border border-gray-200 p-6 md:p-8">
                <div class="space-y-5">

                    <h3 class="text-lg font-bold text-gray-900">
                        Profil
                    </h3>

                    {{-- Email --}}
                    <x-form-input label="Alamat Email" type="email" wire:model="form.email"
                        placeholder="Masukkan email aktif" :error="$errors->first('form.email')" />

                    {{-- Name --}}
                    <x-form-input label="Nama Lengkap" type="text" wire:model="form.name"
                        placeholder="Masukkan nama lengkap" :error="$errors->first('form.name')" />

                    <h3 class="text-lg font-bold text-gray-900 pt-8">
                        {{ $form->user ? 'Ubah Password' : 'Password' }}
                    </h3>

                    {{-- Password in create mode --}}
                    @if (!$form->user)
                    <x-form-input label="Password" type="password" wire:model="form.password"
                        placeholder="Masukkan password" :error="$errors->first('form.password')" />

                    <x-form-input label="Konfirmasi Password" type="password" wire:model="form.password_confirmation"
                        placeholder="Ulangi password" :error="$errors->first('form.password')" />
                    @endif

                    {{-- Password in edit mode --}}
                    @if ($form->user)
                    <x-form-input label="Password Lama" type="password" wire:model="form.current_password"
                        placeholder="Masukkan password lama" :error="$errors->first('form.current_password')" />

                    <x-form-input label="Password Baru" type="password" wire:model="form.new_password"
                        placeholder="Masukkan password baru" :error="$errors->first('form.new_password')" />

                    <x-form-input label="Konfirmasi Password Baru" type="password"
                        wire:model="form.new_password_confirmation" placeholder="Ulangi password baru"
                        :error="$errors->first('form.new_password')" />
                    @endif

                </div>

                <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3 pt-6">
                    <x-button type="button" variant="outline-light" href="{{ route('settings.users') }}" wire:navigate
                        size="md">
                        Kembali
                    </x-button>

                    <x-button type="submit" variant="primary" wire:loading.attr="disabled" size="md">
                        @if($form->user)
                        <span class="in-data-loading:hidden">Update Akun</span>
                        @else
                        <span class="in-data-loading:hidden">Buat Akun</span>
                        @endif
                        <span class="not-in-data-loading:hidden">Menyimpan...</span>
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>