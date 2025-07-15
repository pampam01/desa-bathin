@extends('backend.admin.layouts.app')

@section('title', 'Dashboard - Portal Parakan')

@section('page-header')
  <div class="d-flex justify-content-between align-items-center">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Portal Parakan /</span> Dashboard
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
              <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
              <button class="btn p-0" type="button" id="cardOpt2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt2">
                <a class="dropdown-item" href="{{ route('complaints.index') }}">Lihat Semua</a>
                <a class="dropdown-item" href="{{ route('complaints.pending') }}">Keluhan Pending</a>
              </div>
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Total Keluhan</span>
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
              <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                <a class="dropdown-item" href="{{ route('users.index') }}">Lihat Semua</a>
                <a class="dropdown-item" href="{{ route('users.create') }}">Tambah User</a>
              </div>
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Total Pengguna</span>
          <h3 class="card-title mb-2">{{ $totalUsers ?? 0 }}</h3>
          <small class="text-success fw-semibold">
            <i class="bx bx-up-arrow-alt"></i> +{{ $newUsersThisMonth ?? 0 }} bulan ini
          </small>
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
            <button class="btn p-0" type="button" id="recentNews" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="recentNews">
              <a class="dropdown-item" href="{{ route('news.index') }}">Lihat Semua</a>
              <a class="dropdown-item" href="{{ route('news.create') }}">Tambah Berita</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          @if(isset($recentNews) && $recentNews->count() > 0)
            @foreach($recentNews as $news)
              <div class="d-flex justify-content-start align-items-center mb-3">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-primary">
                    <i class="bx bx-news"></i>
                  </span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">{{ $news->title }}</h6>
                    <small class="text-muted">{{ $news->created_at->diffForHumans() }}</small>
                  </div>
                  <div class="user-progress">
                    <small class="fw-semibold">{{ $news->likes_count ?? 0 }} likes</small>
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
          <h5 class="card-title m-0 me-2">Keluhan Terbaru</h5>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="recentComplaints" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="recentComplaints">
              <a class="dropdown-item" href="{{ route('complaints.index') }}">Lihat Semua</a>
              <a class="dropdown-item" href="{{ route('complaints.pending') }}">Keluhan Pending</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          @if(isset($recentComplaints) && $recentComplaints->count() > 0)
            @foreach($recentComplaints as $complaint)
              <div class="d-flex mb-3 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded 
                    @if($complaint->status == 'pending') bg-label-warning
                    @elseif($complaint->status == 'in_progress') bg-label-info  
                    @elseif($complaint->status == 'resolved') bg-label-success
                    @else bg-label-secondary
                    @endif">
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
              <p class="text-muted mt-2">Belum ada keluhan</p>
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
