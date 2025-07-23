@extends('backend.admin.layouts.app')

@section('title', 'Struktur Pemerintahan Desa - Portal Parakan')

@section('page-header')
  <div class="d-flex justify-content-between align-items-center">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Portal Parakan /</span> Struktur Pemerintahan Desa
    </h4>
    <div class="text-muted">
      <small><i class="bx bx-info-circle me-1"></i>Kelola data pejabat desa yang sudah ada</small>
    </div>
  </div>
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
  <li class="breadcrumb-item active">Struktur Pemerintahan Desa</li>
@endsection

@section('content')
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Data Struktur Pemerintahan Desa</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Level</th>
              <th>Departemen</th>
              <th>Kontak</th>
              <th>Urutan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($structures as $structure)
              <tr>
                <td>
                  @if($structure->photo_url)
                    <img src="{{ $structure->photo_url }}" alt="{{ $structure->name }}" 
                         class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                  @else
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-light" 
                         style="width: 40px; height: 40px;">
                      <i class="bx {{ $structure->icon }} text-muted"></i>
                    </div>
                  @endif
                </td>
                <td>
                  <div>
                    <strong>{{ $structure->name }}</strong>
                    @if($structure->email)
                      <br><small class="text-muted">{{ $structure->email }}</small>
                    @endif
                  </div>
                </td>
                <td>{{ $structure->position }}</td>
                <td>
                  <span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $structure->level)) }}</span>
                </td>
                <td>{{ $structure->department ?? '-' }}</td>
                <td>
                  @if($structure->phone)
                    <small>{{ $structure->phone }}</small>
                  @else
                    <small class="text-muted">-</small>
                  @endif
                </td>
                <td>
                  <span class="badge bg-info">{{ $structure->sort_order }}</span>
                </td>
                <td>
                  @if($structure->is_active)
                    <span class="badge bg-success">Aktif</span>
                  @else
                    <span class="badge bg-danger">Tidak Aktif</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('villagestructure.edit', $structure) }}" 
                     class="btn btn-sm btn-primary">
                    <i class="bx bx-edit me-1"></i>Edit
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9" class="text-center">
                  <div class="py-4">
                    <i class="bx bx-user-x fs-1 text-muted"></i>
                    <p class="text-muted mt-2">Belum ada data struktur pemerintahan</p>
                    <small class="text-muted">Data akan tersedia setelah seeder dijalankan</small>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  // Add any custom JavaScript if needed
</script>
@endpush
