<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi – Portal KUA Bathin XXIV</title>
    <meta name="description"
        content="Kebijakan Privasi penggunaan Portal KUA Bathin XXIV. Pelajari bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda.">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #0d9488;
            --primary-hover: #0f766e;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --border-color: #e5e7eb;
            --card-bg: #ffffff;
            --body-bg: #f9fafb;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--body-bg);
            color: var(--text-dark);
        }

        h1,
        h2,
        h3 {
            font-family: 'Merriweather', serif;
            font-weight: 700;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .nav-link {
            color: var(--text-light);
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-color) !important;
        }

        .hero {
            background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%);
            color: #fff;
            padding: 90px 0 60px;
        }

        .terms-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        }

        .terms-card p,
        .terms-card ul {
            color: var(--text-light);
        }

        .callout {
            background: #ecfeff;
            border: 1px solid #a5f3fc;
            color: #155e75;
            border-radius: .75rem;
            padding: 1rem 1.25rem;
        }

        .footer {
            border-top: 1px solid var(--border-color);
            background: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
                <img src="{{ asset('kemeneg.jpg') }}" alt="Logo" style="height: 38px;" class="me-2">
                <div>
                    <span class="fs-6 text-dark d-block">Portal KUA Bathin XXIV</span>
                    <small class="text-muted">Layanan Informasi & Pengaduan</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class='bx bx-menu fs-3'></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('frontend.news.index') }}">Berita</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('frontend.complaints.index') }}">Pengaduan</a></li>
                    <li class="nav-item ms-lg-3"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main style="margin-top: 88px;">
        <section class="hero">
            <div class="container">
                <h1 class="display-6 mb-2">Kebijakan Privasi</h1>
                <p class="mb-0">Pelajari bagaimana kami mengelola, melindungi, dan menggunakan informasi Anda di
                    Portal KUA Bathin XXIV.</p>
                <div class="breadcrumb mt-2 small">
                    <a href="{{ route('welcome') }}">Beranda</a>
                    <span class="separator">/</span>
                    <span>Kebijakan Privasi</span>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="terms-card">
                            <div class="callout mb-3">
                                <i class='bx bx-info-circle me-1'></i>
                                Kebijakan Privasi ini berlaku efektif per {{ date('d F Y') }}.
                            </div>

                            <h3>1. Informasi yang Kami Kumpulkan</h3>
                            <p>Kami dapat mengumpulkan informasi pribadi seperti nama, alamat email, nomor telepon,
                                serta data lain yang Anda berikan saat menggunakan layanan.</p>

                            <h3>2. Penggunaan Informasi</h3>
                            <p>Informasi yang dikumpulkan digunakan untuk memberikan layanan, mengelola pengaduan,
                                meningkatkan pengalaman pengguna, dan keperluan komunikasi resmi.</p>

                            <h3>3. Perlindungan Data</h3>
                            <p>Kami menerapkan langkah-langkah keamanan yang wajar untuk melindungi data dari akses,
                                penggunaan, atau pengungkapan yang tidak sah.</p>

                            <h3>4. Berbagi Informasi</h3>
                            <p>Kami tidak akan membagikan informasi pribadi Anda kepada pihak ketiga, kecuali jika
                                diwajibkan oleh hukum atau dengan persetujuan Anda.</p>

                            <h3>5. Hak Pengguna</h3>
                            <p>Anda berhak mengakses, memperbarui, atau menghapus informasi pribadi Anda yang disimpan
                                oleh kami dengan menghubungi pengelola.</p>

                            <h3>6. Perubahan Kebijakan</h3>
                            <p>Kami dapat memperbarui Kebijakan Privasi ini sewaktu-waktu. Perubahan akan diumumkan
                                melalui halaman ini.</p>

                            <h3>7. Kontak</h3>
                            <p>Jika Anda memiliki pertanyaan tentang kebijakan ini, silakan hubungi kami melalui halaman
                                <a href="{{ route('welcome') }}#tentang">Tentang</a>.</p>

                            <div class="d-flex flex-wrap gap-2 mt-4">
                                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary"><i
                                        class='bx bx-left-arrow-alt me-1'></i> Kembali ke Beranda</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer py-4">
        <div class="container text-center small text-muted">
            <div>&copy; {{ date('Y') }} Portal KUA Bathin XXIV. Hak Cipta Dilindungi.</div>
            <div class="mt-1">
                <a href="{{ route('terms') }}" class="text-muted me-2">Syarat & Ketentuan</a>
                <span class="text-muted">•</span>
                <a href="{{ route('privacy') }}" class="text-muted ms-2">Kebijakan Privasi</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
