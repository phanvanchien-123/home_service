@extends('layouts.base')
@section('content')
<div class="section-title-01 honmob">
    <div class="bg_parallax image_01_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>{{ $services->name }}</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>{{ $services->name }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="content-central">
    <div class="semiboxshadow text-center">
        <img src="image" class="img-responsive" alt="">
    </div>
    <div class="content_info">
        <div class="paddings-mini">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 single-blog">
                        <div class="post-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="post-header">
                                        <div class="post-format-icon post-format-standard"
                                            style="margin-top: -10px;">
                                            <i class="fa fa-image"></i>
                                        </div>
                                        <div class="post-info-wrap">
                                            <h2 class="post-title"><a href="#" title="Post Format: Standard"
                                                    rel="bookmark">{{ $services->name }}: AC</a></h2>
                                            <div class="post-meta" style="height: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="single-carousel">
                                        <div class="img-hover">
                                            <img src="{{ asset('images/services') }}/{{ $services->image }}" alt="{{  $services->image  }}"
                                                class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="post-content">
                                        <h3>{{ $services->name }}</h3>
                                        <p>{!! $services->description !!}</p>
                                        <h4>Inclusion</h4>
                                        <ul class="list-styles">
                                            {{-- @foreach (explode("
                                             ",$services->inclusion) as $item)
                                            <li><i class="fa fa-plus"></i>{!! $item !!}</li>
                                            @endforeach --}}
                                            <li><i class="fa fa-plus"></i>.</li>
                                            {!! $services->inclusion !!}
                                            
                                            
                                        </ul>
                                        <h4>Exclusion</h4>
                                        <ul class="list-styles">
                                            <li><i class="fa fa-plus"></i>.</li>
                                            {!! $services->exclusion !!}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <aside class="widget" style="margin-top: 18px;">
                            <div class="panel panel-default">
                                <div class="panel-heading">Booking Details</div>
                                <div class="panel-body">
                                    <table class="table">
                                        <tr>
                                            <td style="border-top: none;">Price</td>
                                            <td style="border-top: none;"><span>&#36;</span> {{ $services->price }}</td>
                                        </tr>
                                        @if ($services->discount)
                                            @if ($services->discount_type=='fixed')
                                            <tr>
                                                <td>Discount</td>
                                                <td>${{ $services->discount }}</td>
                                            </tr>
                                            @elseif($services->discount_type=='percent')
                                            <tr>
                                                <td>Discount</td>
                                                <td>${{ $services->discount }}</td>
                                            </tr>
                                            @endif
                                        @endif
                                        
                                        <tr>
                                            <td>Total</td>
                                            <td><span>&#36;</span>{{ $total }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="panel-footer">
                                    <form>                                                
                                        <input type="submit" class="btn btn-primary" name="submit"
                                            value=" Book Now">
                                    </form>
                                </div>
                            </div>
                        </aside>
                        <aside>
                            <h3>Related Service</h3>
                            @if ($relatedServices->isNotEmpty())
                            @foreach ($relatedServices as $item)
                            <div class="col-md-12 col-sm-6 col-xs-12 bg-dark color-white padding-top-mini"
                            style="max-width: 360px">
                            <a href="{{ route('show.details_service',$item->slug) }}">
                                <div class="img-hover">
                                    <img src=" {{asset('images/services/thumbnails/'.$item->thumbnail)  }} " alt="{{ $item->thumbnail }}"
                                        class="img-responsive">
                                </div>
                                <div class="info-gallery">
                                    <h3>
                                       {{ $item->name }}
                                    </h3>
                                    <hr class="separator">
                                    <p>{{ $item->category->name }}</p>
                                 
                                    <div class="content-btn"><a href="{{ route('show.details_service',$item->slug) }}"
                                            class="btn btn-warning">View Details</a></div>
                                            <div class="price"><span>&#36;</span><b>From</b>200</div>
                                </div>
                            </a>
                        </div>
                            @endforeach
                            
                            @endif
                            
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>            
</section>
@endsection