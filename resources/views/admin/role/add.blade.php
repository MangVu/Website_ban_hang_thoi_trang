@extends('Layout.admin') 

@section('title')
    <title> Trang chủ</title>
@endsection

@section('css')
    <link href="{{asset('admins/slider/add/add.css')}}" rel="stylesheet" />
    <style>
      .card-header{
        background-color: #007bff!important;
        color: white!important;
      }
    </style>
@endsection

@section('content')
<div class="content-wrapper">
    @include('patials.content-header', ['name' => 'Role', 'key' => 'Add'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data" style="width:100%">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tên vai trò</label>
                            <input type="text"  
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Nhập tên slider"
                                   value="{{old('name')}}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mô tả vai trò</label>
                            <textarea name="description" 
                                      class="form-control @error('description') is-invalid @enderror"
                                      rows="4">{{old('description')}}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="card border-primary mb-3 col-md-12" >
                                <div class="card-header">
                                    <label>
                                        <input type="checkbox"  value="">
                                    </label>
                                    Model Sản phẩm
                                </div>
                                <div class="row">
                                    @for($i = 1; $i <= 4; $i++)
                                    <div class="card-body text-primary col-md-3">
                                        <h5 class="card-title">
                                            <label>
                                                <input type="checkbox"  value="">
                                            </label>
                                            Thêm sản phẩm
                                        </h5>
                                    </div>
                                    @endfor
                                </div>                               
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
