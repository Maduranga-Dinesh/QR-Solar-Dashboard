<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class Voltage extends Component
{
    public $voltage = null;

    public function mount()
    {
        $min_voltage = 11.9;
        $max_voltage = 12.1;

        // Generate a random integer between 119 and 121 (to represent 11.9 and 12.1 respectively)
        $random_int = mt_rand($min_voltage * 10, $max_voltage * 10);

        // Convert the random integer to a floating-point number
        $random_voltage = $random_int / 10;
        $this->voltage = 'N/A';
    }

    public function updateVoltage()
    {
        try {
            $response = Http::timeout(10)->get('http://192.168.8.125:80/voltage');

            if ($response->successful()) {
                $this->voltage = $response->body();
            } else {
                $this->voltage = 'Error';
            }
        } catch (ConnectionException $e) {
            // Log the exception or handle it as needed
            // For example, you can log it using:
            // Log::error($e->getMessage());

            $this->voltage = 'No response';
        } catch (\Exception $e) {
            // Handle other potential exceptions
            $this->voltage = 'No response';
        }
    }

    public function render()
    {
        return view('livewire.voltage');
    }
}
