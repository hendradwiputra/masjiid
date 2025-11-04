<?php

namespace App\Livewire\Auth;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Livewire\Component;

class Register extends Component
{
    #[Title('Register')]
    public $name;
    public $email;
    public $password = '';
    public $password_confirmation = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    protected $messages = [
        'name.required'  => 'Username harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.unique'   => 'Email sudah digunakan.',
        'password.required'  => 'Password harus diisi.',
        'password.min'   => 'Password minimal 8 karakter.',
        'password.confirmed'  => 'Konfirmasi password tidak cocok.',
    ];

    public function mount()
    {
        // If users already exist, redirect to login
        if (User::count() > 0) {
            return redirect()->route('login');
        }
    }

    public function store()
    {
        $validated = $this->validate();

        // Create new user using the create method
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($user) {
            session()->flash('message', 'Registration successful! Please log in.');
            return redirect()->route('login');
        }
        
        session()->flash('error', 'Registration failed!');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}