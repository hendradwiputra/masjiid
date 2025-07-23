<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;

#[Title('Masjiid - Login')]
class Login extends Component
{
    public function render()
    {
        return view('livewire.auth.login');
    }
}
