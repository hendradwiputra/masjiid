<?php

namespace App\Livewire\Image;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Image;
use App\Models\SlideImage;

class EditSlideImage extends Component
{
    #[Title('Slide Gambar')]

    public $slideImage;
    public $image_id; 
    public $fullscreen_mode = 0;
    public $status_id = 1;
    public $title;
    public $content;
    public $author;
    public $start_date;
    public $end_date;
    public $updated_at;
    public $showImageModal = false;

    protected function rules()
    {
        return [
            'image_id' => 'required',
            'title' => 'nullable|string',
            'content' => 'nullable|string',
            'author' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ];
    }

    public $messages = [
        'image_id.required' => 'Silahkan pilih gambar.',
        'start_date.required' => 'Tanggal mulai harus diisi.',
        'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
        'end_date.required' => 'Tanggal berakhir harus diisi.',
        'end_date.date' => 'Tanggal berakhir harus berupa tanggal yang valid.',
        'end_date.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai.',
    ];

    public function mount($id)
    {
        $this->slideImage = SlideImage::with('image')->findOrFail($id);
        $this->image_id = $this->slideImage->image_id;
        $this->fullscreen_mode = $this->slideImage->fullscreen_mode;
        $this->status_id = $this->slideImage->status_id;
        $this->title = $this->slideImage->title;
        $this->content = $this->slideImage->content;
        $this->author = $this->slideImage->author;
        $this->start_date = $this->slideImage->start_date ? $this->slideImage->start_date->format('Y-m-d') : null;
        $this->end_date = $this->slideImage->end_date ? $this->slideImage->end_date->format('Y-m-d') : null;
        $this->updated_at = $this->slideImage->updated_at->format('d M Y, h:i A');
    }

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

    public function update()
    {
        $this->validate();

        $this->slideImage->update([
            'image_id' => $this->image_id,
            'fullscreen_mode' => $this->fullscreen_mode,
            'status_id' => $this->status_id,
            'title' => $this->title ?? '',
            'content' => $this->content ?? '',
            'author' => $this->author ?? '',
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ]);

        session()->flash('message', 'Slide gambar berhasil diperbaharui.');
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

        return view('livewire.image.edit-slide-image', compact ('images', 'selectedImage'));
    }
}
