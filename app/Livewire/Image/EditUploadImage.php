<?php

namespace App\Livewire\Image;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithValidation;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class EditUploadImage extends Component
{
    use WithFileUploads;

    #[Title('Image Upload')]

    public $file;
    public $selectedImageId;
    public $selectedFileName;
    public $selectedFileType;
    public $selectedImageMimeType;
    public $selectedImageSize;
    public $currentFileSize;
    public $updated_at;

    protected function rules()
    {
        return [
            'file' => [
                'nullable',
                'file',
                'mimes:png,jpg,jpeg,gif,webp,mp4,avi,mov,wmv,webm', // added video formats
                'max:51200', // Image not more than 50 MB
            ]
        ];
    }

    protected $messages = [
        'file.file' => 'File yang diupload harus dalam format yang valid.',
        'file.max' => 'Ukuran file tidak boleh lebih dari 50 MB.',
        'file.mimes' => 'Format file harus: gambar (PNG, JPG, JPEG, GIF, WEBP) atau video (MP4, AVI, MOV, WMV, WEBM).',
    ];

    public function updatedFile()
    {
        if ($this->file) {
            $this->currentFileSize = $this->formatFileSize($this->file->getSize());
        } else {
            $this->currentFileSize = null;
        }
        $this->resetValidation();
    }

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

    public function isVideoFile($file)
    {
        if (!$file) return false;

        // For temporary uploaded files
        if (method_exists($file, 'getMimeType')) {
            $mimeType = $file->getMimeType();
            return str_starts_with($mimeType, 'video/');
        }

        // For stored files in database
        if (is_string($file)) {
            return str_starts_with($file, 'video/');
        }

        return false;
    }

    public function generateVideoThumbnail($fileName)
    {
        return asset('storage/' . $fileName) . '#t=0.1';
    }

    public function mount($id)
    {
        $image = Image::findOrFail($id);

        $this->selectedImageId = $id;
        $this->selectedFileName = $image->file_name;
        $this->selectedFileType = $image->type;
        $this->selectedImageMimeType = $image->mime_type;
        $this->selectedImageSize = $this->formatFileSize($image->file_size);
        $this->updated_at = $image->updated_at->format('d M Y, h:i A');

        $this->file = null;
        $this->currentFileSize = null; 
    }

    public function cancel()
    {
        return $this->redirect(route('upload-image'), navigate: true);
    }

    public function update()
    {
        $this->validate();

        $image = Image::findOrFail($this->selectedImageId);

        if ($this->file) {
            // Delete old image
            Storage::disk('public')->delete($image->file_name);

            // Determine new file type
            $mimeType = $this->file->getMimeType();
            $type = str_starts_with($mimeType, 'video/') ? 'video' : 'image';

            // Store new file and update
            $image->update([
                'file_name' => $this->file->store('images/upload', 'public'),
                'type' => $type,
                'mime_type' => $mimeType,
                'file_size' => $this->file->getSize(),
            ]);
        }

        session()->flash('message', 'Gambar berhasil diperbarui.');

        return $this->redirect(route('upload-image'), navigate: true);
    }

    public function render()
    {
        return view('livewire.image.edit-upload-image');
    }
}
