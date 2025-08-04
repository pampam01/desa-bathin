@extends('backend.admin.layouts.app')

@section('title', 'Detail Pengguna')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Pengguna /</span> Detail Pengguna
        </h4>
        <div class="d-flex gap-2">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                <i class="bx bx-edit me-1"></i> Edit
            </a>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .user-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .user-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .info-card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
        }

        .info-item {
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1.1rem;
            color: #495057;
        }

        .badge-large {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }

        .activity-item {
            padding: 1rem;
            border-left: 3px solid #e9ecef;
            margin-bottom: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .activity-item.news {
            border-left-color: #007bff;
        }

        .activity-item.complaint {
            border-left-color: #ffc107;
        }

        .activity-item.response {
            border-left-color: #28a745;
        }
    </style>
@endpush

@section('content')
    <!-- User Header -->
    <div class="user-header">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="user-avatar">
                @else
                    <div class="user-avatar d-flex align-items-center justify-content-center"
                        style="background: rgba(255,255,255,0.2);">
                        <i class="bx bx-user" style="font-size: 3rem;"></i>
                    </div>
                @endif
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="mb-2 text-white">{{ $user->name }}</h2>
                        <p class="mb-3 opacity-75">{{ $user->email }}</p>
                        @if ($user->bio)
                            <p class="mb-3 opacity-90">{{ $user->bio }}</p>
                        @endif
                    </div>
                    <div class="col-md-4 text-end">
                        @if ($user->role == 'admin')
                            <span class="badge bg-danger badge-large">Admin</span>
                        @else
                            <span class="badge bg-info badge-large">Masyarakat</span>
                        @endif
                        <div class="mt-3">
                            @if ($user->email_verified_at)
                                <span class="badge bg-success">
                                    <i class="bx bx-check-circle me-1"></i> Terverifikasi
                                </span>
                            @else
                                <span class="badge bg-warning">
                                    <i class="bx bx-x-circle me-1"></i> Belum Terverifikasi
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Personal Information -->
        <div class="col-md-8">
            <div class="card info-card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bx bx-user me-2"></i>Informasi Personal</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Nama Lengkap</div>
                                <div class="info-value">{{ $user->name }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Email</div>
                                <div class="info-value">
                                    {{ $user->email }}
                                    @if ($user->email_verified_at)
                                        <i class="bx bx-check-circle text-success ms-2" title="Terverifikasi"></i>
                                    @else
                                        <i class="bx bx-x-circle text-danger ms-2" title="Belum Terverifikasi"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Nomor Telepon</div>
                                <div class="info-value">{{ $user->phone ?: '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">Role</div>
                                <div class="info-value">
                                    @if ($user->role == 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @else
                                        <span class="badge bg-info">Masyarakat</span>
                                    @endif
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Bergabung Sejak</div>
                                <div class="info-value">{{ $user->created_at->format('d M Y, H:i') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Terakhir Diperbarui</div>
                                <div class="info-value">{{ $user->updated_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                    </div>

                    @if ($user->address)
                        <div class="info-item">
                            <div class="info-label">Alamat</div>
                            <div class="info-value">{{ $user->address }}</div>
                        </div>
                    @endif

                    @if ($user->bio)
                        <div class="info-item">
                            <div class="info-label">Bio</div>
                            <div class="info-value">{{ $user->bio }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Activity/Statistics -->
            <div class="card info-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bx bx-chart me-2"></i>Statistik Aktivitas</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="p-3">
                                <i class="bx bx-news bx-lg text-primary mb-2"></i>
                                <h4 class="mb-1">{{ $user->news()->count() }}</h4>
                                <small class="text-muted">Berita</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3">
                                <i class="bx bx-message-square-detail bx-lg text-warning mb-2"></i>
                                <h4 class="mb-1">{{ $user->complaints()->count() ?? 0 }}</h4>
                                <small class="text-muted">Keluhan</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3">
                                <i class="bx bx-heart bx-lg text-danger mb-2"></i>
                                <h4 class="mb-1">0</h4>
                                <small class="text-muted">Total Likes</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Quick Actions -->
            <div class="card info-card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bx bx-cog me-2"></i>Tindakan Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                            <i class="bx bx-edit me-1"></i> Edit Pengguna
                        </a>
                        @if ($user->id != auth()->id())
                            <button class="btn btn-outline-danger"
                                onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                <i class="bx bx-trash me-1"></i> Hapus Pengguna
                            </button>
                        @endif
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card info-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bx bx-time me-2"></i>Aktivitas Terbaru</h5>
                </div>
                <div class="card-body">
                    @php
                        $recentNews = $user->news()->latest()->take(3)->get();
                        $hasActivity = $recentNews->count() > 0;
                    @endphp

                    @if ($hasActivity)
                        @foreach ($recentNews as $news)
                            <div class="activity-item news">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <small class="text-muted">{{ $news->created_at->diffForHumans() }}</small>
                                        <h6 class="mb-1">{{ Str::limit($news->title, 50) }}</h6>
                                        <small class="text-muted">Berita • {{ $news->status }}</small>
                                    </div>
                                    <i class="bx bx-news text-primary"></i>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="bx bx-time bx-lg text-muted mb-2"></i>
                            <p class="text-muted">Belum ada aktivitas terbaru</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(id, name) {
            showConfirmModal(
                `Apakah Anda yakin ingin menghapus pengguna "${name}"? Tindakan ini tidak dapat dibatalkan.`,
                function() {
                    // Create form and submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/users/${id}`;

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
