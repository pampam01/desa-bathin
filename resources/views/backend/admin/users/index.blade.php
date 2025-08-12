@extends('backend.admin.layouts.app')

@section('title', 'Kelola Pengguna')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen /</span> Semua Pengguna
        </h4>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Tambah Pengguna
        </a>
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Semua Pengguna</li>
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
        .avatar-initial {
            font-weight: 600;
        }
        .role-badge {
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
            <h5 class="card-title mb-0"><i class="bx bx-filter-alt me-1"></i>Filter Pengguna</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('users.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Cari</label>
                        <div class="input-group input-group-merge">
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
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-user fs-3"></i></span>
                    </div>
                    <h4 class="mb-1">{{ $totalUsers ?? 0 }}</h4>
                    <span class="fw-semibold">Total Pengguna</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-shield fs-3"></i></span>
                    </div>
                    <h4 class="mb-1">{{ $adminCount ?? 0 }}</h4>
                    <span class="fw-semibold">Admin</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-info"><i class="bx bx-group fs-3"></i></span>
                    </div>
                    <h4 class="mb-1">{{ $userCount ?? 0 }}</h4>
                    <span class="fw-semibold">Masyarakat</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-label-warning"><i class="bx bx-user-plus fs-3"></i></span>
                    </div>
                    <h4 class="mb-1">{{ $todayUsers ?? 0 }}</h4>
                    <span class="fw-semibold">Bergabung Hari Ini</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pengguna</h5>
            {{-- Menambahkan tombol aksi massal yang scriptnya sudah ada --}}
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary btn-sm" onclick="selectAll()">
                    <i class="bx bx-check-square me-1"></i> Pilih Semua
                </button>
                <button class="btn btn-outline-danger btn-sm" id="deleteSelectedBtn" disabled>
                    <i class="bx bx-trash me-1"></i> Hapus Terpilih
                </button>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            @if (isset($users) && $users->count() > 0)
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            {{-- Menambahkan checkbox untuk aksi massal --}}
                            <th class="text-center" width="50"><input type="checkbox" class="form-check-input" id="selectAllCheckbox"></th>
                            <th>Pengguna</th>
                            <th>Role & Status</th>
                            <th>Kontak</th>
                            <th>Bergabung</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr>
                                {{-- Menambahkan checkbox untuk aksi massal --}}
                                <td class="text-center"><input type="checkbox" class="form-check-input user-checkbox" value="{{ $user->id }}"></td>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="avatar-wrapper">
                                            <div class="avatar avatar-lg me-3">
                                                @if ($user->avatar)
                                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle" style="object-fit: cover;">
                                                @else
                                                    <span class="avatar-initial rounded-circle bg-label-primary">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold">{{ $user->name }}</span>
                                            <small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($user->role == 'admin')
                                        <span class="badge bg-label-success role-badge">Admin</span>
                                    @else
                                        <span class="badge bg-label-info role-badge">Masyarakat</span>
                                    @endif
                                    {{-- Mengaktifkan tampilan status verifikasi email --}}
                                    @if ($user->email_verified_at)
                                        <i class="bx bx-check-circle text-success ms-1" data-bs-toggle="tooltip" title="Email Terverifikasi"></i>
                                    @else
                                        <i class="bx bx-time-five text-warning ms-1" data-bs-toggle="tooltip" title="Email Belum Terverifikasi"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->phone)
                                        <span class="fw-semibold">{{ $user->phone }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="d-block">{{ $user->created_at->format('d M Y') }}</span>
                                    <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-icon btn-outline-info" data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="tooltip" title="Edit Pengguna">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        @if ($user->id != auth()->id())
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger" data-bs-toggle="tooltip" title="Hapus Pengguna"
                                                onclick="confirmDelete({{ $user->id }}, '{{ addslashes($user->name) }}')">
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
                    <i class="bx bx-user-x fs-1 text-muted mb-3"></i>
                    <h5 class="text-muted">Belum Ada Pengguna</h5>
                    <p class="text-muted">Tidak ada data pengguna yang cocok dengan filter Anda.</p>
                    <a href="{{ route('users.create') }}" class="btn btn-primary mt-2">
                        <i class="bx bx-plus me-1"></i> Tambah Pengguna Pertama
                    </a>
                </div>
            @endif
        </div>
        @if (isset($users) && $users->total() > 0 && method_exists($users, 'links'))
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} pengguna
                </small>
                <div>{{ $users->appends(request()->query())->links() }}</div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Tooltip
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            const userCheckboxes = document.querySelectorAll('.user-checkbox');
            const deleteBtn = document.getElementById('deleteSelectedBtn');

            if (selectAllCheckbox && deleteBtn) {
                // Event listener untuk checkbox "pilih semua"
                selectAllCheckbox.addEventListener('change', function() {
                    userCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateDeleteButton();
                });

                // Event listener untuk setiap checkbox pengguna
                userCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateDeleteButton);
                });
                
                // Panggil sekali saat load untuk inisialisasi
                updateDeleteButton();
            }
        });

        function updateDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            const deleteBtn = document.getElementById('deleteSelectedBtn');
            if (deleteBtn) {
                if (checkedBoxes.length > 0) {
                    deleteBtn.disabled = false;
                    deleteBtn.innerHTML = `<i class="bx bx-trash me-1"></i> Hapus (${checkedBoxes.length}) Terpilih`;
                } else {
                    deleteBtn.disabled = true;
                    deleteBtn.innerHTML = '<i class="bx bx-trash me-1"></i> Hapus Terpilih';
                }
            }
        }
        
        function selectAll() {
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            if(selectAllCheckbox) {
                selectAllCheckbox.checked = !selectAllCheckbox.checked;
                selectAllCheckbox.dispatchEvent(new Event('change'));
            }
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Anda Yakin?',
                html: `Anda akan menghapus pengguna: <br><b>"${name}"</b>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: { confirmButton: 'btn btn-danger', cancelButton: 'btn btn-secondary ms-2' },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ url('users') }}/${id}`;
                    form.innerHTML = `@method('DELETE') @csrf`;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function deleteSelected() {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            const ids = Array.from(checkedBoxes).map(cb => cb.value);

            if (ids.length === 0) return;

            Swal.fire({
                title: 'Anda Yakin?',
                text: `Anda akan menghapus ${ids.length} pengguna terpilih. Tindakan ini tidak dapat dibatalkan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Semua!',
                cancelButtonText: 'Batal',
                customClass: { confirmButton: 'btn btn-danger', cancelButton: 'btn btn-secondary ms-2' },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('{{ route("users.multipleDelete") }}', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ ids: ids })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 2000, showConfirmButton: false })
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Gagal!', data.message || 'Terjadi kesalahan.', 'error');
                        }
                    })
                    .catch(error => Swal.fire('Error!', 'Tidak dapat terhubung ke server.', 'error'));
                }
            });
        }
    </script>
@endpush