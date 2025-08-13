<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Syarat dan Ketentuan – Portal KUA Bathin XXIV</title>
    <meta name="description"
        content="Syarat dan Ketentuan penggunaan Portal KUA Bathin XXIV. Harap baca dengan saksama sebelum menggunakan layanan kami.">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        h3,
        h4,
        h5,
        h6 {
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

        .hero .breadcrumb a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
        }

        .hero .breadcrumb .separator {
            opacity: 0.8;
            margin: 0 8px;
        }

        .terms-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        }

        .terms-card h3 {
            font-size: 1.35rem;
            margin-top: 1.5rem;
        }

        .terms-card p {
            color: var(--text-light);
        }

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
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="display-6 mb-2">Syarat dan Ketentuan</h1>
                        <p class="mb-0">Harap baca syarat dan ketentuan penggunaan Portal KUA Bathin XXIV ini dengan
                            saksama.</p>
                        <div class="breadcrumb mt-2 small">
                            <a href="{{ route('welcome') }}">Beranda</a>
                            <span class="separator">/</span>
                            <span>Syarat dan Ketentuan</span>
                        </div>
                    </div>
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
                                Versi ini berlaku efektif per {{ date('d F Y') }}. Dengan mengakses atau menggunakan
                                situs, Anda dianggap menyetujui ketentuan ini.
                            </div>

                            <h3>1. Penerimaan Ketentuan</h3>
                            <p>Dengan mengakses dan/atau menggunakan layanan pada Portal KUA Bathin XXIV ("Portal"),
                                Anda menyatakan telah membaca, memahami, dan menyetujui untuk terikat pada Syarat dan
                                Ketentuan ini serta kebijakan yang menjadi bagiannya, termasuk <a
                                    href="{{ route('privacy') }}">Kebijakan Privasi</a>.</p>

                            <h3>2. Definisi</h3>
                            <ul>
                                <li><strong>Pengguna</strong>: setiap orang yang mengakses atau menggunakan Portal.</li>
                                <li><strong>Layanan</strong>: seluruh fitur yang disediakan, termasuk informasi berita,
                                    pengaduan masyarakat, dan layanan administrasi.</li>
                            </ul>

                            <h3>3. Ketentuan Penggunaan</h3>
                            <ul>
                                <li>Pengguna wajib memberikan informasi yang benar, akurat, dan dapat
                                    dipertanggungjawabkan.</li>
                                <li>Dilarang mengunggah konten yang melanggar hukum, memfitnah, mengandung SARA,
                                    pornografi, atau meresahkan masyarakat.</li>
                                <li>Dilarang melakukan percobaan peretasan, mengganggu kinerja sistem, atau
                                    penyalahgunaan layanan.</li>
                                <li>Administrasi berhak menolak, menyunting, dan/atau menghapus konten yang melanggar
                                    ketentuan.</li>
                            </ul>

                            <h3>4. Hak Kekayaan Intelektual</h3>
                            <p>Seluruh materi pada Portal (termasuk logo, teks, desain, dan gambar) dilindungi oleh
                                hukum. Penggunaan di luar tujuan non-komersial tanpa izin tertulis dilarang.</p>

                            <h3>5. Konten Pengguna</h3>
                            <p>Dengan mengirimkan pengaduan atau komentar, Anda memberikan lisensi non-eksklusif kepada
                                pengelola untuk menggunakan, menampilkan, dan menyimpan konten tersebut sesuai kebutuhan
                                operasional layanan.</p>

                            <h3>6. Privasi dan Keamanan Data</h3>
                            <p>Pengelolaan data diatur dalam <a href="{{ route('privacy') }}">Kebijakan Privasi</a>.
                                Kami menerapkan langkah-langkah keamanan yang wajar untuk melindungi data, namun tidak
                                dapat menjamin keamanan absolut.</p>

                            <h3>7. Batasan Tanggung Jawab</h3>
                            <p>Portal disediakan sebagaimana adanya. Pengelola tidak bertanggung jawab atas kerugian
                                langsung maupun tidak langsung yang timbul dari penggunaan atau ketidakmampuan
                                menggunakan layanan.</p>

                            <h3>8. Perubahan Layanan dan Ketentuan</h3>
                            <p>Kami dapat memperbarui layanan dan/atau mengubah Syarat dan Ketentuan ini kapan saja.
                                Perubahan akan diberitahukan melalui Portal dan berlaku saat diumumkan.</p>

                            <h3>9. Hukum yang Berlaku</h3>
                            <p>Ketentuan ini diatur oleh hukum Republik Indonesia. Sengketa akan diselesaikan secara
                                musyawarah, atau melalui jalur hukum yang berlaku bila diperlukan.</p>

                            <h3>10. Kontak</h3>
                            <p>Untuk pertanyaan terkait ketentuan ini, silakan hubungi kami melalui halaman <a
                                    href="{{ route('welcome') }}#tentang">Tentang</a> atau menu <a
                                    href="{{ route('frontend.complaints.index') }}">Pengaduan</a>.</p>

                            <div class="d-flex flex-wrap gap-2 mt-4">
                                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary"><i
                                        class='bx bx-left-arrow-alt me-1'></i> Kembali ke Beranda</a>
                                <a href="{{ route('frontend.complaints.index') }}" class="btn btn-success"
                                    style="background: var(--primary-color); border-color: var(--primary-color);"><i
                                        class='bx bx-check-circle me-1'></i> Saya Mengerti</a>
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
