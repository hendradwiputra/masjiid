<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatusBadge extends Component
{
    public $status;
    public $activeText;
    public $inactiveText;
    public $activeColor;
    public $inactiveColor;

    public function __construct(
        $status,
        $activeText = 'Active',
        $inactiveText = 'Inactive',
        $activeColor = 'green',
        $inactiveColor = 'yellow'
    ) {
        $this->status = $status;
        $this->activeText = $activeText;
        $this->inactiveText = $inactiveText;
        $this->activeColor = $activeColor;
        $this->inactiveColor = $inactiveColor;
    }

    public function render()
    {
        return view('components.status-badge');
    }
}