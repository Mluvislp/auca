<nav class="sidebar">
  <div class="sidebar-header">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
      <span>AUCA</span>
    </a>
    <div class="sidebar-toggler not-active">
      <a href="{{ route('dashboard') }}">
        <i style="color: gray;" class="link-icon" data-feather="menu"></i>
      </a>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Hệ thống</li>
      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
          <i class="link-icon" data-feather="monitor"></i>
          <span class="link-title">Bảng điều khiển</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('company') }}" class="nav-link">
          <i class="link-icon" data-feather="briefcase"></i>
          <span class="link-title">Công ty</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('depot') }}" class="nav-link">
          <i class="link-icon" data-feather="anchor"></i>
          <span class="link-title">Kho hàng</span>
        </a>
      </li>
      <li class="nav-item nav-category">CỬA HÀNG</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#store" role="button" aria-expanded="false"
          aria-controls="store">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Sản phẩm</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="store">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('product') }}" class="nav-link">Quản lý sản phẩm</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('batch') }}" class="nav-link">Lô sản phẩm</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('category') }}" class="nav-link">Danh mục</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('brand') }}" class="nav-link">Thương hiệu</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('variant') }}" class="nav-link">Thuộc tính</a>
            </li>
            <li class="nav-item">
              <a href="{{route('suppliers.index')}}" class="nav-link">Nhà cung cấp</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#exchange" role="button" aria-expanded="false"
          aria-controls="exchange">
          <i class="link-icon" data-feather="mouse-pointer"></i>
          <span class="link-title">Sàn TMDT</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="exchange">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('lazada') }}" class="nav-link">Lazada.vn</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('shopee') }}" class="nav-link">Shopee.vn</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('tiktok') }}" class="nav-link">Tiktok.com</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('tiki') }}" class="nav-link">Tiki.vn</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">KHO HÀNG</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#warehouse" role="button" aria-expanded="false"
          aria-controls="warehouse">
          <i class="link-icon" data-feather="layers"></i>
          <span class="link-title">Quản lý kho</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="warehouse">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('bill') }}" class="nav-link">Xuất nhập kho</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('transfer') }}" class="nav-link">Chuyển kho</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('check') }}" class="nav-link">Kiểm kho</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('draft') }}" class="nav-link">Phiếu nháp</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('inventory') }}" class="nav-link">Tồn kho</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('storagetime') }}" class="nav-link">Thời gian lưu kho</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('limit') }}" class="nav-link">Hạn mức tồn kho</a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{ route('forecasting') }}" class="nav-link">Dự báo nhập hàng</a>
            </li> --}}
            <li class="nav-item">
              <a href="{{ route('history') }}" class="nav-link">Lịch sử sửa, xóa</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#packages" role="button" aria-expanded="false"
          aria-controls="packages">
          <i class="link-icon" data-feather="package"></i>
          <span class="link-title">Gói sản phẩm</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="packages">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('add_product_package') }}" class="nav-link">Thêm gói sản phẩm</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('unbox_product_package') }}" class="nav-link">Bung gói sản phẩm</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#prod-locations" role="button" aria-expanded="false"
          aria-controls="prod-locations">
          <i class="link-icon" data-feather="compass"></i>
          <span class="link-title">Vị trí sản phẩm</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="prod-locations">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('location') }}" class="nav-link">Vị trí sản phẩm</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('categoryLocation') }}" class="nav-link">Danh mục vị trí</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('billLocation') }}" class="nav-link">Hóa đơn xuất nhập vị trí</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('productLocation') }}" class="nav-link">Sản phẩm xuất nhập vị trí</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">CÀI ĐẶT</li>
      <li class="nav-item">
        <a href="{{ route('account') }}" class="nav-link">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Tài khoản</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
