<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
        
    }
}
