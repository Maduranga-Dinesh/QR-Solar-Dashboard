<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class Networkstatus extends Component
{
    public $network = null;

    public function mount()
    {
        $this->network = 'not connected';
    }

    public function updateNetwork()
    {
        try {
            $response = Http::get('http://192.168.8.125:80/network');

            if ($response->successful()) {
                $this->network = $response->body();
            } else {
                $this->network = 'N/A';
            }
        } catch (ConnectionException $e) {


            $this->network = 'No response';
        } catch (\Exception $e) {
            // Handle other potential exceptions
            $this->network = 'No response';
        }
    }

    public function render()
    {
        return view('livewire.networkstatus');
    }
}
