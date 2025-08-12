@extends('backend.admin.layouts.app')

@section('title', 'Manajemen KUA')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen KUA /</span> Tentang KUA
        </h4>
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('aboutvillage.edit', $aboutVillage->id) }}" class="btn btn-primary">
                <i class="bx bx-pencil me-1"></i> Edit Informasi KUA
            </a>
        @endif
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Tentang KUA</li>
@endsection

@push('styles')
    <style>
        .card {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: none;
        }
        .fw-semibold {
            font-weight: 600 !important;
        }
        /* Styling untuk konten Visi, Misi, Profil */
        .tab-content .card-text {
            line-height: 1.8;
            color: #566a7f;
        }
        .tab-content .card-text ul,
        .tab-content .card-text ol {
            padding-left: 1.2rem;
        }
        .tab-content .card-text p:last-child {
            margin-bottom: 0;
        }
        .list-group-item {
            border-color: rgba(0, 0, 0, 0.05);
        }
    </style>
@endpush

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-primary">
                            <i class="bx bxs-heart-circle fs-3"></i>
                        </span>
                    </div>
                    <h4 class="mb-1">{{ $totalPeople ?? 0 }}</h4>
                    <span class="fw-semibold">Pasangan Menikah</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                     <div class="avatar avatar-md mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-success">
                            <i class="bx bxs-book-bookmark fs-3"></i>
                        </span>
                    </div>
                    <h4 class="mb-1">{{ $totalFamilies ?? 0 }}</h4>
                    <span class="fw-semibold">Pernikahan Tercatat</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                     <div class="avatar avatar-md mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-warning">
                            <i class="bx bxs-briefcase-alt-2 fs-3"></i>
                        </span>
                    </div>
                    <h4 class="mb-1">{{ $totalBloks ?? 0 }}</h4>
                    <span class="fw-semibold">Jumlah Layanan</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                     <div class="avatar avatar-md mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-info">
                            <i class="bx bxs-star fs-3"></i>
                        </span>
                    </div>
                    <h4 class="mb-1">{{ $totalPrograms ?? 0 }}</h4>
                    <span class="fw-semibold">Program Unggulan</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#nav-profil" aria-controls="nav-profil" aria-selected="true">
                                <i class="bx bx-building-house me-1"></i> Profil Umum
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav-visi" aria-controls="nav-visi" aria-selected="false">
                                <i class="bx bx-show me-1"></i> Visi
                            </button>
                        </li>
                        <li class="nav-item">
                             <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav-misi" aria-controls="nav-misi" aria-selected="false">
                                <i class="bx bx-list-ul me-1"></i> Misi
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="nav-profil" role="tabpanel">
                             <div class="card-text">
                                {!! $description ?? '<p class="text-muted"><em>Informasi profil KUA belum ditambahkan.</em></p>' !!}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-visi" role="tabpanel">
                             <div class="card-text">
                                {!! $visi ?? '<p class="text-muted"><em>Informasi visi KUA belum ditambahkan.</em></p>' !!}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-misi" role="tabpanel">
                            <div class="card-text">
                                {!! $misi ?? '<p class="text-muted"><em>Informasi misi KUA belum ditambahkan.</em></p>' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0"><i class="bx bx-phone-call me-1"></i> Informasi Kontak</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <i class="bx bx-map fs-4 me-3 text-primary"></i>
                            <div>
                                <span class="fw-semibold">Alamat Kantor</span>
                                <p class="mb-0 text-muted">{{ $location ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                           <i class="bx bx-envelope fs-4 me-3 text-primary"></i>
                            <div>
                                <span class="fw-semibold">Email</span>
                                <p class="mb-0 text-muted">{{ $email ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <i class="bx bx-phone fs-4 me-3 text-primary"></i>
                            <div>
                                <span class="fw-semibold">No. Telepon</span>
                                <p class="mb-0 text-muted">{{ $telp ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection