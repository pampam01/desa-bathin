@extends('auth.layouts.app')

@section('title', 'Registrasi')

@section('heading', 'Daftar Akun Pusat Pengaduan!')

@section('subheading', 'Bergabunglah dengan sistem informasi untuk mendapatkan layanan terbaik!')

@section('content')
    <form id="formAuthentication" class="mb-3" action="{{ route('register.store') }}" method="POST">
        @csrf

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Success message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda" required autofocus />
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" placeholder="contoh@email.com" required />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" required />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">
                <small>Password minimal 8 karakter, kombinasi huruf dan angka</small>
            </div>
        </div>

        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password_confirmation">Konfirmasi Password <span
                    class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password_confirmation" required />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required />
                <label class="form-check-label" for="terms-conditions">
                    Saya setuju dengan
                    <a href="{{ route('terms') }}" target="_blank">syarat dan ketentuan</a>
                    serta
                    <a href="{{ route('privacy') }}" target="_blank">kebijakan privasi</a>
                </label>
            </div>
        </div>

        <button class="btn btn-primary d-grid w-100" type="submit">
            Daftar Sekarang
        </button>
    </form>
@endsection

@section('footer-links')
    <p class="text-center">
        <span>Sudah punya akun?</span>
        <a href="{{ route('login') }}">
            <span>Masuk di sini</span>
        </a>
    </p>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password confirmation validation
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');

            function validatePassword() {
                if (password.value !== passwordConfirmation.value) {
                    passwordConfirmation.setCustomValidity('Password tidak cocok');
                } else {
                    passwordConfirmation.setCustomValidity('');
                }
            }

            password.addEventListener('input', validatePassword);
            passwordConfirmation.addEventListener('input', validatePassword);

            // Form submission validation
            document.getElementById('formAuthentication').addEventListener('submit', function(e) {
                const termsCheckbox = document.getElementById('terms-conditions');
                if (!termsCheckbox.checked) {
                    e.preventDefault();
                    alert('Anda harus menyetujui syarat dan ketentuan untuk melanjutkan');
                    return;
                }
            });

            // Real-time validation feedback
            const inputs = document.querySelectorAll('input[required]');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.validity.valid) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                    }
                });
            });
        });
    </script>
@endpush
