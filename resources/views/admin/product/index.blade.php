
@extends('Layout.admin') 

@section('title')
    <title>Add product</title>
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
                  <th scope="col">Action</th>/ <!--sửa xóa-->
                </tr>
              </thead>
              <tbody>
{{--                @foreach($categories as $category ) --}}
                <tr>
                  <th scope="row">1</th>
                  <td>Iphone 10</td>
                  <td>10.000.000</td>
                  <td>
                    <img src="" alt="">
                  </td>
                  <td>Điện thoại</td>
                  <td>
                    <a href="" class="btn btn-default">Edit</a>
                    <a href="" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
{{--               @endforeach --}}
              </tbody>
            </table>
          </div>
          <div class="col-md-12"> 
           
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection




