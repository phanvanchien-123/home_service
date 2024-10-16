<?php

namespace App\Http\Controllers\Sprovider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('Sprovider.index');
    }
}
