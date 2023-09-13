<div class="modal fade" id="modal-create-new-attribute" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl modal-fullscreen-sm-down">
    <div class="modal-content">
      <div class="modal-content-block" style="display: block">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tạo thuộc tính mới</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="min-height: 600px">
          <iframe src="{{ route('create-variant' ,  ['hideViewPartial' => true]) }}"
            style="width: 100% !important; min-height: 600px"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
        </div>
      </div>
    </div>
  </div>
</div>