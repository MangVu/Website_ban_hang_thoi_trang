
@extends('Layout.admin') 

@section('title')
    <title> Trang chủ</title>
@endsection
@section('css')
    <link href="{{asset('admins/slider/index/index.css') }}" rel="stylesheet" />
@endsection
@section('js')
    <script src="{{asset('venders/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/main.js')}}"></script>
@endsection
@section('content')
    <div class="content-wrapper">
    @include('patials.content-header', ['name' => 'User', 'key' => 'List'])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <a href="{{route('users.create')}}" class="btn btn-success float-right m-2">Add</a>
          </div>
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tên </th>
                  <th scope="col">Email</th>
                  <th scope="col">Action</th><!--sửa xóa-->
                </tr>
              </thead>
              <tbody>
                 @foreach($users as $user) 
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                      <a href="" class="btn btn-default">Edit</a>
                      <a href="" data-url="" class="btn btn-danger action_delete">Delete</a>
                    </td>
                </tr>
                 @endforeach  
              </tbody>
            </table>
          </div>
          <div class="col-md-12"> 
            {{$users->links()}} 
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection




