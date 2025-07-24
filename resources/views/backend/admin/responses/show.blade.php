@extends('backend.admin.layouts.app')

@section('title', 'Detail Tanggapan Pengaduan - Portal Parakan')

@section('page-header')
  <div class="d-flex justify-content-between align-items-center">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Portal Parakan / Pengaduan / Tanggapan /</span> Detail Tanggapan
    </h4>
    <div class="d-flex gap-2">
      <a href="{{ route('complaint-response.edit', $response->id) }}" class="btn btn-warning">
        <i class="bx bx-edit me-1"></i> Edit
      </a>
      <a href="{{ route('complaint-response.index') }}" class="btn btn-outline-secondary">
        <i class="bx bx-arrow-back me-1"></i> Kembali
      </a>
    </div>
  </div>
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{ route('complaints.index') }}">Pengaduan</a></li>
  <li class="breadcrumb-item"><a href="{{ route('complaint-response.index') }}">Tanggapan</a></li>
  <li class="breadcrumb-item active">Detail Tanggapan</li>
@endsection

@push('styles')
  <style>
    .response-card {
      border-left: 4px solid #696cff;
      background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
    }
    .status-badge {
      font-size: 0.875rem;
      padding: 0.5rem 1rem;
      border-radius: 20px;
    }
    .complaint-info {
      background: #f8f9fa;
      border-radius: 10px;
      border: 1px solid #e9ecef;
    }
    .response-content {
      line-height: 1.8;
      font-size: 1.1rem;
      background: white;
      border-radius: 8px;
      padding: 1.5rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .timeline-item {
      border-left: 2px solid #e9ecef;
      padding-left: 1.5rem;
      margin-left: 1rem;
      padding-bottom: 1.5rem;
    }
    .timeline-item-last {
      border-left: none;
      padding-bottom: 0;
    }
    .timeline-marker {
      width: 12px;
      height: 12px;
      background: #696cff;
      border-radius: 50%;
      margin-left: -1.75rem;
      margin-top: 0.25rem;
      border: 2px solid white;
      box-shadow: 0 0 0 2px #e9ecef;
    }
    .timeline-content {
      background: white;
      border-radius: 8px;
      padding: 1rem;
      border: 1px solid #e9ecef;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .response-text {
      background: #f8f9fa;
      border-radius: 6px;
      padding: 0.75rem;
      border-left: 3px solid #dee2e6;
    }
    .btn-sm {
      padding: 0.25rem 0.5rem;
    }
    .btn-sm i {
      font-size: 0.875rem;
    }
    .avatar-xs {
      width: 1.5rem;
      height: 1.5rem;
      font-size: 0.75rem;
    }
    #responseForm {
      background: #f8f9ff;
      border-radius: 8px;
      padding: 1rem;
      border: 1px solid #e9ecef;
    }

    /* Timeline Styles */
    .timeline-wrapper {
      position: relative;
      max-height: 500px;
      overflow-y: auto;
      padding: 1rem 0;
    }

    .response-timeline-item {
      position: relative;
      padding-left: 3rem;
      margin-bottom: 2rem;
      border-left: 2px solid #e9ecef;
    }

    .response-timeline-item:last-child {
      margin-bottom: 0;
    }

    .response-timeline-item.current-response {
      background: rgba(105, 108, 255, 0.05);
      border-radius: 0.375rem;
      padding: 1rem;
      margin-left: -1rem;
      margin-right: -1rem;
      border-left: 3px solid #696cff;
    }

    .response-timeline-marker {
      position: absolute;
      left: -0.75rem;
      top: 0.5rem;
      width: 1.5rem;
      height: 1.5rem;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 0.75rem;
      font-weight: 600;
      border: 3px solid #fff;
      box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }

    .response-timeline-content {
      background: #fff;
      border-radius: 0.375rem;
      padding: 1rem;
      border: 1px solid #e9ecef;
      transition: all 0.3s ease;
    }

    .response-timeline-content:hover {
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
      border-color: #d0d5dd;
    }

    .response-author {
      border-bottom: 1px solid #f5f5f5;
      padding-bottom: 0.5rem;
    }

    .response-text {
      padding-top: 0.5rem;
      line-height: 1.5;
    }

    .current-response .response-timeline-content {
      border-color: #696cff;
      background: rgba(105, 108, 255, 0.02);
    }

    /* Form Styles */
    #addResponseForm {
      background: #f8f9fa;
      padding: 1.5rem;
      border-radius: 0.375rem;
      border: 1px solid #e9ecef;
    }

    #addResponseForm .form-control:focus,
    #addResponseForm .form-select:focus {
      border-color: #696cff;
      box-shadow: 0 0 0 0.2rem rgba(105, 108, 255, 0.25);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .response-timeline-item {
        padding-left: 2rem;
      }
      
      .response-timeline-marker {
        left: -0.5rem;
        width: 1rem;
        height: 1rem;
        font-size: 0.6rem;
      }
      
      .response-timeline-content {
        padding: 0.75rem;
      }
      
      .timeline-wrapper {
        max-height: 400px;
      }
    }
  </style>
