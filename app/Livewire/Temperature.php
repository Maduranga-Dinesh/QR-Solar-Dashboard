<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

class Temperature extends Component

{

    public $temperature = null;

    public function mount($temperature)
    {
        $this->$temperature=$temperature;
    }
    public function render()
    {
        return view('livewire.temperature');
    }
}
