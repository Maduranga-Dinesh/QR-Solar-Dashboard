<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Temperature extends Component
{
    public $temperature = null;

    public function mount()
    {

        $this->temperature = 'N/A';
    }

    public function updateTemperature()
    {
        try {
            $response = Http::get('http://192.168.8.125:80/temperature');

            if ($response->successful()) {
                $this->temperature = $response->body();
            } else {
                Log::warning('Failed to get temperature from ESP32, generating random temperature');
                $this->temperature = 'N/A';
            }
        } catch (ConnectionException $e) {

                $this->temperature = 'N/A';
        } catch (\Exception $e) {

                $this->temperature = 'N/A';
        }
    }

    public function render()
    {
        return view('livewire.temperature');
    }
}
