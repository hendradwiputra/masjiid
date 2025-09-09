<?php

namespace App\Livewire\Notification;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\RunningText;

class ShowRunningText extends Component
{
    use WithPagination;

    public $announcement;
    public $start_date;
    public $end_date;
    public $showModal = false;
    public $editMode = false;
    public $runningTextId;
    public $sortField = 'start_date';
    public $sortDirection = 'desc';
    public $showDeleteModal = false;
    public $deleteId;

    public function resetForm()
    {
        $this->reset(['announcement', 'start_date', 'end_date', 'runningTextId']);
        $this->resetValidation();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['announcement', 'start_date', 'end_date', 'runningTextId', 'editMode']);
        $this->resetValidation();
    }

    protected function rules()
    {
        return [
            'announcement' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }

    protected $messages = [
        'announcement.required' => 'Berita harus diisi.',
        'start_date.required' => 'Tanggal mulai harus diisi.',
        'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
        'end_date.required' => 'Tanggal berakhir harus diisi.',
        'end_date.date' => 'Tanggal berakhir harus berupa tanggal yang valid.',
        'end_date.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai.',
    ];

    public function save()
    {
        $this->validate();

        if ($this->editMode) {
            $runningText = RunningText::findOrFail($this->runningTextId);
            $runningText->update([
                'announcement' => $this->announcement,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);
            session()->flash('message', 'Data berhasil diperbarui.');
        } else {
            RunningText::create([
                'announcement' => $this->announcement,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);
            session()->flash('message', 'Data berhasil disimpan.');
        }

        $this->closeModal();

        return $this->redirect(request()->header('Referer'), navigate: true);
    }

    public function edit($id)
    {
        $runningText = RunningText::findOrFail($id);
        $this->runningTextId = $id;
        $this->announcement = $runningText->announcement;
        $this->start_date = $runningText->start_date ? $runningText->start_date->format('Y-m-d') : null;
        $this->end_date = $runningText->end_date ? $runningText->end_date->format('Y-m-d') : null;
        $this->editMode = true;
        $this->showModal = true;
        $this->resetValidation();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->deleteId) {
            RunningText::findOrFail($this->deleteId)->delete();
            session()->flash('message', 'Data berhasil dihapus.');
            $this->showDeleteModal = false;
            $this->deleteId = null;
            return $this->redirect(request()->header('Referer'), navigate: true);
        }
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $runningTexts = RunningText::orderBy($this->sortField, $this->sortDirection)->paginate(10);

        // Calculate status for each running text
        foreach ($runningTexts as $runningText) {
            $now = now();
            if ($now > $runningText->end_date) {
                $runningText->status = 'Berakhir';
            } elseif ($now >= $runningText->start_date && $now <= $runningText->end_date) {
                $runningText->status = 'Aktif';
            } else {
                $runningText->status = 'Nonaktif';
            }
        }
        
        return view('livewire.notification.show-running-text', compact('runningTexts'));
    }
}