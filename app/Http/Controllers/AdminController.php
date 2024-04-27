<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function profilepage()
    {
        return view('profile');
    }

    public function recharge()
    {
        return view('recharge');
    }

    public function reports()
    {
        return view('reports');
    }

    public function insertqr()
    {
        return view('insertqr');
    }
}
