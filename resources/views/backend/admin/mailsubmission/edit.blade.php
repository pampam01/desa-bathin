@extends('backend.admin.layouts.app')

@section('title', 'Edit Pengajuan Surat')

@push('styles')
    {{-- Summernote CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Pengajuan Surat /</span> Edit Pengajuan
        </h4>
    </div>
@endsection

@section('content')
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
            <div class="alert alert-info" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bx bx-info-circle me-2"></i>
                    <div>
                        <strong>Jenis Surat:</strong> {{ $mailSubmission->jenis_surat }}<br>
                        <small class="text-muted">Pemohon: {{ $mailSubmission->name }} (NIK:
                            {{ $mailSubmission->nik }})</small>
                    </div>
                </div>
            </div>

            <form action="{{ route('mail-submissions.update', $mailSubmission->id) }}" method="POST"
                enctype="multipart/form-data" id="editSubmissionForm">
                @csrf
                @method('PUT')

                {{-- Baris 1: NIK & No. KK --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                            name="nik" value="{{ old('nik', $mailSubmission->nik) }}" required pattern="\d{16}"
                            title="NIK harus terdiri dari 16 digit angka">
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="no_kk" class="form-label">No. KK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('no_kk') is-invalid @enderror" id="no_kk"
                            name="no_kk" value="{{ old('no_kk', $mailSubmission->no_kk) }}" required pattern="\d{16}"
                            title="No. KK harus terdiri dari 16 digit angka">
                        @error('no_kk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Baris 2: Nama & No. HP --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $mailSubmission->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                            name="no_hp" value="{{ old('no_hp', $mailSubmission->no_hp) }}" pattern="\d{10,15}"
                            title="No. HP harus terdiri dari 10-15 digit angka">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Baris 3: Jenis Surat --}}
                <div class="mb-3">
                    <label for="jenis_surat" class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                    <select class="form-select @error('jenis_surat') is-invalid @enderror" id="jenis_surat"
                        name="jenis_surat" required>
                        <option value="">Pilih Jenis Surat</option>
                        @php
                            $jenisSuratOptions = [
                                'surat pelayanan haji',
                                'surat rujuk',
                                'surat rekomendasi nikah',
                                'surat pengaduan gugat cerai',
                                'surat rekomendasi tanah wakaf',
                            ];
                        @endphp
                        @foreach ($jenisSuratOptions as $option)
                            <option value="{{ $option }}"
                                {{ old('jenis_surat', $mailSubmission->jenis_surat) == $option ? 'selected' : '' }}>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Baris 4: Keterangan Tambahan --}}
                <div class="mb-3">
                    <label for="summernote" class="form-label">Keterangan Tambahan <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="summernote" name="description" required>{{ old('description', $mailSubmission->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Baris 5: Status & File --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                            required>
                            <option value="">Pilih Status</option>
                            @php
                                $statusOptions = [
                                    'pending' => 'Pending',
                                    'process' => 'Diproses',
                                    'completed' => 'Selesai',
                                    'rejected' => 'Ditolak',
                                ];
                            @endphp
                            @foreach ($statusOptions as $key => $value)
                                <option value="{{ $key }}"
                                    {{ old('status', $mailSubmission->status) == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="file" class="form-label">File Pendukung</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file"
                            name="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if ($mailSubmission->file)
                            <small class="form-text text-muted">
                                File saat ini: <a href="{{ asset('storage/' . $mailSubmission->file) }}"
                                    target="_blank">{{ basename($mailSubmission->file) }}</a>
                            </small>
                        @endif
                    </div>
                </div>

                {{-- Tombol Aksi --}}
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

@push('scripts')
    {{-- PERBAIKAN 1: Tambahkan jQuery SEBELUM Summernote JS --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            // PERBAIKAN 2: Inisialisasi Summernote dengan benar
            $('#summernote').summernote({
                placeholder: 'Masukkan keterangan tambahan jika diperlukan...',
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });

            // Script untuk loading state pada tombol submit (lebih aman)
            document.getElementById('editSubmissionForm').addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (this.checkValidity()) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i>Menyimpan...';
                }
            });
        });
    </script>
@endpush
