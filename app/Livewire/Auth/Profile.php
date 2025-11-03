<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Profile extends Component
{

    #[Title('Edit Profile')]

    public $user;
    public $name;
    public $email;
    public $password = '';
    public $password_confirmation = '';
    public $updated_at;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }

    protected $messages = [
        'name.required'  => 'Username harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.unique'   => 'Email sudah digunakan.',
        'password.min'   => 'Password minimal 8 karakter.',
        'password.confirmed'  => 'Konfirmasi password tidak cocok.',
    ];

    public function update()
    {
        $validated = $this->validate();

        $this->user->name  = $validated['name'];
        $this->user->email = $validated['email'];
        $this->user->updated_at = now();

        // Change password only if user typed something
        if (!empty($validated['password'])) {
            $this->user->password = Hash::make($validated['password']);
        }

        $this->user->save();

        session()->flash('message', 'Profile berhasil diperbaharui.');

        return $this->redirect(request()->header('Referer'), navigate: true);
    }

    public function mount()
    {
        $this->user = User::first();

        if ($this->user) {
            $this->id = $this->user->id;
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->updated_at = $this->user->updated_at->format('d M Y, h:i A');
        }
    }

    public function render()
    {
        return view('livewire.auth.profile');
    }
}
