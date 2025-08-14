@extends('backend.admin.layouts.app')

@section('title', 'Kelola Pengaduan')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen /</span> Semua Pengaduan
        </h4>
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('complaints.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Buat Pengaduan
            </a>
        @endif
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Semua Pengaduan</li>
@endsection

@push('styles')
    <style>
        .card {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .table-hover tbody tr {
            transition: all 0.2s ease-in-out;
        }

        .table-hover tbody tr:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 20px rgba(34, 41, 47, .1);
            z-index: 2;
            position: relative;
        }

        .complaint-status {
            font-size: 0.8rem;
            padding: 0.3em 0.6em;
            font-weight: 600;
        }

        .form-label {
            font-weight: 600;
        }

        .avatar-initial {
            font-weight: 600;
        }

        .btn-icon i {
            font-size: 1.1rem;
        }
    </style>
@endpush

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="bx bx-filter-alt me-1"></i>Filter Pengaduan</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('complaints.index') }}">
                {{-- CSRF tidak diperlukan untuk form GET --}}
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Cari</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                placeholder="Judul, nama, atau isi pengaduan...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="">Semua Status</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Pengaduan</label>
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
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Total Pengaduan</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $totalComplaints ?? 0 }}</h4>
                            </div>
                        </div>
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="bx bx-file fs-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Selesai</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $resolvedComplaints ?? 0 }}</h4>
                            </div>
                        </div>
                        <span class="avatar-initial rounded bg-label-success">
                            <i class="bx bx-check-circle fs-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Draft</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $draftComplaints ?? 0 }}</h4>
                            </div>
                        </div>
                        <span class="avatar-initial rounded bg-label-warning">
                            <i class="bx bx-edit fs-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Ditolak</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $rejectedComplaints ?? 0 }}</h4>
                            </div>
                        </div>
                        <span class="avatar-initial rounded bg-label-danger">
                            <i class="bx bx-x-circle fs-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pengaduan</h5>
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

        <div class="table-responsive text-nowrap">
            @if (isset($complaints) && $complaints->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" width="50">
                                <input type="checkbox" class="form-check-input" id="selectAllCheckbox">
                            </th>
                            <th>Pengadu</th>
                            <th>Judul Pengaduan</th>
                            <th class="text-center">Kategori</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($complaints as $item)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="form-check-input complaint-checkbox"
                                        value="{{ $item->id }}">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="avatar-wrapper">
                                            <div class="avatar avatar-sm me-3">
                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                    {{ substr($item->user->name ?? 'A', 0, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold">{{ $item->user->name ?? 'Anonymous' }}</span>
                                            <small class="text-muted">{{ $item->user->email ?? '' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($item->image)
                                        <a href="{{ asset('storage/' . $item->image) }}" data-bs-toggle="tooltip"
                                            title="Lihat Lampiran" target="_blank">
                                            <i class="bx bx-paperclip me-1"></i>
                                        </a>
                                    @endif
                                    <span class="fw-semibold">{{ Str::limit($item->title, 45) }}</span>
                                    <div class="mt-1">
                                        @php
                                            $statusClass = '';
                                            $statusText = 'Draft';
                                            switch ($item->status) {
                                                case 'in_progress':
                                                    $statusClass = 'bg-label-info';
                                                    $statusText = 'Diproses';
                                                    break;
                                                case 'resolved':
                                                    $statusClass = 'bg-label-success';
                                                    $statusText = 'Selesai';
                                                    break;
                                                case 'rejected':
                                                    $statusClass = 'bg-label-danger';
                                                    $statusText = 'Ditolak';
                                                    break;
                                                case 'draft':
                                                default:
                                                    $statusClass = 'bg-label-warning';
                                                    $statusText = 'Draft';
                                                    break;
                                            }
                                        @endphp
                                        <span
                                            class="badge {{ $statusClass }} complaint-status">{{ $statusText }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-label-secondary">{{ $item->category ?? 'Lainnya' }}</span>
                                </td>
                                <td>
                                    <span class="d-block">{{ $item->created_at->format('d M Y') }}</span>
                                    <small class="text-muted">{{ $item->created_at->format('H:i') }} WIB</small>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('complaints.show', $item->id) }}"
                                            class="btn btn-sm btn-icon btn-outline-info" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Lihat Detail">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        @if ($item->status != 'resolved' && $item->status != 'rejected')
                                            @if (Auth::user()->role == 'admin')
                                                <a href="{{ route('complaint-response.create', ['complaint_id' => $item->id]) }}"
                                                    class="btn btn-sm btn-icon btn-outline-success"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Tanggapi">
                                                    <i class="bx bx-reply"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('complaints.edit', $item->id) }}"
                                                class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                        @endif
                                        @if (Auth::user()->role == 'admin')
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Pengaduan"
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
            @else
                <div class="text-center py-5">
                    <i class="bx bx-message-square-x bx-lg text-muted mb-3"></i>
                    <h5 class="text-muted">Belum Ada Pengaduan</h5>
                    <p class="text-muted">Tidak ada data untuk ditampilkan saat ini.</p>
                    <a href="{{ route('complaints.create') }}" class="btn btn-primary mt-2">
                        <i class="bx bx-plus me-1"></i> Buat Pengaduan
                    </a>
                </div>
            @endif
        </div>

        @if (isset($complaints) && $complaints->total() > 0 && method_exists($complaints, 'links'))
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $complaints->firstItem() }} - {{ $complaints->lastItem() }} dari
                    {{ $complaints->total() }} data
                </small>
                <div>{{ $complaints->appends(request()->query())->links() }}</div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(id, title) {
            showConfirmModal(
                `Apakah Anda yakin ingin menghapus berita "${title}"? Tindakan ini tidak dapat dibatalkan.`,
                function() {
                    // Create form and submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/complaints/${id}`;

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
    </script>
@endpush
