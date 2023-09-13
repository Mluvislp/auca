<div class="modal fade" id="propertiesModal" tabindex="-1" aria-labelledby="propertiesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-content-block" style="display: block">
        <div class="modal-header">
          <h5 class="modal-title" id="propertiesModalLabel">
            Thêm giá trị cho thuộc tính undefined
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <input type="text" id="attributeValueTxt" placeholder="Tên (bắt buộc)" class="form-control">
          </div>
          <div class="form-group mb-3">
            <input type="text" id="attributeCodeTxt" placeholder="Code" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" id="attributeContentTxt" placeholder="Giá trị" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="modal-confirm-confirmed" class="btn btn-success">
            <i class="icon-lg pb-3px" data-feather="save"></i>
            Lưu
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        </div>
      </div>
      <div class="modal-loading-block" style="display: none">
        <div class="modal-body">
          <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>