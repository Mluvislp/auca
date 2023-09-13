<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Đăng ký</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/common/css/login.css') }}">
</head>

<body>

    <div class="wrapper" style="background-image: url({{ url('/assets/common/img/bg-login.png') }});">
        <div class="inner">
            <div class="image-holder">
                <img src="{{ asset('assets/common/img/poster-login.png') }}" alt="">
            </div>
            <form action="">
                <h3>ĐĂNG KÝ</h3>
                <div class="form-group">
                    <input type="text" placeholder="Họ" class="form-control">
                    <input type="text" placeholder="Tên" class="form-control">
                </div>
                <div class="form-wrapper">
                    <input type="text" placeholder="Tên đăng nhập" class="form-control">
                    <i class="zmdi zmdi-account"></i>
                </div>
                <div class="form-wrapper">
                    <input type="password" placeholder="Mật khẩu" class="form-control">
                    <i class="zmdi zmdi-lock"></i>
                </div>
                <div class="form-wrapper">
                    <input type="password" placeholder="Nhập lại mật khẩu" class="form-control">
                    <i class="zmdi zmdi-lock"></i>
                </div>
                <button type="submit">
                    <div>
                        Đăng ký
                    </div>
                </button>
                <div class="footer">
                    <p>Bạn đã có tài khoản? <a style="text-decoration: none" href="{{ route('login') }}">Đăng nhập</a></p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>