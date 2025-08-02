@extends('backend.admin.layouts.app')

@section('title', 'Tambah Pengajuan Surat')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Pengajuan Surat /</span> Tambah Pengajuan Surat
        </h4>
        <a href="{{ route('mail-submissions.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>
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
    <form action="{{ route('mail-submissions.store') }}" method="POST" enctype="multipart/form-data" id="mailsForm">
        @csrf
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-edit me-2"></i>Informasi Pengajuan Surat</h5>
                    </div>
                    <div class="card-body">
                        <!-- NIK -->
                        <div class="mb-3">
                            <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK) <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                name="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK..." required
                                pattern="[0-9]{16}" maxlength="16">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- KK -->
                        <div class="mb-3">
                            <label for="no_kk" class="form-label">Nomor Kartu Keluarga (KK) <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('no_kk') is-invalid @enderror" id="no_kk"
                                name="no_kk" value="{{ old('no_kk') }}" placeholder="Masukkan KK..." required
                                pattern="[0-9]{16}" maxlength="16">
                            @error('no_kk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap..." required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NO HP -->
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor Handphone <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                name="no_hp" value="{{ old('no_hp') }}" placeholder="Masukkan nomor handphone..."
                                required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jenis Surat -->
                        <div class="mb-3">
                            <label for="jenis_surat" class="form-label">Jenis Keperluan Surat<span
                                    class="text-danger">*</span></label>
                            <select name="jenis_surat" id="jenis_surat"
                                class="form-select @error('jenis_surat') is-invalid @enderror">
                                <option disabled selected>Pilih jenis surat...</option>
                                <option value="surat keterangan domisili"
                                    {{ old('jenis_surat') == 'surat keterangan domisili' ? 'selected' : '' }}>Surat
                                    Ketarangan Domisili</option>
                                <option value="surat keterangan usaha"
                                    {{ old('jenis_surat') == 'surat keterangan usaha' ? 'selected' : '' }}>Surat Keterangan
                                    Usaha</option>
                                <option value="surat keterangan tidak mampu"
                                    {{ old('jenis_surat') == 'surat keterangan tidak mampu' ? 'selected' : '' }}>Surat
                                    Keterangan Tidak Mampu</option>
                                <option value="surat keterangan kematian"
                                    {{ old('jenis_surat') == 'surat keterangan kematian' ? 'selected' : '' }}>Surat
                                    Keterangan Kematian</option>
                                <option value="surat keterangan lahir"
                                    {{ old('jenis_surat') == 'surat keterangan lahir' ? 'selected' : '' }}>Surat Keterangan
                                    Lahir</option>
                                <option value="surat keterangan pindah"
                                    {{ old('jenis_surat') == 'surat keterangan pindah' ? 'selected' : '' }}>Surat
                                    Keterangan Pindah</option>
                                <option value="surat keterangan belum menikah"
                                    {{ old('jenis_surat') == 'surat keterangan belum menikah' ? 'selected' : '' }}>Surat
                                    Keterangan Belum Menikah</option>
                            </select>
                            @error('jenis_surat')
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
                    <div class="card-body">
                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description	" class="form-label">Deskripsi Pengajuan Surat <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                <i class="bx bx-save me-1"></i> Simpan Pengajuan Surat
                            </button>
                            <a href="{{ route('mail-submissions.index') }}" class="btn btn-outline-danger">
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
                height: 120,
                lang: 'id-ID',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']]
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


        // Form validation before submit
        document.getElementById('mailsForm').addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const description = $('#description').summernote('code').trim();

            if (!title) {
                e.preventDefault();
                alert('Judul Pengajuan Surat harus diisi!');
                document.getElementById('title').focus();
                return;
            }

            if (!description || description === '<p><br></p>') {
                e.preventDefault();
                alert('Deskripsi Pengajuan Surat harus diisi!');
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
