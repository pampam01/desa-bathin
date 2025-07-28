@extends('backend.admin.layouts.app')

@section('title', 'Edit Pengguna')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Pengguna /</span> Edit Pengguna
        </h4>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Pengguna</a></li>
    <li class="breadcrumb-item active">Edit Pengguna</li>
@endsection

@push('styles')
    <style>
        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #dee2e6;
        }

        .drag-drop-area {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .drag-drop-area:hover,
        .drag-drop-area.dragover {
            border-color: #696cff;
            background-color: #f8f9ff;
        }

        .drag-drop-area.dragover {
            transform: scale(1.02);
        }

        .password-strength {
            margin-top: 5px;
        }

        .password-strength .strength-bar {
            height: 4px;
            background-color: #e9ecef;
            border-radius: 2px;
            overflow: hidden;
        }

        .password-strength .strength-fill {
            height: 100%;
            transition: width 0.3s ease;
        }

        .strength-weak {
            background-color: #dc3545;
        }

        .strength-medium {
            background-color: #ffc107;
        }

        .strength-strong {
            background-color: #28a745;
        }
    </style>
@endpush

@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" id="userForm">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-8">
                <!-- Basic Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-user me-2"></i>Informasi Dasar</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $user->name) }}"
                                    placeholder="Masukkan nama lengkap..." required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $user->email) }}"
                                    placeholder="user@example.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Nomor Telepon</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                                    placeholder="08123456789">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role"
                                    name="role" required>
                                    <option value="">Pilih Role</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                        Admin</option>
                                    <option value="masyarakat"
                                        {{ old('role', $user->role) == 'masyarakat' ? 'selected' : '' }}>Masyarakat
                                    </option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="col-12 mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                    placeholder="Masukkan alamat lengkap...">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Bio -->
                            <div class="col-12 mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3"
                                    placeholder="Tulis bio singkat...">{{ old('bio', $user->bio) }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Bio akan ditampilkan di profil pengguna</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-shield me-2"></i>Keamanan</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="bx bx-info-circle me-2"></i>
                            Kosongkan password jika tidak ingin mengubah password
                        </div>
                        <div class="row">
                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Masukkan password baru...">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="bx bx-hide"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="password-strength mt-2" style="display: none;">
                                    <div class="strength-bar">
                                        <div class="strength-fill" id="strengthFill"></div>
                                    </div>
                                    <small class="text-muted" id="strengthText">Minimal 8 karakter</small>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Konfirmasi password baru...">
                                    <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
                                        <i class="bx bx-hide"></i>
                                    </button>
                                </div>
                                <small class="text-muted" id="passwordMatch"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Avatar -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-image me-2"></i>Avatar</h5>
                    </div>
                    <div class="card-body text-center">
                        @if ($user->avatar)
                            <!-- Current Avatar -->
                            <div class="mb-3">
                                <label class="form-label">Avatar Saat Ini</label>
                                <div class="current-avatar-preview">
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar"
                                        class="avatar-preview mb-2" id="avatarPreview">
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            {{-- <img id="avatarPreview" 
                                 src="{{ $user->avatar ? asset('storage/' . $user->avatar) : '' }}"
                                 alt="Avatar Preview" class="avatar-preview"> --}}
                        </div>

                        <div class="drag-drop-area" id="dragDropArea">
                            <i class="bx bx-cloud-upload bx-lg text-primary mb-2"></i>
                            <p class="mb-2">Seret & lepas gambar di sini</p>
                            <p class="text-muted mb-3">atau</p>
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                onclick="document.getElementById('avatar').click()">
                                {{ $user->avatar ? 'Ganti Avatar' : 'Pilih Avatar' }}
                            </button>
                        </div>

                        <input type="file" class="form-control d-none @error('avatar') is-invalid @enderror"
                            id="avatar" name="avatar" accept="image/*" onchange="previewAvatar(this)">

                        <!-- Hidden field to track avatar removal -->
                        <input type="hidden" id="remove_avatar" name="remove_avatar" value="0">

                        @error('avatar')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <div class="form-text">Format: JPG, PNG, WebP. Maksimal 2MB</div>

                        <div class="mt-3 d-none" id="avatarActions">
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeAvatar()">
                                <i class="bx bx-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>

                <!-- User Info -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-info-circle me-2"></i>Informasi Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Bergabung Sejak</label>
                            <p class="text-muted mb-0">{{ $user->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Terakhir Diperbarui</label>
                            <p class="text-muted mb-0">{{ $user->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                        @if ($user->email_verified_at)
                            <div class="mb-3">
                                <label class="form-label">Email Terverifikasi</label>
                                <p class="text-success mb-0">
                                    <i class="bx bx-check-circle me-1"></i>
                                    {{ $user->email_verified_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        @else
                            <div class="mb-3">
                                <label class="form-label">Status Email</label>
                                <p class="text-warning mb-0">
                                    <i class="bx bx-x-circle me-1"></i>
                                    Belum terverifikasi
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-cog me-2"></i>Aksi</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i> Update Pengguna
                            </button>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-danger">
                                <i class="bx bx-x me-1"></i> Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Phone number formatting
            $('#phone').on('input', function() {
                let value = $(this).val().replace(/[^\d]/g, '');
                if (value.startsWith('0')) {
                    value = value.substring(1);
                }
                if (value.length > 0) {
                    value = '0' + value;
                }
                $(this).val(value);
            });

            // Character counter for bio
            $('#bio').on('input', function() {
                const maxLength = 1000;
                const currentLength = $(this).val().length;
                const remaining = maxLength - currentLength;

                let counter = $('#bio').siblings('.char-counter');
                if (counter.length === 0) {
                    counter = $('<div class="char-counter form-text"></div>');
                    $('#bio').after(counter);
                }

                counter.text(`${currentLength}/${maxLength} karakter`);
                counter.toggleClass('text-danger', remaining < 0);
            });
        });

        // Password toggle
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('bx-hide');
                icon.classList.add('bx-show');
            } else {
                password.type = 'password';
                icon.classList.remove('bx-show');
                icon.classList.add('bx-hide');
            }
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const password = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('bx-hide');
                icon.classList.add('bx-show');
            } else {
                password.type = 'password';
                icon.classList.remove('bx-show');
                icon.classList.add('bx-hide');
            }
        });

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthContainer = document.querySelector('.password-strength');
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');

            if (password.length > 0) {
                strengthContainer.style.display = 'block';

                let strength = 0;
                let text = '';

                if (password.length >= 8) strength++;
                if (password.match(/[a-z]/)) strength++;
                if (password.match(/[A-Z]/)) strength++;
                if (password.match(/[0-9]/)) strength++;
                if (password.match(/[^a-zA-Z0-9]/)) strength++;

                switch (strength) {
                    case 0:
                    case 1:
                        strengthFill.style.width = '20%';
                        strengthFill.className = 'strength-fill strength-weak';
                        text = 'Sangat lemah';
                        break;
                    case 2:
                        strengthFill.style.width = '40%';
                        strengthFill.className = 'strength-fill strength-weak';
                        text = 'Lemah';
                        break;
                    case 3:
                        strengthFill.style.width = '60%';
                        strengthFill.className = 'strength-fill strength-medium';
                        text = 'Sedang';
                        break;
                    case 4:
                        strengthFill.style.width = '80%';
                        strengthFill.className = 'strength-fill strength-strong';
                        text = 'Kuat';
                        break;
                    case 5:
                        strengthFill.style.width = '100%';
                        strengthFill.className = 'strength-fill strength-strong';
                        text = 'Sangat kuat';
                        break;
                }

                strengthText.textContent = text;
            } else {
                strengthContainer.style.display = 'none';
            }
        });

        // Password confirmation check
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            const matchText = document.getElementById('passwordMatch');

            if (confirmPassword) {
                if (password === confirmPassword) {
                    matchText.textContent = 'Password cocok';
                    matchText.className = 'text-success';
                } else {
                    matchText.textContent = 'Password tidak cocok';
                    matchText.className = 'text-danger';
                }
            } else {
                matchText.textContent = '';
            }
        });

        // Drag and Drop for avatar
        const dragDropArea = document.getElementById('dragDropArea');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dragDropArea.addEventListener(eventName, preventDefaults, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dragDropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dragDropArea.addEventListener(eventName, unhighlight, false);
        });

        dragDropArea.addEventListener('drop', handleDrop, false);

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight(e) {
            dragDropArea.classList.add('dragover');
        }

        function unhighlight(e) {
            dragDropArea.classList.remove('dragover');
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                document.getElementById('avatar').files = files;
                previewAvatar(document.getElementById('avatar'));
            }
        }

        // Avatar preview
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                    document.getElementById('avatarActions').classList.remove('d-none');
                    document.getElementById('dragDropArea').style.display = 'none';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeAvatar() {
            document.getElementById('avatar').value = '';
            document.getElementById('avatarPreview').src =
                "data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiByeD0iNTAiIGZpbGw9IiNmOGY5ZmEiLz4KPHN2ZyB4PSIyNSIgeT0iMjUiIHdpZHRoPSI1MCIgaGVpZ2h0PSI1MCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiM2Yzc1N2QiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj4KPHBhdGggZD0iTTIwIDIxdi0yYTQgNCAwIDAgMC00LTRIOGE0IDQgMCAwIDAtNCA0djIiLz4KPGNpcmNsZSBjeD0iMTIiIGN5PSI3IiByPSI0Ii8+Cjwvc3ZnPgo8L3N2Zz4K";
            document.getElementById('avatarActions').classList.add('d-none');
            document.getElementById('dragDropArea').style.display = 'block';
        }

        function removeCurrentAvatar() {
            document.getElementById('remove_avatar').value = '1';
            document.querySelector('.current-avatar-preview').style.display = 'none';
            document.getElementById('dragDropArea').style.display = 'block';
        }

        // Form validation
        document.getElementById('userForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password && confirmPassword) {
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Password dan konfirmasi password tidak cocok!');
                    return;
                }

                if (password.length < 8) {
                    e.preventDefault();
                    alert('Password harus minimal 8 karakter!');
                    return;
                }
            }

            showLoading();
        });
    </script>
@endpush
