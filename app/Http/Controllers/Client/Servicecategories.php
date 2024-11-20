<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class Servicecategories extends Controller
{
   public function index(){
    $categories = ServiceCategory::all();
   
    return view('Client.Category',compact('categories'));
   } 
}
