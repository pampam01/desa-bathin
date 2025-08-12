@extends('backend.admin.layouts.app')

@section('title', 'Struktur Perangkat KUA')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Struktur /</span> Struktur Perangkat KUA
        </h4>
        {{-- Tombol Tambah tidak ada di kode asli, jadi tidak ditambahkan untuk menjaga fungsi tetap sama --}}
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Struktur Perangkat KUA</li>
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
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Struktur Perangkat KUA</h5>
             <small class="text-muted"><i class="bx bx-info-circle me-1"></i>Kelola data perangkat KUA yang sudah ada</small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Perangkat KUA</th>
                        <th>Jabatan & Posisi</th>
                        <th class="text-center">Status & Urutan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($structures as $structure)
                        <tr>
                            {{-- Kolom Perangkat KUA (Foto, Nama, Kontak) digabung --}}
                            <td>
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-lg me-3">
                                            @if ($structure->photo_url)
                                                <img src="{{ $structure->photo_url }}" alt="{{ $structure->name }}" class="rounded-circle" style="object-fit: cover;">
                                            @else
                                                <span class="avatar-initial rounded-circle bg-label-secondary">
                                                    <i class="bx {{ $structure->icon ?? 'bx-user' }} fs-3"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold">{{ $structure->name }}</span>
                                        <small class="text-muted">{{ $structure->email ?? '-' }}</small>
                                        <small class="text-muted">{{ $structure->phone ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            {{-- Kolom Jabatan & Posisi (Jabatan, Level, Seksi) digabung --}}
                            <td>
                                <span class="fw-semibold">{{ $structure->position }}</span><br>
                                <span class="badge bg-label-secondary me-1">{{ ucfirst(str_replace('_', ' ', $structure->level)) }}</span>
                                <small class="text-muted">{{ $structure->department ?? '' }}</small>
                            </td>
                            {{-- Kolom Status & Urutan digabung dan dipusatkan --}}
                            <td class="text-center">
                                @if ($structure->is_active)
                                    <span class="badge bg-label-success" data-bs-toggle="tooltip" title="Status Aktif">
                                        <i class="bx bx-check-circle"></i>
                                    </span>
                                @else
                                    <span class="badge bg-label-danger" data-bs-toggle="tooltip" title="Status Tidak Aktif">
                                        <i class="bx bx-x-circle"></i>
                                    </span>
                                @endif
                                <span class="badge bg-label-info ms-1" data-bs-toggle="tooltip" title="Nomor Urut">
                                    #{{ $structure->sort_order }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('kuastructure.edit', $structure) }}" 
                                   class="btn btn-sm btn-icon btn-outline-warning" 
                                   data-bs-toggle="tooltip" 
                                   title="Edit Data">
                                    <i class="bx bx-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <div class="py-5">
                                    <i class="bx bx-user-x fs-1 text-muted"></i>
                                    <h5 class="mt-2">Belum Ada Data Struktur</h5>
                                    <p class="text-muted">Data struktur perangkat KUA akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Inisialisasi semua tooltip Bootstrap setelah halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endpush