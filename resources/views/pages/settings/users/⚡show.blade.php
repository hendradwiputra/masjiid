<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\User;

new #[Title('Manajemen Pengguna')] class extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $selectedRows = [];
    public $selectAll = false;
    public $showDeleteModal = false;
    public $deleteItemId = null;
    public $deleteItemName = null;

    #[On('deleteConfirmed')]
    public function handleDelete($data)
    {
        if ($data['action'] === 'deleteUser') {
            $user = User::find($data['id']);
            if ($user) {
                $user->delete();
                session()->flash('message', 'Akun berhasil dihapus.');
            }
        }
    }

    private function usersQuery()
    {
        $query = User::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
        }

        return $query->orderBy($this->sortField, $this->sortDirection);
    }

    public function sortBy($field)
    {
        $this->resetPage();

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedRows = $this->usersQuery()->pluck('id')->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    public function confirmDeleteSelected()
    {
        if (count($this->selectedRows) > 0) {
            $this->showDeleteModal = true;
        }
    }

    public function render()
    {
        $users = $this->usersQuery()->paginate($this->perPage);

        $headers = [
            [
                'field' => 'name',
                'label' => 'Nama',
                'class' => 'font-medium',
                'render' => function($value, $row) {
                    $userId = $row['id'] ?? $row->id;

                    return '<a href="' . route('settings.users.edit', $userId) . '" wire:navigate class="text-blue-600 hover:text-blue-800 hover:underline">' . e($value) . '</a>';
                }
            ],
            ['field' => 'email', 'label' => 'Email'],
            ['field' => 'role', 'label' => 'Role'],
            [
                'field' => 'email_verified_at', 
                'label' => 'Status',
                'render' => function($value, $row) {
                    return view('components.status-badge', [
                        'status' => !is_null($value),
                        'activeText' => 'Active',
                        'inactiveText' => 'Pending'
                    ])->render();
                }
            ]
        ];

        $bulkActions = [
            [
                'label' => 'Hapus',
                'action' => 'confirmDeleteSelected',
                'variant' => 'danger'
            ]
        ];

        return $this->view([
            'headers' => $headers,
            'rows' => $users,
            'bulkActions' => $bulkActions,
            'config' => [
                'emptyMessage' => 'Tidak ada data pengguna',
                'searchable' => true,
                'perPage' => $this->perPage,
                'sortField' => $this->sortField,
                'sortDirection' => $this->sortDirection
            ]
        ])->layout('layouts::dashboard');
    }

    public function deleteSelected()
    {
        if (count($this->selectedRows) > 0) {
            User::whereIn('id', $this->selectedRows)->delete();
            session()->flash('message', count($this->selectedRows) . ' akun berhasil dihapus.');
            $this->selectedRows = [];
            $this->selectAll = false;
            $this->cancel();
        }
    }

    public function delete()
    {
        $this->deleteSelected();
    }

    public function cancel()
    {
        $this->showDeleteModal = false;
    }
};
?>

<div>
    <div class="flex items-center justify-end mb-8">
        <x-button href="{{ route('settings.users.create') }}" wire:navigate variant="primary" size="md" icon="plus">
            Tambah
        </x-button>
    </div>

    <x-data-table :headers="$headers" :rows="$rows" :bulk-actions="$bulkActions"
        :empty-message="$config['emptyMessage']" :searchable="$config['searchable']" :per-page="$config['perPage']"
        :sort-field="$config['sortField']" :sort-direction="$config['sortDirection']" />

    <x-delete-modal />

</div>