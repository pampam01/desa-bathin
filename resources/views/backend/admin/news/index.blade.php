@extends('backend.admin.layouts.app')

@section('title', 'Kelola Berita')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen /</span> Semua Berita
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
    <li class="breadcrumb-item active">Semua Berita</li>
@endsection

@push('styles')
    <style>
        .card {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: none;
        }
        .table-hover tbody tr {
            transition: background-color 0.2s ease-in-out;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(105, 108, 255, 0.07);
        }
        .news-status {
            font-size: 0.8rem;
            padding: 0.3em 0.6em;
            font-weight: 600;
        }
        .avatar-initial {
            font-weight: 600;
        }
        .btn-icon i {
            font-size: 1.1rem;
        }
        .form-label, .fw-semibold {
            font-weight: 600 !important;
        }
    </style>
@endpush

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="bx bx-filter-alt me-1"></i>Filter & Pencarian</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('news.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Cari Berita</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                placeholder="Judul atau konten berita...">
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
                        <label class="form-label">Tanggal Publikasi</label>
                        <input type="date" class="form-control" name="date" value="{{ request('date') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bx bx-search d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Filter</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-news fs-3"></i></span>
                    </div>
                    <h4 class="mb-1">{{ $totalNews ?? 0 }}</h4>
                    <span class="fw-semibold">Total Berita</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-check-circle fs-3"></i></span>
                    </div>
                    <h4 class="mb-1">{{ $publishedNewsCount ?? 0 }}</h4>
                    <span class="fw-semibold">Dipublikasikan</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-warning"><i class="bx bx-edit fs-3"></i></span>
                    </div>
                    <h4 class="mb-1">{{ $draftNews ?? 0 }}</h4>
                    <span class="fw-semibold">Draft</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-info"><i class="bx bx-show fs-3"></i></span>
                    </div>
                    <h4 class="mb-1">{{ $totalViews ?? 0 }}</h4>
                    <span class="fw-semibold">Total Dilihat</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Berita</h5>
            @if (Auth::user()->role == 'admin')
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm" onclick="selectAll()">
                        <i class="bx bx-check-square me-1"></i> Pilih Semua
                    </button>
                    <button class="btn btn-outline-danger btn-sm" id="deleteSelectedBtn" disabled>
                        <i class="bx bx-trash me-1"></i> Hapus Terpilih
                    </button>
                </div>
            @endif
        </div>

        {{-- Logika View untuk Admin --}}
        @if (Auth::user()->role == 'admin')
            <div class="table-responsive text-nowrap">
                @if (isset($news) && $news->count() > 0)
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" width="50">
                                    <input type="checkbox" class="form-check-input" id="selectAllCheckbox">
                                </th>
                                <th>Penulis</th>
                                <th>Judul Artikel</th>
                                <th class="text-center">Dilihat</th>
                                <th>Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($news as $item)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input news-checkbox" value="{{ $item->id }}">
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="avatar-wrapper">
                                                <div class="avatar avatar-lg me-3">
                                                    @if ($item->image)
                                                        <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar Berita" class="rounded" style="object-fit: cover;">
                                                    @else
                                                        <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-news fs-3"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold">{{ $item->user->name ?? 'Anonymous' }}</span>
                                                <small class="text-muted">{{ $item->user->email ?? '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">{{ Str::limit($item->title, 55) }}</span>
                                        <div class="mt-1">
                                            @if ($item->status == 'published')
                                                <span class="badge bg-label-success news-status">Dipublikasikan</span>
                                            @else
                                                <span class="badge bg-label-warning news-status">Draft</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-label-info rounded-pill">{{ $item->views ?? 0 }}</span>
                                    </td>
                                    <td>
                                        <span class="d-block">{{ $item->created_at->format('d M Y') }}</span>
                                        <small class="text-muted">{{ $item->created_at->format('H:i') }} WIB</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('news.show', $item->id) }}" class="btn btn-sm btn-icon btn-outline-info" data-bs-toggle="tooltip" title="Lihat Detail">
                                                <i class="bx bx-show"></i>
                                            </a>
                                            <a href="{{ route('news.edit', $item->id) }}" class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="tooltip" title="Edit Berita">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger" data-bs-toggle="tooltip" title="Hapus Berita"
                                                onclick="confirmDelete({{ $item->id }}, '{{ addslashes($item->title) }}')">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-5">
                        <i class="bx bx-news bx-lg text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Berita</h5>
                        <p class="text-muted">Tidak ada data berita yang cocok dengan filter Anda.</p>
                        <a href="{{ route('news.create') }}" class="btn btn-primary mt-2">
                            <i class="bx bx-plus me-1"></i> Tambah Berita Pertama
                        </a>
                    </div>
                @endif
            </div>

            @if (isset($news) && $news->total() > 0 && method_exists($news, 'links'))
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Menampilkan {{ $news->firstItem() }} - {{ $news->lastItem() }} dari {{ $news->total() }} berita
                    </small>
                    <div>{{ $news->appends(request()->query())->links() }}</div>
                </div>
            @endif
        
        {{-- Logika View untuk non-Admin --}}
        @else
            <div class="table-responsive text-nowrap">
                @if (isset($publishedNews) && $publishedNews->count() > 0)
                     <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Penulis</th>
                                <th>Judul Artikel</th>
                                <th>Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($publishedNews as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="avatar-wrapper">
                                                <div class="avatar avatar-lg me-3">
                                                    @if ($item->image)
                                                        <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar Berita" class="rounded" style="object-fit: cover;">
                                                    @else
                                                        <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-news fs-3"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold">{{ $item->user->name ?? 'Anonymous' }}</span>
                                                <span class="badge bg-label-secondary mt-1" style="width: fit-content;">{{ $item->category->name ?? 'Umum' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">{{ Str::limit($item->title, 60) }}</span><br>
                                        <small class="text-muted">{{ Str::limit(strip_tags($item->content), 90) }}</small>
                                    </td>
                                     <td>
                                        <span class="d-block">{{ $item->created_at->format('d M Y') }}</span>
                                        <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('news.show', $item->id) }}" class="btn btn-sm btn-icon btn-outline-info" data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class="bx bx-show"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-5">
                        <i class="bx bx-news bx-lg text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Berita yang Dipublikasikan</h5>
                        <p class="text-muted">Saat ini tidak ada berita yang tersedia untuk ditampilkan.</p>
                    </div>
                @endif
            </div>
             @if (isset($publishedNews) && $publishedNews->total() > 0 && method_exists($publishedNews, 'links'))
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Menampilkan {{ $publishedNews->firstItem() }} - {{ $publishedNews->lastItem() }} dari {{ $publishedNews->total() }} berita
                    </small>
                    <div>{{ $publishedNews->appends(request()->query())->links() }}</div>
                </div>
            @endif
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const newsCheckboxes = document.querySelectorAll('.news-checkbox');
        const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');

        if (selectAllCheckbox && newsCheckboxes.length > 0 && deleteSelectedBtn) {
            const updateDeleteButton = () => {
                const checkedCount = document.querySelectorAll('.news-checkbox:checked').length;
                if (checkedCount > 0) {
                    deleteSelectedBtn.disabled = false;
                    deleteSelectedBtn.innerHTML = `<i class="bx bx-trash me-1"></i> Hapus (${checkedCount}) Terpilih`;
                } else {
                    deleteSelectedBtn.disabled = true;
                    deleteSelectedBtn.innerHTML = '<i class="bx bx-trash me-1"></i> Hapus Terpilih';
                }
                selectAllCheckbox.checked = checkedCount === newsCheckboxes.length;
            };

            selectAllCheckbox.addEventListener('change', () => {
                newsCheckboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
                updateDeleteButton();
            });

            newsCheckboxes.forEach(checkbox => checkbox.addEventListener('change', updateDeleteButton);

            deleteSelectedBtn.addEventListener('click', () => deleteSelected());
            updateDeleteButton();
        }
    });

    function selectAll() {
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        if (selectAllCheckbox) {
            selectAllCheckbox.checked = !selectAllCheckbox.checked;
            selectAllCheckbox.dispatchEvent(new Event('change'));
        }
    }

    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Anda Yakin?',
            html: `Anda akan menghapus berita:<br><b>"${title}"</b>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: { confirmButton: 'btn btn-danger', cancelButton: 'btn btn-secondary ms-2' },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ url('news') }}/${id}`;
                form.innerHTML = `@method('DELETE') @csrf`;
                document.body.appendChild(form);
                showLoading('Menghapus berita...');
                form.submit();
            }
        });
    }

    function deleteSelected() {
        const checkedBoxes = document.querySelectorAll('.news-checkbox:checked');
        const ids = Array.from(checkedBoxes).map(cb => cb.value);

        if (ids.length === 0) {
            showToast('error', 'Tidak ada berita yang terpilih untuk dihapus.');
            return;
        }

        Swal.fire({
            title: 'Anda Yakin?',
            text: `Anda akan menghapus ${ids.length} berita terpilih. Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Semua!',
            cancelButtonText: 'Batal',
            customClass: { confirmButton: 'btn btn-danger', cancelButton: 'btn btn-secondary ms-2' },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading('Menghapus berita terpilih...');
                fetch('{{ route("news.multipleDelete") }}', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ ids: ids })
                })
                .then(response => response.json())
                .then(data => {
                    hideLoading();
                    if (data.success) {
                        Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 2000, showConfirmButton: false })
                            .then(() => location.reload());
                    } else {
                        Swal.fire('Gagal!', data.message || 'Terjadi kesalahan.', 'error');
                    }
                })
                .catch(error => {
                    hideLoading();
                    Swal.fire('Error!', 'Tidak dapat terhubung ke server.', 'error');
                });
            }
        });
    }

    // --- Helper Functions ---
    function showLoading(message = 'Memproses...') {
        Swal.fire({ title: message, allowOutsideClick: false, didOpen: () => Swal.showLoading() });
    }
    function hideLoading() { Swal.close(); }
</script>
@endpush