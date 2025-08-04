@extends('backend.admin.layouts.app')

@section('title', 'Tambah Tanggapan Pengaduan')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Pengaduan /</span> Tambah Tanggapan
        </h4>
        <a href="{{ route('complaint-response.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <!-- Form Section -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bx bx-plus me-2"></i>Tambah Tanggapan Baru
                    </h5>
                </div>
                <div class="card-body">
                    @if (isset($selectedComplaint))
                        <!-- Selected Complaint Info -->
                        <div class="alert alert-info" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="bx bx-info-circle me-2"></i>
                                <div>
                                    <strong>Pengaduan Terpilih:</strong> {{ $selectedComplaint->title }}<br>
                                    <small class="text-muted">ID: #{{ $selectedComplaint->id }} | Dibuat:
                                        {{ $selectedComplaint->created_at->format('d M Y') }}</small>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Create Form -->
                    <form action="{{ route('complaint-response.store') }}" method="POST" id="createResponseForm">
                        @csrf

                        <div class="mb-3">
                            <label for="complaint_id" class="form-label">Pengaduan <span
                                    class="text-danger">*</span></label>
                            <select class="form-select @error('complaint_id') is-invalid @enderror" id="complaint_id"
                                name="complaint_id" required>
                                <option value="">Pilih Pengaduan</option>
                                @foreach ($complaints as $complaint)
                                    <option value="{{ $complaint->id }}"
                                        {{ old('complaint_id') == $complaint->id || (isset($selectedComplaintId) && $selectedComplaintId == $complaint->id) ? 'selected' : '' }}>
                                        #{{ $complaint->id }} - {{ $complaint->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('complaint_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="response" class="form-label">Tanggapan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('response') is-invalid @enderror" id="response" name="response" rows="6"
                                placeholder="Tulis tanggapan Anda terhadap pengaduan ini..." required>{{ old('response') }}</textarea>
                            @error('response')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if (Auth::user()->role == 'admin')
                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="process" {{ old('status') == 'process' ? 'selected' : '' }}>Diproses
                                    </option>
                                    <option value="resolved" {{ old('status') == 'resolved' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @else
                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror"
                                    id="status" name="status" value="{{ old('status', 'pending') }}" readonly>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Penanggap</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            <small class="form-text text-muted">Tanggapan akan dibuat atas nama Anda</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-send me-2"></i>Simpan Tanggapan
                            </button>
                            <a href="{{ route('complaint-response.index') }}" class="btn btn-outline-danger">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Complaint Details Section -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bx bx-info-circle me-2"></i>Detail Pengaduan
                    </h5>
                </div>
                <div class="card-body">
                    <div id="complaintDetails" class="d-none">
                    </div>
                    <div id="noComplaintSelected" class="text-center text-muted">
                        <i class="bx bx-info-circle bx-lg mb-3"></i>
                        <p>Pilih pengaduan untuk melihat detail</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Handle complaint selection
        document.getElementById('complaint_id').addEventListener('change', function() {
            const complaintId = this.value;
            const complaintDetails = document.getElementById('complaintDetails');
            const noComplaintSelected = document.getElementById('noComplaintSelected');

            if (complaintId) {
                // Show loading state
                complaintDetails.innerHTML = `
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Memuat detail pengaduan...</p>
                    </div>
                `;
                complaintDetails.classList.remove('d-none');
                noComplaintSelected.classList.add('d-none');

                // Fetch complaint details via AJAX
                fetch(`/complaint-response/complaint/${complaintId}`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        console.log('Response headers:', response.headers);

                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        return response.text().then(text => {
                            console.log('Response text:', text);
                            try {
                                return JSON.parse(text);
                            } catch (e) {
                                console.error('JSON parse error:', e);
                                console.error('Response text:', text);
                                throw new Error('Invalid JSON response: ' + text.substring(0, 100) +
                                    '...');
                            }
                        });
                    })
                    .then(complaint => {
                        if (complaint.error) {
                            throw new Error(complaint.error);
                        }

                        // Show complaint details
                        complaintDetails.innerHTML = `
                            <div class="complaint-info">
                                <h6 class="mb-3">
                                    <span class="badge bg-primary me-2">#${complaint.id}</span>
                                    ${complaint.title}
                                </h6>
                                
                                <div class="mb-3">
                                    <strong>Status:</strong>
                                    <span class="badge ${getStatusClass(complaint.status)} ms-2">
                                        ${getStatusText(complaint.status)}
                                    </span>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Kategori:</strong>
                                    <span class="ms-2">${complaint.category || 'Tidak ada kategori'}</span>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Pengadu:</strong>
                                    <span class="ms-2">${complaint.user ? complaint.user.name : 'Tidak diketahui'}</span>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Tanggal:</strong>
                                    <span class="ms-2">${formatDate(complaint.created_at)}</span>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Deskripsi:</strong>
                                    <div class="mt-2 p-3 bg-light rounded">
                                        ${complaint.description}
                                    </div>
                                </div>
                                
                                ${complaint.image ? `
                                                        <div class="mb-3">
                                                            <strong>Gambar:</strong>
                                                            <div class="mt-2">
                                                                <img src="${complaint.image}" 
                                                                     alt="Bukti pengaduan" 
                                                                     class="img-fluid rounded shadow-sm" 
                                                                     style="max-height: 300px; cursor: pointer;"
                                                                     onclick="openImageModal(this.src)">
                                                            </div>
                                                        </div>
                                                    ` : ''}
                            </div>
                        `;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        console.error('Complaint ID:', complaintId);
                        console.error('Fetch URL:', `/complaint-response/complaint/${complaintId}`);

                        complaintDetails.innerHTML = `
                            <div class="alert alert-danger">
                                <i class="bx bx-error me-2"></i>
                                <strong>Gagal memuat detail pengaduan:</strong><br>
                                ${error.message}
                                <br><small class="text-muted">Periksa console untuk detail lebih lanjut</small>
                            </div>
                        `;
                    });
            } else {
                hideComplaintDetails();
            }
        });

        // Helper function to hide complaint details
        function hideComplaintDetails() {
            document.getElementById('complaintDetails').classList.add('d-none');
            document.getElementById('noComplaintSelected').classList.remove('d-none');
        }

        // Helper function to get status class
        function getStatusClass(status) {
            const statusClasses = {
                'draft': 'bg-secondary',
                'in_progress': 'bg-warning',
                'resolved': 'bg-success',
                'rejected': 'bg-danger'
            };
            return statusClasses[status] || 'bg-secondary';
        }

        // Helper function to get status text
        function getStatusText(status) {
            const statusTexts = {
                'draft': 'Draft',
                'in_progress': 'Sedang Diproses',
                'resolved': 'Selesai',
                'rejected': 'Ditolak'
            };
            return statusTexts[status] || 'Tidak diketahui';
        }

        // Helper function to format date
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Function to open image modal
        function openImageModal(imageSrc) {
            // Create modal if it doesn't exist
            if (!document.getElementById('imageModal')) {
                const modal = document.createElement('div');
                modal.className = 'modal fade';
                modal.id = 'imageModal';
                modal.tabIndex = -1;
                modal.innerHTML = `
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Bukti Pengaduan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img id="modalImage" src="" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
            }

            // Set image source and show modal
            document.getElementById('modalImage').src = imageSrc;
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        }

        // Form validation
        document.getElementById('createResponseForm').addEventListener('submit', function(e) {
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

        // Initialize if there's a selected complaint
        @if (isset($selectedComplaintId))
            // Trigger change event to load complaint details
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('complaint_id').dispatchEvent(new Event('change'));
            });
        @endif
    </script>
@endsection
