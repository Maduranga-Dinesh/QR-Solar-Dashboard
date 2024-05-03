<?php
//not use
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ESP32DataController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
        ]);

        // Store the data in your database or perform any other actions
        // For example:
        $temperature = $request->input('temperature');
        $humidity = $request->input('humidity');

        // Log the received data to Laravel's log file
        Log::info("Temperature: $temperature, Humidity: $humidity");

        return response()->json(['message' => 'Data received successfully'], 200);
    }
}
