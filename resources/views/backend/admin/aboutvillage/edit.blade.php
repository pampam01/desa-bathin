@extends('backend.admin.layouts.app')

@section('title', 'Edit Tentang Desa')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Kelola /</span> Edit Informasi Desa
        </h4>
        <a href="{{ route('aboutvillage.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('aboutvillage.index') }}">Tentang Desa</a></li>
    <li class="breadcrumb-item active">Edit Informasi Desa</li>
@endsection

@push('styles')
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            color: white;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .counter-input {
            border: 2px solid #e3e6f0;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
        }

        .counter-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .draft-actions {
            border-top: 1px solid #e3e6f0;
            padding-top: 1rem;
            margin-top: 1rem;
        }

        .note-editor .note-toolbar {
            border-bottom: 1px solid #e3e6f0;
        }

        .note-editor .note-editing-area {
            background: #fff;
        }
    </style>
@endpush

@section('content')
    <form action="{{ route('aboutvillage.update', $aboutVillage->id) }}" method="POST" id="aboutVillageForm">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-8">
                <!-- Statistik Desa -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-bar-chart me-2"></i>Statistik Desa</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="people_total" class="form-label">Total Penduduk</label>
                                <input type="number"
                                    class="form-control counter-input @error('people_total') is-invalid @enderror"
                                    id="people_total" name="people_total"
                                    value="{{ old('people_total', $aboutVillage->people_total) }}" placeholder="0"
                                    min="0">
                                @error('people_total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="family_total" class="form-label">Total Keluarga</label>
                                <input type="number"
                                    class="form-control counter-input @error('family_total') is-invalid @enderror"
                                    id="family_total" name="family_total"
                                    value="{{ old('family_total', $aboutVillage->family_total) }}" placeholder="0"
                                    min="0">
                                @error('family_total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="blok_total" class="form-label">Total Dusun/Blok</label>
                                <input type="number"
                                    class="form-control counter-input @error('blok_total') is-invalid @enderror"
                                    id="blok_total" name="blok_total"
                                    value="{{ old('blok_total', $aboutVillage->blok_total) }}" placeholder="0"
                                    min="0">
                                @error('blok_total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="program_total" class="form-label">Total Program Unggulan</label>
                                <input type="number"
                                    class="form-control counter-input @error('program_total') is-invalid @enderror"
                                    id="program_total" name="program_total"
                                    value="{{ old('program_total', $aboutVillage->program_total) }}" placeholder="0"
                                    min="0">
                                @error('program_total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi Desa -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-file-blank me-2"></i>Deskripsi Desa</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi/Sejarah Desa</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $aboutVillage->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Tuliskan sejarah, deskripsi, dan informasi umum tentang desa</div>
                        </div>
                    </div>
                </div>

                <!-- Visi & Misi -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-target-lock me-2"></i>Visi & Misi Desa</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="visi" class="form-label">Visi Desa</label>
                                    <textarea class="form-control @error('visi') is-invalid @enderror" id="visi" name="visi" rows="6"
                                        placeholder="Tuliskan visi desa...">{{ old('visi', $aboutVillage->visi) }}</textarea>
                                    @error('visi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="misi" class="form-label">Misi Desa</label>
                                    <textarea class="form-control @error('misi') is-invalid @enderror" id="misi" name="misi" rows="6"
                                        placeholder="Tuliskan misi desa...">{{ old('misi', $aboutVillage->misi) }}</textarea>
                                    @error('misi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Informasi Kontak -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-phone me-2"></i>Informasi Kontak</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="location" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control @error('location') is-invalid @enderror" id="location" name="location" rows="4"
                                placeholder="Jl. Nama Jalan No.123, Kecamatan, Kabupaten, Provinsi">{{ old('location', $aboutVillage->location) }}</textarea>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control @error('no_telp') is-invalid @enderror"
                                id="no_telp" name="no_telp" value="{{ old('no_telp', $aboutVillage->no_telp) }}"
                                placeholder="(021) 1234567">
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Desa</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $aboutVillage->email) }}"
                                placeholder="desa@example.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('aboutvillage.index') }}" class="btn btn-outline-danger">
                                <i class="bx bx-x me-1"></i> Batal
                            </a>
                        </div>
                        <div class="draft-actions">
                            <button type="button" class="btn btn-outline-secondary btn-sm w-100" onclick="clearDraft()">
                                <i class="bx bx-trash me-1"></i> Hapus Draft
                            </button>
                            <small class="text-muted d-block mt-1 text-center">Draft disimpan otomatis setiap 2
                                detik</small>
                        </div>
                    </div>
                </div>

                <!-- Preview Stats -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bx bx-show me-2"></i>Preview Statistik</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="text-center p-2 bg-light rounded">
                                    <div class="h6 mb-0" id="preview-people">{{ $aboutVillage->people_total ?? 0 }}</div>
                                    <small class="text-muted">Penduduk</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-2 bg-light rounded">
                                    <div class="h6 mb-0" id="preview-family">{{ $aboutVillage->family_total ?? 0 }}</div>
                                    <small class="text-muted">Keluarga</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-2 bg-light rounded">
                                    <div class="h6 mb-0" id="preview-blok">{{ $aboutVillage->blok_total ?? 0 }}</div>
                                    <small class="text-muted">Dusun</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-2 bg-light rounded">
                                    <div class="h6 mb-0" id="preview-program">{{ $aboutVillage->program_total ?? 0 }}
                                    </div>
                                    <small class="text-muted">Program</small>
                                </div>
                            </div>
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
            // Initialize Summernote for description
            $('#description').summernote({
                height: 200,
                lang: 'id-ID',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('#visi').summernote({
                height: 200,
                lang: 'id-ID',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                ]
            });

            $('#misi').summernote({
                height: 200,
                lang: 'id-ID',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                ]
            });

            // Real-time preview updates
            $('#people_total').on('input', function() {
                $('#preview-people').text($(this).val() || '0');
            });

            $('#family_total').on('input', function() {
                $('#preview-family').text($(this).val() || '0');
            });

            $('#blok_total').on('input', function() {
                $('#preview-blok').text($(this).val() || '0');
            });

            $('#program_total').on('input', function() {
                $('#preview-program').text($(this).val() || '0');
            });

            // Phone number formatting
            $('#no_telp').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                if (value.length > 0) {
                    if (value.startsWith('0')) {
                        // Format: (021) 1234567
                        if (value.length <= 3) {
                            value = '(' + value + ')';
                        } else {
                            value = '(' + value.substr(0, 3) + ') ' + value.substr(3);
                        }
                    } else if (value.startsWith('62')) {
                        // Format: +62 21 1234567
                        value = '+' + value.substr(0, 2) + ' ' + value.substr(2, 2) + ' ' + value.substr(4);
                    }
                }
                $(this).val(value);
            });
        });

        // Form validation before submit
        document.getElementById('aboutVillageForm').addEventListener('submit', function(e) {
            // Optional: Add validation logic here
            showSubmitLoading();
        });

        // Show loading indicator during form submission
        function showSubmitLoading() {
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm me-2"></i>Menyimpan...';

            // Restore button after timeout (fallback)
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }, 10000);
        }

        // Auto-save functionality
        let autoSaveTimeout;
        let lastSaveTime = 0;

        function autoSave() {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(function() {
                const now = Date.now();
                // Prevent too frequent saves (min 2 seconds apart)
                if (now - lastSaveTime < 2000) return;

                try {
                    // Save draft to localStorage
                    const formData = {
                        people_total: document.getElementById('people_total').value,
                        family_total: document.getElementById('family_total').value,
                        blok_total: document.getElementById('blok_total').value,
                        program_total: document.getElementById('program_total').value,
                        description: $('#description').summernote('code'),
                        visi: $('#visi').summernote('code'),
                        misi: $('#misi').summernote('code'),
                        location: document.getElementById('location').value,
                        no_telp: document.getElementById('no_telp').value,
                        email: document.getElementById('email').value,
                        timestamp: new Date().toISOString()
                    };

                    localStorage.setItem('aboutvillage_draft', JSON.stringify(formData));
                    lastSaveTime = now;

                    // Show subtle save indicator
                    showSaveIndicator();
                } catch (error) {
                    console.error('Auto-save failed:', error);
                }
            }, 2000);
        }

        function showSaveIndicator() {
            // Remove existing indicator
            const existing = document.getElementById('save-indicator');
            if (existing) existing.remove();

            const saveIndicator = document.createElement('div');
            saveIndicator.id = 'save-indicator';
            saveIndicator.className = 'alert alert-success alert-dismissible fade show position-fixed';
            saveIndicator.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px; opacity: 0.9;';
            saveIndicator.innerHTML = `
        <i class="bx bx-check me-2"></i>
        Draft tersimpan otomatis
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      `;
            document.body.appendChild(saveIndicator);

            setTimeout(() => {
                if (saveIndicator.parentNode) {
                    saveIndicator.parentNode.removeChild(saveIndicator);
                }
            }, 3000);
        }

        // Add auto-save listeners for regular inputs
        document.querySelectorAll('input, textarea:not(#description):not(#visi):not(#misi)').forEach(element => {
            element.addEventListener('input', autoSave);
        });

        // Add auto-save listeners for Summernote editors
        $('#description').on('summernote.change', autoSave);
        $('#visi').on('summernote.change', autoSave);
        $('#misi').on('summernote.change', autoSave);

        // Load draft on page load (wait for Summernote to initialize)
        setTimeout(function() {
            const draft = localStorage.getItem('aboutvillage_draft');
            if (draft) {
                try {
                    const data = JSON.parse(draft);
                    const now = new Date();
                    const draftTime = new Date(data.timestamp);
                    const diffMinutes = (now - draftTime) / (1000 * 60);

                    // Only load if draft is less than 30 minutes old
                    if (diffMinutes < 30) {
                        const draftAge = Math.round(diffMinutes);
                        const confirmMessage =
                            `Ditemukan draft yang tersimpan ${draftAge} menit yang lalu. Apakah Anda ingin memuat draft tersebut?`;

                        if (confirm(confirmMessage)) {
                            // Load draft data
                            Object.keys(data).forEach(key => {
                                if (key !== 'timestamp') {
                                    const element = document.getElementById(key);
                                    if (element) {
                                        try {
                                            if (key === 'description' || key === 'visi' || key === 'misi') {
                                                $('#' + key).summernote('code', data[key] || '');
                                            } else {
                                                element.value = data[key] || '';
                                            }
                                        } catch (error) {
                                            console.error(`Error loading ${key}:`, error);
                                        }
                                    }
                                }
                            });

                            // Update previews
                            $('#preview-people').text(data.people_total || '0');
                            $('#preview-family').text(data.family_total || '0');
                            $('#preview-blok').text(data.blok_total || '0');
                            $('#preview-program').text(data.program_total || '0');

                            // Show success message
                            showDraftLoadedIndicator();
                        }
                    } else {
                        // Draft is too old, remove it
                        localStorage.removeItem('aboutvillage_draft');
                    }
                } catch (error) {
                    console.error('Error loading draft:', error);
                    localStorage.removeItem('aboutvillage_draft');
                }
            }
        }, 1000); // Wait 1 second for Summernote to fully initialize

        function showDraftLoadedIndicator() {
            const indicator = document.createElement('div');
            indicator.className = 'alert alert-success alert-dismissible fade show position-fixed';
            indicator.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            indicator.innerHTML = `
        <i class="bx bx-check-circle me-2"></i>
        Draft berhasil dimuat
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      `;
            document.body.appendChild(indicator);

            setTimeout(() => {
                if (indicator.parentNode) {
                    indicator.parentNode.removeChild(indicator);
                }
            }, 3000);
        }

        // Clear draft on successful form submission
        document.getElementById('aboutVillageForm').addEventListener('submit', function() {
            localStorage.removeItem('aboutvillage_draft');
        });

        // Clear draft manually
        function clearDraft() {
            if (confirm('Apakah Anda yakin ingin menghapus draft yang tersimpan?')) {
                localStorage.removeItem('aboutvillage_draft');
                showDraftClearedIndicator();
            }
        }

        function showDraftClearedIndicator() {
            const indicator = document.createElement('div');
            indicator.className = 'alert alert-info alert-dismissible fade show position-fixed';
            indicator.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            indicator.innerHTML = `
        <i class="bx bx-info-circle me-2"></i>
        Draft berhasil dihapus
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      `;
            document.body.appendChild(indicator);

            setTimeout(() => {
                if (indicator.parentNode) {
                    indicator.parentNode.removeChild(indicator);
                }
            }, 3000);
        }
    </script>
@endpush
