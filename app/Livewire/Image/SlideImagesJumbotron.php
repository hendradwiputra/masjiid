<?php

namespace App\Livewire\Image;

use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use App\Models\Image;
use App\Models\SlideJumbotron;

class SlideImagesJumbotron extends Component
{
    use WithPagination;

    #[Title('Slide Jumbotron')]

    public $image_id, $status_id = 1;
    public $deleteId;
    public $showDeleteModal = false;
    public $showImageModal = false;

    public function resetForm()
    {
        // Redirect to create page
        return $this->redirect(route('slide-images-jumbotron.create'), navigate: true);
    }

    public function edit($id)
    {
        // Redirect to edit page
        return $this->redirect(route('slide-images-jumbotron.edit', $id), navigate: true);
    }

    public function cancel()
    {
        return $this->redirect(route('slide-images-jumbotron'), navigate: true);
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->deleteId) {
            $slideJumbotron = SlideJumbotron::findOrFail($this->deleteId);
            $slideJumbotron->delete();

            $this->showDeleteModal = false;
            $this->deleteId = null;

            session()->flash('message', 'Slide gambar berhasil dihapus.');
            return $this->redirect(route('slide-images-jumbotron'), navigate: true);
        }
    }
    
    public function render()
    {
        $slide_jumbotron = SlideJumbotron::with('image')->latest()->paginate(10);

        return view('livewire.image.slide-images-jumbotron', [
            'slide_jumbotron' => $slide_jumbotron
        ]);
    }
}
