<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class timestamp extends Component
{
    public $createdBy;
    public $createdAt;
    public $updatedBy;
    public $updatedAt;
    public $label;
    public $bgColor;
    public $icon;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $createdBy = null,
        $createdAt = null,
        $updatedBy = null,
        $updatedAt = null,
        $label = 'Updated by:',
        $bgColor = 'blue-100',
        $icon = 'heroicon-o-clock'
    ) {
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
        $this->updatedBy = $updatedBy;
        $this->updatedAt = $updatedAt;
        $this->label = $label;
        $this->bgColor = $bgColor;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.timestamp');
    }
}
