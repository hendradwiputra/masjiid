<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Title('Beranda')] class extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts::dashboard'); 
    }
};
?>

<div>
    {{-- Be present above all else. - Naval Ravikant --}}
</div>