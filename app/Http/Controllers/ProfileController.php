<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
     public function show()
    {
        $user = auth()->user();
        return view('user_profile', compact('user'));
    }
}
