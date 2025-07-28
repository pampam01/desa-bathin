@extends('backend.admin.layouts.app')

@section('title', 'Edit Tanggapan Pengaduan')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Pengaduan /</span> Edit Tanggapan
        </h4>
    </div>
@endsection

@section('content')
    <!-- Content -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bx bx-edit me-2"></i>Edit Tanggapan #{{ $response->id }}
                </h5>
                <a href="{{ route('complaint-response.show', $response->id) }}" class="btn btn-outline-secondary">
                    <i class="bx bx-arrow-back me-2"></i>Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Complaint Info -->
            <div class="alert alert-info" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bx bx-info-circle me-2"></i>
                    <div>
                        <strong>Pengaduan:</strong> {{ $response->complaint->title ?? 'N/A' }}<br>
                        <small class="text-muted">ID: #{{ $response->complaint->id ?? 'N/A' }}</small>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <form action="{{ route('complaint-response.update', $response->id) }}" method="POST" id="editResponseForm">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="complaint_id" class="form-label">Pengaduan <span
                                    class="text-danger">*</span></label>
                            <select class="form-select @error('complaint_id') is-invalid @enderror" id="complaint_id"
                                name="complaint_id" required>
                                <option value="">Pilih Pengaduan</option>
                                @foreach ($complaints as $complaint)
                                    <option value="{{ $complaint->id }}"
                                        {{ old('complaint_id', $response->complaint_id) == $complaint->id ? 'selected' : '' }}>
                                        #{{ $complaint->id }} - {{ $complaint->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('complaint_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Penanggap</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" id="user_id"
                                name="user_id">
                                <option value="">Pilih Penanggap (Opsional)</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id', $response->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Kosongkan jika ingin menggunakan user saat ini</small>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="response" class="form-label">Tanggapan <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('response') is-invalid @enderror" id="response" name="response" rows="6"
                        placeholder="Tulis tanggapan Anda terhadap pengaduan ini..." required>{{ old('response', $response->response) }}</textarea>
                    @error('response')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                        required>
                        <option value="">Pilih Status</option>
                        <option value="pending" {{ old('status', $response->status) == 'pending' ? 'selected' : '' }}>
                            Pending</option>
                        <option value="process" {{ old('status', $response->status) == 'process' ? 'selected' : '' }}>
                            Diproses</option>
                        <option value="resolved" {{ old('status', $response->status) == 'resolved' ? 'selected' : '' }}>
                            Selesai</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save me-2"></i>Simpan Perubahan
                    </button>
                    <a href="{{ route('complaint-response.show', $response->id) }}" class="btn btn-outline-secondary">
                        <i class="bx bx-x me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Form validation
        document.getElementById('editResponseForm').addEventListener('submit', function(e) {
            const response = document.getElementById('response').value.trim();
            const status = document.getElementById('status').value;
            const complaintId = document.getElementById('complaint_id').value;

            if (!response) {
                e.preventDefault();
                alert('Tanggapan tidak boleh kosong');
                return;
            }

            if (!status) {
                e.preventDefault();
                alert('Status harus dipilih');
                return;
            }

            if (!complaintId) {
                e.preventDefault();
                alert('Pengaduan harus dipilih');
                return;
            }

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i>Menyimpan...';
        });

        // Auto-resize textarea
        document.getElementById('response').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    </script>
@endsection
