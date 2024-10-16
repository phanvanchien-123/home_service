@extends('layouts.base')
@section('content')
<div class="section-title-01 honmob">
    <div class="bg_parallax image_01_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>Các dịch vụ về {{$category->name  }}</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li>/</li>
                    <li>Các dịch vụ về {{$category->name  }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="content-central">
    <div class="container">
        <div class="row" style="margin-top: -30px;">
            <div class="titles">
                <h2><span>Dịch vụ </span> :  {{$category->name  }} </h2>
                <i class="fa fa-plane"></i>
                <hr class="tall">
            </div>
        </div>
    </div>
    <div class="content_info" style="margin-top: -70px;">
        <div>
            <div class="container">
                <div class="portfolioContainer">
                    @if ($category->services->count()>0)
                        
                    
                    @foreach ($category->services as $item)
                    <div class="col-xs-6 col-sm-4 col-md-3 nature hsgrids"
                    style="padding-right: 5px;padding-left: 5px;">
                    <a class="g-list" href="{{ route('show.details_service',$item->slug) }}">
                        <div class="img-hover">
                            <img src="{{ asset('images/services/thumbnails') }}/{{ $item->thumbnail }}" alt="{{ $item->name }}"
                                class="img-responsive">
                        </div>
                        <div class="info-gallery">
                            <h3>{{ $item->name }}</h3>
                            <hr class="separator">
                            <p>{{ $item->name }}</p>
                            <div class="content-btn"><a href="service-details/ac-wet-servicing.html"
                                    class="btn btn-primary">Book Now</a></div>
                            <div class="price"><span>&#36;</span><b>From</b>{{ $item->price }}</div>
                        </div>
                    </a>
                </div>
                    @endforeach
                    @else
                    <div class="col-md-12"><p class="text-center">Danh mục dịch vụ này chưa có</p></div>
                 
                        
                    @endif
                </div>
            </div>
        </div>
    </div>            
</section>
@endsection