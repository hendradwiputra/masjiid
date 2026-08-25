<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    public $headers;
    public $rows;
    public $actions;
    public $emptyMessage;
    public $searchable;
    public $perPage;
    public $perPageOptions;
    public $sortField;
    public $sortDirection;
    public $bulkActions;
    public $wireKey;

    public function __construct(
        $headers = [],
        $rows = [],
        $actions = [],
        $emptyMessage = 'Tidak ada data',
        $searchable = false,
        $perPage = 10,
        $perPageOptions = [5, 10, 25, 50, 100],
        $sortField = 'id',
        $sortDirection = 'asc',
        $bulkActions = [],
        $wireKey = null
    ) {
        $this->headers = $headers;
        $this->rows = $rows;
        $this->actions = $actions;
        $this->emptyMessage = $emptyMessage;
        $this->searchable = $searchable;
        $this->perPage = $perPage;
        $this->perPageOptions = $perPageOptions;
        $this->sortField = $sortField;
        $this->sortDirection = $sortDirection;
        $this->bulkActions = $bulkActions;
        $this->wireKey = $wireKey;
    }

    public function render()
    {
        return view('components.data-table');
    }
}