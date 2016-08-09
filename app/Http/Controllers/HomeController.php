<?php

namespace App\Http\Controllers;

use App\Models\Node;

class HomeController extends Controller
{
    public function index()
    {
        return view('networkmap');
    }
}
