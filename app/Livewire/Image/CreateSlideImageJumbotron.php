<?php

namespace App\Livewire\Image;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Image;
use App\Models\SlideJumbotron;

class CreateSlideImageJumbotron extends Component
{
    #[Title('Slide Jumbotron')]

    public $image_id;    
    public $status_id = 1;
    public $title;
    public $content;
    public $start_date;
    public $end_date;
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
        $this->resetValidation();
    }

    public function cancel()
    {
        return $this->redirect(route('slide-images-jumbotron'), navigate: true);
    }

    protected function rules()
    {
        return [
            'image_id' => 'required',
            'status_id' => 'required',
            'title' => 'nullable|string',
            'content' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ];
    }

    protected $messages = [
        'image_id.required' => 'Silahkan pilih gambar.',
        'start_date.required' => 'Tanggal mulai harus diisi.',
        'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
        'end_date.required' => 'Tanggal berakhir harus diisi.',
        'end_date.date' => 'Tanggal berakhir harus berupa tanggal yang valid.',
        'end_date.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai.',
    ];

    public function save()
    {
        $this->validate();

        SlideJumbotron::create([
            'image_id' => $this->image_id,
            'status_id' => $this->status_id,
            'title' => $this->title ?? '',
            'content' => $this->content ?? '',
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        session()->flash('message', 'Slide gambar berhasil disimpan');
        return $this->redirect(route('slide-images-jumbotron'), navigate: true);

    }
    
    public function render()
    {
        $images = Image::latest()->get();
        $selectedImage = Image::find($this->image_id);

        return view('livewire.image.create-slide-image-jumbotron', compact('images', 'selectedImage'));
    }
}
