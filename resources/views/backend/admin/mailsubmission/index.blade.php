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

        .form-label,
        .fw-semibold {
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
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak
                            </option>
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
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bx bx-list-ul me-1"></i>Daftar Pengajuan Surat</h5>
            <form id="bulk-delete-form" action="{{ route('mail-submissions.multipleDelete') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Hapus Terpilih</button>
            </form>
        </div>

        <div class="table-responsive text-nowrap">
            @if (isset($mails) && $mails->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="select-all">
                            </th>
                            <th>Pemohon</th>
                            <th>Jenis Surat</th>
                            <th class="text-center">Status</th>
                            <th>Tanggal Pengajuan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mails as $mail)
                            <tr>
                                <td>
                                    <input type="checkbox" name="selected_ids[]" form="bulk-delete-form"
                                        value="{{ $mail->id }}" class="row-checkbox">
                                </td>
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
                                        $statusClass =
                                            [
                                                'pending' => 'bg-label-warning',
                                                'process' => 'bg-label-info',
                                                'completed' => 'bg-label-success',
                                                'rejected' => 'bg-label-danger',
                                            ][$mail->status] ?? 'bg-label-secondary';

                                        $statusText =
                                            [
                                                'pending' => 'Pending',
                                                'process' => 'Diproses',
                                                'completed' => 'Selesai',
                                                'rejected' => 'Ditolak',
                                            ][$mail->status] ?? 'N/A';
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                                </td>
                                <td>
                                    <span class="d-block">{{ $mail->created_at->format('d M Y') }}</span>
                                    <small class="text-muted">{{ $mail->created_at->format('H:i') }} WIB</small>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('mail-submissions.show', $mail->id) }}"
                                            class="btn btn-sm btn-icon btn-outline-info" title="Lihat">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        @if (Auth::user()->role == 'admin')
                                            <a href="{{ route('mail-submissions.edit', $mail->id) }}"
                                                class="btn btn-sm btn-icon btn-outline-warning" title="Edit">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger"
                                                onclick="confirmDelete({{ $mail->id }}, '{{ $mail->jenis_surat }} untuk {{ $mail->name }}')">
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
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.row-checkbox');
        const deleteBtn = document.getElementById('delete-selected');

        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            toggleDeleteBtn();
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                toggleDeleteBtn();
                if (!this.checked) selectAll.checked = false;
            });
        });

        function toggleDeleteBtn() {
            const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
            deleteBtn.disabled = checkedCount === 0;
        }
    </script>
@endpush


@push('scripts')
    <script>
        function confirmDelete(id, title) {
            showConfirmModal(
                `Apakah Anda yakin ingin menghapus berita "${title}"? Tindakan ini tidak dapat dibatalkan.`,
                function() {
                    // Create form and submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/mail-submissions/${id}`;

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
