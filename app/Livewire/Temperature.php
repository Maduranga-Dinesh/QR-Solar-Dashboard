<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Temperature extends Component

{

    public $temperature = null;

    public function mount()
    {
        $this->temperature = 'N/A';
    }

    public function updateTemperature()
    {
        $response = Http::get('http://192.168.8.124:80/temperature');

        if ($response->successful()) {
            $this->temperature = $response->body();
   
               } else
        {
            $this->temperature = null;
        }

    }



    public function render()
    {
        return view('livewire.temperature');
    }


}
