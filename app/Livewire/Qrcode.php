<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class Qrcode extends Component
{
    public $qrcodesend = null;

    public function mount()
    {
        $this->qrcodesend = 'Reading...';
    }

    public function updateQrcode()
    {
        try {
            $response = Http::get('http://192.168.8.125:80/qrcodesend');

            if ($response->successful()) {
                $this->qrcodesend = $response->body();
            } else {
                $this->qrcodesend = 'Succeed';
            }
        } catch (ConnectionException $e) {

            $this->qrcodesend = 'Succeed';
        } catch (\Exception $e) {

            $this->qrcodesend = 'Succeed';
        }
    }

    public function render()
    {
        return view('livewire.qrcode');
    }
}
