@extends('backend.admin.layouts.app')

@section('title', 'Kelola Tanggapan Pengaduan')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Pengaduan /</span> Semua Tanggapan
        </h4>
        <a href="{{ route('complaints.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali ke Pengaduan
        </a>
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('complaints.index') }}">Pengaduan</a></li>
    <li class="breadcrumb-item active">Semua Tanggapan</li>
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
        .form-label, .fw-semibold {
            font-weight: 600 !important;
        }
        .avatar-initial {
            font-weight: 600;
        }
        .badge {
            font-weight: 600;
            font-size: 0.8rem;
        }
        .btn-icon i {
            font-size: 1.1rem;
        }
    </style>
@endpush

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="bx bx-filter-alt me-1"></i>Filter Tanggapan</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('complaint-response.index') }}">
                {{-- CSRF tidak diperlukan untuk form GET --}}
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Cari</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                placeholder="Judul pengaduan...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="process" {{ request('status') == 'process' ? 'selected' : '' }}>Proses</option>
                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal</label>
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
                            <span>Total Tanggapan</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $totalResponses ?? 0 }}</h4>
                            </div>
                        </div>
                        <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-file fs-4"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Pending</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $pendingResponses ?? 0 }}</h4>
                            </div>
                        </div>
                        <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-time-five fs-4"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Proses</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $processResponses ?? 0 }}</h4>
                            </div>
                        </div>
                        <span class="avatar-initial rounded bg-label-info"><i class="bx bx-loader-alt fs-4"></i></span>
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
                                <h4 class="mb-0 me-2">{{ $resolvedResponses ?? 0 }}</h4>
                            </div>
                        </div>
                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check-circle fs-4"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bx bx-list-ul me-1"></i>Daftar Tanggapan
            </h5>
            <a href="{{ route('complaint-response.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i>Tambah Tanggapan
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            @if (isset($responses) && $responses->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Untuk Pengaduan</th>
                            <th>Penanggap</th>
                            <th class="text-center">Status</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($responses as $response)
                            <tr>
                                <td>
                                    <span class="fw-semibold">{{ Str::limit($response->complaint->title ?? 'N/A', 40) }}</span><br>
                                    <small class="text-muted">ID Pengaduan: #{{ $response->complaint->id ?? 'N/A' }}</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-2">
                                            <span class="avatar-initial rounded-circle bg-label-secondary">
                                                {{ substr($response->user->name ?? 'A', 0, 1) }}
                                            </span>
                                        </div>
                                        <span class="fw-semibold">{{ $response->user->name ?? 'Administrator' }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusClass = '';
                                        $statusText = 'N/A';
                                        $statusIcon = 'bx-question-mark';
                                        switch ($response->status) {
                                            case 'pending': $statusClass = 'bg-label-warning'; $statusText = 'Pending'; $statusIcon = 'bx-time-five'; break;
                                            case 'process': $statusClass = 'bg-label-info'; $statusText = 'Diproses'; $statusIcon = 'bx-loader-alt'; break;
                                            case 'resolved': $statusClass = 'bg-label-success'; $statusText = 'Selesai'; $statusIcon = 'bx-check-circle'; break;
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}"><i class="bx {{ $statusIcon }} me-1"></i>{{ $statusText }}</span>
                                </td>
                                <td>
                                    <span class="d-block">{{ $response->created_at->format('d M Y') }}</span>
                                    <small class="text-muted">{{ $response->created_at->format('H:i') }} WIB</small>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('complaint-response.show', $response->id) }}" class="btn btn-sm btn-icon btn-outline-info" data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('complaint-response.edit', $response->id) }}" class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="tooltip" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="confirmDelete({{ $response->id }}, '#{{ $response->complaint->id ?? 'N/A' }}')" data-bs-toggle="tooltip" title="Hapus">
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
                    <i class="bx bx-message-square-x" style="font-size: 4rem; color: #ddd;"></i>
                    <h5 class="mt-3 text-muted">Belum Ada Tanggapan</h5>
                    <p class="text-muted">Semua tanggapan yang dibuat akan muncul di sini.</p>
                    <a href="{{ route('complaint-response.create') }}" class="btn btn-primary mt-2">
                        <i class="bx bx-plus me-1"></i>Buat Tanggapan Pertama
                    </a>
                </div>
            @endif
        </div>
        @if (isset($responses) && $responses->total() > 0 && method_exists($responses, 'links'))
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $responses->firstItem() }} - {{ $responses->lastItem() }} dari {{ $responses->total() }} data
                </small>
                <div>{{ $responses->appends(request()->query())->links() }}</div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi semua tooltip Bootstrap
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        /**
         * Menampilkan modal konfirmasi sebelum menghapus tanggapan.
         * @param {number} id - ID tanggapan.
         * @param {string} complaintId - ID pengaduan untuk ditampilkan di modal.
         */
        function confirmDelete(id, complaintId) {
            Swal.fire({
                title: 'Anda Yakin?',
                html: `Anda akan menghapus tanggapan untuk pengaduan <b>${complaintId}</b>.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary ms-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ url('complaint-response') }}/${id}`;
                    form.innerHTML = `@method('DELETE') @csrf`;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endpush