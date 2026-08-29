<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;
use App\Models\User;

class ProfileForm extends Form
{
    public ?Profile $profile = null;

    public $logo;

    #[Validate]
    public string $name = '';

    public string $address = '';

    public string $phone = '';

    public function rules(): array
    {
        return [
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'name' => ['required', 'min:3', 'max:255'],
            'address' => ['nullable', 'max:255'],
            'phone' => ['nullable', 'max:255']

        ];
    }

    public function messages(): array
    {
        return [
            'logo.image' => 'File harus berupa gambar.',
            'logo.mimes' => 'Format gambar harus: jpeg, png, jpg, gif, svg, atau webp.',
            'logo.max' => 'Ukuran file tidak boleh melebihi 1 MB (1024 KB).',
            'name.required' => 'Nama masjid wajib diisi.',
            'name.min' => 'Nama masjid minimal :min karakter.',
            'name.max' => 'Nama masjid maksimal :max karakter.',            
        ];
    }

    public function logoUrl(): string
    {
        if ($this->logo) {
            return $this->logo->temporaryUrl();
        }

        if ($this->profile?->logo && Storage::disk('public')->exists($this->profile->logo)) {
            return '/storage/' . ltrim($this->profile->logo, '/');
        }

        return '/storage/images/logo.png';
    }

    public function setProfile(Profile $profile): void
    {
        $this->profile = $profile;
        $this->name = $profile->name;
        $this->address = $profile->address;
        $this->phone = $profile->phone;
        $this->logo = null;
    }    

    public function store(): void
    {
        $this->validate();

        $oldLogo = $this->profile?->logo;

        $data = [
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id()
        ];

        if ($this->logo) {
            $data['logo'] = $this->logo->store('images/upload', 'public');
        }

        if ($this->profile) {
            $this->profile->update($data);
        } else {
            $this->profile = Profile::create($data);
        }

        if (isset($data['logo']) && $oldLogo) {
            Storage::disk('public')->delete($oldLogo);
        }
    }
}
