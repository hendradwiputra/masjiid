<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Profile;
use App\Models\Image;

class UpdateProfile extends Component
{
    
    #[Title('Profile Overview')] 

    public $profile;
    public $id, $logo, $name, $address, $description, $contact_no, $selected_theme, $image_id, $image_name, $created_at, $updated_at;
    public $showImageModal = false;

    public function getProfile()
    {
        $this->profile = Profile::first();

        if ($this->profile) {
            $this->id = $this->profile->id;            
            $this->name = $this->profile->name;
            $this->address = $this->profile->address;
            $this->description = $this->profile->description;
            $this->contact_no = $this->profile->contact_no;
            $this->selected_theme = $this->profile->selected_theme;
            $this->image_id = $this->profile->image_id;
            $this->created_at = $this->profile->created_at;
            $this->updated_at = $this->profile->updated_at->format('d M Y, h:i A');

            // Load image_name with validation
            $this->image_name = null;
            if ($this->image_id) {
                $image = Image::find($this->image_id);
                if ($image) {
                    $this->image_name = $image->image_name;
                } else {
                    // Handle invalid image_id
                    $this->image_id = null; // Reset invalid image_id
                    \Log::warning("Invalid image_id {$this->image_id} found in profile ID {$this->profile->id}");
                }
            }
        }
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
        $this->image_name = Image::find($imageId)?->image_name;
        $this->showImageModal = false;
    }

    public function clearLogo()
    {
        $this->image_id = null;
        $this->image_name = null;
    }
   
    public function mount()
    {
        $this->getProfile();
    }

    public function rules()
    {
        return [            
            'name' => 'required|string|max:255',
            'address' => '|string',
            'description' => 'nullable|string',
            'contact_no' => 'nullable|string|max:60',
            'selected_theme' => 'required|string',
            'image_id' => 'nullable|exists:images,id',
        ];
    }

    public function update()
    {
        $this->validate();

        $profile = Profile::firstOrNew(['id' => $this->id]);

        $profile->name = $this->name;
        $profile->address = $this->address;
        $profile->description = $this->description;
        $profile->contact_no = $this->contact_no;
        $profile->selected_theme = $this->selected_theme;
        $profile->image_id = $this->image_id;
        $profile->updated_at = now();
        $profile->save();
        
        // Refresh the data
        $this->mount();

        session()->flash('message', 'Data berhasil disimpan.');

        return $this->redirect(request()->header('Referer'), navigate: true);

    }
    
    public function render()
    {
        $images = Image::query()->where('category', '1')->latest('id')->paginate(12); // Only logos
        return view('livewire.profile.update-profile', compact('images'));
    }
}
