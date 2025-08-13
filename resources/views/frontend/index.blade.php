<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $seoData['title'] }}</title>
    <meta name="description" content="{{ $seoData['description'] ?? '' }}">
    <meta name="keywords" content="{{ $seoData['keywords'] ?? '' }}">
    <link rel="canonical" href="{{ $seoData['canonical_url'] ?? url('/') }}">
    <meta property="og:title" content="{{ $seoData['og_title'] ?? ($seoData['title'] ?? '') }}">
    <meta property="og:description" content="{{ $seoData['og_description'] ?? ($seoData['description'] ?? '') }}">
    <meta property="og:image" content="{{ $seoData['og_image'] ?? asset('assets/img/logo-desa.png') }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #0d9488;
            /* Teal-600 */
            --primary-hover: #0f766e;
            /* Teal-700 */
            --secondary-color: #f0fdfa;
            /* Teal-50 */
            --text-dark: #1f2937;
            /* Gray-800 */
            --text-light: #6b7280;
            /* Gray-500 */
            --border-color: #e5e7eb;
            /* Gray-200 */
            --card-bg: #ffffff;
            --body-bg: #f9fafb;
            /* Gray-50 */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--body-bg);
            color: var(--text-dark);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Merriweather', serif;
            font-weight: 700;
        }

        /* --- Navbar --- */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand span {
            font-weight: 600;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-light);
            transition: color 0.3s ease;
        }

        .navbar.scrolled .nav-link {
            color: var(--text-dark);
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: var(--primary-color) !important;
        }

        /* --- Hero Section --- */
        #home {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            overflow: hidden;
        }

        #hero-video {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -2;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(10, 30, 40, 0.6);
            z-index: -1;
        }

        .hero-content h1 {
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            font-weight: 700;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .hero-content .highlight {
            color: #6ee7b7;
            /* Emerald-300 */
        }

        .hero-content p {
            max-width: 600px;
            margin: 20px auto 30px;
            font-size: 1.1rem;
            line-height: 1.8;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .btn-hero {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-hero.primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-hero.primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-3px);
        }

        .btn-hero.secondary {
            border-color: white;
            color: white;
        }

        .btn-hero.secondary:hover {
            background-color: white;
            color: var(--text-dark);
            transform: translateY(-3px);
        }

        /* --- General Section Styling --- */
        .section {
            padding: 80px 0;
        }

        .section-title {
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 2.5rem;
        }

        .section-title p {
            color: var(--text-light);
        }

        .divider {
            width: 80px;
            height: 4px;
            background: var(--primary-color);
            border-radius: 2px;
            margin: 20px auto;
        }

        /* --- Card Styling --- */
        .unified-card {
            background: var(--card-bg);
            border: 1px solid transparent;
            border-radius: 1rem;
            padding: 2.5rem;
            height: 100%;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .unified-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: inherit;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .unified-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.07);
        }

        .unified-card:hover::before {
            border-image: linear-gradient(135deg, var(--primary-color), #2dd4bf) 1;
        }

        /* Stats Card */
        .stat-card {
            text-align: center;
        }

        .stat-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .stat-label {
            font-size: 1rem;
            color: var(--text-light);
        }

        /* News & Complaint Card */
        .post-card {
            display: flex;
            flex-direction: column;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            overflow: hidden;
            height: 100%;
            transition: all 0.3s ease;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.07);
        }

        .post-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .post-card-body {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .post-card-body h5 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .post-card-body p {
            color: var(--text-light);
            flex-grow: 1;
        }

        .post-card-body .news-meta {
            font-size: 0.8rem;
            color: #9ca3af;
        }

        .post-card-body .btn-read-more {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }

        /* --- Struktur Organisasi --- */
        .org-card {
            background: var(--card-bg);
            border-radius: 1rem;
            text-align: center;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            height: 100%;
        }

        .org-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .org-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: -50px auto 1rem;
            border: 4px solid var(--card-bg);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .org-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .org-avatar .initial {
            font-size: 2.5rem;
            background-color: var(--primary-color);
            color: white;
        }

        .org-card h6 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .org-card p {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .org-badge {
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* --- Footer --- */
        .footer {
            background: var(--text-dark);
            color: #d1d5db;
            padding-top: 60px;
        }

        .footer h5 {
            color: white;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .footer p,
        .footer ul li a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer ul li a:hover {
            color: white;
        }

        .footer-bottom {
            padding: 20px 0;
            margin-top: 40px;
            background: rgba(0, 0, 0, 0.2);
            text-align: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#home">
                <img src="{{ asset('kemeneg.jpg') }}" alt="Logo" style="height: 40px;" class="me-2">
                <div>
                    <span class="fs-5 text-dark">{{ $seoData['og_title'] }}</span>
                    <small class="d-block text-muted"
                        style="font-size: 0.7rem; line-height: 1;">{{ $seoData['og_description'] }}</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class='bx bx-menu fs-3'></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home" data-section="home">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang" data-section="tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#struktur" data-section="struktur">Struktur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#berita" data-section="berita">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan" data-section="layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pengaduan" data-section="pengaduan">Pengaduan</a>
                    </li>
                    <li class="nav-item ms-lg-3"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home">
        <video id="hero-video" poster="{{ asset('assets/img/backgrounds/banner2.jpg') }}" playsinline autoplay muted
            loop>
            <source src="https://kua-kec-bathin-xxiv.com/assets/videos/background.mp4" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
        <div class="container" data-aos="fade-in">
            <div class="hero-content">
                <h1>Selamat Datang di <span class="highlight">{{ $seoData['title'] }}</span></h1>
                <p>{{ $seoData['description'] }}</p>
                <div class="mt-4">
                    <a href="#tentang" class="btn-hero primary mx-2">Tentang Kami</a>
                    <a href="#pengaduan" class="btn-hero secondary mx-2">Lapor Pengaduan</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row g-4" data-aos="fade-up">
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon"><i class='bx bx-group'></i></div>
                        <div class="stat-number">{{ $totalPeople }}</div>
                        <div class="stat-label">Pasangan Menikah</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon"><i class='bx bxs-book-bookmark'></i></div>
                        <div class="stat-number">{{ $totalFamilies }}</div>
                        <div class="stat-label">Pernikahan Tercatat</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon"><i class='bx bxs-briefcase-alt-2'></i></div>
                        <div class="stat-number">{{ $totalBloks }}</div>
                        <div class="stat-label">Jumlah Layanan</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon"><i class='bx bxs-star'></i></div>
                        <div class="stat-number">{{ $totalPrograms }}</div>
                        <div class="stat-label">Program Unggulan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-white" id="tentang">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="{{ asset('assets/img/backgrounds/banner2.jpg') }}" alt="Tentang KUA"
                        class="img-fluid rounded-4 shadow-lg">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <h2 class="display-5">Tentang Kantor Urusan Agama Bathin XXIV</h2>
                    <div class="divider" style="margin: 20px 0;"></div>
                    <p class="text-muted lead">{{ $seoData['description'] }}</p>
                    <p class="text-muted">Kami berkomitmen untuk memberikan pelayanan terbaik bagi masyarakat dalam
                        urusan keagamaan, pencatatan nikah, serta bimbingan keluarga sakinah. Kunjungi kami untuk
                        informasi dan layanan yang transparan dan akuntabel.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="struktur">
        <div class="container">
            <div class="section-title text-center" data-aos="fade-up">
                <h2 class="display-5">Struktur Perangkat KUA</h2>
                <div class="divider"></div>
                <p class="lead text-muted">Aparat yang berdedikasi untuk melayani masyarakat Kecamatan Bathin XXIV.</p>
            </div>

            <div class="row justify-content-center gy-5" data-aos="fade-up" data-aos-delay="200">
                @if ($kuaStructures['kepala_kemenag']->isNotEmpty())
                    @foreach ($kuaStructures['kepala_kemenag'] as $person)
                        <div class="col-lg-4 col-md-6">
                            <div class="org-card">
                                <div class="org-avatar">
                                    <div class="initial">{{ strtoupper(substr($person->name, 0, 1)) }}</div>
                                </div>
                                <h6>{{ $person->position }}</h6>
                                <p>{{ $person->name }}</p><span
                                    class="badge rounded-pill bg-label-success">{{ $person->department }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if ($kuaStructures['kesubagg_tu']->isNotEmpty())
                    @foreach ($kuaStructures['kesubagg_tu'] as $person)
                        <div class="col-lg-4 col-md-6">
                            <div class="org-card">
                                <div class="org-avatar">
                                    <div class="initial">{{ strtoupper(substr($person->name, 0, 1)) }}</div>
                                </div>
                                <h6>{{ $person->position }}</h6>
                                <p>{{ $person->name }}</p><span
                                    class="badge rounded-pill bg-label-primary">{{ $person->department }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif

                @if ($kuaStructures['kasi_bimas_islam']->isNotEmpty())
                    @foreach ($kuaStructures['kasi_bimas_islam'] as $person)
                        <div class="col-lg-4 col-md-6">
                            <div class="org-card">
                                <div class="org-avatar">
                                    <div class="initial">{{ strtoupper(substr($person->name, 0, 1)) }}</div>
                                </div>
                                <h6>{{ $person->position }}</h6>
                                <p>{{ $person->name }}</p><span
                                    class="badge rounded-pill bg-label-info">{{ $person->department }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="row justify-content-center gy-5 mt-4" data-aos="fade-up" data-aos-delay="400">
                @if ($kuaStructures['kepala_kua']->isNotEmpty())
                    @foreach ($kuaStructures['kepala_kua'] as $person)
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="org-card">
                                <div class="org-avatar">
                                    <div class="initial">{{ strtoupper(substr($person->name, 0, 1)) }}</div>
                                </div>
                                <h6>{{ $person->position }}</h6>
                                <p>{{ $person->name }}</p><span
                                    class="badge rounded-pill bg-label-dark">{{ $person->department }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if ($kuaStructures['pengadministrasi']->isNotEmpty())
                    @foreach ($kuaStructures['pengadministrasi'] as $person)
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="org-card">
                                <div class="org-avatar">
                                    <div class="initial">{{ strtoupper(substr($person->name, 0, 1)) }}</div>
                                </div>
                                <h6>{{ $person->position }}</h6>
                                <p>{{ $person->name }}</p><span
                                    class="badge rounded-pill bg-label-secondary">{{ $person->department }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if ($kuaStructures['operator_simkah']->isNotEmpty())
                    @foreach ($kuaStructures['operator_simkah'] as $person)
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="org-card">
                                <div class="org-avatar">
                                    <div class="initial">{{ strtoupper(substr($person->name, 0, 1)) }}</div>
                                </div>
                                <h6>{{ $person->position }}</h6>
                                <p>{{ $person->name }}</p><span
                                    class="badge rounded-pill bg-label-secondary">{{ $person->department }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if ($kuaStructures['pramu_kantor']->isNotEmpty())
                    @foreach ($kuaStructures['pramu_kantor'] as $person)
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="org-card">
                                <div class="org-avatar">
                                    <div class="initial">{{ strtoupper(substr($person->name, 0, 1)) }}</div>
                                </div>
                                <h6>{{ $person->position }}</h6>
                                <p>{{ $person->name }}</p><span
                                    class="badge rounded-pill bg-label-secondary">{{ $person->department }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="section bg-white" id="berita">
        <div class="container">
            <div class="section-title text-center" data-aos="fade-up">
                <h2 class="display-5">Berita & Informasi</h2>
                <div class="divider"></div>
                <p class="lead text-muted">Ikuti perkembangan dan kegiatan terbaru dari KUA Bathin XXIV.</p>
            </div>
            @if (isset($news) && $news->count() > 0)
                <div class="row g-4">
                    @foreach ($news as $new)
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ 100 * $loop->iteration }}">
                            <div class="post-card">
                                <img src="{{ $new->image ?? asset('storage/' . $new->image) }}"
                                    alt="{{ $new->title }}">
                                <div class="post-card-body">
                                    <div class="news-meta mb-2"><span class="text-muted"><i
                                                class='bx bx-time-five me-1'></i>{{ $new->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h5>{{ $new->title }}</h5>
                                    <p>{{ Str::limit(strip_tags($new->content), 100) }}</p><a
                                        href="{{ route('frontend.news.show', $new->id) }}"
                                        class="btn-read-more mt-auto">Baca Selengkapnya <i
                                            class='bx bx-right-arrow-alt'></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-light text-center">Tidak ada berita terbaru saat ini.</div>
            @endif
        </div>
    </section>

    <section class="section" id="layanan">
        <div class="container">
            <div class="section-title text-center" data-aos="fade-up">
                <h2 class="display-5">Layanan Digital</h2>
                <div class="divider"></div>
                <p class="lead text-muted">Akses berbagai layanan kami secara online untuk kemudahan Anda.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="unified-card text-center">
                        <div class="stat-icon"><i class='bx bx-news'></i></div>
                        <h4>Portal Berita</h4>
                        <p>Informasi terkini tentang kegiatan dan pengumuman resmi dari pemerintah desa.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="unified-card text-center">
                        <div class="stat-icon"><i class='bx bx-message-square-detail'></i></div>
                        <h4>Pengaduan Online</h4>
                        <p>Sampaikan aspirasi dan keluhan Anda secara online dengan mudah dan cepat.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="unified-card text-center">
                        <div class="stat-icon"><i class='bx bx-file-blank'></i></div>
                        <h4>Layanan Administrasi</h4>
                        <p>Akses mudah untuk berbagai keperluan administrasi desa dan dokumen penting.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-white" id="pengaduan">
        <div class="container">
            <div class="section-title text-center" data-aos="fade-up">
                <h2 class="display-5">Pengaduan Masyarakat</h2>
                <div class="divider"></div>
                <p class="lead text-muted">Ruang bagi masyarakat untuk menyampaikan keluhan dan masukan.</p>
            </div>
            @if (isset($complaints) && $complaints->count() > 0)
                <div class="row g-4">
                    @foreach ($complaints as $complaint)
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ 100 * $loop->iteration }}">
                            <div class="post-card"><img
                                    src="{{ $complaint->image ? asset('storage/' . $complaint->image) : asset('assets/img/backgrounds/masjid.jpg') }}"
                                    alt="{{ $complaint->title }}">
                                <div class="post-card-body">
                                    <div class="news-meta mb-2"><span class="text-muted"><i
                                                class='bx bx-time-five me-1'></i>{{ $complaint->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h5>{{ $complaint->title }}</h5>
                                    <p>{!! Str::limit(strip_tags($complaint->description), 100) !!}</p><a
                                        href="{{ route('frontend.complaints.show', $complaint->id) }}"
                                        class="btn-read-more mt-auto">Lihat Detail <i
                                            class='bx bx-right-arrow-alt'></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-light text-center">Belum ada pengaduan yang ditampilkan.</div>
            @endif
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-12">
                    <h5>Tentang Kami</h5>
                    <p>{{ $seoData['description'] }}</p>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <h5>Navigasi</h5>
                    <ul class="list-unstyled">
                        <li><a href="#home">Beranda</a></li>
                        <li><a href="#tentang">Tentang</a></li>
                        <li><a href="#struktur">Struktur</a></li>
                        <li><a href="#berita">Berita</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <h5>Layanan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#layanan">Layanan Digital</a></li>
                        <li><a href="#pengaduan">Pengaduan</a></li>
                        <li><a href="{{ route('login') }}">Login Admin</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="d-flex mb-2"><i class='bx bx-map me-2 mt-1'></i><span>{{ $location }}</span>
                        </li>
                        <li class="d-flex mb-2"><i
                                class='bx bx-envelope me-2 mt-1'></i><span>{{ $email }}</span></li>
                        <li class="d-flex mb-2"><i class='bx bx-phone me-2 mt-1'></i><span>{{ $telp }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="mb-0">&copy; {{ date('Y') }} {{ $seoData['title'] }}. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi AOS
            AOS.init({
                duration: 800,
                once: true,
                offset: 50
            });

            // Efek Navbar saat scroll
            const navbar = document.querySelector('.navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 0) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Navigasi aktif saat scroll
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link[data-section]');
            window.addEventListener('scroll', () => {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    if (pageYOffset >= sectionTop - 100) {
                        current = section.getAttribute('id');
                    }
                });
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('data-section') === current) {
                        link.classList.add('active');
                    }
                });
            });
        });
    </script>
</body>

</html>
