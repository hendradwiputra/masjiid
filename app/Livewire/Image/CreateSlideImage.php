<?php

namespace App\Livewire\Image;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Image;
use App\Models\SlideImage;

class CreateSlideImage extends Component
{

    #[Title('Slide Gambar')]

    #[Validate('required|exists:images,id')]
    public $image_id;

    #[Validate('required|in:1,0')]
    public $status_id = 1;

    public $showImageModal = false;

    public function openImageModal()
    {
        $this->showImageModal = true;
    }

    public function closeImageModal()
    {
        $this->showImageModal = false;
    }

    public function selectImage($imageId)
    {
        $this->image_id = $imageId;
        $this->showImageModal = false;
    }

    public function save()
    {
        $this->validate();

        SlideImage::create([
            'image_id' => $this->image_id,
            'status_id' => $this->status_id
        ]);

        session()->flash('message', 'Slide gambar berhasil disimpan.');
        return $this->redirect(route('slide-images'), navigate: true);
    }

    public function cancel()
    {
        return $this->redirect(route('slide-images'), navigate: true);
    }

    public function render()
    {
        $images = Image::latest()->get();
        $selectedImage = Image::find($this->image_id);
        
        return view('livewire.image.create-slide-image', compact('images', 'selectedImage'));
    }
}
