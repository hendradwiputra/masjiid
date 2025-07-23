<?php

namespace App\Livewire\Auth;

use App\Models\User;

use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);
        
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);

        if ($user) {
            session()->flash('message', 'Registration successful! Please log in.');

            return redirect()->route('auth.login');
        }
        
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
