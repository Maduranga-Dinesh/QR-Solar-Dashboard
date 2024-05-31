<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Qrcode extends Component
{

    public $qrcodesend = null;

    public function mount()
    {
        $this->qrcodesend = 'N/A';
    }

    public function updateQrcode()
    {
        $response = Http::get('http://192.168.8.124:80/qrcodesend');

        if ($response->successful()) {
            $this->qrcodesend = $response->body();
            } else
            {
            $this->qrcodesend = null;
        }

    }
    public function render()
    {
        return view('livewire.qrcode');
    }
}
