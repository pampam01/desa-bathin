<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 | Halaman Tidak Ditemukan</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Nunito:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #0f5132 0%, #198754 50%, #20c997 100%);
            min-height: 100vh;
            color: #fff;
            position: relative;
            padding: 2rem 0;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="islamic" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/><path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23islamic)"/></svg>');
            opacity: 0.3;
        }

        .container {
            text-align: center;
            z-index: 10;
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        .mosque-icon {
            font-size: 8rem;
            margin-bottom: 1rem;
            color: #fff;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .error-number {
            font-family: 'Amiri', serif;
            font-size: 12rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            margin: 1rem 0;
            line-height: 1;
        }

        .error-title {
            font-family: 'Amiri', serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .error-message {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
        }

        .islamic-quote {
            font-family: 'Amiri', serif;
            font-style: italic;
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
            padding: 1rem;
            border-left: 4px solid #fff;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 0 8px 8px 0;
        }

        .buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 1rem 2rem;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-primary {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            color: #0f5132;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #fff;
            border: 2px solid #fff;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            top: 20%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        @media (max-width: 768px) {
            .error-number {
                font-size: 8rem;
            }

            .error-title {
                font-size: 2rem;
            }

            .mosque-icon {
                font-size: 6rem;
            }

            .buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>

<body>
    <div class="floating-elements">
        <div class="floating-element">☪</div>
        <div class="floating-element">🕌</div>
        <div class="floating-element">📿</div>
    </div>

    <div class="container">
        <div class="mosque-icon">🕌</div>
        <div class="error-number">404</div>
        <h1 class="error-title">Halaman Tidak Ditemukan</h1>
        <p class="error-message">
            Maaf, halaman yang Anda cari tidak dapat ditemukan.<br>
            Seperti mencari hikmah dalam kehidupan, kadang kita harus kembali ke jalan yang benar.
        </p>

        <div class="islamic-quote">
            "Sesungguhnya Allah bersama orang-orang yang sabar"<br>
            <small>- Al-Baqarah: 153</small>
        </div>

        <div class="buttons">
            <a href="{{ route('welcome') }}" class="btn btn-primary">
                🏠 Kembali ke Beranda
            </a>
            <a href="javascript:history.back()" class="btn btn-secondary">
                ⬅️ Kembali Sebelumnya
            </a>
        </div>
    </div>
</body>

</html>
