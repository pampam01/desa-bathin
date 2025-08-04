@extends('backend.admin.layouts.app')

@section('title', 'Kelola Berita')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Berita /</span> Semua Berita
        </h4>
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('news.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Tambah Berita
            </a>
        @endif
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
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
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .news-status {
            font-size: 0.75rem;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
        }

        .btn-sm i {
            font-size: 0.875rem;
        }
    </style>
@endpush

@section('content')
    <!-- Filter and Search -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('news.index') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Cari Berita</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                placeholder="Judul berita...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="">Semua Status</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                                Dipublikasikan</option>
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
            @if (Auth::user()->role == 'admin')
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm" onclick="selectAll()">
                        <i class="bx bx-check-square me-1"></i> Pilih Semua
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="deleteSelected()" disabled
                        id="deleteSelectedBtn">
                        <i class="bx bx-trash me-1"></i> Hapus Terpilih
                    </button>
                </div>
            @endif
        </div>
        <div class="card-body">
            @if (isset($news) && $news->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @if (Auth::user()->role == 'admin')
                                    <th width="50">
                                        <input type="checkbox" class="form-check-input" id="selectAllCheckbox"
                                            onchange="toggleSelectAll()">
                                    </th>
                                @endif
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Status</th>

                                <th>Tanggal</th>
                                <th width="140">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $item)
                                <tr>
                                    @if (Auth::user()->role == 'admin')
                                        <td>
                                            <input type="checkbox" class="form-check-input news-checkbox"
                                                value="{{ $item->id }}" onchange="updateDeleteButton()">
                                        </td>
                                    @endif
                                    <td>
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="News Image"
                                                class="rounded" width="60" height="40"
                                                style="object-fit: cover; cursor: pointer;"
                                                onclick="showImagePreview('{{ asset('storage/' . $item->image) }}', '{{ $item->title }}')">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                style="width: 60px; height: 40px;">
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
                                        @if ($item->status == 'published')
                                            <span class="badge bg-success news-status">Dipublikasikan</span>
                                        @else
                                            <span class="badge bg-warning news-status">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">0</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
                                        <br>
                                        <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('news.show', $item->id) }}"
                                                class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Lihat Detail">
                                                <i class="bx bx-show"></i>
                                            </a>
                                            @if (Auth::user()->role == 'admin')
                                                <a href="{{ route('news.edit', $item->id) }}"
                                                    class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Edit Berita">
                                                    <i class="bx bx-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Berita"
                                                    onclick="confirmDelete({{ $item->id }}, '{{ $item->title }}')">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if (method_exists($news, 'links'))
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <small class="text-muted">
                                Menampilkan {{ $news->firstItem() }} - {{ $news->lastItem() }} dari {{ $news->total() }}
                                berita
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

            if (ids.length === 0) {
                console.warn('Tidak ada berita yang terpilih untuk dihapus.');
                return;
            }

            showConfirmModal(
                `Apakah Anda yakin ingin menghapus ${ids.length} berita terpilih? Tindakan ini tidak dapat dibatalkan.`,
                function() {
                    showLoading();

                    fetch('{{ route('news.multipleDelete') }}', {
                            method: 'DELETE', // Sesuai dengan rute Laravel
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                ids: ids
                            })
                        })
                        .then(response => {
                            hideLoading();
                            if (!response.ok) {
                                // Tangani error HTTP (misal 4xx atau 5xx)
                                return response.json().then(errorData => {
                                    throw new Error(errorData.message || 'Terjadi kesalahan pada server.');
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Tampilkan pesan sukses dengan SweetAlert2
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: data.message || 'Berita berhasil dihapus.',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    // RELOAD HALAMAN SETELAH PESAN SUKSES
                                    location.reload();
                                });
                            } else {
                                // Tampilkan pesan error dari server
                                Swal.fire('Error!', data.message || 'Gagal menghapus berita.', 'error');
                            }
                        })
                        .catch(error => {
                            hideLoading();
                            Swal.fire('Error!', error.message || 'Terjadi kesalahan saat memproses permintaan.',
                                'error');
                            console.error('AJAX Error:', error);
                        });
                }
            );
        }

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            const selectAllNewsCheckbox = document.getElementById('selectAllNewsCheckbox');
            const newsCheckboxes = document.querySelectorAll('.news-checkbox');
            const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');

            function updateDeleteButtonAndSelectAllStatus() {
                const checkedCount = document.querySelectorAll('.news-checkbox:checked').length;
                const totalCheckboxes = newsCheckboxes.length;

                // Mengaktifkan/menonaktifkan tombol "Hapus Terpilih"
                if (deleteSelectedBtn) { // Pastikan tombol ada sebelum mengaksesnya
                    deleteSelectedBtn.disabled = checkedCount === 0;
                }

                // Memperbarui status checkbox "Pilih Semua"
                if (selectAllNewsCheckbox) { // Pastikan checkbox "Pilih Semua" ada sebelum mengaksesnya
                    if (totalCheckboxes > 0 && checkedCount === totalCheckboxes) {
                        selectAllNewsCheckbox.checked = true;
                    } else {
                        selectAllNewsCheckbox.checked = false;
                    }
                }
            }
        });

        if (selectAllNewsCheckbox) {
            selectAllNewsCheckbox.addEventListener('change', function() {
                newsCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateDeleteButtonAndSelectAllStatus();
            });
        }

        // Event listener untuk setiap checkbox berita individual
        newsCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateDeleteButtonAndSelectAllStatus);
        });

        // Event listener untuk tombol "Hapus Terpilih"
        if (deleteSelectedBtn) {
            deleteSelectedBtn.addEventListener('click', deleteSelected); // Memanggil fungsi deleteSelected()
        }

        // === Inisialisasi Tooltips Bootstrap ===
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // === Inisialisasi Awal ===
        // Panggil ini untuk mengatur status awal tombol dan checkbox saat halaman dimuat
        updateDeleteButtonAndSelectAllStatus();
    </script>
@endpush
