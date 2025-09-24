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
    public $start_date;
    public $end_date;
    public $showModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $selectedImageId;
    public $selectedImageCategory;
    public $selectedImageName;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    
    public function resetForm()
    {
        $this->reset('category', 'image_name', 'start_date', 'end_date');
        $this->showModal = true;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->reset('category', 'image_name', 'selectedImageId', 'selectedImageCategory', 'start_date', 'end_date');
    }

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
            'start_date' => 'date',
            'end_date' => 'date|after_or_equal:start_date'
        ];
    }

    protected $messages = [
        'category.required' => 'Kategori wajib diisi.',
        'image_name.required' => 'Gambar wajib diunggah.',
        'image_name.image' => 'File yang diupload harus dalam format gambar.',
        'image_name.max' => 'Ukuran gambar tidak boleh lebih dari 5 MB.',
        'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
        'end_date.date' => 'Tanggal berakhir harus berupa tanggal yang valid.',
        'end_date.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai.',
    ];

    public function save()
    {

        $this->validate();

        $path = $this->image_name->store('images/upload', 'public');
       
        Image::create([
            'category' => $this->category,
            'image_name' => $path,  
            'start_date' => $this->start_date,
            'end_date' => $this->end_date   
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
        $this->start_date = $image->start_date ? $image->start_date->format('Y-m-d') : null;
        $this->end_date = $image->end_date ? $image->end_date->format('Y-m-d') : null;
        $this->image_name = null; 
        $this->showEditModal = true;
        $this->showModal = false;
        $this->showDeleteModal = false;
    }

    public function update()
    {
        $this->validate([
            'category' => 'required',
            'image_name' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,webp', 'max:5120'], 
            'start_date' => 'date',
            'end_date' => 'date|after_or_equal:start_date',
        ]);

        $image = Image::findOrFail($this->selectedImageId);

        $data = [
            'category' => $this->category,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ];

        if ($this->image_name) {
            Storage::disk('public')->delete($image->image_name);
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
       
        $images = Image::orderBy($this->sortField, $this->sortDirection)->paginate(10);

        foreach ($images as $image) {

            if ($image->category == '1') {
                $image->category = 'Logo';
            } else if ($image->category == '2') {
                $image->category = 'Slide Gambar';
            } else {
                $image->category = 'Slide Jumbotron';
            }

            $now = now();
            if ($now > $image->end_date) {
                $image->status = 'Berakhir';
            } elseif ($now >= $image->start_date && $now <= $image->end_date) {
                $image->status = 'Aktif';
            } else {
                $image->status = 'Nonaktif';
            }
        }

        return view('livewire.image.upload-image', compact('images'));

    }
}
