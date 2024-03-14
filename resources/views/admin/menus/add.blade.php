@extends('Layout.admin') 

@section('title')
    <title> Trang chủ</title>
@endsection

@section('content')
    
  <div class="content-wrapper">
    @include('patials.content-header', ['name' => 'Menu', 'key' => 'Add'])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            <form  action="{{ route('menus.store')}}" method="post">
              @csrf
                <div class="form-group">
                    <label>Tên menu</label>
                    <input type="text"  name="name"class="form-control" placeholder="Nhập tên menu">
                </div>
                <div class="form-group">
                    <label >Chọn menu </label>
                    <select class="form-control" name="parent_id">
                    <option value='0'>Chọn menu cha</option>
                    {!!$optionSelect!!}
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div> 
        </div>
      </div>
    </div>
    
  </div>
@endsection




