<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class indexcontroller extends Controller
{
    public function index(){
        $category=ServiceCategory::inRandomOrder()->take(12)->get();
        $featured = Service::where('featured',1)->take(8)->get();
        return view('Client.index',compact('category','featured'));
    }
}