@endpush

@section('content')
  <div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
      <!-- Response Header -->
      <div class="card response-card mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
              <h5 class="mb-2">
                <i class="bx bx-message-square-detail me-2"></i>
                Tanggapan Pengaduan #{{ $response->complaint_id }}
              </h5>
              <div class="d-flex gap-2">
                @if($response->status == 'pending')
                  <span class="badge bg-warning status-badge">
                    <i class="bx bx-time me-1"></i>Menunggu
                  </span>
                @elseif($response->status == 'process')
                  <span class="badge bg-info status-badge">
                    <i class="bx bx-loader-circle me-1"></i>Diproses
                  </span>
                @elseif($response->status == 'resolved')
                  <span class="badge bg-success status-badge">
                    <i class="bx bx-check-circle me-1"></i>Selesai
                  </span>
                @endif
              </div>
            </div>
            <div class="text-end">
              <small class="text-muted">{{ $response->created_at->format('d M Y, H:i') }}</small>
            </div>
          </div>

          <!-- Responder Info -->
          <div class="d-flex align-items-center mb-3">
            <div class="avatar avatar-sm me-3">
              <span class="avatar-initial rounded-circle bg-label-primary">
                {{ substr($response->user->name ?? 'A', 0, 1) }}
              </span>
            </div>
            <div>
              <h6 class="mb-0">{{ $response->user->name ?? 'Administrator' }}</h6>
              <small class="text-muted">Penanggap</small>
            </div>
          </div>

          <!-- Response Content -->
          <div class="response-content">
            <h6 class="mb-3">Tanggapan:</h6>
            <p class="mb-0">{{ $response->response }}</p>
          </div>
        </div>
      </div>

      <!-- Original Complaint Info -->
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">
            <i class="bx bx-file-blank me-2"></i>Pengaduan Asli
          </h5>
        </div>
        <div class="card-body">
          <div class="complaint-info p-3">
            <div class="row mb-3">
              <div class="col-md-3">
                <strong>Judul Pengaduan:</strong>
              </div>
              <div class="col-md-9">
                {{ $response->complaint->title ?? 'Tidak tersedia' }}
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-3">
                <strong>Kategori:</strong>
              </div>
              <div class="col-md-9">
                <span class="badge bg-label-info">{{ $response->complaint->category ?? 'Umum' }}</span>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-3">
                <strong>Pelapor:</strong>
              </div>
              <div class="col-md-9">
                {{ $response->complaint->user->name ?? 'Anonim' }}
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-3">
                <strong>Tanggal Pengaduan:</strong>
              </div>
              <div class="col-md-9">
                {{ $response->complaint->created_at->format('d M Y, H:i') }}
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <strong>Deskripsi:</strong>
              </div>
              <div class="col-md-9">
                <p class="mb-0">{!! Str::limit($response->complaint->description ?? 'Tidak ada deskripsi', 200) !!}</p>
              </div>
            </div>
          </div>
          
          <div class="mt-3">
            <a href="{{ route('complaints.show', $response->complaint_id) }}" class="btn btn-outline-primary">
              <i class="bx bx-show me-1"></i> Lihat Pengaduan Lengkap
            </a>
          </div>
        </div>
      </div>

      <!-- Add New Response Form -->
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">
            <i class="bx bx-plus me-2"></i>Tambah Tanggapan Baru
          </h5>
        </div>
        <div class="card-body">
          <form action="{{ route('complaint-response.store') }}" method="POST" id="addResponseForm">
            @csrf
            <input type="hidden" name="complaint_id" value="{{ $response->complaint_id }}">
            
            <div class="mb-3">
              <label for="response" class="form-label">Tanggapan <span class="text-danger">*</span></label>
              <textarea 
                class="form-control @error('response') is-invalid @enderror" 
                id="response" 
                name="response" 
                rows="5" 
                placeholder="Tulis tanggapan Anda terhadap pengaduan ini..."
                required>{{ old('response') }}</textarea>
              @error('response')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                  <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="">Pilih Status</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="process" {{ old('status') == 'process' ? 'selected' : '' }}>Diproses</option>
                    <option value="resolved" {{ old('status') == 'resolved' ? 'selected' : '' }}>Selesai</option>
                  </select>
                  @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="user_id" class="form-label">Penanggap</label>
                  <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                    <option value="">Pilih Penanggap (Opsional)</option>
                    <!-- Assuming you have users available -->
                    @if(isset($users))
                      @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                          {{ $user->name }}
                        </option>
                      @endforeach
                    @endif
                  </select>
                  @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  <small class="form-text text-muted">Kosongkan jika ingin menggunakan user yang sedang login</small>
                </div>
              </div>
            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">
                <i class="bx bx-send me-2"></i>Kirim Tanggapan
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- All Responses List -->
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">
            <i class="bx bx-list-ul me-2"></i>Semua Tanggapan untuk Pengaduan #{{ $response->complaint_id }}
          </h5>
        </div>
        <div class="card-body">
          @if(isset($allResponses) && $allResponses->count() > 0)
            <div class="timeline-wrapper">
              @foreach($allResponses as $index => $resp)
                <div class="response-timeline-item {{ $resp->id == $response->id ? 'current-response' : '' }}">
                  <div class="response-timeline-marker 
                    @if($resp->status == 'pending') bg-warning 
                    @elseif($resp->status == 'process') bg-info 
                    @elseif($resp->status == 'resolved') bg-success 
                    @endif">
                    {{ $index + 1 }}
                  </div>
                  <div class="response-timeline-content">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                      <div>
                        <h6 class="mb-1">
                          Tanggapan #{{ $resp->id }}
                          @if($resp->id == $response->id)
                            <span class="badge bg-primary ms-2">Saat ini</span>
                          @endif
                        </h6>
                        <div class="d-flex gap-2 align-items-center">
                          @if($resp->status == 'pending')
                            <span class="badge bg-warning">
                              <i class="bx bx-time me-1"></i>Pending
                            </span>
                          @elseif($resp->status == 'process')
                            <span class="badge bg-info">
                              <i class="bx bx-loader-circle me-1"></i>Diproses
                            </span>
                          @elseif($resp->status == 'resolved')
                            <span class="badge bg-success">
                              <i class="bx bx-check-circle me-1"></i>Selesai
                            </span>
                          @endif
                          <small class="text-muted">{{ $resp->created_at->format('d M Y, H:i') }}</small>
                        </div>
                      </div>
                      <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <ul class="dropdown-menu">
                          <li>
                            <a class="dropdown-item" href="{{ route('complaint-response.show', $resp->id) }}">
                              <i class="bx bx-show me-2"></i>Lihat Detail
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="{{ route('complaint-response.edit', $resp->id) }}">
                              <i class="bx bx-edit me-2"></i>Edit
                            </a>
                          </li>
                          <li><hr class="dropdown-divider"></li>
                          <li>
                            <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $resp->id }})">
                              <i class="bx bx-trash me-2"></i>Hapus
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    
                    <div class="response-author mb-2">
                      <div class="d-flex align-items-center">
                        <div class="avatar avatar-xs me-2">
                          <span class="avatar-initial rounded-circle bg-label-primary">
                            {{ substr($resp->user->name ?? 'A', 0, 1) }}
                          </span>
                        </div>
                        <small class="text-muted">{{ $resp->user->name ?? 'Administrator' }}</small>
                      </div>
                    </div>
                    
                    <div class="response-text">
                      <p class="mb-0">{{ $resp->response }}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <div class="text-center py-4">
              <i class="bx bx-message-square-x" style="font-size: 3rem; color: #ddd;"></i>
              <h6 class="mt-2 text-muted">Belum ada tanggapan lain</h6>
              <p class="text-muted small mb-0">Tanggapan yang Anda tambahkan akan muncul di sini</p>
            </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
      <!-- Response Info -->
      <div class="card mb-4">
        <div class="card-header">
          <h6 class="mb-0">
            <i class="bx bx-info-circle me-2"></i>Informasi Tanggapan
          </h6>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-sm-5">
              <small class="text-muted">ID Tanggapan:</small>
            </div>
            <div class="col-sm-7">
              <small class="fw-semibold">#{{ $response->id }}</small>
            </div>
          </div>
          <hr class="my-2">
          <div class="row mb-3">
            <div class="col-sm-5">
              <small class="text-muted">ID Pengaduan:</small>
            </div>
            <div class="col-sm-7">
              <small class="fw-semibold">#{{ $response->complaint_id }}</small>
            </div>
          </div>
          <hr class="my-2">
          <div class="row mb-3">
            <div class="col-sm-5">
              <small class="text-muted">Penanggap:</small>
            </div>
            <div class="col-sm-7">
              <small class="fw-semibold">{{ $response->user->name ?? 'Admin' }}</small>
            </div>
          </div>
          <hr class="my-2">
          <div class="row mb-3">
            <div class="col-sm-5">
              <small class="text-muted">Dibuat:</small>
            </div>
            <div class="col-sm-7">
              <small class="fw-semibold">{{ $response->created_at->format('d M Y, H:i') }}</small>
            </div>
          </div>
          <hr class="my-2">
          <div class="row">
            <div class="col-sm-5">
              <small class="text-muted">Diperbarui:</small>
            </div>
            <div class="col-sm-7">
              <small class="fw-semibold">{{ $response->updated_at->format('d M Y, H:i') }}</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Status Timeline -->
      <div class="card mb-4">
        <div class="card-header">
          <h6 class="mb-0">
            <i class="bx bx-time me-2"></i>Timeline Status
          </h6>
        </div>
        <div class="card-body">
          <div class="timeline">
            <div class="timeline-item">
              <div class="timeline-marker"></div>
              <div class="timeline-content">
                <h6 class="mb-1">Tanggapan Dibuat</h6>
                <small class="text-muted">{{ $response->created_at->format('d M Y, H:i') }}</small>
                <p class="small mb-0">Status: Pending</p>
              </div>
            </div>
            
            @if($response->status != 'pending')
              <div class="timeline-item">
                <div class="timeline-marker bg-info"></div>
                <div class="timeline-content">
                  <h6 class="mb-1">Status Diperbarui</h6>
                  <small class="text-muted">{{ $response->updated_at->format('d M Y, H:i') }}</small>
                  <p class="small mb-0">Status: {{ ucfirst($response->status) }}</p>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Actions -->
      <div class="card">
        <div class="card-header">
          <h6 class="mb-0">
            <i class="bx bx-cog me-2"></i>Aksi
          </h6>
        </div>
        <div class="card-body">
          <div class="d-grid gap-2">
            <a href="{{ route('complaint-response.edit', $response->id) }}" class="btn btn-warning">
              <i class="bx bx-edit me-2"></i>Edit Tanggapan
            </a>
            
            {{-- @if($response->status == 'pending')
              <form action="{{ route('complaint-response.update', $response->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="process">
                <button type="submit" class="btn btn-info w-100">
                  <i class="bx bx-play me-2"></i>Mulai Proses
                </button>
              </form>
            @endif
            
            @if($response->status == 'process')
              <form action="{{ route('complaint-response.update', $response->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="resolved">
                <button type="submit" class="btn btn-success w-100">
                  <i class="bx bx-check me-2"></i>Selesaikan
                </button>
              </form>
            @endif --}}
            
            <hr>
            
            <button type="button" class="btn btn-outline-danger" 
                    onclick="confirmDelete({{ $response->id }})">
              <i class="bx bx-trash me-2"></i>Hapus Tanggapan
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    function confirmDelete(id) {
      if (confirm('Apakah Anda yakin ingin menghapus tanggapan ini?')) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/complaint-response/${id}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
      }
    }

    // Form validation
    document.getElementById('addResponseForm').addEventListener('submit', function(e) {
      const response = document.getElementById('response').value.trim();
      const status = document.getElementById('status').value;
      
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
      
      // Show loading state
      const submitBtn = this.querySelector('button[type="submit"]');
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i>Mengirim...';
    });

    // Auto-resize textarea
    document.getElementById('response').addEventListener('input', function() {
      this.style.height = 'auto';
      this.style.height = this.scrollHeight + 'px';
    });
  </script>
@endpush
