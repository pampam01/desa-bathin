@extends('backend.admin.layouts.app')

@section('title', 'Kelola Pengguna - Portal Parakan')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Portal Parakan / Pengguna /</span> Semua Pengguna
        </h4>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Tambah Pengguna
        </a>
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Pengguna</a></li>
    <li class="breadcrumb-item active">Semua Pengguna</li>
@endsection

@push('styles')
    <style>
        .user-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .user-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .user-status {
            font-size: 0.75rem;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
        }

        .btn-sm i {
            font-size: 0.875rem;
        }

        .avatar-lg {
            width: 3rem;
            height: 3rem;
        }

        .role-badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
        }
    </style>
@endpush

@section('content')
    <!-- Filter and Search -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('users.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Cari Pengguna</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                placeholder="Nama atau email...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="masyarakat" {{ request('role') == 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Daftar</label>
                        <input type="date" class="form-control" name="date" value="{{ request('date') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-search me-1"></i> Filter
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <i class="bx bx-user bx-md text-primary"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Total Pengguna</span>
                            <h3 class="card-title mb-0">{{ $totalUsers ?? 0 }}</h3>
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
                            <i class="bx bx-shield bx-md text-success"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Admin</span>
                            <h3 class="card-title mb-0">{{ $adminCount ?? 0 }}</h3>
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
                            <i class="bx bx-user-check bx-md text-info"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Masyarakat</span>
                            <h3 class="card-title mb-0">{{ $userCount ?? 0 }}</h3>
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
                            <i class="bx bx-time bx-md text-warning"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Hari Ini</span>
                            <h3 class="card-title mb-0">{{ $todayUsers ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users List -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pengguna</h5>
        </div>
        <div class="card-body">
            @if (isset($users) && $users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Pengguna</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Kontak</th>
                                <th>Bergabung</th>
                                <th width="140">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-3">
                                                @if ($user->avatar)
                                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                                        class="rounded-circle" width="40" height="40"
                                                        style="object-fit: cover;">
                                                @else
                                                    <span class="avatar-initial rounded-circle bg-label-primary">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $user->name }}</h6>
                                                @if ($user->bio)
                                                    <small class="text-muted">{{ Str::limit($user->bio, 50) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">{{ $user->email }}</span>
                                        {{-- @if ($user->email_verified_at)
                                            <i class="bx bx-check-circle text-success ms-1" title="Email Terverifikasi"></i>
                                        @else
                                            <i class="bx bx-x-circle text-danger ms-1" title="Email Belum Terverifikasi"></i>
                                        @endif --}}
                                    </td>
                                    <td>
                                        @if ($user->role == 'admin')
                                            <span class="badge bg-danger role-badge">Admin</span>
                                        @else
                                            <span class="badge bg-info role-badge">Masyarakat</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->phone)
                                            <span class="fw-semibold">{{ $user->phone }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                        @if ($user->address)
                                            <br><small class="text-muted">{{ Str::limit($user->address, 30) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $user->created_at->format('d M Y') }}</small>
                                        <br>
                                        <small class="text-muted">{{ $user->created_at->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('users.show', $user->id) }}"
                                                class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Lihat Detail">
                                                <i class="bx bx-show"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit Pengguna">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            @if ($user->id != auth()->id())
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Pengguna"
                                                    onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if (method_exists($users, 'links'))
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <small class="text-muted">
                                Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }}
                                pengguna
                            </small>
                        </div>
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="bx bx-user bx-lg text-muted mb-3"></i>
                    <h5 class="text-muted">Belum Ada Pengguna</h5>
                    <p class="text-muted">Tambahkan pengguna pertama untuk memulai.</p>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus me-1"></i> Tambah Pengguna Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            const userCheckboxes = document.querySelectorAll('.user-checkbox');

            userCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });

            updateDeleteButton();
        }

        function selectAll() {
            document.getElementById('selectAllCheckbox').checked = true;
            toggleSelectAll();
        }

        function updateDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            const deleteBtn = document.getElementById('deleteSelectedBtn');

            if (checkedBoxes.length > 0) {
                deleteBtn.disabled = false;
                deleteBtn.innerHTML = `<i class="bx bx-trash me-1"></i> Hapus Terpilih (${checkedBoxes.length})`;
            } else {
                deleteBtn.disabled = true;
                deleteBtn.innerHTML = '<i class="bx bx-trash me-1"></i> Hapus Terpilih';
            }
        }

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

        function deleteSelected() {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            const ids = Array.from(checkedBoxes).map(cb => cb.value);

            if (ids.length === 0) {
                console.warn('Tidak ada pengguna yang terpilih untuk dihapus.');
                return;
            }

            showConfirmModal(
                `Apakah Anda yakin ingin menghapus ${ids.length} pengguna terpilih? Tindakan ini tidak dapat dibatalkan.`,
                function() {
                    showLoading();

                    fetch('{{ route('users.multipleDelete') }}', {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                ids: ids
                            })
                        })
                        .then(response => {
                            hideLoading();
                            if (!response.ok) {
                                return response.json().then(errorData => {
                                    throw new Error(errorData.message || 'Terjadi kesalahan pada server.');
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: data.message || 'Pengguna berhasil dihapus.',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!', data.message || 'Gagal menghapus pengguna.', 'error');
                            }
                        })
                        .catch(error => {
                            hideLoading();
                            Swal.fire('Error!', error.message || 'Terjadi kesalahan saat memproses permintaan.',
                                'error');
                            console.error('AJAX Error:', error);
                        });
                }
            );
        }

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endpush
