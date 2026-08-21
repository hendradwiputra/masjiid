<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
};
?>

<div class="border-t border-slate-700/50">
    <a wire:click="logout"
        class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-400 hover:bg-slate-700/50 hover:text-red-300 transition-colors">
        <x-heroicon-o-arrow-left-on-rectangle class="w-4 h-4" />
        Keluar
    </a>
</div>