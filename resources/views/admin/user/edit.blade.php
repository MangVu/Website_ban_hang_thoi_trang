@extends('Layout.admin') 

@section('title')
    <title>Chỉnh Sửa Người Dùng</title>
@endsection

@section('css')
    <link href="{{ asset('venders/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('js')
    <script src="{{ asset('venders/select2/select2.min.js') }}"></script>
    <script src="{{asset('admins/user/add/add.js')}}"></script>
@endsection

@section('content')
    
<div class="content-wrapper">
@include('patials.content-header', ['name' => 'User', 'key' => 'Edit'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('users.update',['id'=>$user->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Họ và tên</label>
                            <input type="text"  
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nhập họ và tên"
                                value="{{$user->name}}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"  
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Nhập email"
                                value="{{$user->email}}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password"  
                                name="password" 
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Nhập mật khẩu">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Chọn vai trò</label>
                            <select id="roleSelect" name="role_id[]" class="form-control select2_init @error('role_id') is-invalid @enderror" multiple>
                                <option value=""></option>

                                @foreach($roles as $role)
                                    <option 
                                    {{ $roleOfUser->contains('id', $role->id)?'selected':''}}
                                    value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>

@endsection
