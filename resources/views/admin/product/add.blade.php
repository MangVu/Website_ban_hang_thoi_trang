@extends('Layout.admin') 

@section('title')
    <title>Add product</title>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    
  <div class="content-wrapper">
    @include('patials.content-header', ['name' => 'Product', 'key' => 'Add'])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            <form  action="" method="post" enctype="multiple/form-data">
              @csrf
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text"  name="name"class="form-control" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label>Giá sản phẩm</label>
                    <input type="text"  name="price" class="form-control" placeholder="Nhập giá sản phẩm">
                </div>
                
                <div class="form-group">
                    <label>Hình ảnh đại diện</label>
                    <input type="file"  
                        name="feature_image_path"
                        class="form-control" 
                    >
                </div>

                <div class="form-group">
                    <label>Hình ảnh chi tiết</label>
                    <input type="file" 
                        multiple 
                        name="image_path[]"
                        class="form-control" 
                    >
                </div>

                <div class="form-group">
                    <label >Chọn danh mục</label>
                    <select class="form-control" name="parent_id">
                    <option value='0'>Chọn danh mục </option>
                    {!!$htmlOption!!}
                    </select>
                </div>

                <div class="form-group">
                    <label >Nhập tag cho sản phẩm</label>
                    <select class="form-control tags_select_choose" multiple="multiple">
                        
                    </select>
                </div>
            
                <div class="form-group">
                    <label>Nhập nội dung</label>
                    <textarea name="content" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div> 
        </div>
      </div>
    </div>
    
  </div>
@endsection
<!--lấy các phần CSS này đưa vào cái yield bên /layout/admin -->
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function(){
            $(".tags_select_choose").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })
        })
    </script>
@endsection




