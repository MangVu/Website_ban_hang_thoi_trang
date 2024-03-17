<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')
  <!-- Google Font: Source Sans Pro -->
  <!--hàm asset  URL đầy đủ đến một tệp tin tài nguyên như CSS, JavaScript, hình ảnh, font chữ, vv. từ thư mục public của ứng dụng.-->
  <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
  @yield('css')
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('patials.header')
  @include('patials.sidebar')

  @yield('content')
  <!-- Main Footer -->
 @include('patials.footer')
</div>
<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

@yield('js')
</body>
</html>
