@extends('backend.admin.layouts.app')

@section('title', 'Profile')

@section('content')
    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Profile Pengguna</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="row">
        <!-- Profile Information -->
        <div class="col-xl-4 col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <!-- Profile Avatar -->
                        <div class="profile-avatar mb-4">
                            @if (auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar"
                                    class="avatar-img rounded-circle" width="120" height="120"
                                    style="object-fit: cover;">
                            @else
                                <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                    style="width: 120px; height: 120px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: 2.5rem; font-weight: bold;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <!-- Profile Info -->
                        <h4 class="mb-1">{{ auth()->user()->name }}</h4>
                        <p class="text-muted mb-2">{{ auth()->user()->email }}</p>

                        @if (auth()->user()->role)
                            <span class="badge bg-primary mb-3">
                                <i class="bx bx-user me-1"></i>
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        @endif

                        <!-- Profile Stats -->
                        <div class="row text-center mt-4">
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
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bx bx-flash me-2"></i>Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary" onclick="scrollToSection('profile-form')">
                            <i class="bx bx-edit me-2"></i>Edit Profile
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="scrollToSection('password-form')">
                            <i class="bx bx-lock me-2"></i>Ubah Password
                        </button>
                        <a href="{{ route('dashboard.index') }}" class="btn btn-outline-success">
                            <i class="bx bx-home me-2"></i>Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Forms -->
        <div class="col-xl-8 col-lg-7">
            <!-- Update Profile Form -->
            <div class="card mb-4" id="profile-form">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bx bx-user me-2"></i>Update Profile
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                        id="updateProfileForm">
                        @csrf
                        @method('PUT')

                        <!-- Avatar Upload -->
                        <div class="mb-4">
                            <label class="form-label">Photo Profile</label>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    @if (auth()->user()->avatar)
                                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Current Avatar"
                                            class="rounded-circle" width="60" height="60" style="object-fit: cover;"
                                            id="currentAvatar">
                                    @else
                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px; background: #f8f9fa; color: #6c757d; font-size: 1.5rem;"
                                            id="currentAvatar">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                        id="avatar" name="avatar" accept="image/*" onchange="previewAvatar(this)">
                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Format: JPG, PNG, GIF. Maksimal 2MB.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                        required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Phone -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone"
                                        value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                        placeholder="08xxxxxxxxxx">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Role (Read Only) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <input type="text" class="form-control-plaintext" id="role"
                                        value="{{ ucfirst(auth()->user()->role ?? 'User') }}" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                placeholder="Masukkan alamat lengkap">{{ old('address', auth()->user()->address ?? '') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bio -->
                        <div class="mb-4">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3"
                                placeholder="Ceritakan tentang diri Anda">{{ old('bio', auth()->user()->bio ?? '') }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-2"></i>Simpan Perubahan
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bx bx-reset me-2"></i>Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Change Password Form -->
            <div class="card" id="password-form">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bx bx-lock me-2"></i>Ubah Password
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.password') }}" method="POST" id="changePasswordForm">
                        @csrf
                        @method('PUT')

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password" required>
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="togglePassword('current_password')">
                                    <i class="bx bx-show" id="current_password_icon"></i>
                                </button>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required>
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="togglePassword('password')">
                                    <i class="bx bx-show" id="password_icon"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                Password minimal 8 karakter, kombinasi huruf, angka, dan simbol.
                            </small>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="togglePassword('password_confirmation')">
                                    <i class="bx bx-show" id="password_confirmation_icon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="bx bx-key me-2"></i>Ubah Password
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bx bx-reset me-2"></i>Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .profile-avatar {
            position: relative;
        }

        .avatar-img {
            border: 4px solid #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .avatar-placeholder {
            border: 4px solid #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #667eea 100%);
            transform: translateY(-1px);
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .input-group .btn {
            z-index: 3;
        }

        .scroll-smooth {
            scroll-behavior: smooth;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Preview avatar before upload
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const currentAvatar = document.getElementById('currentAvatar');
                    currentAvatar.innerHTML =
                        `<img src="${e.target.result}" alt="Preview" class="rounded-circle" width="60" height="60" style="object-fit: cover;">`;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '_icon');

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bx-show');
                icon.classList.add('bx-hide');
            } else {
                field.type = 'password';
                icon.classList.remove('bx-hide');
                icon.classList.add('bx-show');
            }
        }

        // Smooth scroll to section
        function scrollToSection(sectionId) {
            document.getElementById(sectionId).scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Form validation
        document.getElementById('updateProfileForm').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();

            if (!name) {
                e.preventDefault();
                alert('Nama lengkap wajib diisi');
                return;
            }

            if (!email) {
                e.preventDefault();
                alert('Email wajib diisi');
                return;
            }

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i>Menyimpan...';
        });

        // Password form validation
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            const currentPassword = document.getElementById('current_password').value;
            const newPassword = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (!currentPassword || !newPassword || !confirmPassword) {
                e.preventDefault();
                alert('Semua field password wajib diisi');
                return;
            }

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Password baru dan konfirmasi password tidak cocok');
                return;
            }

            if (newPassword.length < 8) {
                e.preventDefault();
                alert('Password minimal 8 karakter');
                return;
            }

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i>Mengubah Password...';
        });

        // Auto-resize textarea
        document.querySelectorAll('textarea').forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });
    </script>
@endsection
