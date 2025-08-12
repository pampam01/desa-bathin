@extends('backend.admin.layouts.app')

@section('title', 'Dashboard')

@section('page-header')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Dashboard
    </h4>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Statistik Website</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-3 col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar me-3">
                                    <div class="avatar-initial bg-label-primary rounded-3">
                                        <i class="bx bx-news bx-sm"></i>
                                    </div>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Total Berita</h6>
                                        <small class="text-muted">+{{ $newNewsThisMonth ?? 0 }} bulan ini</small>
                                    </div>
                                    <div class="user-progress">
                                        <h5 class="mb-0">{{ $totalNews ?? 0 }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar me-3">
                                    <div class="avatar-initial bg-label-warning rounded-3">
                                        <i class="bx bx-message-dots bx-sm"></i>
                                    </div>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Total Pengaduan</h6>
                                        <small class="text-muted">{{ $pendingComplaints ?? 0 }} menunggu</small>
                                    </div>
                                    <div class="user-progress">
                                        <h5 class="mb-0">{{ $totalComplaints ?? 0 }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar me-3">
                                    <div class="avatar-initial bg-label-success rounded-3">
                                        <i class="bx bx-user bx-sm"></i>
                                    </div>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    @if (Auth::user()->role === 'admin')
                                        <div class="me-2">
                                            <h6 class="mb-0">Total Pengguna</h6>
                                            <small class="text-muted">+{{ $newUsersThisMonth ?? 0 }} bulan ini</small>
                                        </div>
                                        <div class="user-progress">
                                            <h5 class="mb-0">{{ $totalUsers ?? 0 }}</h5>
                                        </div>
                                    @else
                                        <div class="me-2">
                                            <h6 class="mb-0">Pengajuan Surat</h6>
                                            <small class="text-muted">+{{ $newMailSubmissionsThisMonth ?? 0 }} bulan ini</small>
                                        </div>
                                        <div class="user-progress">
                                            <h5 class="mb-0">{{ $totalMailSubmissions ?? 0 }}</h5>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar me-3">
                                    <div class="avatar-initial bg-label-info rounded-3">
                                        <i class="bx bx-like bx-sm"></i>
                                    </div>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Total Likes</h6>
                                        <small class="text-muted">Pada semua berita</small>
                                    </div>
                                    <div class="user-progress">
                                        <h5 class="mb-0">{{-- Variabel untuk total likes --}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row">
                <div class="col-md-8 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Berita Terbaru</h5>
                            <a href="{{ route('news.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                            @if (isset($recentNews) && $recentNews->count() > 0)
                                <ul class="p-0 m-0">
                                    @foreach ($recentNews as $news)
                                        <li class="d-flex mb-4 pb-1">
                                            <div class="avatar flex-shrink-0 me-3">
                                                @if ($news->image)
                                                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-image"></i></span>
                                                @endif
                                            </div>
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-1 text-primary"><a href="#">{{ Str::limit($news->title, 60) }}</a></h6>
                                                    <small class="text-muted d-block">{{ Str::limit(strip_tags($news->content), 80) }}</small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-3">
                                                    <small class="text-muted"><i class="bx bx-time-five me-1"></i>{{ $news->created_at->diffForHumans() }}</small>
                                                    <span class="badge bg-label-{{ $news->status == 'published' ? 'success' : 'warning' }}">{{ $news->status == 'published' ? 'Publish' : 'Draft' }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
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

                <div class="col-md-4 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Pengaduan Terbaru</h5>
                            <a href="{{ route('complaints.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                             @if (isset($recentComplaints) && $recentComplaints->count() > 0)
                                <ul class="p-0 m-0">
                                    @foreach ($recentComplaints as $complaint)
                                        <li class="d-flex mb-4 pb-1">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-message-error"></i></span>
                                            </div>
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-1">{{ Str::limit($complaint->title, 30) }}</h6>
                                                    <small class="text-muted">{{ $complaint->user->name ?? 'Anonymous' }}</small>
                                                </div>
                                                <div class="user-progress">
                                                     <small class="text-muted">{{ $complaint->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
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
        </div>
    </div>
@endsection