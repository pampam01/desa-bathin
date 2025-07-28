@extends('backend.admin.layouts.app')

@section('title', 'Manajemen Kelola')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Kelola
        </h4>
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('aboutvillage.edit', $aboutVillage->id) }}" class="btn btn-warning">
                <i class="bx bx-pencil me-1"></i> Edit Tentang Desa
            </a>
        @endif
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('aboutvillage.index') }}">Tentang Desa</a></li>
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
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <i class="bx bx-group bx-md text-primary"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Total Penduduk</span>
                            <h3 class="card-title mb-0">{{ $totalPeople ?? 0 }}</h3>
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
                            <i class="bx bx-home-heart bx-md text-success"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Total Rumah Tangga</span>
                            <h3 class="card-title mb-0">{{ $totalFamilies ?? 0 }}</h3>
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
                            <i class="bx bx-door-open bx-md text-warning"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Total Dusun</span>
                            <h3 class="card-title mb-0">{{ $totalBloks ?? 0 }}</h3>
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
                            <i class="bx bx-book-content bx-md text-info"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Total Program</span>
                            <h3 class="card-title mb-0">{{ $totalPrograms ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <i class="bx bx-blanket bx-md text-success"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Alamat</span>
                            <p class="card-title mb-0">{{ $location ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <i class="bx bx-envelope bx-md text-success"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Email</span>
                            <p class="card-title mb-0">{{ $email ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <i class="bx bx-phone bx-md text-success"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">No Telepon</span>
                            <p class="card-title mb-0">{{ $telp ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <i class="bx bx-file bx-md text-warning"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Visi Desa</span>
                            <p class="card-title mb-0">{!! $visi ?? '' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <i class="bx bx-book bx-md text-info"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Misi Desa</span>
                            <p class="card-title mb-0">{!! $misi ?? '' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <i class="bx bx-bookmarks bx-md text-primary"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Deskripsi Desa</span>
                            <p class="card-title mb-0">{!! $description ?? '' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
