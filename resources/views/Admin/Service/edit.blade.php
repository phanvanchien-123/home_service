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
        height:auto;
    }
</style>
    <div class="section-title-01 honmob">
        <div class="bg_parallax image_02_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1>Thêm Dịch Vụ </h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="">Home</a></li>
                        <li>/</li>
                        <li>Thêm dịch vụ </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="content-central">
        <div class="content_info">
            <div class="paddings-mini">
                <div class="container">
                   
                        <div class=" col-md-10 col-md-offset-2 profile1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Cập Nhật Dịch Vụ
                                        </div>
                                        <div class="col-md-6">
                                        <a href="{{ route('admin.services.index') }}" class="btn btn-info pull-right">Tất cả dịch vụ </a>    
                                        </div>                                   
                                     </div>
                                </div>
                                <div class="panel-body">
                                    @include('Admin.Service.form')
                                 
                                    
                                    
                                    
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
