

<head>
  <meta charset="utf-8">
  <title>Đăng nhập</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/common/css/login.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/backend/css/font-awesome.min.css') }}">

</head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('assets/backend/js/jquery-3.7.0.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/backend/css/toastr.min.css') }}">

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- /Logo -->

  <div class="wrapper" style="background-image: url({{ url('/assets/common/img/bg-login.png') }});">
    <div class="inner">
      <div class="image-holder">
        <img src="{{ asset('assets/common/img/poster-login.png') }}" alt="">
      </div>
      <form id="login-form" class="mt-5" action="">
        <h3>ĐĂNG NHẬP </h3>
        <div class="form-wrapper">
          <input type="text" placeholder="Email đăng nhập" id="email-input" class="form-control">
          <i class="zmdi zmdi-account"></i>
        </div>
        <div class="form-wrapper">
          <input type="password" placeholder="Mật khẩu" id="password-input" class="form-control">
          <i class="zmdi zmdi-lock"></i>
        </div>
        <button id="login_button" type="submit">
          <div>
            Đăng nhập
          </div>
        </button>
        <div class="container_load hidden">
          <div class="wrapper_load">
             <div class="loader">
                <div class="dot"></div>
             </div>
             <div class="loader"> 
                <div class="dot"></div>
             </div>
             <div class="loader">
                <div class="dot"></div>
             </div>
             <div class="loader">
                <div class="dot"></div>
             </div>
             <div class="loader">
                <div class="dot"></div>
             </div>
             <div class="loader">
                <div class="dot"></div>
             </div>
          </div>
          <div class="text">
             Xin vui lòng đợi
          </div>
       </div>
        <div class="footer">
          <p>Bạn đã quên mật khẩu? <a style="text-decoration: none" href="#">Khôi phục tài khoản</a></p><br>
          <p>Bạn chưa có tài khoản? <a style="text-decoration: none" href="{{ route('register') }}">Đăng ký</a></p>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

</body>

</html>

<script type="text/javascript">  
$(document).ready(function() {
  $('#login-form').submit(function(event) {
    event.preventDefault();
    var email = $('#email-input').val();
    var password = $('#password-input').val();
    var loginData = {
      user_email : email,
      password : password
    }
    $('#login_button').addClass('hidden');
    $('.container_load').removeClass('hidden');
    if(email == '' || password == ''){
      $('#login_button').removeClass('hidden');
      $('.container_load').addClass('hidden');
      toastr.error('Bạn cần nhập email và password', 'Lỗi');
    }else{
      $.ajax({
        url: '{{ route('loginWeb') }}',
        type: 'POST',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: loginData,
        dataType: 'json',
        success: function(response) {
        const route12 = response.data.route
        $.ajax({
        url: '{{ route('loginApi') }}',
        type: 'POST',
        data: loginData,
        dataType: 'json',
        success: function(response) {
           // Xử lý thành công
            $('#login_button').removeClass('hidden');
            $('.container_load').addClass('hidden');
            localStorage.setItem('Token', response.data.access_token);
            toastr.success('Đăng nhập thành công!', 'Thông báo');
            window.location.href = route12;
        },
        error: function(xhr, status, error) {
          $('#login_button').removeClass('hidden');
          $('.container_load').addClass('hidden');
          toastr.error('Sai mật khẩu hoặc email', 'Lỗi');
        }
      });
        },
        error: function(xhr, status, error) {
          $('#login_button').removeClass('hidden');
          $('.container_load').addClass('hidden');
          toastr.error('Sai mật khẩu hoặc email', 'Lỗi');
        }
    });
    }
});

function TimeOut(time) {
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve();
    }, time);
  });
}

})
</script>
<script src="{{ asset('assets/backend/js/toastr.js') }}"></script>
