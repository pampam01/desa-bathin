@extends('backend.admin.layouts.app')

@section('title', 'Profile')

@push('styles')
    <style>
        .profile-user-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .profile-avatar .avatar-img, .profile-avatar .avatar-placeholder {
            border: 4px solid #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        .profile-avatar .online-indicator {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 18px;
            height: 18px;
            background-color: #28c76f;
            border-radius: 50%;
            border: 2px solid #fff;
        }
        .profile-stats h5 {
            font-size: 1.1rem;
            font-weight: 600;
        }
        .list-group-item-action {
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .list-group-item-action i {
            transition: transform 0.2s ease;
        }
        .list-group-item-action:hover i {
            transform: translateX(3px);
        }
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid #e9ecef;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }
        /* Styling untuk tab yang aktif */
        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            background-color: #696cff; /* Sesuaikan dengan warna primer tema */
            box-shadow: 0 2px 4px rgba(105, 108, 255, 0.4);
        }
        /* Styling untuk preview avatar di form */
        .avatar-preview {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border: 2px solid #e9ecef;
        }
    </style>
@endpush

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 fw-bold">Profile Pengguna</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card mb-4">
                <div class="card-body profile-user-card text-center rounded">
                    <div class="profile-avatar mx-auto mb-3" style="width: 120px; position: relative;">
                        @if (auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar"
                                 class="avatar-img rounded-circle" width="120" height="120">
                        @else
                            <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                 style="width: 120px; height: 120px; background-color: #696cff; color: white; font-size: 3rem; font-weight: bold;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="online-indicator"></span>
                    </div>

                    <h4 class="mb-1 text-dark">{{ auth()->user()->name }}</h4>
                    <p class="text-muted mb-2">{{ auth()->user()->email }}</p>
                    
                    @if (auth()->user()->role)
                        <span class="badge rounded-pill bg-label-primary mb-3">
                            <i class="bx bx-user me-1"></i>{{ ucfirst(auth()->user()->role) }}
                        </span>
                    @endif
                </div>
                <div class="card-footer bg-white">
                     <div class="row text-center profile-stats">
                        <div class="col-6">
                            <div class="border-end">
                                <h5 class="mb-1">{{ auth()->user()->created_at->format('d M Y') }}</h5>
                                <p class="text-muted mb-0">Bergabung</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5 class="mb-1">{{ auth()->user()->updated_at->diffForHumans() }}</h5>
                            <p class="text-muted mb-0">Terakhir Update</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bx bx-flash me-1"></i>Aksi Cepat</h5>
                </div>
                <div class="list-group list-group-flush">
                     <a href="#forms-card" class="list-group-item list-group-item-action" onclick="switchTab('profile-tab')">
                        <i class="bx bx-edit me-2"></i>Edit Profile
                    </a>
                    <a href="#forms-card" class="list-group-item list-group-item-action" onclick="switchTab('password-tab')">
                        <i class="bx bx-lock me-2"></i>Ubah Password
                    </a>
                    <a href="{{ route('dashboard.index') }}" class="list-group-item list-group-item-action">
                        <i class="bx bx-home me-2"></i>Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card" id="forms-card">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="pill" data-bs-target="#profile-form-pane" type="button" role="tab">
                                <i class="bx bx-user me-1"></i>Update Profile
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="password-tab" data-bs-toggle="pill" data-bs-target="#password-form-pane" type="button" role="tab">
                                <i class="bx bx-lock me-1"></i>Ubah Password
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profile-form-pane" role="tabpanel">
                             <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="updateProfileForm" novalidate>
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Photo Profile</label>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <img id="avatarPreview" src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=696cff&color=fff' }}" 
                                                 alt="Avatar" class="rounded-circle avatar-preview">
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                                            <div class="invalid-feedback"></div>
                                            <small class="form-text text-muted">Format: JPG, PNG. Maksimal 2MB.</small>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', auth()->user()->address ?? '') }}</textarea>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i>Simpan Perubahan</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="password-form-pane" role="tabpanel">
                            <form action="{{ route('profile.password') }}" method="POST" id="changePasswordForm" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Password Saat Ini <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('current_password')"><i class="bx bx-show"></i></button>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password Baru <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')"><i class="bx bx-show"></i></button>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <small class="form-text text-muted">Minimal 8 karakter.</small>
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                     <div class="input-group">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation')"><i class="bx bx-show"></i></button>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-warning"><i class="bx bx-key me-1"></i>Ubah Password</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        /**
         * Mengganti alert() dengan validasi Bootstrap yang lebih modern.
         * @param {HTMLFormElement} form - Elemen form yang divalidasi.
         * @param {Object} rules - Aturan validasi.
         * @returns {boolean} - True jika valid, false jika tidak.
         */
        function validateForm(form, rules) {
            let isValid = true;
            // Hapus semua pesan error sebelumnya
            form.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
                el.nextElementSibling.textContent = '';
            });

            for (const fieldId in rules) {
                const field = form.querySelector(`#${fieldId}`);
                const feedback = field.nextElementSibling;
                const value = field.value.trim();
                const rule = rules[fieldId];

                if (rule.required && value === '') {
                    isValid = false;
                    field.classList.add('is-invalid');
                    feedback.textContent = 'Field ini wajib diisi.';
                } else if (rule.minLength && value.length < rule.minLength) {
                    isValid = false;
                    field.classList.add('is-invalid');
                    feedback.textContent = `Minimal ${rule.minLength} karakter.`;
                } else if (rule.match && value !== form.querySelector(`#${rule.match}`).value) {
                    isValid = false;
                    field.classList.add('is-invalid');
                    feedback.textContent = 'Konfirmasi password tidak cocok.';
                }
            }
            return isValid;
        }

        /**
         * Menampilkan preview avatar yang akan diunggah.
         * @param {HTMLInputElement} input - Input file.
         */
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => document.getElementById('avatarPreview').src = e.target.result;
                reader.readAsDataURL(input.files[0]);
            }
        }

        /**
         * Mengubah tipe input password (show/hide).
         * @param {string} fieldId - ID dari input password.
         */
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('bx-show', 'bx-hide');
            } else {
                field.type = 'password';
                icon.classList.replace('bx-hide', 'bx-show');
            }
        }
        
        /**
         * Pindah ke tab dan scroll ke form.
         * @param {string} tabId - ID dari tombol tab.
         */
        function switchTab(tabId) {
            const tab = new bootstrap.Tab(document.getElementById(tabId));
            tab.show();
            document.getElementById('forms-card').scrollIntoView({ behavior: 'smooth' });
        }


        document.addEventListener('DOMContentLoaded', function() {
            // Event listener untuk preview avatar
            const avatarInput = document.getElementById('avatar');
            if(avatarInput) avatarInput.addEventListener('change', () => previewAvatar(avatarInput));

            // Event listener untuk form update profile
            const profileForm = document.getElementById('updateProfileForm');
            if (profileForm) {
                profileForm.addEventListener('submit', function(e) {
                    const rules = { name: { required: true }, email: { required: true } };
                    if (!validateForm(this, rules)) {
                        e.preventDefault();
                    } else {
                        const submitBtn = this.querySelector('button[type="submit"]');
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Menyimpan...';
                    }
                });
            }

            // Event listener untuk form ganti password
            const passwordForm = document.getElementById('changePasswordForm');
            if (passwordForm) {
                passwordForm.addEventListener('submit', function(e) {
                     const rules = {
                        current_password: { required: true },
                        password: { required: true, minLength: 8 },
                        password_confirmation: { required: true, match: 'password' }
                    };
                    if (!validateForm(this, rules)) {
                        e.preventDefault();
                    } else {
                         const submitBtn = this.querySelector('button[type="submit"]');
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Mengubah...';
                    }
                });
            }
        });
    </script>
@endpush