<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function getLockerOne(){

    }

    public function onereceiveData(Request $request)
    {

        $data = $request->getContent();

        if (is_string($data) && is_array(json_decode($data, true)) && (json_last_error() == JSON_ERROR_NONE)) {
            $data = json_decode($data, true);
        }

        return response()->json(['Limit Switch 1 data received' => $data]);
    }

    public function tworeceiveData(Request $request)
    {

        $data = $request->getContent();

        if (is_string($data) && is_array(json_decode($data, true)) && (json_last_error() == JSON_ERROR_NONE)) {
            $data = json_decode($data, true);
        }

        return response()->json(['Limit Switch 2 data received' => $data]);
    }
}
