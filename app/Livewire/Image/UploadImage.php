<?php

namespace App\Livewire\Image;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;
use App\Models\Image;

class UploadImage extends Component
{
    
    use WithFileUploads;
    use WithPagination;

    #[Title('Image Upload')]

    #[Validate('required')]
    public $category;

    #[Validate('image|max:2048')]
    public $image_name;

    public $updated_at;
  
    public function save()
    {

        $this->validate();

        $path = $this->image_name->store('images/upload', 'public');

       
        Image::create([
            'category' => $this->category,
            'image_name' => $path,     
        ]);


        session()->flash('message', 'Image uploaded successfully!');

        $this->reset('category', 'image_name');

        return $this->redirect(request()->header('Referer'), navigate: true);

    }

    public function render()
    {

        $images = Image::query()->latest('id')->paginate(12);

        return view('livewire.image.upload-image', compact('images'));

    }
}
