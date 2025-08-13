<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tidak Ada Koneksi Internet – Portal KUA Bathin XXIV</title>
    <meta name="description" content="Halaman pemberitahuan jika tidak ada koneksi internet pada Portal KUA Bathin XXIV.">

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
            text-align: center;
        }

        .terms-card p {
            color: var(--text-light);
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
        </div>
    </nav>

    <main style="margin-top: 88px;">
        <section class="hero text-center">
            <div class="container">
                <h1 class="display-6 mb-2">Tidak Ada Koneksi Internet</h1>
                <p class="mb-0">Periksa koneksi Anda dan coba lagi.</p>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="terms-card">
                            <i class='bx bx-wifi-off fs-1 text-danger mb-3'></i>
                            <h3>Koneksi Terputus</h3>
                            <p>Kami tidak dapat menghubungkan ke server. Pastikan perangkat Anda terhubung ke internet.
                            </p>
                            <div class="d-flex justify-content-center gap-2 mt-4">
                                <button class="btn btn-primary" onclick="window.location.reload()">
                                    <i class='bx bx-refresh me-1'></i> Coba Lagi
                                </button>
                                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">
                                    <i class='bx bx-home me-1'></i> Kembali ke Beranda
                                </a>
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
        </div>
    </footer>

    <script>
        // Deteksi jika koneksi hilang setelah halaman terbuka
        window.addEventListener('offline', () => {
            alert("Koneksi internet Anda terputus!");
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
