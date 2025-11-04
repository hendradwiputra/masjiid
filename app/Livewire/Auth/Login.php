<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use App\Models\User;

class Login extends Component
{
    #[Title('Masjiid - Login')]

    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $password;

    public function mount()
    {
        // Check if there are no users in the database
        if (User::count() === 0) {
            return redirect()->route('register');
        }
    }

    public function login()
    {
        $this->validate();

        $credentials = [
            'name' => $this->name,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('praytimes');
        } else {
            session()->flash('error', 'Username atau password salah.');
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
