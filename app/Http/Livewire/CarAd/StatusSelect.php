<?php

namespace App\Http\Livewire\CarAd;

use App\Models\CarAd;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class StatusSelect extends Component
{
    public CarAd $carAd;
    public array $statuses = [
        'archived' => 'Archived',
        'processing' => 'Processing',
        'published' => 'Published',
        'waiting' => 'Waiting'
    ];

    public function changeEvent($value)
    {
        $published_at = $value === 'published' && is_null($this->carAd->published_at) ? now() : $this->carAd->published_at;
        $this->carAd->update([
            'published_at' => $published_at,
            'status' => $value
        ]);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.car-ad.status-select');
    }
}
