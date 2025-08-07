<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index,follow">
    <meta name="author" content="{{ $seoData['author'] }}">
    <meta name="theme-color" content="{{ $seoData['theme_color'] ?? '#dc3545' }}">

    <!-- SEO Meta Tags -->
    <title>{{ $seoData['title'] }}</title>
    <meta name="description" content="{{ $seoData['description'] ?? '' }}">
    <meta name="keywords" content="{{ $seoData['keywords'] ?? '' }}">
    <link rel="canonical" href="{{ $seoData['canonical_url'] ?? url('/') }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $seoData['og_title'] ?? ($seoData['title'] ?? '') }}">
    <meta property="og:description" content="{{ $seoData['og_description'] ?? ($seoData['description'] ?? '') }}">
    <meta property="og:type" content="{{ $seoData['og_type'] ?? 'website' }}">
    <meta property="og:url" content="{{ $seoData['og_url'] ?? url('/') }}">
    <meta property="og:image" content="{{ $seoData['og_image'] ?? asset('assets/img/logo-desa.png') }}">
    <meta property="og:site_name" content="">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="{{ $seoData['twitter_card'] ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ $seoData['twitter_title'] ?? ($seoData['title'] ?? '') }}">
    <meta name="twitter:description"
        content="{{ $seoData['twitter_description'] ?? ($seoData['description'] ?? '') }}">
    <meta name="twitter:image" content="{{ $seoData['twitter_image'] ?? asset('assets/img/logo-desa.png') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/logo-desa.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- BoxIcons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- My Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/mystyle.css') }}">

    <!-- Organization Chart Styles -->
    <style>
        .structure-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .org-chart-container {
            position: relative;
            margin: 50px 0;
        }

        .org-level {
            margin: 30px 0;
            position: relative;
        }

        .org-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(220, 53, 69, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
            margin: 15px;
            min-height: 320px;
            display: flex;
            flex-direction: column;
        }

        .org-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(45deg, #35dc43c1 0%, #31b02a 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .org-card:hover::before {
            opacity: 1;
        }

        .org-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(220, 53, 69, 0.2);
            border-color: rgba(220, 53, 69, 0.3);
        }

        .org-card.kepala-desa {
            background: linear-gradient(135deg, #35dc43c1 0%, #31b02a 100%);
            color: white;
            max-width: 320px;
            margin: 0 auto;
        }

        .org-card.sekretaris {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: white;
            max-width: 300px;
            margin: 0 auto;
        }

        /* Photo Section - Full Width at Top */
        .org-card-photo {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .org-card.kepala-desa .org-card-photo,
        .org-card.sekretaris .org-card-photo {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.1) 100%);
        }

        .org-card-photo::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(255, 107, 122, 0.1) 100%);
        }

        .org-card.kepala-desa .org-card-photo::before,
        .org-card.sekretaris .org-card-photo::before {
            background: none;
        }

        .org-avatar {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.2);
            font-size: 80px;
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .org-card:not(.kepala-desa):not(.sekretaris) .org-avatar {
            background: linear-gradient(135deg, #dc3545, #ff6b7a);
            color: white;
        }

        /* Ensure all avatars have consistent styling when they have photos */
        .org-card.kepala-desa .org-avatar,
        .org-card.sekretaris .org-avatar {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Content Section */
        .org-card-content {
            padding: 20px;
            text-align: center;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .org-card.kepala-desa .org-card-content,
        .org-card.sekretaris .org-card-content {
            padding: 25px 30px;
        }

        .org-info h5,
        .org-info h6 {
            margin-bottom: 10px;
            font-weight: 600;
            line-height: 1.3;
        }

        .org-name {
            font-size: 15px;
            margin-bottom: 15px;
            opacity: 0.9;
            font-weight: 500;
            line-height: 1.4;
        }

        .org-card.kepala-desa .org-name,
        .org-card.sekretaris .org-name {
            font-size: 16px;
            margin-bottom: 18px;
        }

        .org-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .org-badge.secondary {
            background: #6c757d;
            color: white;
        }

        .org-badge.info {
            background: #0dcaf0;
            color: white;
        }

        .org-badge.warning {
            background: #ffc107;
            color: #000;
        }

        .org-badge.success {
            background: #198754;
            color: white;
        }

        .org-badge.primary {
            background: #0d6efd;
            color: white;
        }

        .org-badge.danger {
            background: #dc3545;
            color: white;
        }

        .org-badge.dark {
            background: #212529;
            color: white;
        }

        .org-connector {
            position: absolute;
            background: #dee2e6;
        }

        .org-connector.vertical {
            width: 2px;
            height: 30px;
            left: 50%;
            transform: translateX(-50%);
        }

        .org-connector.horizontal {
            height: 2px;
            width: 60%;
            left: 20%;
            top: 50%;
            transform: translateY(-50%);
        }

        .bpd-section {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .bpd-card {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
        }

        .bpd-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .bpd-header i {
            font-size: 30px;
            margin-right: 15px;
        }

        .bpd-member {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .bpd-member:last-child {
            border-bottom: none;
        }

        .position {
            font-weight: 600;
        }

        .info-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            height: 100%;
        }

        .function-list {
            list-style: none;
            padding: 0;
        }

        .function-list li {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 8px 0;
        }

        .function-list i {
            color: #28a745;
            margin-right: 10px;
            font-size: 18px;
        }

        @media (max-width: 768px) {

            .about-divider,
            .news-divider,
            .complaint-divider {
                margin-left: 0;
                margin-right: auto;
            }

            .org-card {
                margin: 10px 0;
                min-height: 280px;
            }

            .org-card-photo {
                height: 180px;
            }

            .org-avatar {
                width: 160px;
                height: 160px;
                font-size: 64px;
                border-width: 3px;
            }

            .org-card-content {
                padding: 16px;
            }

            .org-card.kepala-desa .org-card-content,
            .org-card.sekretaris .org-card-content {
                padding: 20px;
            }

            .org-connector.horizontal {
                display: none;
            }

            .bpd-section {
                padding: 20px;
            }

            .bpd-member {
                flex-direction: column;
                text-align: center;
                gap: 5px;
            }

            .org-info h5,
            .org-info h6 {
                font-size: 14px;
                margin-bottom: 5px;
            }

            .org-name {
                font-size: 12px;
            }
        }



        @media (max-width: 576px) {
            .org-card {
                min-height: 240px;
            }

            .org-card-photo {
                height: 140px;
            }

            .org-avatar {
                width: 120px;
                height: 120px;
                font-size: 48px;
            }

            .org-info h5 {
                font-size: 13px;
            }

            .org-info h6 {
                font-size: 12px;
            }

            .org-name {
                font-size: 11px;
            }

            .org-badge {
                font-size: 9px;
                padding: 2px 6px;
            }
        }

        /* Enhanced Navbar Styles */
        .navbar {
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 600;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 8px 16px !important;
            margin: 0 2px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background: rgba(220, 53, 69, 0.1);
            color: #35dc5f !important;
        }

        .navbar-toggler {
            border: none;
            padding: 4px 8px;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* Enhanced Divider Styles */
        .about-divider,
        .news-divider,
        .complaint-divider {
            width: 60px;
            height: 4px;
            background: linear-gradient(45deg, #35dc43c1 0%, #31b02a 100%);
            margin: 20px 0;
            border-radius: 2px;
        }

        /* Mobile Divider Positioning */
        @media (max-width: 768px) {

            .about-divider,
            .news-divider,
            .complaint-divider {
                margin-left: 0;
                margin-right: auto;
            }
        }



        .section-subtitle {
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 8px 16px;
            border-radius: 25px;
            display: inline-block;
            margin-bottom: 20px;
        }

        /* Responsive Navbar */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                margin-top: 15px;
                padding: 20px;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(0, 0, 0, 0.1);
            }

            .navbar-nav .nav-link {
                margin: 2px 0;
                padding: 12px 16px !important;
            }

            .navbar-brand small {
                font-size: 0.6rem !important;
            }
        }

        @media (max-width: 768px) {
            .navbar-brand span:not(.badge) {
                font-size: 1rem;
            }

            .navbar-brand small {
                font-size: 0.55rem !important;
            }

            .section-subtitle {
                font-size: 12px;
                padding: 6px 12px;
            }

            .about-divider,
            .news-divider,
            .complaint-divider {
                width: 40px;
                height: 3px;
                margin: 15px 0;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('kemeneg.jpg') }}" alt="Logo" class="logo"
                    style="width: 30px; height: 30px; aspect-ratio: 1/1; object-fit: contain;">

                <span>{{ $seoData['og_title'] }}</span>
                <small class="d-block"
                    style="font-size: 0.7rem; color: #6c757d;">{{ $seoData['og_description'] }}</small>
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
                        <a class="nav-link" href="#struktur" data-section="struktur">Struktur</a>
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
            Website Resmi {{ $seoData['title'] }}
        </div>

        <div class="container">
            <div class="hero-content">
                <h1>
                    Selamat Datang di
                    <span class="highlight">{{ $seoData['title'] }}</span>
                </h1>
                <p>
                    {{ $seoData['description'] }}
                </p>

                <div class="mt-4">
                    <a href="#tentang" class="btn-hero primary">
                        <i class='bx bx-info-circle'></i>
                        Tentang
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
            <div class="row g-4" data-aos="fade-up" data-aos-duration="800">
                <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="100">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class='bx bx-group'></i>
                        </div>
                        <div class="stat-number">{{ $totalPeople }}</div>
                        <div class="stat-label">Jiwa Penduduk</div>
                    </div>
                </div>

                <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="200">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class='bx bx-home'></i>
                        </div>
                        <div class="stat-number">{{ $totalFamilies }}</div>
                        <div class="stat-label">Rumah Tangga</div>
                    </div>
                </div>

                <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class='bx bx-map-pin'></i>
                        </div>
                        <div class="stat-number">{{ $totalBloks }}</div>
                        <div class="stat-label">Dusun</div>
                    </div>
                </div>

                <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="400">
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
            <div class="row text-center mb-5 mt-5" data-aos="fade-up" data-aos-duration="800">
                <div class="col-lg-8 mx-auto">
                    <div class="section-subtitle badge bg-success">Tentang Kami</div>
                    <h2 class="display-5 fw-bold">Kantor Agama Kecamatan BATHIN XXIV</h2>
                    <div class="about-divider mx-auto"></div>
                    <p class="lead text-muted">{{ $seoData['description'] }}</p>
                </div>
            </div>

            <div class="about-content" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
                <div class="about-image" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="400">
                    <img src="{{ asset('assets/img/backgrounds/banner2.jpg') }}" alt="KUA Bathin XXIV">
                </div>

                <div class="about-text" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="600">
                    <h3></h3>
                    <div class="about-divider"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Village Government Structure Section -->
    <section class="structure-section" id="struktur">
        <div class="container">
            <div class="row text-center mb-5 mt-5" data-aos="fade-up" data-aos-duration="800">
                <div class="col-lg-8 mx-auto">
                    <div class="section-subtitle badge bg-success">Struktur Organisasi</div>
                    <h2 class="display-5 fw-bold">Struktur Perangkat KUA</h2>
                    <div class="about-divider mx-auto"></div>
                    <p class="lead text-muted">KUA Kecamatan bathin melayani masyarakat dengan dedikasi
                        tinggi
                    </p>
                </div>
            </div>

            <!-- Organization Chart -->
            <div class="org-chart-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <!-- Level 1 - Kepala Desa -->
                @if ($villageStructures['kepala']->isNotEmpty())
                    <div class="org-level level-1" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="400">
                        @foreach ($villageStructures['kepala'] as $kepala)
                            <div class="org-card kepala-desa">
                                <div class="org-card-photo">
                                    <div class="org-avatar">
                                        @if ($kepala->photo_url)
                                            <img src="{{ $kepala->photo_url }}" alt="{{ $kepala->name }}"
                                                class="avatar-img">
                                        @else
                                            <i class='bx {{ $kepala->icon }}'></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="org-card-content">
                                    <div class="org-info">
                                        <h6>{{ $kepala->position }}</h6>
                                        <p class="org-name">{{ $kepala->name }}</p>
                                        <span
                                            class="org-badge {{ $kepala->badge_class }}">{{ $kepala->department }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Connector Line -->
                {{-- @if ($villageStructures['kepala']->isNotEmpty() && $villageStructures['sekretaris']->isNotEmpty())
                <div class="org-connector vertical"></div>
                @endif --}}

                <!-- Level 2 - Sekretaris Desa -->
                @if ($villageStructures['sekretaris']->isNotEmpty())
                    <div class="org-level level-2" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                        @foreach ($villageStructures['sekretaris'] as $sekretaris)
                            <div class="org-card sekretaris">
                                <div class="org-card-photo">
                                    <div class="org-avatar">
                                        @if ($sekretaris->photo_url)
                                            <img src="{{ $sekretaris->photo_url }}" alt="{{ $sekretaris->name }}"
                                                class="avatar-img">
                                        @else
                                            <i class='bx {{ $sekretaris->icon }}'></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="org-card-content">
                                    <div class="org-info">
                                        <h6>{{ $sekretaris->position }}</h6>
                                        <p class="org-name">{{ $sekretaris->name }}</p>
                                        <span
                                            class="org-badge {{ $sekretaris->badge_class }}">{{ $sekretaris->department }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Connector Lines -->
                {{-- @if ($villageStructures['sekretaris']->isNotEmpty() && $villageStructures['kaur']->isNotEmpty())
                <div class="org-connector vertical"></div>
                <div class="org-connector horizontal"></div>
                @endif --}}

                <!-- Level 3 - Kepala Urusan -->
                @if ($villageStructures['kaur']->isNotEmpty())
                    <div class="org-level level-3" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
                        <div class="row g-3 justify-content-center">
                            @foreach ($villageStructures['kaur'] as $kaur)
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="org-card kaur">
                                        <div class="org-card-photo">
                                            <div class="org-avatar">
                                                @if ($kaur->photo_url)
                                                    <img src="{{ $kaur->photo_url }}" alt="{{ $kaur->name }}"
                                                        class="avatar-img">
                                                @else
                                                    <i class='bx {{ $kaur->icon }}'></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="org-card-content">
                                            <div class="org-info">
                                                <h6>{{ $kaur->position }}</h6>
                                                <p class="org-name">{{ $kaur->name }}</p>
                                                <span
                                                    class="org-badge {{ $kaur->badge_class }}">{{ $kaur->department }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Connector Lines -->
                {{-- @if ($villageStructures['kaur']->isNotEmpty() && $villageStructures['kasi']->isNotEmpty())
                <div class="org-connector vertical mt-4"></div>
                <div class="org-connector horizontal"></div>
                @endif --}}

                <!-- Level 4 - Kepala Seksi -->
                @if ($villageStructures['kasi']->isNotEmpty())
                    <div class="org-level level-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="1000">
                        <div class="row g-3 justify-content-center">
                            @foreach ($villageStructures['kasi'] as $kasi)
                                <div class="col-lg-4 col-md-6">
                                    <div class="org-card kasi">
                                        <div class="org-card-photo">
                                            <div class="org-avatar">
                                                @if ($kasi->photo_url)
                                                    <img src="{{ $kasi->photo_url }}" alt="{{ $kasi->name }}"
                                                        class="avatar-img">
                                                @else
                                                    <i class='bx {{ $kasi->icon }}'></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="org-card-content">
                                            <div class="org-info">
                                                <h6>{{ $kasi->position }}</h6>
                                                <p class="org-name">{{ $kasi->name }}</p>
                                                <span
                                                    class="org-badge {{ $kasi->badge_class }}">{{ $kasi->department }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Connector Lines -->
                {{-- @if ($villageStructures['kasi']->isNotEmpty() && $villageStructures['kadus']->isNotEmpty())
                <div class="org-connector vertical mt-4"></div>
                <div class="org-connector horizontal"></div>
                @endif --}}

                <!-- Level 5 - Kepala Dusun -->
                @if ($villageStructures['kadus']->isNotEmpty())
                    <div class="org-level level-5" data-aos="fade-up" data-aos-duration="800" data-aos-delay="1200">
                        <div class="row g-3 justify-content-center">
                            @foreach ($villageStructures['kadus'] as $kadus)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="org-card kadus">
                                        <div class="org-card-photo">
                                            <div class="org-avatar">
                                                @if ($kadus->photo_url)
                                                    <img src="{{ $kadus->photo_url }}" alt="{{ $kadus->name }}"
                                                        class="avatar-img">
                                                @else
                                                    <i class='bx {{ $kadus->icon }}'></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="org-card-content">
                                            <div class="org-info">
                                                <h6>{{ $kadus->position }}</h6>
                                                <p class="org-name">{{ $kadus->name }}</p>
                                                <span
                                                    class="org-badge {{ $kadus->badge_class }}">{{ $kadus->department }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>


            <!-- News Section -->
            <section class="news-section" id="berita">
                <div class="container">
                    <div class="row mb-5 justify-align-center mt-5" data-aos="fade-up" data-aos-duration="800">
                        <div class="col-lg-8">
                            <div class="section-subtitle badge bg-success">Berita Terkini</div>
                            <h5 class="display-5 fw-bold fs-2 my-3">Berita dan Informasi Desa Terbaru</h5>
                            <div class="news-divider"></div>
                        </div>
                        <div class="col-lg-4 text-end">
                            <a href="{{ route('frontend.news.index') }}" class="btn btn-success rounded-5">Lihat
                                Semua Berita
                                <i class='bx bx-chevrons-right'></i></a>
                        </div>
                    </div>

                    <!-- News Cards -->
                    @if (@isset($news) && $news->count() > 0)
                        <div class="row g-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                            @foreach ($news as $index => $new)
                                <div class="col-md-4" data-aos="zoom-in" data-aos-duration="600"
                                    data-aos-delay="{{ 400 + $index * 100 }}">
                                    <div class="news-card">
                                        <img src="{{ $new->image ? asset('storage/' . $new->image) : asset('assets/img/backgrounds/masjid.jpg') }}"
                                            alt="{{ $new->title }}">
                                        <div class="news-card-body">
                                            <div class="news-meta mb-2">
                                                <span class="text-muted"><i class='bx bx-time-five text-danger'></i>
                                                    {{ $new->created_at->diffForHumans() }}</span>
                                            </div>
                                            <h5>{{ $new->title }}</h5>
                                            <p>{{ Str::limit($new->content, 100) }}</p>
                                            <a href="{{ route('frontend.news.show', $new->id) }}"
                                                class="btn btn-outline-success btn-sm rounded-3">Baca Selengkapnya</a>
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
                <div class="row text-center mb-5 mt-5" data-aos="fade-up" data-aos-duration="800">
                    <div class="col-lg-8 mx-auto">
                        <h5 class="display-5 fw-bold">Layanan Kami</h5>
                        <p class="lead text-muted">Berbagai layanan digital KUA Bathin XXIV</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class='bx bx-news'></i>
                            </div>
                            <h4>Portal Berita</h4>
                            <p>Informasi terkini tentang kegiatan dan pengumuman resmi dari pemerintah desa</p>
                        </div>
                    </div>

                    <div class="col-md-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class='bx bx-message-square-detail'></i>
                            </div>
                            <h4>Pengaduan Online</h4>
                            <p>Sampaikan aspirasi dan keluhan Anda secara online dengan mudah dan cepat</p>
                        </div>
                    </div>

                    <div class="col-md-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
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
                <div class="row mb-5 justify-align-center mt-5" data-aos="fade-up" data-aos-duration="800">
                    <div class="col-lg-4 text-start">
                        <a href="{{ route('frontend.complaints.index') }}"
                            class="btn btn-success rounded-5">Lihat Semua
                            Pengaduan <i class='bx bx-chevrons-right'></i></a>
                    </div>
                    <div class="col-lg-8 text-end">
                        <div class="section-subtitle badge bg-success">Pengaduan Terkini</div>
                        <h5 class="display-5 fw-bold fs-2 my-3">Pengaduan Masyarakat Mengenai Keluhan</h5>
                        <div class="complaint-divider ms-auto"></div>
                    </div>
                </div>

                <!-- Complaint Cards -->
                @if (@isset($complaints) && $complaints->count() > 0)
                    <div class="row g-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        @foreach ($complaints as $index => $complaint)
                            <div class="col-md-4" data-aos="zoom-in" data-aos-duration="600"
                                data-aos-delay="{{ 400 + $index * 100 }}">
                                <div class="news-card">
                                    <img src="{{ $complaint->image ? asset('storage/' . $complaint->image) : asset('assets/img/backgrounds/masjid.jpg') }}"
                                        alt="{{ $complaint->title }}">
                                    <div class="news-card-body">
                                        <div class="news-meta mb-2">
                                            <span class="text-muted"><i class='bx bx-time-five text-danger'></i>
                                                {{ $complaint->created_at->diffForHumans() }}</span>
                                        </div>
                                        <h5>{{ $complaint->title }}</h5>
                                        <p>{!! Str::limit($complaint->description, 100) !!}</p>
                                        <a href="{{ route('frontend.complaints.show', $complaint->id) }}"
                                            class="btn btn-outline-success btn-sm rounded-3">Baca Selengkapnya</a>
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
        <div class="footer-top" data-aos="fade-up" data-aos-duration="800">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2>Mari Bersama</h2>
                        <p>Membangun Kota Ini Bersama Kami</p>
                        <div class="footer-cta-buttons">
                            <a href="#tentang" class="footer-cta-btn">
                                <i class='bx bx-phone'></i>
                                Hubungi Kami
                            </a>
                            <a href="{{ route('login') }}" class="footer-cta-btn secondary">
                                <i class='bx bx-user'></i>
                                Pusat Layanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-main" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
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
                                <li><a href="#struktur">Struktur Pemerintahan</a></li>
                                <li><a href="#berita">Berita</a></li>
                                <li><a href="#layanan">Layanan</a></li>
                                <li><a href="#pengaduan">Pengaduan</a></li>
                                <li><a href="{{ route('login') }}">Portal Administrasi</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="footer-column">
                            <h5>KUA Bathin XXIV</h5>
                            <p>Website resmi KUA Bathin XXIV, Kecamatan Maleber, Kabupaten Kuningan, Jawa Barat.
                                Menyediakan informasi terkini tentang kegiatan dan perkembangan desa.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <p class="footer-copyright">&copy; 2025 KUA Bathin XXIV - <br> Hak Cipta
                    Dilindungi Undang-Undang.</p>
            </div>
        </div>
    </footer>

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Profil KUA Bathin XXIV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Profil KUA Bathin XXIV"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Custom JS -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            delay: 100,
            once: true,
            offset: 50
        });

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
        document.querySelectorAll('.feature-card, .news-card, .stat-card, .org-card, .bpd-card, .info-card').forEach(
            card => {
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
        }, {
            threshold: 0.5
        });

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
