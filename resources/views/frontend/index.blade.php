<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Parakan - Website Resmi Desa Parakan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- BoxIcons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- My Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/mystyle.css') }}">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <span class="badge">P</span>
                <span>Portal Parakan</span>
                <small class="d-block" style="font-size: 0.7rem; color: #6c757d;">Kecamatan Maleber, Kabupaten
                    Kuningan</small>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home" data-section="home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang" data-section="tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#berita" data-section="berita">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#layanan" data-section="layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pengaduan" data-section="pengaduan">Pengaduan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="hero-website-info">
            Website Resmi Desa Parakan
        </div>

        <div class="container">
            <div class="hero-content">
                <h1>
                    Selamat Datang di
                    <span class="highlight">Portal Parakan</span>
                </h1>
                <p>
                    Desa yang indah dengan kearifan lokal dan potensi alam yang melimpah,
                    menuju masa depan yang berkelanjutan
                </p>

                <div class="mt-4">
                    <a href="#tentang" class="btn-hero primary">
                        <i class='bx bx-info-circle'></i>
                        Tentang Desa
                    </a>
                    <a href="#pengaduan" class="btn-hero secondary">
                        <i class='bx bx-phone'></i>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>

        <!-- Play Button -->
        {{-- <div class="play-button" data-bs-toggle="modal" data-bs-target="#videoModal">
            <i class='bx bx-play'></i>
        </div> --}}

        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <i class='bx bx-chevron-down'></i>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class='bx bx-group'></i>
                        </div>
                        <div class="stat-number">{{ $totalPeople }}</div>
                        <div class="stat-label">Jiwa Penduduk</div>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class='bx bx-home'></i>
                        </div>
                        <div class="stat-number">{{ $totalFamilies }}</div>
                        <div class="stat-label">Rumah Tangga</div>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class='bx bx-map-pin'></i>
                        </div>
                        <div class="stat-number">{{ $totalBloks }}</div>
                        <div class="stat-label">Dusun</div>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class='bx bx-trophy'></i>
                        </div>
                        <div class="stat-number">{{ $totalPrograms }}-+</div>
                        <div class="stat-label">Program Unggulan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="tentang">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <div class="section-subtitle badge bg-danger">Tentang Kami</div>
                    <h2 class="display-5 fw-bold">Mengenal Desa Parakan</h2>
                    <div class="about-divider mx-auto"></div>
                    <p class="lead text-muted">Perjalanan panjang sejarah dan budaya yang membentuk identitas Desa
                        Parakan</p>
                </div>
            </div>

            <div class="about-content">
                <div class="about-image">
                    <img src="https://maleber.godesa.id/assets/uploads/4f18e3f3136e9c95d94278695be1b634.jpeg"
                        alt="Desa Parakan">
                </div>

                <div class="about-text">
                    <h3>Sejarah & Warisan Budaya</h3>
                    <div class="about-divider"></div>
                    <p>{!! nl2br(e($description)) !!}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Identity Section -->
    <section class="identity-section" id="identitas">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <div class="section-subtitle badge bg-danger">Visi & Misi</div>
                    <h2 class="display-5 fw-bold">Arah Pembangunan Desa</h2>
                    <div class="about-divider mx-auto"></div>
                    <p class="lead text-muted">Komitmen kami dalam membangun masa depan yang berkelanjutan</p>
                </div>
            </div>

            <div class="identity-content">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-4">
                        <div class="identity-card">
                            <div class="identity-icon">
                                <i class='bx bx-medal'></i>
                            </div>
                            <h4>Visi Desa</h4>
                            <div class="about-divider mx-auto"></div>
                            <p>{!! nl2br(e($visi)) !!}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="identity-card">
                            <div class="identity-icon">
                                <i class='bx bx-file'></i>
                            </div>
                            <h4>Misi Desa</h4>
                            <div class="about-divider mx-auto"></div>
                            <p>{!! nl2br(e($misi)) !!}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section" id="berita">
        <div class="container">
            <div class="row mb-5 justify-align-center">
                <div class="col-lg-8">
                    <div class="section-subtitle badge bg-danger">Berita Terkini</div>
                    <h5 class="display-5 fw-bold fs-2 my-3">Berita dan Informasi Desa Terbaru</h5>
                    <div class="news-divider"></div>
                </div>
                <div class="col-lg-4 text-end">
                    <a href="{{ route('frontend.news.index') }}" class="btn btn-danger rounded-5">Lihat Semua Berita <i
                            class='bx bx-chevrons-right'></i></a>
                </div>
            </div>

            <!-- News Cards -->
            @if (@isset($news) && $news->count() > 0)
                <div class="row g-4">
                    @foreach ($news as $new)
                        <div class="col-md-4">
                            <div class="news-card">
                                <img src="{{ $new->image ? asset('storage/' . $new->image) : asset('assets/img/backgrounds/masjid.jpg') }}" alt="{{ $new->title }}">
                                <div class="news-card-body">
                                    <div class="news-meta mb-2">
                                        <span class="text-muted"><i class='bx bx-time-five text-danger'></i>
                                            {{ $new->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h5>{{ $new->title }}</h5>
                                    <p>{{ Str::limit($new->content, 100) }}</p>
                                    <a href="{{ route('frontend.news.show', $new->id) }}" class="btn btn-outline-danger btn-sm rounded-3">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endisset
            @if ($news->count() == 0)
                <div class="alert alert-info mt-4" role="alert">
                    Tidak ada berita terbaru saat ini.
                </div>
            @endif
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="layanan">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h5 class="display-5 fw-bold">Layanan Kami</h5>
                    <p class="lead text-muted">Berbagai layanan digital untuk kemudahan warga Desa Parakan</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class='bx bx-news'></i>
                        </div>
                        <h4>Portal Berita</h4>
                        <p>Informasi terkini tentang kegiatan dan pengumuman resmi dari pemerintah desa</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class='bx bx-message-square-detail'></i>
                        </div>
                        <h4>Pengaduan Online</h4>
                        <p>Sampaikan aspirasi dan keluhan Anda secara online dengan mudah dan cepat</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class='bx bx-file-blank'></i>
                        </div>
                        <h4>Layanan Administrasi</h4>
                        <p>Akses mudah untuk berbagai keperluan administrasi desa dan dokumen penting</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pengaduan Section -->
    <section class="news-section" id="pengaduan">
        <div class="container">
            <div class="row mb-5 justify-align-center">
                <div class="col-lg-4 text-start">
                    <a href="{{ route('frontend.complaints.index') }}" class="btn btn-danger rounded-5">Lihat Semua Pengaduan <i
                            class='bx bx-chevrons-right'></i></a>
                </div>
                <div class="col-lg-8 text-end">
                    <div class="section-subtitle badge bg-danger">Pengaduan Terkini</div>
                    <h5 class="display-5 fw-bold fs-2 my-3">Pengaduan Masyarakat Mengenai Keluhan</h5>
                    <div class="complaint-divider"></div>
                </div>
            </div>

            <!-- Complaint Cards -->
            @if (@isset($complaints) && $complaints->count() > 0)
                <div class="row g-4">
                    @foreach ($complaints as $complaint)
                        <div class="col-md-4">
                            <div class="news-card">
                                <img src="{{ $complaint->image ? asset('storage/' . $complaint->image) : asset('assets/img/backgrounds/masjid.jpg') }}" alt="{{ $complaint->title }}">
                                <div class="news-card-body">
                                    <div class="news-meta mb-2">
                                        <span class="text-muted"><i class='bx bx-time-five text-danger'></i>
                                            {{ $complaint->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h5>{{ $complaint->title }}</h5>
                                    <p>{{ Str::limit($complaint->description, 100) }}</p>
                                    <a href="{{ route('frontend.complaints.show', $complaint->id) }}" class="btn btn-outline-danger btn-sm rounded-3">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endisset
            @if ($news->count() == 0)
                <div class="alert alert-info mt-4" role="alert">
                    Tidak ada berita terbaru saat ini.
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2>Mari Bersama Membangun Desa</h2>
                        <p>Bergabunglah dengan kami dalam memajukan Desa Parakan. Suara dan partisipasi Anda sangat berarti bagi masa depan desa.</p>
                        <div class="footer-cta-buttons">
                            <a href="#tentang" class="footer-cta-btn">
                                <i class='bx bx-phone'></i>
                                Hubungi Kami
                            </a>
                            <a href="{{ route('login') }}" class="footer-cta-btn secondary">
                                <i class='bx bx-user'></i>
                                Layanan Desa
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
                            <h5>Portal Parakan</h5>
                            <p>Website resmi Desa Parakan, Kecamatan Maleber, Kabupaten Kuningan, Jawa Barat. Menyediakan informasi terkini tentang kegiatan dan perkembangan desa.</p>
                            <p>Portal ini menjadi jembatan komunikasi antara pemerintah desa dan masyarakat dalam rangka meningkatkan transparansi dan partisipasi dalam pembangunan desa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <p class="footer-copyright">&copy; 2025 Portal Parakan - KKN Kelompok 7 UNIKU 2025. <br> Hak Cipta Dilindungi Undang-Undang.</p>
            </div>
        </div>
    </footer>

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Profil Desa Parakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Profil Desa Parakan"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Smooth scrolling
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

        // Navbar scroll effect and active state
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }

            // Update active nav links
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link[data-section]');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= (sectionTop - 100)) {
                    current = section.getAttribute('id');
                }
            });

            // Default to home if no section is active
            if (!current) {
                current = 'home';
            }

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-section') === current) {
                    link.classList.add('active');
                }
            });
        });

        // Initialize active state on page load
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link[data-section]');
            navLinks.forEach(link => {
                if (link.getAttribute('data-section') === 'home') {
                    link.classList.add('active');
                }
            });
        });

        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.feature-card, .news-card, .stat-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });

        // Counter animation for stats
        const counters = document.querySelectorAll('.stat-number');
        
        function animateCounter(counter) {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60fps
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        }

        // Initialize counter animation on scroll
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    // Set initial value to 0
                    counter.textContent = '0';
                    // Start animation
                    setTimeout(() => animateCounter(counter), 200);
                    counterObserver.unobserve(counter);
                }
            });
        }, { threshold: 0.5 });

        // Set data-target and observe counters
        counters.forEach(counter => {
            const originalText = counter.textContent;
            const targetValue = originalText.replace(/[^\d]/g, '');
            counter.setAttribute('data-target', targetValue);
            counter.textContent = '0';
            counterObserver.observe(counter);
        });
    </script>
</body>

</html>
