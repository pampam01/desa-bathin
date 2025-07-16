@extends('backend.admin.layouts.app')

@section('title', 'Tambah Pengaduan - Portal Parakan')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Portal Parakan / Pengaduan /</span> Tambah Pengaduan
        </h4>
        <a href="{{ route('complaints.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('complaints.index') }}">Pengaduan</a></li>
    <li class="breadcrumb-item active">Tambah Pengaduan</li>
@endsection

@push('styles')
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        .image-preview {
            max-width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .drag-drop-area {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .drag-drop-area:hover,
        .drag-drop-area.dragover {
            border-color: #696cff;
            background-color: #f8f9ff;
        }

        .drag-drop-area.dragover {
            transform: scale(1.02);
        }
    </style>
@endpush

@section('content')
    <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" id="complaintsForm">
        @csrf
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-edit me-2"></i>Informasi Pengaduan</h5>
                    </div>
                    <div class="card-body">
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Pengaduan <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title') }}" placeholder="Masukkan judul Pengaduan..."
                                required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Judul akan muncul sebagai headline Pengaduan</div>
                        </div>

                        <!-- Slug -->
                        {{-- <div class="mb-3">
              <label for="slug" class="form-label">Slug URL</label>
              <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                     id="slug" name="slug" value="{{ old('slug') }}" 
                     placeholder="otomatis-dari-judul">
              @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="form-text">URL yang ramah SEO (opsional, akan otomatis diisi dari judul)</div>
            </div> --}}

                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror"
                                id="category" name="category" value="{{ old('category') }}"
                                placeholder="Masukkan kategori Pengaduan...">
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Ringkasan akan tampil di daftar Pengaduan (maksimal 300 karakter)</div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Pengaduan <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Featured Image -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-image me-2"></i>Gambar Utama</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="drag-drop-area" id="dragDropArea">
                                <i class="bx bx-cloud-upload bx-lg text-primary mb-2"></i>
                                <p class="mb-2">Seret & lepas gambar di sini</p>
                                <p class="text-muted mb-3">atau</p>
                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="document.getElementById('image').click()">
                                    Pilih File
                                </button>
                            </div>

                            <input type="file" class="form-control d-none @error('image') is-invalid @enderror"
                                id="image" name="image" accept="image/*" onchange="previewImage(this)">

                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <div class="form-text">Format: JPG, PNG, WebP. Maksimal 2MB. Rekomendasi: 800x600px</div>
                        </div>

                        <!-- Image Preview -->
                        <div id="imagePreview" class="d-none">
                            <img id="previewImg" src="" alt="Preview" class="image-preview mb-2">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-sm btn-outline-primary"
                                    onclick="document.getElementById('image').click()">
                                    Ganti Gambar
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Publish Settings -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-cog me-2"></i>Aksi</h5>
                    </div>
                    <div class="card-body">
                        <!-- Status -->
                        <input type="hidden" name="status" value="draft" id="status">

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i> Simpan Pengaduan
                            </button>
                            <a href="{{ route('complaints.index') }}" class="btn btn-outline-danger">
                                <i class="bx bx-x me-1"></i> Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-id-ID.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Summernote
            $('#description').summernote({
                height: 300,
                lang: 'id-ID',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Auto-generate slug from title
            $('#title').on('input', function() {
                const title = $(this).val();
                const slug = title.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim();
                $('#slug').val(slug);
            });

            // Character counter for excerpt
            $('#excerpt').on('input', function() {
                const maxLength = 300;
                const currentLength = $(this).val().length;
                const remaining = maxLength - currentLength;

                // Update or create counter
                let counter = $('#excerpt').siblings('.char-counter');
                if (counter.length === 0) {
                    counter = $('<div class="char-counter form-text"></div>');
                    $('#excerpt').after(counter);
                }

                counter.text(`${currentLength}/${maxLength} karakter`);
                counter.toggleClass('text-danger', remaining < 0);
            });
        });

        // Drag and Drop functionality
        const dragDropArea = document.getElementById('dragDropArea');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dragDropArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dragDropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dragDropArea.addEventListener(eventName, unhighlight, false);
        });

        dragDropArea.addEventListener('drop', handleDrop, false);

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight(e) {
            dragDropArea.classList.add('dragover');
        }

        function unhighlight(e) {
            dragDropArea.classList.remove('dragover');
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                document.getElementById('image').files = files;
                previewImage(document.getElementById('image'));
            }
        }

        // Image preview
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('d-none');
                    document.getElementById('dragDropArea').style.display = 'none';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            document.getElementById('image').value = '';
            document.getElementById('imagePreview').classList.add('d-none');
            document.getElementById('dragDropArea').style.display = 'block';
        }

        // Save as draft
        function saveDraft() {
            document.getElementById('status').value = 'draft';
            document.getElementById('complaintsForm').submit();
        }

        // Form validation before submit
        document.getElementById('complaintsForm').addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const description = $('#description').summernote('code').trim();

            if (!title) {
                e.preventDefault();
                alert('Judul Pengaduan harus diisi!');
                document.getElementById('title').focus();
                return;
            }

            if (!description || description === '<p><br></p>') {
                e.preventDefault();
                alert('Deskripsi Pengaduan harus diisi!');
                $('#description').summernote('focus');
                return;
            }

            // ⬇ Tambahkan baris ini
            $('#description').val(description); // Sinkronkan ke textarea

            showLoading();
        });

        // Auto-save draft every 2 minutes
        let autoSaveInterval;

        function startAutoSave() {
            autoSaveInterval = setInterval(function() {
                const title = document.getElementById('title').value.trim();
                const description = $('#description').summernote('code').trim();

                if (title && description && description !== '<p><br></p>') {
                    // Implement auto-save logic here
                    console.log('Auto-saving draft...');
                }
            }, 120000); // 2 minutes
        }

        // Start auto-save when user starts typing
        let typingTimer;
        document.getElementById('title').addEventListener('input', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(startAutoSave, 3000);
        });
    </script>
@endpush
