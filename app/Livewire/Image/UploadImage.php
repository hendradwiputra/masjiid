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

    public $category;
    public $image_name;
    public $showModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $selectedImageId;
    public $selectedImageCategory;
    public $selectedImageName;

    protected function rules()
    {
        return [
            'category' => 'required',
            'image_name' => [
                'required',
                'image',
                'mimes:png,jpg,jpeg,gif,webp',
                'max:5120', 
            ],
        ];
    }

    protected $messages = [
        'category.required' => 'Kategori wajib diisi.',
        'image_name.required' => 'Gambar wajib diunggah.',
        'image_name.image' => 'File yang diupload harus dalam format gambar.',
        'image_name.max' => 'Ukuran gambar tidak boleh lebih dari 5 MB.',
    ];
    
    public function resetForm()
    {
        $this->reset('category', 'image_name');
        $this->showModal = true;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->reset('category', 'image_name', 'selectedImageId', 'selectedImageCategory');
    }

    public function save()
    {

        $this->validate();

        $path = $this->image_name->store('images/upload', 'public');
       
        Image::create([
            'category' => $this->category,
            'image_name' => $path,     
        ]);

        session()->flash('message', 'Gambar berhasil diupload.');

        $this->closeModal();

        return $this->redirect(request()->header('Referer'), navigate: true);

    }

    public function edit($id)
    {
        $image = Image::findOrFail($id);
        $this->selectedImageId = $id;
        $this->selectedImageCategory = $image->category;
        $this->category = $image->category;
        $this->selectedImageName = $image->image_name;
        $this->image_name = null; 
        $this->showEditModal = true;
        $this->showModal = false;
        $this->showDeleteModal = false;
    }

    public function update()
    {
        $this->validate([
            'category' => 'required',
            'image_name' => ['nullable', 'image', 'max:5120'], 
        ]);

        $image = Image::findOrFail($this->selectedImageId);

        $data = ['category' => $this->category];

        if ($this->image_name) {
            // Delete old image
            Storage::disk('public')->delete($image->image_name);
            // Store new image
            $data['image_name'] = $this->image_name->store('images/upload', 'public');
        }

        $image->update($data);

        session()->flash('message', 'Gambar berhasil diperbarui.');

        $this->closeModal();

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

        $this->closeModal();

        return $this->redirect(request()->header('Referer'), navigate: true);
    }

    public function render()
    {

        $images = Image::query()->latest('id')->paginate(12);

        return view('livewire.image.upload-image', compact('images'));

    }
}
