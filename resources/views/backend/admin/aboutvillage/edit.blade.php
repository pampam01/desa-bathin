@extends('backend.admin.layouts.app')

@section('title', 'Edit Informasi KUA')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen KUA /</span> Edit Informasi KUA
        </h4>
        <a href="{{ route('aboutvillage.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('aboutvillage.index') }}">Tentang KUA</a></li>
    <li class="breadcrumb-item active">Edit Informasi KUA</li>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        .counter-input {
            border: 2px solid #e3e6f0;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
        }
        .draft-actions {
            border-top: 1px solid #e3e6f0;
            padding-top: 1rem;
            margin-top: 1rem;
        }
    </style>
@endpush

@section('content')
    <form action="{{ route('aboutvillage.update', $aboutVillage->id) }}" method="POST" id="aboutVillageForm">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-bar-chart me-2"></i>Statistik KUA</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="people_total" class="form-label">Total Pasangan Menikah</label>
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
                                <label for="family_total" class="form-label">Total Pernikahan Tercatat</label>
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
                                <label for="blok_total" class="form-label">Total Layanan KUA</label>
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

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-building-house me-2"></i>Profil KUA</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="description" class="form-label">Profil/Sejarah KUA</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $aboutVillage->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Tuliskan profil, sejarah, dan informasi umum tentang KUA</div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-target-lock me-2"></i>Visi & Misi KUA</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="visi" class="form-label">Visi KUA</label>
                                    <textarea class="form-control @error('visi') is-invalid @enderror" id="visi" name="visi" rows="6"
                                        placeholder="Tuliskan visi KUA...">{{ old('visi', $aboutVillage->visi) }}</textarea>
                                    @error('visi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="misi" class="form-label">Misi KUA</label>
                                    <textarea class="form-control @error('misi') is-invalid @enderror" id="misi" name="misi" rows="6"
                                        placeholder="Tuliskan misi KUA...">{{ old('misi', $aboutVillage->misi) }}</textarea>
                                    @error('misi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-phone me-2"></i>Informasi Kontak</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="location" class="form-label">Alamat Lengkap Kantor</label>
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
                            <label for="email" class="form-label">Email KUA</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $aboutVillage->email) }}"
                                placeholder="kua@example.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

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
                            <small class="text-muted d-block mt-1 text-center">Draft disimpan otomatis setiap 2 detik</small>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bx bx-show me-2"></i>Preview Statistik</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="text-center p-2 bg-light rounded">
                                    <div class="h6 mb-0" id="preview-people">{{ $aboutVillage->people_total ?? 0 }}</div>
                                    <small class="text-muted">Pasangan</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-2 bg-light rounded">
                                    <div class="h6 mb-0" id="preview-family">{{ $aboutVillage->family_total ?? 0 }}</div>
                                    <small class="text-muted">Pernikahan</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-2 bg-light rounded">
                                    <div class="h6 mb-0" id="preview-blok">{{ $aboutVillage->blok_total ?? 0 }}</div>
                                    <small class="text-muted">Layanan</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-2 bg-light rounded">
                                    <div class="h6 mb-0" id="preview-program">{{ $aboutVillage->program_total ?? 0 }}</div>
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-id-ID.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Summernote editors
            const summernoteConfig = {
                height: 200,
                lang: 'id-ID',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            };
            $('#description').summernote(summernoteConfig);
            $('#visi').summernote(summernoteConfig);
            $('#misi').summernote(summernoteConfig);

            // Real-time preview updates
            $('#people_total').on('input', function() { $('#preview-people').text($(this).val() || '0'); });
            $('#family_total').on('input', function() { $('#preview-family').text($(this).val() || '0'); });
            $('#blok_total').on('input', function() { $('#preview-blok').text($(this).val() || '0'); });
            $('#program_total').on('input', function() { $('#preview-program').text($(this).val() || '0'); });

        });

        // Show loading indicator during form submission
        document.getElementById('aboutVillageForm').addEventListener('submit', function(e) {
            showSubmitLoading();
        });

        function showSubmitLoading() {
            const submitBtn = document.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm me-2"></i>Menyimpan...';
        }

        // Auto-save functionality
        let autoSaveTimeout;
        const DRAFT_KEY = 'aboutkua_draft'; // Changed key for KUA

        function autoSave() {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(function() {
                try {
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
                    localStorage.setItem(DRAFT_KEY, JSON.stringify(formData));
                    showSaveIndicator();
                } catch (error) {
                    console.error('Auto-save failed:', error);
                }
            }, 2000);
        }
        
        // Add listeners for all inputs
        document.querySelectorAll('input, textarea:not(#description):not(#visi):not(#misi)').forEach(el => el.addEventListener('input', autoSave));
        $('#description, #visi, #misi').on('summernote.change', autoSave);

        // Load draft on page load
        setTimeout(function() {
            const draft = localStorage.getItem(DRAFT_KEY);
            if (draft) {
                try {
                    const data = JSON.parse(draft);
                    const draftTime = new Date(data.timestamp);
                    const diffMinutes = (new Date() - draftTime) / 60000;

                    if (diffMinutes < 30) { // Only load if draft is less than 30 minutes old
                        const draftAge = Math.round(diffMinutes);
                        if (confirm(`Ditemukan draft yang tersimpan ${draftAge} menit yang lalu. Muat draft?`)) {
                            Object.keys(data).forEach(key => {
                                if (key === 'description' || key === 'visi' || key === 'misi') {
                                    $('#' + key).summernote('code', data[key] || '');
                                } else if (document.getElementById(key)) {
                                    document.getElementById(key).value = data[key] || '';
                                }
                            });
                            // Update previews
                            $('#preview-people').text(data.people_total || '0');
                            $('#preview-family').text(data.family_total || '0');
                            $('#preview-blok').text(data.blok_total || '0');
                            $('#preview-program').text(data.program_total || '0');
                            showDraftLoadedIndicator();
                        }
                    } else {
                        localStorage.removeItem(DRAFT_KEY); // Draft is too old
                    }
                } catch (error) {
                    console.error('Error loading draft:', error);
                    localStorage.removeItem(DRAFT_KEY);
                }
            }
        }, 1000);

        // Clear draft on successful form submission or manual clear
        document.getElementById('aboutVillageForm').addEventListener('submit', () => localStorage.removeItem(DRAFT_KEY));
        
        window.clearDraft = function() { // Expose function to global scope for onclick
            if (confirm('Apakah Anda yakin ingin menghapus draft yang tersimpan?')) {
                localStorage.removeItem(DRAFT_KEY);
                showDraftClearedIndicator();
            }
        }

        // --- Notification Functions ---
        function createIndicator(message, type, icon) {
            const indicator = document.createElement('div');
            indicator.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            indicator.style.cssText = 'top: 20px; right: 20px; z-index: 9999;';
            indicator.innerHTML = `<i class="bx ${icon} me-2"></i> ${message} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
            document.body.appendChild(indicator);
            setTimeout(() => indicator.remove(), 3000);
        }
        function showSaveIndicator() { createIndicator('Draft tersimpan otomatis', 'success', 'bx-check-circle'); }
        function showDraftLoadedIndicator() { createIndicator('Draft berhasil dimuat', 'success', 'bx-check-circle'); }
        function showDraftClearedIndicator() { createIndicator('Draft berhasil dihapus', 'info', 'bx-info-circle'); }

    </script>
@endpush