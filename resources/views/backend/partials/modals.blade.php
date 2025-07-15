{{-- Loading Spinner Component --}}
<div id="loading" class="d-none">
  <div class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center" style="background: rgba(0,0,0,0.5); z-index: 9999;">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
</div>

{{-- Confirmation Modal --}}
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="confirmMessage">Apakah Anda yakin ingin melakukan tindakan ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="confirmAction">Ya, Lanjutkan</button>
      </div>
    </div>
  </div>
</div>

{{-- Image Preview Modal --}}
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imagePreviewModalLabel">Preview Gambar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="previewImage" src="" alt="Preview" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<script>
// Global functions for modals
function showLoading() {
  document.getElementById('loading').classList.remove('d-none');
}

function hideLoading() {
  document.getElementById('loading').classList.add('d-none');
}

function showConfirmModal(message, callback) {
  document.getElementById('confirmMessage').textContent = message;
  document.getElementById('confirmAction').onclick = function() {
    callback();
    bootstrap.Modal.getInstance(document.getElementById('confirmModal')).hide();
  };
  new bootstrap.Modal(document.getElementById('confirmModal')).show();
}

function showImagePreview(src, title = 'Preview Gambar') {
  document.getElementById('previewImage').src = src;
  document.getElementById('imagePreviewModalLabel').textContent = title;
  new bootstrap.Modal(document.getElementById('imagePreviewModal')).show();
}
</script>
