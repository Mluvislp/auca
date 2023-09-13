@extends('layout.layout')

@section('title')
    Quên mật khẩu
@endsection

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card">
          <div class="card-body">
            <h3>Yêu cầu khôi phục? 🔒</h3>
            <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
            <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Số điện thoại</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="Vui lòng nhập số điện thoại"
                  autofocus
                />
              </div>
              <button class="btn btn-primary d-grid w-100">Gửi yêu cầu</button>
            </form>
            <div class="text-center">
              <a href="auth-login-basic.html" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                Trở về đăng nhập
              </a>
            </div>
          </div>
        </div>
        <!-- /Forgot Password -->
      </div>
    </div>
</div>
@endsection
