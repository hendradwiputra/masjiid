<?php

namespace App\Livewire\Notification;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Notification;

class UpdateNotification extends Component
{

    public $notification;
    public $id, $before_adhan_caption, $adhan_caption, $iqomah_caption, $sunrise_caption, $prayer_caption, $jumuah_caption,
        $updated_at;

    #[Title('Notification')]
    
    public function getNotification()
    {
        $this->notification = Notification::first();

        if ($this->notification) {
            $this->id = $this->notification->id;
            $this->before_adhan_caption = $this->notification->before_adhan_caption;
            $this->adhan_caption = $this->notification->adhan_caption;
            $this->iqomah_caption = $this->notification->iqomah_caption;
            $this->sunrise_caption = $this->notification->sunrise_caption;
            $this->prayer_caption = $this->notification->prayer_caption;
            $this->jumuah_caption = $this->notification->jumuah_caption;
            $this->updated_at = $this->notification->updated_at->format('d M Y, h:i A');
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

    public function updateNotification()
    {
        $this->validate();

        $notification = Notification::firstOrNew(['id' => $this->id]);

        $notification->before_adhan_caption = $this->before_adhan_caption;
        $notification->adhan_caption = $this->adhan_caption;
        $notification->iqomah_caption = $this->iqomah_caption;
        $notification->sunrise_caption = $this->sunrise_caption;
        $notification->prayer_caption = $this->prayer_caption;
        $notification->jumuah_caption = $this->jumuah_caption;
        $notification->updated_at = now();

        $notification->save();

        $this->mount();

        session()->flash('message', 'Data berhasil disimpan.');

        return $this->redirect(request()->header('Referer'), navigate: true);

    }

    public function mount()
    {
        $this->notification = $this->getNotification();
    }

    public function render()
    {
        return view('livewire.notification.update-notification', [
            'notification' => $this->notification
        ]);
    }
}
