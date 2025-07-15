@extends('backend.admin.layouts.app')

@section('title', 'Kelola Berita - Portal Parakan')

@section('page-header')
  <div class="d-flex justify-content-between align-items-center">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Portal Parakan / Berita /</span> Semua Berita
    </h4>
    <a href="{{ route('news.create') }}" class="btn btn-primary">
      <i class="bx bx-plus me-1"></i> Tambah Berita
    </a>
  </div>
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Berita</a></li>
  <li class="breadcrumb-item active">Semua Berita</li>
@endsection

@push('styles')
  <style>
    .news-card {
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .news-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .news-status {
      font-size: 0.75rem;
    }
  </style>
@endpush

@section('content')
  <!-- Filter and Search -->
  <div class="card mb-4">
    <div class="card-body">
      <form method="GET" action="{{ route('news.index') }}">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Cari Berita</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bx bx-search"></i></span>
              <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Judul berita...">
            </div>
          </div>
          <div class="col-md-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="status">
              <option value="">Semua Status</option>
              <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
              <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label">Tanggal</label>
            <input type="date" class="form-control" name="date" value="{{ request('date') }}">
          </div>
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">
                <i class="bx bx-search me-1"></i> Filter
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Statistics Cards -->
  <div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar flex-shrink-0 me-3">
              <i class="bx bx-news bx-md text-primary"></i>
            </div>
            <div>
              <span class="fw-semibold d-block mb-1">Total Berita</span>
              <h3 class="card-title mb-0">{{ $totalNews ?? 0 }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar flex-shrink-0 me-3">
              <i class="bx bx-check-circle bx-md text-success"></i>
            </div>
            <div>
              <span class="fw-semibold d-block mb-1">Dipublikasikan</span>
              <h3 class="card-title mb-0">{{ $publishedNews ?? 0 }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar flex-shrink-0 me-3">
              <i class="bx bx-edit bx-md text-warning"></i>
            </div>
            <div>
              <span class="fw-semibold d-block mb-1">Draft</span>
              <h3 class="card-title mb-0">{{ $draftNews ?? 0 }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar flex-shrink-0 me-3">
              <i class="bx bx-heart bx-md text-info"></i>
            </div>
            <div>
              <span class="fw-semibold d-block mb-1">Total Likes</span>
              <h3 class="card-title mb-0">{{ $totalLikes ?? 0 }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- News List -->
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Daftar Berita</h5>
      <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="selectAll()">
          <i class="bx bx-check-square me-1"></i> Pilih Semua
        </button>
        <button class="btn btn-outline-danger btn-sm" onclick="deleteSelected()" disabled id="deleteSelectedBtn">
          <i class="bx bx-trash me-1"></i> Hapus Terpilih
        </button>
      </div>
    </div>
    <div class="card-body">
      @if(isset($news) && $news->count() > 0)
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="50">
                  <input type="checkbox" class="form-check-input" id="selectAllCheckbox" onchange="toggleSelectAll()">
                </th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Status</th>
                <th>Likes</th>
                <th>Tanggal</th>
                <th width="120">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($news as $item)
                <tr>
                  <td>
                    <input type="checkbox" class="form-check-input news-checkbox" value="{{ $item->id }}" onchange="updateDeleteButton()">
                  </td>
                  <td>
                    @if($item->image)
                      <img src="{{ asset('storage/' . $item->image) }}" alt="News Image" 
                           class="rounded" width="60" height="40" style="object-fit: cover; cursor: pointer;"
                           onclick="showImagePreview('{{ asset('storage/' . $item->image) }}', '{{ $item->title }}')">
                    @else
                      <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 40px;">
                        <i class="bx bx-image text-muted"></i>
                      </div>
                    @endif
                  </td>
                  <td>
                    <div>
                      <h6 class="mb-0">{{ Str::limit($item->title, 50) }}</h6>
                      <small class="text-muted">{{ Str::limit($item->content, 80) }}</small>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar avatar-xs me-2">
                        <span class="avatar-initial rounded-circle bg-label-primary">
                          {{ substr($item->user->name ?? 'A', 0, 1) }}
                        </span>
                      </div>
                      <span class="fw-semibold">{{ $item->user->name ?? 'Anonymous' }}</span>
                    </div>
                  </td>
                  <td>
                    @if($item->status == 'published')
                      <span class="badge bg-success news-status">Dipublikasikan</span>
                    @else
                      <span class="badge bg-warning news-status">Draft</span>
                    @endif
                  </td>
                  <td>
                    <span class="badge bg-info">{{ $item->likes_count ?? 0 }}</span>
                  </td>
                  <td>
                    <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
                    <br>
                    <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('news.show', $item->id) }}">
                          <i class="bx bx-show me-1"></i> Lihat
                        </a>
                        <a class="dropdown-item" href="{{ route('news.edit', $item->id) }}">
                          <i class="bx bx-edit me-1"></i> Edit
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="javascript:void(0);" 
                           onclick="confirmDelete({{ $item->id }}, '{{ $item->title }}')">
                          <i class="bx bx-trash me-1"></i> Hapus
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($news, 'links'))
          <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
              <small class="text-muted">
                Menampilkan {{ $news->firstItem() }} - {{ $news->lastItem() }} dari {{ $news->total() }} berita
              </small>
            </div>
            <div>
              {{ $news->links() }}
            </div>
          </div>
        @endif
      @else
        <div class="text-center py-5">
          <i class="bx bx-news bx-lg text-muted mb-3"></i>
          <h5 class="text-muted">Belum Ada Berita</h5>
          <p class="text-muted">Mulai tambahkan berita pertama untuk portal desa Anda.</p>
          <a href="{{ route('news.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Tambah Berita Pertama
          </a>
        </div>
      @endif
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    function toggleSelectAll() {
      const selectAllCheckbox = document.getElementById('selectAllCheckbox');
      const newsCheckboxes = document.querySelectorAll('.news-checkbox');
      
      newsCheckboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
      });
      
      updateDeleteButton();
    }

    function selectAll() {
      document.getElementById('selectAllCheckbox').checked = true;
      toggleSelectAll();
    }

    function updateDeleteButton() {
      const checkedBoxes = document.querySelectorAll('.news-checkbox:checked');
      const deleteBtn = document.getElementById('deleteSelectedBtn');
      
      if (checkedBoxes.length > 0) {
        deleteBtn.disabled = false;
        deleteBtn.innerHTML = `<i class="bx bx-trash me-1"></i> Hapus Terpilih (${checkedBoxes.length})`;
      } else {
        deleteBtn.disabled = true;
        deleteBtn.innerHTML = '<i class="bx bx-trash me-1"></i> Hapus Terpilih';
      }
    }

    function confirmDelete(id, title) {
      showConfirmModal(
        `Apakah Anda yakin ingin menghapus berita "${title}"? Tindakan ini tidak dapat dibatalkan.`,
        function() {
          // Create form and submit
          const form = document.createElement('form');
          form.method = 'POST';
          form.action = `/news/${id}`;
          
          const methodInput = document.createElement('input');
          methodInput.type = 'hidden';
          methodInput.name = '_method';
          methodInput.value = 'DELETE';
          
          const tokenInput = document.createElement('input');
          tokenInput.type = 'hidden';
          tokenInput.name = '_token';
          tokenInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          
          form.appendChild(methodInput);
          form.appendChild(tokenInput);
          document.body.appendChild(form);
          
          showLoading();
          form.submit();
        }
      );
    }

    function deleteSelected() {
      const checkedBoxes = document.querySelectorAll('.news-checkbox:checked');
      const ids = Array.from(checkedBoxes).map(cb => cb.value);
      
      if (ids.length === 0) return;
      
      showConfirmModal(
        `Apakah Anda yakin ingin menghapus ${ids.length} berita terpilih? Tindakan ini tidak dapat dibatalkan.`,
        function() {
          // Implement bulk delete logic here
          showLoading();
          
          // Example: Send AJAX request for bulk delete
          fetch('/news/bulk-delete', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ ids: ids })
          })
          .then(response => response.json())
          .then(data => {
            hideLoading();
            if (data.success) {
              location.reload();
            } else {
              alert('Terjadi kesalahan saat menghapus berita.');
            }
          })
          .catch(error => {
            hideLoading();
            alert('Terjadi kesalahan saat menghapus berita.');
          });
        }
      );
    }

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });
  </script>
@endpush
