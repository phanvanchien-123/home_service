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
        $featured_category = Service::where('featured',1)->take(8)->get();
        $featured_service = ServiceCategory::where('featured',1)->take(8)->get();
        return view('Client.index',compact('category','featured_category','featured_service'));
    }
}
