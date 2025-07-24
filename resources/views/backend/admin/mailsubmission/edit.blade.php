@extends('backend.admin.layouts.app')

@section('title', 'Edit Pengajuan Surat | Portal Parakan')

@section('styles')
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Portal Parakan / Pengajuan Surat /</span> Edit Pengajuan
        </h4>
    </div>
@endsection

@section('content')
    <!-- Content -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bx bx-edit me-2"></i>Edit Pengajuan Surat #{{ $mailSubmission->id }}
                </h5>
                <a href="{{ route('mail-submissions.index') }}" class="btn btn-outline-secondary">
                    <i class="bx bx-arrow-back me-2"></i>Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Submission Info -->
            <div class="alert alert-info" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bx bx-info-circle me-2"></i>
                    <div>
                        <strong>Jenis Surat:</strong> {{ $mailSubmission->jenis_surat }}<br>
                        <small class="text-muted">Pemohon: {{ $mailSubmission->name }} (NIK: {{ $mailSubmission->nik }})</small>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <form action="{{ route('mail-submissions.update', $mailSubmission->id) }}" method="POST" enctype="multipart/form-data" id="editSubmissionForm">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                name="nik" value="{{ old('nik', $mailSubmission->nik) }}" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_kk" class="form-label">No. KK <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('no_kk') is-invalid @enderror" id="no_kk"
                                name="no_kk" value="{{ old('no_kk', $mailSubmission->no_kk) }}" required>
                            @error('no_kk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $mailSubmission->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                name="no_hp" value="{{ old('no_hp', $mailSubmission->no_hp) }}">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="jenis_surat" class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                    <select class="form-select @error('jenis_surat') is-invalid @enderror" id="jenis_surat"
                        name="jenis_surat" required>
                        <option value="">Pilih Jenis Surat</option>
                        <option value="Surat Keterangan Domisili" {{ old('jenis_surat', $mailSubmission->jenis_surat) == 'Surat Keterangan Domisili' ? 'selected' : '' }}>
                            Surat Keterangan Domisili</option>
                        <option value="Surat Keterangan Usaha" {{ old('jenis_surat', $mailSubmission->jenis_surat) == 'Surat Keterangan Usaha' ? 'selected' : '' }}>
                            Surat Keterangan Usaha</option>
                        <option value="Surat Keterangan Tidak Mampu" {{ old('jenis_surat', $mailSubmission->jenis_surat) == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>
                            Surat Keterangan Tidak Mampu</option>
                        <option value="Surat Keterangan Kematian" {{ old('jenis_surat', $mailSubmission->jenis_surat) == 'Surat Keterangan Kematian' ? 'selected' : '' }}>
                            Surat Keterangan Kematian</option>
                        <option value="Surat Keterangan Lahir" {{ old('jenis_surat', $mailSubmission->jenis_surat) == 'Surat Keterangan Lahir' ? 'selected' : '' }}>
                            Surat Keterangan Lahir</option>
                        <option value="Surat Keterangan Pindah" {{ old('jenis_surat', $mailSubmission->jenis_surat) == 'Surat Keterangan Pindah' ? 'selected' : '' }}>
                            Surat Keterangan Pindah</option>
                        <option value="Surat Keterangan Belum Menikah" {{ old('jenis_surat', $mailSubmission->jenis_surat) == 'Surat Keterangan Belum Menikah' ? 'selected' : '' }}>
                            Surat Keterangan Belum Menikah</option>
                        <option value="Surat Keterangan Cerai" {{ old('jenis_surat', $mailSubmission->jenis_surat) == 'Surat Keterangan Cerai' ? 'selected' : '' }}>
                            Surat Keterangan Cerai</option>
                    </select>
                    @error('jenis_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Keterangan Tambahan</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        placeholder="Masukkan keterangan tambahan jika diperlukan...">{!! old('description', $mailSubmission->description) !!}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                                required>
                                <option value="">Pilih Status</option>
                                <option value="pending" {{ old('status', $mailSubmission->status) == 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="process" {{ old('status', $mailSubmission->status) == 'process' ? 'selected' : '' }}>
                                    Diproses</option>
                                <option value="completed" {{ old('status', $mailSubmission->status) == 'completed' ? 'selected' : '' }}>
                                    Selesai</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="file" class="form-label">File Pendukung</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file"
                                name="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($mailSubmission->file)
                                <small class="form-text text-muted">
                                    File saat ini: <a href="{{ asset('storage/' . $mailSubmission->file) }}" target="_blank">{{ basename($mailSubmission->file) }}</a>
                                </small>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save me-2"></i>Simpan Perubahan
                    </button>
                    <a href="{{ route('mail-submissions.index') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-x me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    
    <script>
        // Initialize Summernote
        $(document).ready(function() {
            $('#description').summernote({
                height: 200,
                minHeight: null,
                maxHeight: null,
                focus: false,
                placeholder: 'Masukkan keterangan tambahan jika diperlukan...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        // Handle image upload if needed
                        console.log('Image upload not implemented');
                    }
                }
            });
        });

        // Form validation
        document.getElementById('editSubmissionForm').addEventListener('submit', function(e) {
            const nik = document.getElementById('nik').value.trim();
            const noKk = document.getElementById('no_kk').value.trim();
            const name = document.getElementById('name').value.trim();
            const jenisSurat = document.getElementById('jenis_surat').value;
            const status = document.getElementById('status').value;

            // Update description from Summernote
            $('#description').summernote('triggerEvent', 'summernote.change');

            if (!nik) {
                e.preventDefault();
                alert('NIK tidak boleh kosong');
                return;
            }

            if (!noKk) {
                e.preventDefault();
                alert('No. KK tidak boleh kosong');
                return;
            }

            if (!name) {
                e.preventDefault();
                alert('Nama lengkap tidak boleh kosong');
                return;
            }

            if (!jenisSurat) {
                e.preventDefault();
                alert('Jenis surat harus dipilih');
                return;
            }

            if (!status) {
                e.preventDefault();
                alert('Status harus dipilih');
                return;
            }

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i>Menyimpan...';
        });

        // NIK and No KK validation
        document.getElementById('nik').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            if (this.value.length > 16) {
                this.value = this.value.slice(0, 16);
            }
        });

        document.getElementById('no_kk').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            if (this.value.length > 16) {
                this.value = this.value.slice(0, 16);
            }
        });

        // Phone number validation
        document.getElementById('no_hp').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            if (this.value.length > 15) {
                this.value = this.value.slice(0, 15);
            }
        });
    </script>
@endsection
