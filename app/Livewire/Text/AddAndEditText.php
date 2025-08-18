<?php

namespace App\Livewire\Text;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Praytime;


class AddAndEditText extends Component
{
    public $praytime;
    public $id, $before_adhan_caption, $adhan_caption, $iqomah_caption, $sunrise_caption, $prayer_caption, $jumuah_caption,
        $updated_at;

    #[Title('Add and Edit Text')]
    
    public function getpraytime()
    {
        $this->praytime = Praytime::first();

        if ($this->praytime) {
            $this->id = $this->praytime->id;
            $this->before_adhan_caption = $this->praytime->before_adhan_caption;
            $this->adhan_caption = $this->praytime->adhan_caption;
            $this->iqomah_caption = $this->praytime->iqomah_caption;
            $this->sunrise_caption = $this->praytime->sunrise_caption;
            $this->prayer_caption = $this->praytime->prayer_caption;
            $this->jumuah_caption = $this->praytime->jumuah_caption;
            $this->updated_at = $this->praytime->updated_at->format('d M Y, h:i A');
        }
    }

    public function rules()
    {
        return [
            'before_adhan_caption' => 'required',
            'adhan_caption' => 'required',
            'iqomah_caption' => 'required',
            'sunrise_caption' => 'required',
            'prayer_caption' => 'required',
            'jumuah_caption' => 'required',
        ];
    }

    public function updatePraytime()
    {
        $this->validate();

        $praytime = Praytime::firstOrNew(['id' => $this->id]);

        $praytime->before_adhan_caption = $this->before_adhan_caption;
        $praytime->adhan_caption = $this->adhan_caption;
        $praytime->iqomah_caption = $this->iqomah_caption;
        $praytime->sunrise_caption = $this->sunrise_caption;
        $praytime->prayer_caption = $this->prayer_caption;
        $praytime->jumuah_caption = $this->jumuah_caption;
        $praytime->updated_at = now();

        $praytime->save();

        $this->mount();

        session()->flash('message', 'Data berhasil disimpan.');

        return $this->redirect(request()->header('Referer'), navigate: true);

    }

    public function mount()
    {
        $this->praytime = $this->getpraytime();
    }

    public function render()
    {        
        return view('livewire.text.add-and-edit-text', [
            'praytime' => $this->praytime
        ]);
    }

}
