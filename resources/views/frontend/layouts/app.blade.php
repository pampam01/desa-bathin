<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal KUA - Website Resmi KUA Bathin')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- BoxIcons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- My Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/mystyle.css') }}">

    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <span class="badge">KUA</span>
                <span>Portal Masyarakat</span>
                <small class="d-block" style="font-size: 0.7rem; color: #6c757d;">Pusat Pengaduan Masyarakat KUA desa
                    Bathin XXIV</small>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                            href="{{ route('welcome') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('berita*') ? 'active' : '' }}"
                            href="{{ route('frontend.news.index') }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pengaduan*') ? 'active' : '' }}"
                            href="{{ route('frontend.complaints.index') }}">Pengaduan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="margin-top: 80px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2>Pusat Pengaduan Masyarakat KUA desa Bathin XXIV</h2>
                        <p></p>
                        <div class="footer-cta-buttons">
                            <a href="#tentang" class="footer-cta-btn">
                                <i class='bx bx-phone'></i>
                                Hubungi Kami
                            </a>
                            <a href="{{ route('login') }}" class="footer-cta-btn secondary">
                                <i class='bx bx-user'></i>
                                Layanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="footer-column">
                            <h5>Kontak</h5>
                            <div class="contact-item">
                                <i class='bx bx-map'></i>
                                <p>{{ $location }}</p>
                            </div>
                            <div class="contact-item">
                                <i class='bx bx-envelope'></i>
                                <p>{{ $email }}</p>
                            </div>
                            <div class="contact-item">
                                <i class='bx bx-phone'></i>
                                <p>{{ $telp }}</p>
                            </div>
                            <div class="contact-item">
                                <i class='bx bx-time'></i>
                                <p>Senin - Jumat: 08:00 - 16:00 WIB</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="footer-column">
                            <h5>Link Terkait</h5>
                            <ul>
                                <li><a href="#home">Beranda</a></li>
                                <li><a href="#tentang">Tentang Desa</a></li>
                                <li><a href="#berita">Berita</a></li>
                                <li><a href="#layanan">Layanan</a></li>
                                <li><a href="#pengaduan">Pengaduan</a></li>
                                <li><a href="{{ route('login') }}">Portal Administrasi</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="footer-column">
                            <h5>Portal KUA Bathin</h5>
                            <p>Website resmi KUA Desa Bathin, Jambi.
                                Menyediakan layanan pengajuan dan pengaduan terkait agama.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <p class="footer-copyright">&copy; 2025. <br> Hak Cipta
                    Dilindungi Undang-Undang.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });


        // Deteksi koneksi hilang
        window.addEventListener('offline', function() {
            window.location.href = "{{ route('offline') }}";
        });
    </script>

    @stack('scripts')
</body>

</html>
