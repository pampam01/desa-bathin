@extends('backend.admin.layouts.app')

@section('title', 'Dashboard')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard</span>
        </h4>
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('styles')
    <!-- Page specific styles -->
    <style>
        .stats-card {
            transition: transform 0.2s;
        }

        .stats-card:hover {
            transform: translateY(-2px);
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <!-- Statistics Cards -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-news bx-lg text-primary"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt1">
                                <a class="dropdown-item" href="{{ route('news.index') }}">Lihat Semua</a>
                                <a class="dropdown-item" href="{{ route('news.create') }}">Tambah Berita</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Berita</span>
                    <h3 class="card-title mb-2">{{ $totalNews ?? 0 }}</h3>
                    <small class="text-primary fw-semibold">
                        <i class="bx bx-up-arrow-alt"></i> +{{ $newNewsThisMonth ?? 0 }} bulan ini
                    </small>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-message-dots bx-lg text-warning"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt2" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt2">
                                <a class="dropdown-item" href="{{ route('complaints.index') }}">Lihat Semua</a>
                                <a class="dropdown-item" href="{{ route('complaints.pending') }}">Pengaduan Pending</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Pengaduan</span>
                    <h3 class="card-title mb-2">{{ $totalComplaints ?? 0 }}</h3>
                    <small class="text-warning fw-semibold">
                        <i class="bx bx-time"></i> {{ $pendingComplaints ?? 0 }} menunggu
                    </small>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-user bx-lg text-success"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ route('users.index') }}">Lihat Semua</a>
                                <a class="dropdown-item" href="{{ route('users.create') }}">Tambah User</a>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->role === 'admin')
                        <span class="fw-semibold d-block mb-1">Total Pengguna</span>
                        <h3 class="card-title mb-2">{{ $totalUsers ?? 0 }}</h3>
                        <small class="text-success fw-semibold">
                            <i class="bx bx-up-arrow-alt"></i> +{{ $newUsersThisMonth ?? 0 }} bulan ini
                        </small>
                    @else
                        <span class="fw-semibold d-block mb-1">Total Pengajuan Surat</span>
                        <h3 class="card-title mb-2">{{ $totalMailSubmissions ?? 0 }}</h3>
                        <small class="text-success fw-semibold">
                            <i class="bx bx-up-arrow-alt"></i> +{{ $newMailSubmissionsThisMonth ?? 0 }} bulan ini
                        </small>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-like bx-lg text-info"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Likes</span>
                    <h3 class="card-title mb-2">{{ $totalLikes ?? 0 }}</h3>
                    <small class="text-info fw-semibold">
                        <i class="bx bx-heart"></i> Pada semua berita
                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent News -->
        <div class="col-md-6 col-lg-8 order-0 mb-4">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Berita Terbaru</h5>
                        <small class="text-muted">Berita yang baru dipublikasikan</small>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="recentNews" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="recentNews">
                            <a class="dropdown-item" href="{{ route('news.index') }}">Lihat Semua</a>
                            <a class="dropdown-item" href="{{ route('news.create') }}">Tambah Berita</a>
                        </div>
                    </div>
                </div>
                <div class="card-body my-3">
                    @if (isset($recentNews) && $recentNews->count() > 0)
                        @foreach ($recentNews as $news)
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        @if ($news->image)
                                            <img src="{{ asset('storage/' . $news->image) }}"
                                                class="img-fluid rounded-start h-100"
                                                style="object-fit: cover; min-height: 80px;" alt="{{ $news->title }}">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100 bg-light rounded-start"
                                                style="min-height: 80px;">
                                                <i class="bx bx-image text-muted" style="font-size: 2rem;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body py-2 px-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="card-title mb-1">{{ Str::limit($news->title, 50) }}</h6>
                                                    <p class="card-text">
                                                        <small class="text-muted">
                                                            <i class="bx bx-time-five me-1"></i>
                                                            {{ $news->created_at->diffForHumans() }}
                                                        </small>
                                                    </p>
                                                    <p class="card-text">
                                                        <small class="text-muted">
                                                            {{ Str::limit(strip_tags($news->content), 80) }}
                                                        </small>
                                                    </p>
                                                </div>
                                                <div class="text-end">
                                                    <div class="mb-2">
                                                        <span
                                                            class="badge bg-label-{{ $news->status == 'published' ? 'success' : 'warning' }}">
                                                            {{ $news->status == 'published' ? 'Publish' : 'Draft' }}
                                                        </span>
                                                    </div>
                                                    <div class="d-flex gap-2 text-muted">
                                                        <small>
                                                            <i class="bx bx-like me-1"></i>
                                                            {{ $news->likes_count ?? 0 }}
                                                        </small>
                                                        <small>
                                                            <i class="bx bx-show me-1"></i>
                                                            {{ $news->views ?? 0 }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="bx bx-news bx-lg text-muted"></i>
                            <p class="text-muted mt-2">Belum ada berita</p>
                            <a href="{{ route('news.create') }}" class="btn btn-primary btn-sm">Tambah Berita Pertama</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Complaints -->
        <div class="col-md-6 col-lg-4 order-1 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Pengaduan Terbaru</h5>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="recentComplaints" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="recentComplaints">
                            <a class="dropdown-item" href="{{ route('complaints.index') }}">Lihat Semua</a>
                            <a class="dropdown-item" href="{{ route('complaints.pending') }}">Pengaduan Pending</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (isset($recentComplaints) && $recentComplaints->count() > 0)
                        @foreach ($recentComplaints as $complaint)
                            <div class="d-flex mb-3 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span
                                        class="avatar-initial rounded 
                    @if ($complaint->status == 'pending') bg-label-warning
                    @elseif($complaint->status == 'in_progress') bg-label-info  
                    @elseif($complaint->status == 'resolved') bg-label-success
                    @else bg-label-secondary @endif">
                                        <i class="bx bx-message-dots"></i>
                                    </span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{ Str::limit($complaint->title, 30) }}</h6>
                                        <small class="text-muted">{{ $complaint->user->name ?? 'Anonymous' }}</small>
                                        <br>
                                        <small class="text-muted">{{ $complaint->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="bx bx-message-dots bx-lg text-muted"></i>
                            <p class="text-muted mt-2">Belum ada Pengaduan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Page specific scripts -->
    <script>
        // Dashboard specific JavaScript
        $(document).ready(function() {
            // Auto refresh notifications every 5 minutes
            setInterval(function() {
                // You can add AJAX call to refresh notifications here
            }, 300000);
        });
    </script>
@endpush
