@extends('Layout.admin') 

@section('title')
    <title>Setting</title>
@endsection

@section('content')
    
  <div class="content-wrapper">
    @include('patials.content-header', ['name' => 'Setting', 'key' => 'Edit'])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            <form action="{{route('settings.update',['id'=>$setting->id])}}" method="post">
              @csrf
                <div class="form-group">
                    <label>Config key</label>
                    <input type="text"  
                        name="config_key"
                        class="form-control @error('config_key') is-invalid @enderror" 
                        placeholder="Nhập config key"
                        value="{{$setting->config_key}}"
                    >
                    @error('config_key')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                @if(request()->type === "Text")
                    <div class="form-group">
                        <label>Config value</label>
                        <input type="text"  
                            name="config_value"
                            class="form-control @error('config_value') is-invalid @enderror" 
                            placeholder="Nhập config value"
                            value="{{$setting->config_value}}"
                        >
                        @error('config_value')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @elseif(request()->type === "Textarea")
                    <div class="form-group">
                        <label>Config value</label>
                        <textarea rows="5" 
                            name="config_value"
                            class="form-control @error('config_value') is-invalid @enderror" 
                            placeholder="Nhập config value"
                        >{{$setting->config_value}}</textarea>
                        @error('config_value')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div> 
        </div>
      </div>
    </div>
    
  </div>
@endsection




