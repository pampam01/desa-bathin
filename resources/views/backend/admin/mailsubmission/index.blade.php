@extends('backend.admin.layouts.app')

@section('title', 'Kelola Pengajuan Surat')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen /</span> Semua Pengajuan Surat
        </h4>
        <a href="{{ route('mail-submissions.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Buat Pengajuan
        </a>
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Pengajuan Surat</li>
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
            <h5 class="card-title mb-0"><i class="bx bx-filter-alt me-1"></i>Filter Pengajuan</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('mail-submissions.index') }}">
                {{-- CSRF tidak diperlukan untuk form GET --}}
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Cari</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                placeholder="Nama, NIK, atau Jenis Surat...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        {{-- Menyelaraskan value dengan logika di tabel --}}
                        <select class="form-select" name="status">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="process" {{ request('status') == 'process' ? 'selected' : '' }}>Proses</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
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
                            <span>Total Pengajuan</span>
                            <h4 class="mb-0 mt-2">{{ $totalmails ?? 0 }}</h4>
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
                            <h4 class="mb-0 mt-2">{{ $pendingmails ?? 0 }}</h4>
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
                            <span>Diproses</span>
                             <h4 class="mb-0 mt-2">{{ $processmails ?? 0 }}</h4>
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
                            {{-- Mengganti variabel agar konsisten --}}
                            <h4 class="mb-0 mt-2">{{ $completedmails ?? ($resolvedmails ?? 0) }}</h4>
                        </div>
                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check-circle fs-4"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="bx bx-list-ul me-1"></i>Daftar Pengajuan Surat</h5>
        </div>
        <div class="table-responsive text-nowrap">
            @if (isset($mails) && $mails->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Pemohon</th>
                            <th>Jenis Surat</th>
                            <th class="text-center">Status</th>
                            <th>Tanggal Pengajuan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($mails as $mail)
                            <tr>
                                {{-- Menggabungkan info pemohon jadi satu kolom agar rapi --}}
                                <td>
                                    <span class="fw-semibold">{{ $mail->name }}</span><br>
                                    <small class="text-muted">NIK: {{ $mail->nik }}</small>
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $mail->jenis_surat }}</span><br>
                                    <small class="text-muted">{!! Str::limit($mail->description, 40) !!}</small>
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusClass = ''; $statusText = 'N/A'; $statusIcon = 'bx-question-mark';
                                        switch ($mail->status) {
                                            case 'pending': $statusClass = 'bg-label-warning'; $statusText = 'Pending'; $statusIcon = 'bx-time-five'; break;
                                            case 'process': $statusClass = 'bg-label-info'; $statusText = 'Diproses'; $statusIcon = 'bx-loader-alt'; break;
                                            case 'completed': $statusClass = 'bg-label-success'; $statusText = 'Selesai'; $statusIcon = 'bx-check-circle'; break;
                                            case 'rejected': $statusClass = 'bg-label-danger'; $statusText = 'Ditolak'; $statusIcon = 'bx-x-circle'; break;
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}"><i class="bx {{ $statusIcon }} me-1"></i>{{ $statusText }}</span>
                                </td>
                                <td>
                                    <span class="d-block">{{ $mail->created_at->format('d M Y') }}</span>
                                    <small class="text-muted">{{ $mail->created_at->format('H:i') }} WIB</small>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('mail-submissions.show', $mail->id) }}" class="btn btn-sm btn-icon btn-outline-info" data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        @if (Auth::user()->role == 'admin')
                                            <a href="{{ route('mail-submissions.edit', $mail->id) }}" class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="tooltip" title="Edit">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="confirmDelete({{ $mail->id }}, '{{ $mail->jenis_surat }} untuk {{ $mail->name }}')" data-bs-toggle="tooltip" title="Hapus">
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
                    <i class="bx bx-message-square-x" style="font-size: 4rem; color: #ddd;"></i>
                    <h5 class="mt-3 text-muted">Belum Ada Pengajuan Surat</h5>
                    <p class="text-muted">Semua pengajuan surat dari warga akan muncul di sini.</p>
                </div>
            @endif
        </div>
        @if (isset($mails) && $mails->total() > 0 && method_exists($mails, 'links'))
            <div class="card-footer d-flex justify-content-between align-items-center">
                 <small class="text-muted">
                    Menampilkan {{ $mails->firstItem() }} - {{ $mails->lastItem() }} dari {{ $mails->total() }} data
                </small>
                <div>{{ $mails->appends(request()->query())->links() }}</div>
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
         * Menampilkan modal konfirmasi sebelum menghapus pengajuan.
         * @param {number} id - ID pengajuan surat.
         * @param {string} submissionInfo - Info pengajuan untuk ditampilkan.
         */
        function confirmDelete(id, submissionInfo) {
            Swal.fire({
                title: 'Anda Yakin?',
                html: `Anda akan menghapus pengajuan:<br><b>${submissionInfo}</b>`,
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
                    // Menggunakan url() helper agar lebih aman
                    form.action = `{{ url('mail-submission') }}/${id}`; 
                    form.innerHTML = `@method('DELETE') @csrf`;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endpush