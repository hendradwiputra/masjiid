<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

new class extends Component
{
     #[Title('Login Maasjid')]
   
    public $email;
    public $password;

    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
        ];
    }

    public function login()
    {

        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            session()->flash('error', 'Email atau password salah.');
            return redirect()->route('login');
        }

    }
};
?>

<div class="flex flex-col min-h-screen items-center justify-center px-6 py-12 lg:px-8">

    <div class="border border-gray-300 rounded-3xl p-10 shadow-md max-w-md w-full">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo"
                class="mx-auto h-13 w-auto bg-slate-100 p-3 rounded-2xl" />
            <h2 class="mt-5 text-center text-2xl/9 font-bold tracking-wide text-gray-900">Welcome to Maasjid</h2>
        </div>

        <x-session-msg />

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form wire:submit="login" class="space-y-8">
                <div>
                    <x-form-input label="Email" type="text" name="email" wire:model="email" placeholder="Masukkan email"
                        :error="$errors->first('email')" />
                </div>

                <div>
                    <x-form-input label="Kata sandi" type="password" name="password" wire:model="password"
                        placeholder="Masukkan kata sandi" :error="$errors->first('password')" />
                </div>

                <div>
                    <x-button type="submit" class="w-full data-loading:opacity-50" variant="secondary" size="md"
                        icon="arrow-left-start-on-rectangle">
                        <span class="in-data-loading:hidden">Login</span>
                        <span class="not-in-data-loading:hidden">Checking...</span>
                    </x-button>
                </div>
            </form>

        </div>
    </div>
</div>