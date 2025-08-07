@extends('backend.admin.layouts.app')

@section('title', 'Edit Data Pegawai')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Struktur KUA /</span> Edit Data Pegawai
        </h4>
        <a href="{{ route('villagestructure.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('villagestructure.index') }}">Struktur KUA</a></li>
    <li class="breadcrumb-item active">Edit Pegawai</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Data Pegawai</h5>
                    <small class="text-muted">Perbarui informasi pegawai KUA</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('villagestructure.update', $structure) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">Foto Profil</h6>
                                        <div class="mb-3">
                                            @if ($structure->photo_url)
                                                <img id="photo-preview-container" src="{{ $structure->photo_url }}"
                                                    alt="{{ $structure->name }}" class="rounded-circle img-fluid"
                                                    style="width: 150px; height: 150px; object-fit: cover;">
                                            @else
                                                <div id="photo-preview-container"
                                                    class="d-flex align-items-center justify-content-center rounded-circle bg-secondary mx-auto"
                                                    style="width: 150px; height: 150px;">
                                                    <i class="bx {{ $structure->icon }} text-white fs-1"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                                id="photo" name="photo" accept="image/*"
                                                onchange="previewPhoto(this)">
                                            @error('photo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $structure->name) }}"
                                            required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="position" class="form-label">Jabatan <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('position') is-invalid @enderror"
                                            id="position" name="position"
                                            value="{{ old('position', $structure->position) }}" required readonly>
                                        @error('position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Jabatan tidak dapat diubah dari halaman ini</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="level" class="form-label">Level</label>
                                        <input type="text" class="form-control"
                                            value="{{ ucfirst(str_replace('_', ' ', $structure->level)) }}" readonly>
                                        <small class="text-muted">Level tidak dapat diubah</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="department" class="form-label">Seksi / Bagian</label>
                                        <input type="text" class="form-control @error('department') is-invalid @enderror"
                                            id="department" name="department"
                                            value="{{ old('department', $structure->department) }}">
                                        @error('department')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $structure->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone', $structure->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="sort_order" class="form-label">Urutan Tampil</label>
                                        <input type="number"
                                            class="form-control @error('sort_order') is-invalid @enderror" id="sort_order"
                                            name="sort_order" value="{{ old('sort_order', $structure->sort_order) }}"
                                            min="1">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Urutan pada struktur organisasi</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="is_active" class="form-label">Status</label>
                                        <select class="form-select @error('is_active') is-invalid @enderror"
                                            id="is_active" name="is_active">
                                            <option value="1"
                                                {{ old('is_active', $structure->is_active) == 1 ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="0"
                                                {{ old('is_active', $structure->is_active) == 0 ? 'selected' : '' }}>Tidak
                                                Aktif</option>
                                        </select>
                                        @error('is_active')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="description" class="form-label">Deskripsi/Keterangan</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                            rows="3">{{ old('description', $structure->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Informasi tambahan tentang pegawai (cth: NIP, Golongan, dll.)</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('villagestructure.index') }}" class="btn btn-secondary me-2">
                                        <i class="bx bx-x me-1"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-1"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewPhoto(input) {
            const previewContainer = document.getElementById('photo-preview-container');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    input.value = '';
                    return;
                }

                const allowedTypes = ['image/jpeg', 'image/png'];
                 if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG atau PNG.');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContainer.outerHTML =
                        `<img id="photo-preview-container" src="${e.target.result}" alt="Preview" class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;">`;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush