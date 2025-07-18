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
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #dc3545;
            --secondary-color: #6c757d;
            --dark-color: #212529;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* Header */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }

        .navbar-brand .badge {
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 1rem;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* Hero Section */
        .hero-section {
            height: 100vh;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)),
                url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero-content .highlight {
            color: var(--primary-color);
            display: block;
            font-size: 4rem;
            margin: 0.5rem 0;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .hero-website-info {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(255, 255, 255, 0.9);
            padding: 8px 20px;
            border-radius: 20px;
            color: var(--dark-color);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .btn-hero {
            padding: 12px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 0 10px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-hero.primary {
            background: var(--primary-color);
            color: white;
            border: 2px solid var(--primary-color);
        }

        .btn-hero.primary:hover {
            background: transparent;
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .btn-hero.secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .btn-hero.secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        /* Play Button */
        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: -100px;
        }

        .play-button:hover {
            background: white;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .play-button i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-left: 5px;
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        .scroll-indicator i {
            font-size: 2rem;
            color: white;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            40% {
                transform: translateX(-50%) translateY(-10px);
            }

            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }

        /* Identity Section */
        .identity-section {
            min-height: 50vh;
            padding: 80px 0;
            background: var(--light-color);
        }

        .identity-card {
            background: white;
            border-radius: 15px;
            padding: 40px 30px;
            text-align: center;
            height: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .identity-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .identity-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: white;
        }

        .identity-card h4 {
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--dark-color);
        }

        .identity-card p {
            color: var(--secondary-color);
            line-height: 1.6;
        }

        /* Features Section */
        .features-section {
            padding: 80px 0;
            background: var(--light-color);
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 40px 30px;
            text-align: center;
            height: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: white;
        }

        .feature-card h4 {
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--dark-color);
        }

        .feature-card p {
            color: var(--secondary-color);
            line-height: 1.6;
        }

        /* News Section */
        .news-section {
            padding: 80px 0;
            background: white;
        }

        .news-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .news-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .news-card-body {
            padding: 25px;
        }

        .news-card h5 {
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--dark-color);
        }

        .news-card p {
            color: var(--secondary-color);
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .news-meta {
            font-size: 0.9rem;
            color: var(--secondary-color);
        }

        /* Footer */
        .footer {
            background: var(--primary-color);
            color: white;
            padding: 30px 0 0;
        }

        .footer-top {
            padding-bottom: 50px;
            text-align: center;
        }

        .footer-top h2 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            color: white;
        }

        .footer-top p {
            font-size: 1.2rem;
            opacity: 0.95;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .footer-cta-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .footer-cta-btn {
            background: white;
            color: var(--primary-color);
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
        }

        .footer-cta-btn:hover {
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .footer-cta-btn.secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .footer-cta-btn.secondary:hover {
            background: white;
            color: var(--primary-color);
        }

        .footer-main {
            padding: 20px 0 10px;
            background: var(--primary-color);
        }

        .footer-column h5 {
            font-size: .95rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
        }

        .footer-column ul li {
            margin-bottom: 12px;
        }

        .footer-column ul li a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: .95rem;
        }

        .footer-column ul li a:hover {
            color: white;
            text-decoration: underline;
        }

        .footer-column p {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.5;
            margin-bottom: 5px;
            font-size: .95rem;
        }

        .footer-column .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 5px;
        }

        .footer-column .contact-item i {
            color: white;
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .footer-bottom {
            padding: 30px 0;
            text-align: center;
            background: var(--primary-color);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-bottom-links {
            margin-bottom: 20px;
        }

        .footer-bottom-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            margin: 0 15px;
            transition: color 0.3s ease;
            font-size: 0.95rem;
        }

        .footer-bottom-links a:hover {
            color: white;
        }

        .footer-copyright {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin: 0;
        }

        /* Navbar Active State */
        .navbar-nav .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 700;
            position: relative;
        }

        .navbar-nav .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        /* Stats Section */
        .stats-section {
            position: relative;
            margin-top: -100px;
            z-index: 10;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.5rem;
            color: white;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--secondary-color);
            font-weight: 500;
        }

        /* About Section */
        .about-section {
            padding: 80px 0;
            background: white;
        }

        .about-content {
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .about-image {
            flex: 1;
            position: relative;
        }

        .about-image img {
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .about-text {
            flex: 1;
        }

        .about-text h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 10px;
        }

        .about-text .section-subtitle {
            color: var(--primary-color);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .about-text p {
            color: var(--secondary-color);
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 1.1rem;
        }

        .about-divider {
            width: 50px;
            height: 3px;
            background: var(--primary-color);
            margin: 20px 0;
        }

        .news-divider {
            width: 50px;
            height: 4px;
            background: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content .highlight {
                font-size: 3rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .btn-hero {
                padding: 10px 20px;
                font-size: 1rem;
                margin: 5px;
            }

            .stats-section {
                margin-top: -50px;
            }

            .stat-card {
                padding: 20px 15px;
                margin-bottom: 20px;
            }

            .stat-number {
                font-size: 2rem;
            }

            .about-content {
                flex-direction: column;
                gap: 30px;
            }

            .about-text h2 {
                font-size: 2rem;
            }

            /* Footer Responsive */
            .footer-top h2 {
                font-size: 2rem;
            }

            .footer-top p {
                font-size: 1rem;
            }

            .footer-cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .footer-cta-btn {
                padding: 12px 25px;
                font-size: 1rem;
                margin-bottom: 10px;
            }

            .footer-main {
                padding: 40px 0 30px;
            }

            .footer-column h5 {
                font-size: 1.1rem;
                margin-bottom: 20px;
            }

            .footer-bottom-links {
                flex-direction: column;
                gap: 10px;
            }

            .footer-bottom-links a {
                margin: 5px 0;
            }

            .navbar-nav .nav-link.active::after {
                width: 25px;
                height: 2px;
            }
        }
    </style>
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
                        <div class="stat-number">2,500</div>
                        <div class="stat-label">Jiwa Penduduk</div>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class='bx bx-home'></i>
                        </div>
                        <div class="stat-number">650</div>
                        <div class="stat-label">Rumah Tangga</div>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class='bx bx-map-pin'></i>
                        </div>
                        <div class="stat-number">5</div>
                        <div class="stat-label">Dusun</div>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class='bx bx-trophy'></i>
                        </div>
                        <div class="stat-number">10+</div>
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

                    <p>Desa Parakan memiliki sejarah panjang yang dimulai sejak abad ke-18. Nama "Parakan" berasal dari
                        kata "Blerang" yang berarti tempat yang subur dan makmur dalam bahasa Jawa kuno.</p>

                    <p>Dilatarbelakangi oleh sekelompok petani pionir, desa ini berkembang menjadi komunitas yang kuat
                        dengan nilai-nilai gotong royong dan kekeluargaan yang masih terjaga hingga saat ini.</p>

                    <p>Kini Desa Parakan terus berinovasi dengan berbagai program pembangunan berkelanjutan yang
                        berfokus pada kesejahteraan masyarakat dan pelestarian lingkungan.</p>
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
                            <p>Menjadi desa yang mandiri, berdaya saing, dan berkelanjutan</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="identity-card">
                            <div class="identity-icon">
                                <i class='bx bx-file'></i>
                            </div>
                            <h4>Misi Desa</h4>
                            <div class="about-divider mx-auto"></div>
                            <p>Meningkatkan kualitas hidup masyarakat melalui pendidikan, kesehatan, dan ekonomi</p>
                            <p>Sampaikan aspirasi dan keluhan Anda secara online dengan mudah dan cepat</p>
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
                    <a href="#" class="btn btn-danger rounded-5">Lihat Semua Berita <i
                            class='bx bx-chevrons-right'></i></a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="news-card">
                        <img src="https://images.unsplash.com/photo-1560472355-536de3962603?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Berita 1">
                        <div class="news-card-body">
                            <div class="news-meta mb-2">
                                <span class="text-muted"><i class='bx bx-time-five text-danger'></i> 2 hari yang
                                    lalu</span>
                            </div>
                            <h5>Gotong Royong Pembangunan Jalan Desa</h5>
                            <p>Warga Desa Parakan bergotong royong memperbaiki jalan desa untuk kemudahan akses
                                transportasi...</p>
                            <a href="#" class="btn btn-outline-danger btn-sm rounded-3">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="news-card">
                        <img src="https://images.unsplash.com/photo-1574263867128-e4e3b4b2bd8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Berita 2">
                        <div class="news-card-body">
                            <div class="news-meta mb-2">
                                <span class="text-muted"><i class='bx bx-time-five text-danger'></i> 5 hari yang
                                    lalu</span>
                            </div>
                            <h5>Festival Budaya Desa Parakan 2025</h5>
                            <p>Meriahkan Festival Budaya Desa Parakan dengan berbagai pertunjukan seni dan kuliner
                                tradisional...</p>
                            <a href="#" class="btn btn-outline-danger btn-sm rounded-3">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="news-card">
                        <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Berita 3">
                        <div class="news-card-body">
                            <div class="news-meta mb-2">
                                <span class="text-muted"><i class='bx bx-time-five text-danger'></i> 1 minggu yang
                                    lalu</span>
                            </div>
                            <h5>Program Pemberdayaan UMKM Desa</h5>
                            <p>Pemerintah desa meluncurkan program pemberdayaan UMKM untuk meningkatkan kesejahteraan
                                masyarakat...</p>
                            <a href="#" class="btn btn-outline-danger btn-sm rounded-3">Baca Selengkapnya</a>

                        </div>
                    </div>
                </div>
            </div>

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
                                <p>Jl. Desa Parakan No. 123, Kecamatan Maleber, Kabupaten Kuningan, Jawa Barat 45564</p>
                            </div>
                            <div class="contact-item">
                                <i class='bx bx-envelope'></i>
                                <p>info@desaparakan.desa.id</p>
                            </div>
                            <div class="contact-item">
                                <i class='bx bx-phone'></i>
                                <p>(0232) 4567890</p>
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
                                <li><a href="{{ route('login') }}">Portal Administrasi</a></li>
                                <li><a href="#pengaduan">Pengaduan Masyarakat</a></li>
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
                <p class="footer-copyright">&copy; 2025 Portal Parakan. Hak Cipta Dilindungi Undang-Undang.</p>
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
        const speed = 200;

        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target') || +counter.innerText.replace(/[^\d]/g, '');
                const count = +counter.innerText.replace(/[^\d]/g, '');
                const inc = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(updateCount, 1);
                } else {
                    counter.innerText = target;
                }
            };

            // Set data-target attribute
            counter.setAttribute('data-target', counter.innerText.replace(/[^\d]/g, ''));
            
            // Start animation when element is visible
            const counterObserver = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCount();
                        counterObserver.unobserve(entry.target);
                    }
                });
            });
            
            counterObserver.observe(counter);
        });
    </script>
</body>

</html>
