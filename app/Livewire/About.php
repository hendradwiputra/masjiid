<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Collection;

class About extends Component
{
    public $versionHistory;
    public $currentVersion;

    #[Title('About')]

    public function mount()
    {
        $versionHistory = [
            [
                'id' => 1,
                'version' => '1.0',
                'date' => '29 Nov 2020',
                'title' => 'First release. Formely name iMasjid',
            ],
            [
                'id' => 2,
                'version' => '1.1',
                'date' => '5 Nov 2025',
                'title' => 'Upgrade to Laravel 12 and Livewire 3. Change name to Masjiid',
            ],
            [
                'id' => 3,
                'version' => '1.2',
                'date' => '30 Nov 2025',
                'title' => 'Add new features and improvements',
                'changes' => [
                    'Add video slide',
                    'Improve responsive design',
                ]
            ],
        ];

        // Use collection to safely sort
        $collection = collect($versionHistory)
            ->sortByDesc('id')
            ->values();

        $this->versionHistory = $collection->toArray();
        
        // Automatically get the latest version (first item after sorting)
        $this->currentVersion = $collection->first()['version'] ?? '1.0';

    }

    public function render()
    {
        return view('livewire.about');
    }
}