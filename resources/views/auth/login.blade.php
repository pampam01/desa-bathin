@extends('auth.layouts.app')

@section('title', 'Login | Portal Parakan')

@section('content')
<div class="card">
  <div class="card-body">
    <!-- Logo -->
    {{-- @include('auth.partials.logo') --}}
    <!-- /Logo -->
    
    <h4 class="mb-2">Selamat Datang di Portal Parakan! 👋</h4>
    <p class="mb-4">Silakan masuk ke akun Anda untuk mengakses layanan desa</p>

    <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
      @csrf
      
      <!-- Display validation errors -->
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Display session messages -->
      @if(session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      <div class="mb-3">
        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
        <input
          type="email"
          class="form-control @error('email') is-invalid @enderror"
          id="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="Masukkan email Anda"
          required
          autofocus
        />
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3 form-password-toggle">
        <div class="d-flex justify-content-between">
          <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
          <a href="{{ route('password.request') }}" class="text-decoration-none">
            <small>Lupa Password?</small>
          </a>
        </div>
        <div class="input-group input-group-merge">
          <input
            type="password"
            id="password"
            class="form-control @error('password') is-invalid @enderror"
            name="password"
            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
            required
          />
          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
          <label class="form-check-label" for="remember">
            Ingat saya
          </label>
        </div>
      </div>

      <div class="mb-3">
        <button class="btn btn-primary d-grid w-100" type="submit">
          Masuk
        </button>
      </div>
    </form>

    <p class="text-center">
      <span>Belum punya akun?</span>
      <a href="{{ route('register') }}" class="text-decoration-none fw-bolder">
        <span>Daftar di sini</span>
      </a>
    </p>
  </div>
</div>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality
    const passwordToggle = document.querySelector('.form-password-toggle .input-group-text');
    const passwordInput = document.getElementById('password');
    const toggleIcon = passwordToggle.querySelector('i');
    
    passwordToggle.addEventListener('click', function() {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bx-hide');
        toggleIcon.classList.add('bx-show');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bx-show');
        toggleIcon.classList.add('bx-hide');
      }
    });
  });
</script>
@endsection
