
@extends('Layout.admin') 

@section('title')
    <title>Add product</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admins/products/add/index/list.css')}}" class="">
@endsection
@section('js')
<script src="{{asset('venders/sweetAlert2/sweetalert2@11.js')}}"></script>
<script type="text/javascript" src="{{asset('admins/main.js')}}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
    @include('patials.content-header', ['name' => 'Product', 'key' => 'List'])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a href="{{ route('product.create')}}" class="btn btn-success float-right m-2">Add</a>
          </div>
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tên sản phẩm</th>
                  <th scope="col">Giá</th>
                  <th scope="col">Hình ảnh</th>
                  <th scope="col">Danh mục</th>
                  <th scope="col">Action</th> <!--sửa xóa-->
                </tr>
              </thead>
              <tbody>
             @foreach($products as $productItem) 
                <tr>
                  <th scope="row">{{$productItem->id}}</th>
                  <td>{{$productItem->name}}</td>
                  <td>{{ number_format((float) $productItem->price) }} </td>
                  <td>
                    <img class="product_image_150_100" src="{{$productItem->feature_image_path}}" alt="">
                  </td>
                  <td>@if($productItem->category)
                          {{$productItem->category->name}}
                      @else
                          {{ "No category" }}
                      @endif
                  </td>
                  <td>
                  <a href="{{ route('product.edit', ['id' => $productItem->id]) }}" class="btn btn-default">Edit</a>
                  <a href="" data-url="{{ route('product.delete', ['id' => $productItem->id]) }}" class="btn btn-danger action_delete">Delete</a>
                  </td>
                </tr>
               @endforeach 
              </tbody>
            </table>
          </div>
          <div class="col-md-12"> 
           {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection




