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

    public $file;    
    public $selectedImageId;
    public $showDeleteModal = false;
    public $updated_at;

    // Helper method to format file size
    private function formatFileSize($bytes)
    {
        if ($bytes == 0) return '0 KB';
        
        $kb = $bytes / 1024;
        
        // Format to 2 decimal places if needed, otherwise show as integer
        if ($kb == (int)$kb) {
            return number_format($kb) . ' KB';
        } else {
            return number_format($kb, 2) . ' KB';
        }
    }

    public function create()
    {
        // Redirect to create page
        return $this->redirect(route('upload-image.create'), navigate: true);
    }

    public function edit($id)
    {
        // Redirect to edit page
        return $this->redirect(route('upload-image.edit', $id), navigate: true);        
    }

    public function cancel()
    {
        $this->showDeleteModal = false;
        $this->reset('selectedImageId');
    }

    public function confirmDelete($id)
    {
        $this->selectedImageId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $image = Image::findOrFail($this->selectedImageId);
        Storage::disk('public')->delete($image->file_name);
        $image->delete();

        session()->flash('message', 'Gambar berhasil dihapus.');

        $this->cancel();

        return $this->redirect(request()->header('Referer'), navigate: true);
    }

    public function render()
    {
       
        $images = Image::latest()->paginate(12);

        return view('livewire.image.upload-image', compact('images'));

    }
}
