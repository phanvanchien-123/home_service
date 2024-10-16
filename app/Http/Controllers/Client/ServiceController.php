<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index($category_slug){
        $category = ServiceCategory::where('slug', $category_slug)->firstOrFail();
       
        return view('Client.Services-by-category',compact('category'));
    }
    public function show($service_slug){
        $services = Service::where('slug',$service_slug)->first();
        $discount = 0;
    if ($services->discount) {
        if ($services->discount_type == 'fixed') {
            $discount = $services->discount;
        } elseif ($services->discount_type == 'percent') {
            $discount = ($services->discount / 100) * $services->price;
        }
    }

    // Calculate total price after discount
    $total = $services->price - $discount;
    $relatedServices = Service::where('service_category_id', $services->service_category_id)
                               ->where('id', '!=', $services->id) // Exclude the current service
                               ->take(2)
                               ->get();
    // Pass data to the view
    return view('Client.DetailsService', [
        'services' => $services,
        'discount' => $discount,
        'total' => $total,
        'relatedServices'=>$relatedServices,
    ]);
    }
}
