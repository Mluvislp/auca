<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    <form class="search-form">
      <div class="input-group">
        <div class="input-group-text">
          <i data-feather="search"></i>
        </div>
        <input type="text" class="form-control" id="navbarForm" placeholder="Tìm kiếm nhanh...">
      </div>
    </form>
    <ul class="navbar-nav">

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="flag-icon flag-icon-vn mt-1" title="vn"></i>
          <span class="ms-1 me-1 d-none d-md-inline-block">Tiếng Việt</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="languageDropdown">
          <a href="javascript:;" class="dropdown-item py-2">
            <i class="flag-icon flag-icon-us" title="us" id="us"></i>
            <span class="ms-1">Tiếng Anh</span>
          </a>
          <a href="javascript:;" class="dropdown-item py-2">
            <i class="flag-icon flag-icon-vn" title="vn" id="vn"></i>
            <span class="ms-1">Tiếng Việt</span>
          </a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="appsDropdown" data-bs-popper="static">
          <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
            <p class="mb-0 fw-bold">Kết nối sàn TMDT</p>
          </div>
          <div class="row g-0 p-1">
            <div class="col-3 text-center">
              <a href="#" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70">
                <i data-feather="git-pull-request"></i>
                <p class="tx-12">Lazada</p>
              </a>
            </div>
            <div class="col-3 text-center">
              <a href="#" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70">
                <i data-feather="git-pull-request"></i>
                <p class="tx-12">Tiki</p>
              </a>
            </div>
            <div class="col-3 text-center">
              <a href="#" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70">
                <i data-feather="git-pull-request"></i>
                <p class="tx-12">Shopee</p>
              </a>
            </div>
            <div class="col-3 text-center">
              <a href="#" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70">
                <i data-feather="git-pull-request"></i>
                <p class="tx-12">Tiktok shop</p>
              </a>
            </div>
          </div>
          <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
            <a href="javascript:;">Kết nối tất cả</a>
          </div>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i data-feather="bell"></i>
          <div class="indicator">
            <div class="circle"></div>
          </div>
        </a>
        <div class="dropdown-menu" aria-labelledby="notificationDropdown">
          <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
            <p>Thông báo</p>
            <a href="javascript:;" class="text-muted">Xóa hết</a>
          </div>
          <div class="p-1">
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="icon-sm text-white" data-feather="bell"></i>
              </div>
              <div class="flex-grow-1 me-2">
                <p>Đơn hàng mới <span style="font-weight: 500;">(XNDFK-123)</span></p>
                <p class="tx-12 text-muted">30 phút trước</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="icon-sm text-white" data-feather="bell"></i>
              </div>
              <div class="flex-grow-1 me-2">
                <p>Đơn hàng mới <span style="font-weight: 500;">(XNDFK-123)</span></p>
                <p class="tx-12 text-muted">30 phút trước</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="icon-sm text-white" data-feather="bell"></i>
              </div>
              <div class="flex-grow-1 me-2">
                <p>Đơn hàng mới <span style="font-weight: 500;">(XNDFK-123)</span></p>
                <p class="tx-12 text-muted">30 phút trước</p>
              </div>
            </a>
          </div>
          <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
            <a href="javascript:;">Xem tất cả</a>
          </div>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <img class="wd-30 ht-30 rounded-circle" src="https://picsum.photos/200" alt="profile">
        </a>
        <div class="dropdown-menu" aria-labelledby="profileDropdown">
          <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
            <div class="mb-3">
              <img class="wd-80 ht-80 rounded-circle" src="https://picsum.photos/200" alt="profile">
            </div>
            <div class="text-center">
              <p class="tx-16 fw-bolder">Tommy đạm</p>
              <p class="tx-12 text-muted">#1 quốc trưởng</p>
            </div>
          </div>
          <ul class="list-unstyled p-1">
            <li class="dropdown-item py-2">
              <a href="pages/general/profile.html" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="user"></i>
                <span>Hồ sơ</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <a href="javascript:;" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="edit"></i>
                <span>Chỉnh sửa</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <a href="javascript:;" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="repeat"></i>
                <span>Phân quyền</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <a href="https://auth.lazada.com/oauth/authorize?response_type=code&force_auth=true&client_id=118838&redirect_uri=https://auca.tech/admin/store/lazada/connector"
                class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="log-out"></i>
                <span>Kết nối lazada</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <a href="{{ route('logout') }}" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="log-out"></i>
                <span>Đăng suất</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

    </ul>
  </div>
</nav>