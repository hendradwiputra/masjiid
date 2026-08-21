<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $type = 'button',
        public string $variant = 'primary',
        public string $size = 'md',
        public ?string $label = null,
        public ?string $icon = null,
        public string $iconPosition = 'left',
        public bool $loading = false,
        public bool $disabled = false,
        public ?string $href = null,
        public string $target = '_self',
        public ?string $wire = null,
        public ?string $wireClick = null,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
