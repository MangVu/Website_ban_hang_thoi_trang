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
    @include('patials.content-header', ['name' => 'Product', 'key' => 'Edit'])
    <form action="{{ route('product.update',['id'=> $product->id])}}" method="post" enctype="multipart/form-data">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                    @csrf
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text"  name="name"class="form-control" placeholder="Nhập tên sản phẩm" value="{{$product->name}}">
                        </div>
                        <div class="form-group">
                            <label>Giá sản phẩm</label>
                            <input type="text"  name="price" class="form-control" placeholder="Nhập giá sản phẩm" value="{{$product->price}}">
                        </div>
                        
                        <div class="form-group ">
                            <label>Hình ảnh đại diện</label>
                            <input type="file"  
                                name="feature_image_path"
                                class="form-control-file" 
                            >
                            <div class="col-md-4 feature_image_container">
                                <div class="row">
                                    <img class="feature_image"src="{{$product->feature_image_path}}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Hình ảnh chi tiết</label>
                            <input type="file" 
                                multiple 
                                name="image_path[]"
                                class="form-control-file" 
                            >
                            <div class="col-md-12 container_image_detail">
                                <div class="row">
                                    @if($product->productImages->count() > 0)
                                        @foreach($product->productImages as $productImageItem)
                                        <div class="col-md-3">
                                            <img class="Image_deatil_product" src="{{$productImageItem->image_path}}" alt="">
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-12">
                                            <p>No images available.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label >Chọn danh mục</label>
                            <select class="form-control select2_init" name="category_id" > <!-- required -->
                            <option value=''>Chọn danh mục </option>
                                {!!$htmlOption!!}
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Nhập tags cho sản phẩm</label>
                            <select name="tags[]"class="form-control tags_select2_choose" multiple="multiple">
                                @foreach($product->tags as $tagItem)
                                <option value="{{$tagItem->name}}" selected> {{$tagItem->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <!--phần này có thể tích hợp file_manager và tinymc để tương tác với hình ảnh-->
                        <div class="form-group">
                            <label>Nhập nội dung</label>
                            <textarea name="contents" class="form-control tinymce_editor_init " rows="8" >{{$product->content}}</textarea>
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




