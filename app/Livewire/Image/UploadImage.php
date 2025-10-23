<?php

namespace App\Livewire\Image;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class UploadImage extends Component
{
    
    use WithFileUploads;
    use WithPagination;

    #[Title('Image Upload')]

    public $image_name;
    public $showModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $selectedImageId;
    public $selectedImageName;
    public $updated_at;
    
    public function resetForm()
    {
        $this->reset('image_name');
        $this->resetValidation();
        $this->showModal = true;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
    }

    public function cancel()
    {
        $this->showModal = false;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->reset('image_name', 'selectedImageId');
        $this->resetValidation();
    }

    protected function rules()
    {
        return [
            'image_name' => [
                'required',
                'image',
                'mimes:png,jpg,jpeg,gif,webp',
                'max:5120', 
            ]
        ];
    }

    protected $messages = [
        'image_name.required' => 'Gambar wajib diunggah.',
        'image_name.image' => 'File yang diupload harus dalam format gambar.',
        'image_name.max' => 'Ukuran gambar tidak boleh lebih dari 5 MB.',
    ];

    public function save()
    {

        $this->validate();

        $path = $this->image_name->store('images/upload', 'public');
       
        Image::create([
            'image_name' => $path
        ]);

        session()->flash('message', 'Gambar berhasil diupload.');

        $this->cancel();

        return $this->redirect(request()->header('Referer'), navigate: true);

    }

    public function edit($id)
    {
        $image = Image::findOrFail($id);
        $this->selectedImageId = $id;
        $this->selectedImageName = $image->image_name;
        $this->updated_at = $image->updated_at->format('d M Y, h:i A');
        $this->image_name = null; 
        $this->showEditModal = true;
        $this->showModal = false;
        $this->showDeleteModal = false;
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate([
            'image_name' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,webp', 'max:5120']
        ]);

        $image = Image::findOrFail($this->selectedImageId);

        if ($this->image_name) {
            // Delete old image
            Storage::disk('public')->delete($image->image_name);

            // Store new image and update
            $image->update([
                'image_name' => $this->image_name->store('images/upload', 'public')
            ]);
        }

        session()->flash('message', 'Gambar berhasil diperbarui.');

        $this->cancel();

        return $this->redirect(request()->header('Referer'), navigate: true);
    }

    public function confirmDelete($id)
    {
        $this->selectedImageId = $id;
        $this->showDeleteModal = true;
        $this->showModal = false;
        $this->showEditModal = false;
    }

    public function delete()
    {
        $image = Image::findOrFail($this->selectedImageId);
        Storage::disk('public')->delete($image->image_name);
        $image->delete();

        session()->flash('message', 'Gambar berhasil dihapus.');

        $this->cancel();

        return $this->redirect(request()->header('Referer'), navigate: true);
    }

    public function render()
    {
       
        $images = Image::latest()->paginate(8);

        return view('livewire.image.upload-image', compact('images'));

    }
}
