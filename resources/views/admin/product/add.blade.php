@extends('Layout.admin') 

@section('title')
    <title>Add product</title>
@endsection
@section('css')
    <link href="{{asset('venders/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{asset('admins/products/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')
    
<div class="content-wrapper">
    @include('patials.content-header', ['name' => 'Product', 'key' => 'Add'])
    <div class="col-md-12">
       
    </div>
    <form action="{{ route('product.store')}}" method="post" enctype="multipart/form-data">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                    @csrf
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text"  name="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Nhập tên sản phẩm"
                                value="{{old('name')}}"
                            >
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Giá sản phẩm</label>
                            <input type="text"  name="price" 
                                class="form-control @error('price') is-invalid @enderror" 
                                placeholder="Nhập giá sản phẩm"
                                value="{{old('price')}}"
                            >
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Hình ảnh đại diện</label>
                            <input type="file"  
                                name="feature_image_path"
                                class="form-control-file" 
                            >
                        </div>

                        <div class="form-group">
                            <label>Hình ảnh chi tiết</label>
                            <input type="file" 
                                multiple 
                                name="image_path[]"
                                class="form-control-file" 
                            >
                        </div>

                        <div class="form-group">
                            <label >Chọn danh mục</label>
                            <select class="form-control select2_init @error('category_id') is-invalid @enderror" name="category_id" > <!-- required -->
                            <option value=''>Chọn danh mục </option>
                            {!!$htmlOption!!}
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label >Nhập tags cho sản phẩm</label>
                            <select name="tags[]"class="form-control tags_select2_choose" multiple="multiple">
                            
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <!--phần này có thể tích hợp file_manager và tinymc để tương tác với hình ảnh-->
                        <div class="form-group">
                            <label>Nhập nội dung</label>
                            <textarea name="contents" 
                                class="form-control tinymce_editor_init @error('contents') is-invalid @enderror" rows="8" >{{old('contents')}}</textarea>
                            @error('contents')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
<!--lấy các phần CSS này đưa vào cái yield bên /layout/admin -->
@section('js')
    <script src="{{asset('../../venders/select2/select2.min.js') }}"></script>
    <script src="//cdn.tiny.cloud/1/1e9k07p9je74o3tfpzhy686zinvjzfct0546vnmnma2e9dok/tinymce/5/tinymce.min.js"></script>
    <script src="{{asset('../../admins/products/add/add.js') }}"></script>
@endsection




