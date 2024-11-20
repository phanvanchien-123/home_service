@extends('layouts.base')
@section('content')
<style>
    nav svg{
        height: 20px;
    }
    nav .hidden{
        display: block !important;
    }
    .panel-body{
        height: 400px;
    }
</style>
    <div class="section-title-01 honmob">
        <div class="bg_parallax image_02_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1>Cập nhật Slide  </h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="">Home</a></li>
                        <li>/</li>
                        <li>Cập nhật Slide  </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="content-central">
        <div class="content_info">
            <div class="paddings-mini">
                <div class="container">
                    <div class="row portfolioContainer">
                        <div class=" col-md-8 col-md-offset-2 profile1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Cập nhật Slide
                                        </div>
                                        <div class="col-md-6">
                                        <a href="{{ route('admin.slides.index') }}" class="btn btn-info pull-right">Tất cả Slide </a>    
                                        </div>                                   
                                     </div>
                                </div>
                                <div class="panel-body">
                                    @include('Admin.Slide.form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
