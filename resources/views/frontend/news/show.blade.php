@extends('frontend.layouts.app')

@section('title', $news->title . ' - Portal Parakan')

@push('styles')
    <style>
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0 60px;
            margin-top: -80px;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.7);
        }

        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: white;
        }

        .news-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 3rem;
        }

        .news-header {
            padding: 2rem;
            border-bottom: 1px solid #eee;
        }

        .news-meta {
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .news-meta .badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .news-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        .news-featured-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .news-body {
            padding: 2rem;
        }

        .news-body p {
            line-height: 1.8;
            margin-bottom: 1.5rem;
            color: #495057;
            font-size: 1.1rem;
        }

        .news-body h2,
        .news-body h3 {
            color: #2c3e50;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .news-body ul,
        .news-body ol {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }

        .news-body li {
            margin-bottom: 0.5rem;
            line-height: 1.6;
        }

        .social-share {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin: 2rem 0;
        }

        .btn-share {
            margin: 0.25rem;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .related-news {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .related-news-card {
            border: 1px solid #eee;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .related-news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .related-news-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .related-news-card .card-body {
            padding: 1rem;
        }

        .related-news-card h6 {
            font-size: 0.95rem;
            line-height: 1.4;
            margin-bottom: 0.5rem;
        }

        .related-news-card .card-text {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .back-to-list {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .back-to-list:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('frontend.news.index') }}">Berita</a></li>
                            <li class="breadcrumb-item active">{{ Str::limit($news->title, 50) }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- News Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Main News Content -->
                    <a href="{{ route('frontend.news.index') }}" class="btn btn-secondary rounded-4 mb-3">
                        <i class='bx bx-arrow-back me-2'></i>
                        Kembali ke Daftar Berita
                    </a>
                    <article class="news-content">
                        <div class="news-header">
                            <div class="news-meta">
                                <span class="badge me-2">Berita Desa</span>
                                <i class='bx bx-time-five me-1'></i>
                                {{ $news->created_at->format('d F Y, H:i') }} WIB
                                <span class="mx-2">•</span>
                                <i class='bx bx-user me-1'></i>
                                {{ $news->user->name ?? 'Admin' }}
                            </div>
                            <h1 class="news-title">{{ $news->title }}</h1>
                        </div>

                        @if ($news->image)
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}"
                                class="news-featured-image">
                        @endif

                        <div class="news-body">
                            {!! nl2br(e($news->content)) !!}
                        </div>

                        <!-- Social Share -->
                        <div class="social-share">
                            <h6 class="mb-3">
                                <i class='bx bx-share-alt me-2'></i>
                                Bagikan Berita Ini
                            </h6>
                            <div class="d-flex flex-wrap">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                    target="_blank" class="btn btn-primary btn-share">
                                    <i class='bx bxl-facebook me-1'></i>
                                    Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($news->title) }}"
                                    target="_blank" class="btn btn-info btn-share">
                                    <i class='bx bxl-twitter me-1'></i>
                                    Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . request()->fullUrl()) }}"
                                    target="_blank" class="btn btn-success btn-share">
                                    <i class='bx bxl-whatsapp me-1'></i>
                                    WhatsApp
                                </a>
                                <button onclick="copyToClipboard()" class="btn btn-secondary btn-share">
                                    <i class='bx bx-copy me-1'></i>
                                    Salin Link
                                </button>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4">
                    <!-- Related News -->
                    @if ($relatedNews->count() > 0)
                        <div class="related-news">
                            <h5 class="mb-4">
                                <i class='bx bx-news me-2'></i>
                                Berita Terkait
                            </h5>

                            @foreach ($relatedNews as $related)
                                <div class="related-news-card mb-3">
                                    <img src="{{ $related->image ? asset('storage/' . $related->image) : asset('assets/img/backgrounds/masjid.jpg') }}"
                                        alt="{{ $related->title }}">
                                    <div class="card-body">
                                        <h6>
                                            <a href="{{ route('frontend.news.show', $related->id) }}"
                                                class="text-decoration-none text-dark">
                                                {{ Str::limit($related->title, 60) }}
                                            </a>
                                        </h6>
                                        <p class="card-text">
                                            <small>{{ $related->created_at->format('d M Y') }}</small>
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                            <div class="text-center mt-4">
                                <a href="{{ route('frontend.news.index') }}"
                                    class="btn btn-outline-primary btn-sm rounded-pill">
                                    <i class='bx bx-right-arrow-alt me-1'></i>
                                    Lihat Semua Berita
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function copyToClipboard() {
            navigator.clipboard.writeText(window.location.href).then(function() {
                // Success
                const btn = event.target.closest('button');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="bx bx-check me-1"></i>Tersalin!';
                btn.classList.remove('btn-secondary');
                btn.classList.add('btn-success');

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-secondary');
                }, 2000);
            }, function(err) {
                // Error
                alert('Gagal menyalin link');
            });
        }

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

        // Observe elements
        document.querySelectorAll('.news-content, .related-news').forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'all 0.6s ease';
            observer.observe(element);
        });
    </script>
@endpush
