@extends('layouts.base')
@section('content')
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }
    </style>
    <div class="section-title-01 honmob">
        <div class="bg_parallax image_02_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1> Slide </h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="">Home</a></li>
                        <li>/</li>
                        <li>Slide </li>
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
                        <div class=" col-md-12 profile1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    @if (session('success'))
                                        <div class="alert alert-success " role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6">
                                            Tất cả Slide
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route('admin.slides.create') }}"
                                                class="btn btn-info pull-right">Thêm Slide </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Create_at</th>
                                        <th>Tùy Chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($slides as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td><img class="icon-img" src="{{ asset('images/slides/' . $item->image) }}"
                                                    alt="{{ $item->thumbnail }}" width="60px"></td>
                                            <td>{{ $item->title }}</td>
                                            
                                            <td>
                                                @if ($item->status)
                                                    Hoạt động
                                                @else
                                                    Không hoạt động
                                                @endif
                                            </td>
                                            
                                            <td>{{ $item->created_at }}</td>
                                            <td><a href="{{ route('admin.slides.edit', $item->id) }}"><i class="fa fa-edit fa-2x text-info"></i></a>                     
                                                <form action="{{ route('admin.slides.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                         <button type="submit" class="fa fa-times fa-2x text-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');" style="" ></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $slides->withQueryString()->links('pagination.default') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
