@extends('backend.layout.layout')

@section('title')
Sản phẩm
@endsection

@section('style')
<style>
.perfect-scrollbar-example {
  position: relative;
}
</style>
@endsection

@section('content')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Bảng điều khiển</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Danh mục sản phẩm</li>
      <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#home" role="tab"
            aria-controls="home" aria-selected="true">Thông tin cơ bản</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="sell-price-line-tab" data-bs-toggle="tab" href="#fixSellPrice" role="tab"
            aria-controls="fixSellPrice" aria-selected="false">Website</a>
        </li>
      </ul>
      <div class="tab-content mt-3" id="lineTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">
          <div class="card-body p-0 pt-2">
            <div class="card card-general-input col-12">
              <div class="card-header header-elements-inline bg-light d-block d-sm-flex">
                <h5 class="card-title font-weight-semibold mb-0">
                  <i class="icon-lg pb-3px" data-feather="info"></i>
                  Thông tin cơ bản
                </h5>
              </div>
              <div class="col-12 col-lg-6">
                <div class="card-body">
                  <div class="form-group mb-2">
                    <label>Danh mục</label>
                    <select class="form-select" id="category" data-placeholder="Chọn một danh mục">
                      <option></option>
                      <option>Reactive</option>
                      <option>Solution</option>
                      <option>Conglomeration</option>
                      <option>Algoritm</option>
                      <option>Holistic</option>
                    </select>
                  </div>
                  <div class="form-group mb-2">
                    <label>Tên<span class="text-danger">*</span></label>
                    <input type="text" name="name" maxlength="255" class="required form-control" id="name"
                      autocomplete="off" value="" placeholder="Nhập tên danh mục">
                  </div>
                  <div class="form-group mb-2">
                    <label>Mã danh mục<span class="text-danger">*</span></label>
                    <input type="text" name="code" maxlength="255" class="required form-control" id="code"
                      autocomplete="off" value="" placeholder="Nhập mã danh mục">
                  </div>
                  <div class="form-group mb-3">
                    <label class="mb-1">Sau khi lưu dữ liệu:</label>
                    <div class="px-2 d-flex align-items-center justify-content-start flex-wrap gap-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          Tiếp tục thêm danh mục
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                          checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                          Hiện thị danh mục
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-2">
                    <button id="btnSaveForm" type="button" class="btn btn-success">
                      <i class="icon-lg pb-3px" data-feather="save"></i>
                      Lưu
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="fixSellPrice" role="tabpanel" aria-labelledby="sell-price-line-tab">
          <div class="card-body p-0 pt-2">
            <div class="card card-general-input col-12">
              <div class="card-header header-elements-inline bg-light d-block d-sm-flex">
                <h5 class="card-title font-weight-semibold mb-0">
                  <i class="icon-lg pb-3px" data-feather="info"></i>
                  Website
                </h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <div class="form-group mb-2">
                      <label>Trạng thái:</label>
                      <select name="status" id="status" class="form-control">
                        <option value="1">Hiển thị</option>
                        <option value="2">Ẩn</option>
                      </select>
                    </div>
                    <div class="form-group mb-2">
                      <label>Hiển thị trang chủ:</label>
                      <select name="showHome" id="showHome" class="form-control">
                        <option value="">- Trạng thái -</option>
                        <option value="1">Hiển thị</option>
                        <option value="2">Không hiển thị</option>
                      </select>
                    </div>
                    <div class="card mb-3">
                      <div
                        class="card-header header-elements-inline bg-light d-flex align-items-center justify-content-between">
                        <h5 class="card-title font-weight-semibold mb-0">
                          <i class="icon-lg pb-3px" data-feather="image"></i>
                          Hình ảnh
                        </h5>
                        <div class="header-elements">
                          <div class="list-icons">
                            <a class="list-icons-item" data-bs-toggle="collapse" href="#list-images-item"
                              aria-expanded="false" aria-controls="list-images-item">
                              <i class="icon-xl pb-3px" data-feather="chevron-down"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="card-body collapse show" id="list-images-item">
                        <div class="form-group mb-2">
                          <div class="media mt-0 d-flex align-items-start justify-content-between gap-2">
                            <input type="hidden" name="imageCategory" class="imageUploadFile" id="imageCategory"
                              value="">
                            <div class="mr-3 imageArea"><i class="icon-xxl pb-3px" data-feather="camera"></i></div>
                            <div class="media-body" style="width: 90%">
                              <div class="uniform-uploader" id="uniform-imageUpload">
                                <input class="form-control" name="imageUpload"
                                  class="form-input-styled businessFileUpload" accept="image/*" id="imageUpload"
                                  type="file">
                              </div>
                              <span class="form-text text-muted">File: gif, png, jpg, bmp (Tối đa 4MB)</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card mb-2">
                      <div
                        class="card-header header-elements-inline bg-light d-flex align-items-center justify-content-between">
                        <h5 class="card-title font-weight-semibold mb-0">
                          <i class="icon-lg pb-3px" data-feather="image"></i>
                          Icon
                        </h5>
                        <div class="header-elements">
                          <a class="list-icons-item" data-bs-toggle="collapse" href="#list-icons-item"
                            aria-expanded="false" aria-controls="list-icons-item">
                            <i class="icon-xl pb-3px" data-feather="chevron-down"></i>
                          </a>
                        </div>
                      </div>
                      <div class="card-body collapse show" id="list-icons-item">
                        <div class="form-group mb-2">
                          <div class="media mt-0 d-flex align-items-start justify-content-between gap-2">
                            <input type="hidden" name="iconCategory" class="imageUploadFile" id="iconCategory" value="">
                            <div class="mr-3 imageArea"><i class="icon-xxl pb-3px" data-feather="camera"></i></div>
                            <div class="media-body" style="width: 90%">
                              <div class="uniform-uploader" id="uniform-iconUpload">
                                <input class="form-control" name="iconUpload"
                                  class="form-input-styled businessFileUpload" accept="image/*" id="iconUpload"
                                  type="file">
                              </div>
                              <span class="form-text text-muted">File: gif, png, jpg, bmp (Tối đa 4MB)</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group mb-2">
                      <label>Mô tả:</label>
                      <input type="text" name="description" maxlength="255" id="description" autocomplete="off"
                        class="form-control" value="">
                    </div>
                    <div class="form-group mb-2">
                      <label>metaTitle: </label>
                      <input type="text" name="metaTitle" id="metaTitle" autocomplete="off" class="form-control"
                        value="">
                    </div>
                    <div class="form-group mb-2">
                      <label>metaKeywords: </label>
                      <input type="text" name="metaKeywords" id="metaKeywords" autocomplete="off" class="form-control"
                        value="">
                    </div>
                    <div class="form-group mb-2">
                      <label>metaDescription: </label>
                      <input type="text" name="metaDescription" id="metaDescription" autocomplete="off"
                        class="form-control" value="">
                    </div>
                    <div class="form-group mb-2">
                      <label>Tags: </label>
                      <input type="text" name="tags" maxlength="255" id="tags" autocomplete="off" class="form-control"
                        value="">
                      <div class="bootstrap-autocomplete dropdown-menu"
                        style="top: 380.781px; left: 10px; width: 772.438px;"><a class="dropdown-item disabled">Không
                          tìm thấy tag</a></div>
                      <div class="tagArea"></div>
                    </div>
                    <div class="form-group mb-2">
                      <label>Thứ tự:</label>
                      <input type="text" name="order" maxlength="11" id="order" autocomplete="off" class="form-control"
                        value="">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group mb-2" id="categoryProductContent">
                      <!-- CK editor area -->
                      CK editor area
                      <!-- CK editor area -->
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <label class="mb-1">Sau khi lưu dữ liệu:</label>
                    <div class="px-2 d-flex align-items-center justify-content-start flex-wrap gap-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          Tiếp tục thêm danh mục
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                          checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                          Hiện thị danh mục
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-2">
                    <button id="btnSaveForm" type="button" class="btn btn-success">
                      <i class="icon-lg pb-3px" data-feather="save"></i>
                      Lưu
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection @section('script')
<script>
$('#category').select2({
  theme: "bootstrap-5",
  width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
  placeholder: $(this).data('placeholder'),
});
</script>
@endsection