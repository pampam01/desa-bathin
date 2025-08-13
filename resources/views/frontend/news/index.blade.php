@extends('frontend.layouts.app')

@section('title', 'Berita & Informasi')

@push('styles')
    <style>
        .page-header {
            background: linear-gradient(135deg, #66ea73 0%, #4ba24e 100%);
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

        .news-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .news-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .news-card-body {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .news-meta {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .news-card h5 {
            font-weight: 600;
            margin-bottom: 1rem;
            line-height: 1.4;
            flex: 1;
        }

        .news-card p {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .search-bar {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            color: white;
        }

        .search-bar::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-bar:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            color: white;
            box-shadow: none;
        }

        .btn-search {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 50px;
        }

        .btn-search:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .pagination {
            margin-top: 3rem;
        }

        .page-link {
            border-radius: 50px;
            margin: 0 2px;
            border: none;
            color: #66ea73;
        }

        .page-link:hover {
            background-color: #66ea73;
            color: white;
        }

        .page-item.active .page-link {
            background-color: #66ea73;
            border-color: #66ea6f;
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Berita</li>
                        </ol>
                    </nav>
                    <h1 class="display-4 fw-bold mb-3">Berita </h1>
                    <p class="lead">Informasi terkini KUA Bathin XXIV</p>
                </div>
                <div class="col-lg-4">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('frontend.news.index') }}" class="mt-4">
                        <div class="input-group">
                            <input type="text" class="form-control search-bar" name="search"
                                value="{{ request('search') }}" placeholder="Cari berita...">
                            <button class="btn btn-search" type="submit">
                                <i class='bx bx-search'></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- News Content -->
    <section class="py-5">
        <div class="container">
            @if (request('search'))
                <div class="alert alert-info">
                    <i class='bx bx-search me-2'></i>
                    Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
                    <a href="{{ route('frontend.news.index') }}" class="btn btn-sm btn-outline-primary ms-2">
                        <i class='bx bx-x'></i> Hapus Filter
                    </a>
                </div>
            @endif

            @if ($news->count() > 0)
                <div class="row g-4">
                    @foreach ($news as $item)
                        <div class="col-lg-4 col-md-6">
                            <article class="news-card">
                                <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/backgrounds/masjid.jpg') }}"
                                    alt="{{ $item->title }}" loading="lazy">
                                <div class="news-card-body">
                                    <div class="news-meta">
                                        <i class='bx bx-time-five text-danger me-1'></i>
                                        {{ $item->created_at->format('d M Y') }}
                                        <span class="mx-2">•</span>
                                        <i class='bx bx-user me-1'></i>
                                        {{ $item->user->name ?? 'Admin' }}
                                    </div>
                                    <h5>{{ $item->title }}</h5>
                                    <p>{!! Str::limit(strip_tags($item->content), 120) !!}</p>
                                    <a href="{{ route('frontend.news.show', $item->id) }}"
                                        class="btn btn-outline-danger btn-sm rounded-pill">
                                        <i class='bx bx-right-arrow-alt me-1'></i>
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $news->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class='bx bx-news bx-lg text-muted mb-3'></i>
                    <h4 class="text-muted mb-3">
                        @if (request('search'))
                            Tidak ada berita yang ditemukan
                        @else
                            Belum ada berita tersedia
                        @endif
                    </h4>
                    <p class="text-muted">
                        @if (request('search'))
                            Coba gunakan kata kunci yang berbeda atau
                            <a href="{{ route('frontend.news.index') }}">lihat semua berita</a>
                        @else
                            Berita akan segera tersedia. Silakan kembali lagi nanti.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
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

        // Observe all news cards
        document.querySelectorAll('.news-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });
    </script>
@endpush
