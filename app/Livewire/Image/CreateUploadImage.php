<?php

namespace App\Livewire\Image;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithValidation;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class CreateUploadImage extends Component
{
    use WithFileUploads;

    #[Title('Image Upload')]

    public $file;
    public $currentFileSize;

    protected function rules()
    {
        return [
            'file' => [
                'required',
                'file',
                'mimes:png,jpg,jpeg,gif,webp,mp4,avi,mov,wmv,webm', // added video formats
                'max:51200', // Image not more than 50 MB
            ]
        ];
    }

    protected $messages = [
        'file.required' => 'File wajib diunggah.',
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

    public function cancel()
    {
        return $this->redirect(route('upload-image'), navigate: true);
    }

    public function save()
    {

        $this->validate();

        $path = $this->file->store('images/upload', 'public');

        // Determine file type
        $mimeType = $this->file->getMimeType();
        $type = str_starts_with($mimeType, 'video/') ? 'video' : 'image';
       
        Image::create([
            'file_name' => $path,
            'type' => $type,
            'mime_type' => $mimeType,
            'file_size' => $this->file->getSize(),
        ]);

        session()->flash('message', 'File uploaded successfully.');

        return $this->redirect(route('upload-image'), navigate: true);
    }

    public function render()
    {
        return view('livewire.image.create-upload-image');
    }
}
