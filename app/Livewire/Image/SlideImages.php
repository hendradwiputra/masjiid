<?php

namespace App\Livewire\Image;

use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use App\Models\SlideImage;
use App\Models\Image;

class SlideImages extends Component
{
    use WithPagination;

    #[Title('Slide Gambar')]

    public $image_id;
    public $status_id = 1;  
    public $deleteId;
    public $showImageModal = false;  
    public $showDeleteModal = false;    
    public $sortField = 'created_at';
    public $sortDirection = 'desc';    
     
    public function create()
    {
        // Redirect to create page
        return $this->redirect(route('slide-images.create'), navigate: true);
    }

    public function edit($id)
    {
        // Redirect to edit page
        return $this->redirect(route('slide-images.edit', $id), navigate: true);
    }

    public function cancel()
    {
        return $this->redirect(route('slide-images'), navigate: true);
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->deleteId) {
            $slideImage = SlideImage::findOrFail($this->deleteId);
            $slideImage->delete();

            $this->showDeleteModal = false;
            $this->deleteId = null;

            session()->flash('message', 'Slide gambar berhasil dihapus.');
            return $this->redirect(route('slide-images'), navigate: true);
        }        
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
        $slide_images = SlideImage::with('image')->orderBy($this->sortField, $this->sortDirection)->paginate(10);

        foreach ($slide_images as $slide) {
            $now = now();
            if ($now > $slide->end_date) {
                $slide->status = "Berakhir"; // Ended
            } else if ($now >= $slide->start_date && $now <= $slide->end_date) {
                $slide->status = "Aktif"; // Active
            } else {
                $slide->status = "Terjadwal"; // Scheduled
            }
        }

        return view('livewire.image.slide-images', [
            'slide_images' => $slide_images,
            
        ]);
    }
}