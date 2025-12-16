<?php

namespace App\Livewire\RunningText;

use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;
use App\Models\RunningText;
use App\Models\AppSetting;

class ShowRunningText extends Component
{
    use WithPagination;

    #[Title('Running Teks')]

    public $announcement;
    public $start_date;
    public $end_date;
    public $status_id = 1;
    public $ticker_speed = 30;
    public $ticker_direction = 'horizontal';
    public $updated_at;
    public $showModal = false;
    public $editMode = false;
    public $runningTextId;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $showDeleteModal = false;
    public $showSettingsModal = false;
    public $deleteId;

    public function resetForm()
    {
        $this->reset(['announcement', 'start_date', 'end_date', 'runningTextId', 'status_id']);
        $this->resetValidation();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function openSettingsModal()
    {
        $this->mount();
        $this->showSettingsModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['announcement', 'start_date', 'end_date', 'runningTextId', 'status_id', 'editMode']);
        $this->resetValidation();
    }

    public function closeSettingsModal()
    {
        $this->showSettingsModal = false;
        $this->mount();
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
                'status_id' => $this->status_id
            ]);
            session()->flash('message', 'Data berhasil diperbarui.');
        } else {
            RunningText::create([
                'announcement' => $this->announcement,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'status_id' => $this->status_id
            ]);
            session()->flash('message', 'Data berhasil disimpan.');
        }

        $this->closeModal();

        return $this->redirect(request()->header('Referer'), navigate: true);
    }

    public function saveSettings()
    {
        /*
        $this->validate([
            'ticker_speed' => 'required|integer|min:1|max:20',
            'ticker_direction' => 'required|in:horizontal,vertical',
        ]);*/

        $settings = AppSetting::firstOrCreate([]);

        $settings->ticker_speed = $this->ticker_speed;
        $settings->ticker_direction = $this->ticker_direction; 

        $settings->save();

        session()->flash('message', 'Pengaturan berhasil disimpan.');
        $this->closeSettingsModal();

        return $this->redirect(request()->header('Referer'), navigate: true);
        
    }

    public function edit($id)
    {
        $runningText = RunningText::findOrFail($id);
        $this->runningTextId = $id;
        $this->announcement = $runningText->announcement;
        $this->start_date = $runningText->start_date ? $runningText->start_date->format('Y-m-d') : null;
        $this->end_date = $runningText->end_date ? $runningText->end_date->format('Y-m-d') : null;
        $this->status_id = $runningText->status_id;
        $this->updated_at = $runningText->updated_at ? $runningText->updated_at->format('d M Y, h:i A') : null;
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
            $this->showDeleteModal = false;
            $this->deleteId = null;

            session()->flash('message', 'Data berhasil dihapus.');            
            return $this->redirect(request()->header('Referer'), navigate: true);
        }
    }

    public function cancel()
    {
        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function mount()
    {
        $settings = AppSetting::first();
        if ($settings) {
            $this->ticker_speed = $settings->ticker_speed ?? 30;
            $this->ticker_direction = $settings->ticker_direction ?? 'horizontal';
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
        
        return view('livewire.running-text.show-running-text', compact('runningTexts'));
    }
}
