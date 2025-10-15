<?php

namespace App\Livewire\Image;

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

    public $image_id, $status_id = 1;  
    public $deleteId;
    public $showImageModal = false;  
    public $showDeleteModal = false;    
     
    public function resetForm()
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
    
    public function render()
    {
        $slide_images = SlideImage::with('image')->latest()->paginate(10);

        return view('livewire.image.slide-images', [
            'slide_images' => $slide_images,
            
        ]);
    }
}