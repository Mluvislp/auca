<div class="modal fade" id="addQuickAttrValueModal" tabindex="-1" aria-labelledby="addQuickAttrValueModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addQuickAttrValueModalLabel">
          Thêm giá trị cho thuộc tính <b class="text-success variantName" id="modalTitle"></b>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="indexValueTxt" class="form-control" />
        <div class="form-group mb-2">
          <input type="text" id="attributeValueTxt" placeholder="Tên (bắt buộc)" class="form-control" />
        </div>
        <div class="form-group mb-2">
          <input type="text" id="attributeCodeTxt" placeholder="Code" class="form-control" />
        </div>
        <div class="form-group mb-2">
          <input type="text" id="attributeContentTxt" placeholder="Giá trị" class="form-control" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="saveAddQuickAttrValueBtn">
          Lưu
        </button>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
          Đóng
        </button>
      </div>
    </div>
  </div>
</div>