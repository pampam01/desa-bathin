# Backend Layout Documentation

## Struktur Partial

Berikut adalah struktur partial yang telah dibuat untuk backend Portal Parakan:

```
resources/views/backend/
├── layouts/
│   ├── app.blade.php          # Layout utama (menggabungkan semua partial)
│   └── main.blade.php         # File asli (untuk backup)
├── partials/
│   ├── head.blade.php         # HTML head, meta tags, CSS
│   ├── sidebar.blade.php      # Menu sidebar/navigasi samping
│   ├── navbar.blade.php       # Top navigation bar
│   ├── footer.blade.php       # Footer content
│   ├── scripts.blade.php      # JavaScript files
│   ├── alerts.blade.php       # Flash messages dan error handling
│   └── modals.blade.php       # Modal components dan global JS functions
└── dashboard.blade.php        # Contoh penggunaan layout
```

## Cara Penggunaan

### 1. Menggunakan Layout Utama

```blade
@extends('backend.admin.layouts.app')

@section('title', 'Judul Halaman')

@section('content')
    <!-- Konten halaman Anda -->
@endsection
```

### 2. Menambahkan CSS Khusus

```blade
@push('styles')
    <link rel="stylesheet" href="custom.css">
    <style>
        .custom-class { color: red; }
    </style>
@endpush
```

### 3. Menambahkan JavaScript Khusus

```blade
@push('scripts')
    <script src="custom.js"></script>
@endpush

@section('scripts')
    <script>
        // JavaScript khusus halaman
    </script>
@endsection
```

### 4. Menambahkan Page Header

```blade
@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Portal Parakan /</span> Halaman
        </h4>
        <a href="#" class="btn btn-primary">Tambah Data</a>
    </div>
@endsection
```

### 5. Menambahkan Breadcrumb

```blade
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Halaman Aktif</li>
@endsection
```

## Fitur Global yang Tersedia

### 1. Flash Messages
Otomatis menampilkan pesan dari session:
- `session('success')`
- `session('error')`
- `session('warning')`
- `session('info')`
- Validation errors dari `$errors`

### 2. Global JavaScript Functions

#### Loading Spinner
```javascript
showLoading();  // Tampilkan loading
hideLoading();  // Sembunyikan loading
```

#### Confirmation Modal
```javascript
showConfirmModal('Apakah Anda yakin?', function() {
    // Callback function ketika user konfirmasi
    console.log('User mengkonfirmasi');
});
```

#### Image Preview
```javascript
showImagePreview('/path/to/image.jpg', 'Judul Preview');
```

### 3. Sidebar Menu

Menu sidebar sudah dikonfigurasi dengan:
- Active state berdasarkan route
- Menu untuk Dashboard, Berita, Keluhan, Users, Settings
- Submenu yang dapat diperluas
- Icon menggunakan Boxicons

### 4. Navbar Features

Navbar includes:
- Mobile menu toggle
- Search bar
- Notification dropdown
- User profile dropdown dengan logout

## Kustomisasi

### Mengubah Brand/Logo

Edit file `resources/views/backend/partials/sidebar.blade.php`:

```blade
<span class="app-brand-text demo menu-text fw-bolder ms-2">Portal Parakan</span>
```

### Menambah Menu Sidebar

Edit file `resources/views/backend/partials/sidebar.blade.php` dan tambahkan:

```blade
<li class="menu-item {{ request()->routeIs('menu.*') ? 'active' : '' }}">
    <a href="{{ route('menu.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-icon"></i>
        <div data-i18n="Menu">Menu Baru</div>
    </a>
</li>
```

### Mengubah Footer

Edit file `resources/views/backend/partials/footer.blade.php`.

## File Routes yang Dibutuhkan

Pastikan routes berikut ada di `routes/web.php`:

```php
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// News
Route::resource('news', NewsController::class);

// Complaints  
Route::resource('complaints', ComplaintController::class);
Route::get('/complaints/pending', [ComplaintController::class, 'pending'])->name('complaints.pending');

// Users
Route::resource('users', UserController::class);

// Settings
Route::resource('settings', SettingController::class);

// Profile
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

// Auth
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Static pages
Route::get('/privacy', function() { return view('privacy'); })->name('privacy');
Route::get('/terms', function() { return view('terms'); })->name('terms');  
Route::get('/contact', function() { return view('contact'); })->name('contact');
```

## Best Practices

1. **Konsistensi**: Gunakan layout yang sama untuk semua halaman backend
2. **Performance**: Gunakan `@push` untuk CSS/JS yang spesifik ke halaman
3. **Accessibility**: Pastikan semua elemen dapat diakses dengan keyboard
4. **Responsive**: Layout sudah responsive, pastikan konten Anda juga responsive
5. **Security**: Selalu validasi input dan gunakan CSRF protection

## Troubleshooting

### CSS/JS tidak load
- Pastikan path asset benar
- Check apakah file ada di `public/assets/`
- Gunakan `php artisan storage:link` jika perlu

### Menu tidak active
- Pastikan route name sesuai dengan kondisi di sidebar
- Check dengan `Route::currentRouteName()`

### Modal tidak muncul
- Pastikan Bootstrap JS sudah di-load
- Check console browser untuk error JavaScript
