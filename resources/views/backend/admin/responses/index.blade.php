@extends('backend.admin.layouts.app')

@section('title', 'Kelola Tanggapans Pengaduan - Portal Parakan')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Portal Parakan / Tanggapan /</span> Semua Tanggapan Pengaduan
        </h4>
    </div>
@endsection
@section('content')
    <!-- Filter and Search -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('complaint-response.index') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Cari Tanggapan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                placeholder="Judul Tanggapan...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="">Semua Status</option>
                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>
                                Diterima</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="process" {{ request('status') == 'process' ? 'selected' : '' }}>Proses</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal</label>
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
                            <i class="bx bx-file bx-md text-primary"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Total Tanggapan</span>
                            <h3 class="card-title mb-0">{{ $totalResponses ?? 0 }}</h3>
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
                            <i class="bx bx-x-circle bx-md text-danger"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Pending</span>
                            <h3 class="card-title mb-0">{{ $pendingResponses ?? 0 }}</h3>
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
                            <i class="bx bx-edit bx-md text-warning"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Proses</span>
                            <h3 class="card-title mb-0">{{ $processResponses ?? 0 }}</h3>
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
                            <i class="bx bx-check-circle bx-md text-success"></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Selesai</span>
                            <h3 class="card-title mb-0">{{ $resolvedResponses ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bx bx-list-ul me-2"></i>Daftar Tanggapan Tanggapan
                    @if(isset($response->complaint))
                        <span class="badge bg-primary ms-2">{{ $response->complaint->title }}</span>
                    @endif
                </h5>
                <a href="{{ route('complaint-response.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-2"></i>Tambah Tanggapan
                </a>
            </div>
        </div>
        <div class="card-body">
            @if (isset($responses) && $responses->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggapan</th>
                                <th>Penanggap</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($responses as $response)
                                <tr>
                                    <td>
                                        <span class="fw-bold">#{{ $response->id }}</span>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ Str::limit($response->complaint->title ?? 'N/A', 50) }}</strong><br>
                                            <small class="text-muted">ID:
                                                #{{ $response->complaint->id ?? 'N/A' }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-xs me-2">
                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                    {{ substr($response->user->name ?? 'A', 0, 1) }}
                                                </span>
                                            </div>
                                            {{ $response->user->name ?? 'Administrator' }}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($response->status == 'pending')
                                            <span class="badge bg-warning">
                                                <i class="bx bx-time me-1"></i>Pending
                                            </span>
                                        @elseif($response->status == 'process')
                                            <span class="badge bg-info">
                                                <i class="bx bx-loader-circle me-1"></i>Diproses
                                            </span>
                                        @elseif($response->status == 'resolved')
                                            <span class="badge bg-success">
                                                <i class="bx bx-check-circle me-1"></i>Selesai
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            {{ $response->created_at->format('d M Y') }}<br>
                                            <small class="text-muted">{{ $response->created_at->format('H:i') }}</small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('complaint-response.show', $response->id) }}"
                                                class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="bx bx-show"></i>
                                            </a>
                                            <a href="{{ route('complaint-response.edit', $response->id) }}"
                                                class="btn btn-sm btn-outline-secondary" title="Edit">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                onclick="confirmDelete({{ $response->id }})" title="Hapus">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                @if (method_exists($responses, 'links'))
                  <!-- Pagination -->
                  <div class="d-flex justify-content-center mt-3">
                      {{ $responses->links() }}
                  </div>
                  
                @endif
            @else
                <div class="text-center py-5">
                    <i class="bx bx-message-square-x" style="font-size: 4rem; color: #ddd;"></i>
                    <h5 class="mt-3 text-muted">Belum ada tanggapan Tanggapan</h5>
                    <p class="text-muted">Tanggapan Tanggapan akan muncul di sini setelah ditambahkan</p>
                    <a href="{{ route('complaint-response.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus me-2"></i>Tambah Tanggapan Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus tanggapan ini?')) {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/complaint-response/${id}`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
