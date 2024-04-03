@extends('Layout.admin') 

@section('title')
    <title> Trang chủ</title>
@endsection

@section('css')
    <link href="{{asset('admins/role/add.css')}}" rel="stylesheet" />
@endsection

@section('js')
    <script src="{{asset('admins/role/add.js')}}"></script>
@endsection

@section('content')
<div class="content-wrapper">
    @include('patials.content-header', ['name' => 'Role', 'key' => 'Edit'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{route('roles.update',['id'=>$role->id])}}" method="post" enctype="multipart/form-data" style="width:100%">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tên vai trò</label>
                            <input type="text"  
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Nhập tên vai trò"
                                   value="{{$role->name}}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mô tả vai trò</label>
                            <textarea name="display_name" 
                                      class="form-control @error('display_name') is-invalid @enderror"
                                      rows="4">{{$role->display_name}}</textarea>
                            @error('display_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    <input type="checkbox" class="Checkall">
                                    Checkall
                                </label>
                            </div>
                            @foreach($permissionsParent as $permissionParentItem) 
                            <div class="card border-primary mb-3 col-md-12" >
                                <div class="card-header">
                                    <label>
                                        <input type="checkbox"  value="" class="checkbox_wapper ">
                                    </label>
                                    Model {{ $permissionParentItem-> name}}
                                </div>
                                <div class="row">
                                    <!lấy ra các thằng con thì trỏ đến phương thức trung gian trong model permission !>
                                    @foreach( $permissionParentItem->permissionChildren as $permissionChildrenItem)
                                    <div class="card-body text-primary col-md-3">
                                        <h5 class="card-title">
                                            <label>
                                                <input  class="checkbox_childrent" type="checkbox" 
                                                    name="permission_id[]" 
                                                    {{$permissionChecked->contains('id',$permissionChildrenItem->id)? 'checked':''}}
                                                    value="{{$permissionChildrenItem->id}}">
                                            </label>
                                            {{ $permissionChildrenItem-> name}}
                                        </h5>
                                    </div>
                                    @endforeach
                                </div>                               
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
