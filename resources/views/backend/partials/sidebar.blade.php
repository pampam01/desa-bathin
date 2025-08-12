@push('styles')
<style>
    /* --- Custom Sidebar Styles --- */
    .layout-menu {
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
        border-right: 1px solid #e9ecef;
    }
    .app-brand {
        padding: 20px 24px;
        height: 64px; /* Samakan dengan tinggi navbar */
    }
    .app-brand .app-brand-text {
        font-size: 1.5rem !important; /* Menyesuaikan ukuran font */
        font-weight: 700 !important;
        color: #566a7f;
    }

    .menu-inner > .menu-item > .menu-link {
        margin: 0 1rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
    }
    .menu-inner > .menu-item:not(.active) > .menu-link:hover {
        background-color: rgba(105, 108, 255, 0.07) !important;
        color: #696cff !important;
    }
    .menu-inner > .menu-item.active > .menu-link {
        background: linear-gradient(45deg, #696cff, #7c4dff);
        color: #fff !important;
        box-shadow: 0 2px 8px rgba(105, 108, 255, 0.5);
    }
    .menu-inner > .menu-item.active > .menu-link i {
        color: #fff !important;
    }
    
    .menu-sub .menu-item .menu-link {
        padding-left: 3.5rem !important;
        position: relative;
    }
    .menu-sub .menu-item::before {
        content: '';
        position: absolute;
        left: 2.2rem;
        top: 0;
        bottom: 0;
        width: 1px;
        background-color: #e9ecef;
    }
    .menu-sub .menu-item:last-child::before {
        height: 1.1rem; /* Garis berhenti di item terakhir */
    }
    .menu-sub .menu-item.active > .menu-link::after {
        content: '';
        position: absolute;
        left: 2.2rem;
        top: 50%;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #696cff;
        border: 1px solid #fff;
        margin-left: -4px;
        box-shadow: 0 0 0 3px rgba(105, 108, 255, 0.2);
    }
    .menu-sub .menu-item.active > .menu-link {
        color: #696cff !important;
        background-color: transparent !important;
    }

    .menu-header {
        padding: 0.5rem 1.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        color: #a1acb8;
    }
</style>
@endpush

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/favicon/favicon.ico') }}" alt="Logo" class="logo"
                     style="width: 32px; height: 32px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2 text-capitalize">Pengaduan</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Utama</span>
        </li>
        
        <li class="menu-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
            <a href="{{ route('dashboard.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('news.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="News">Berita</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('news.index') ? 'active' : '' }}">
                    <a href="{{ route('news.index') }}" class="menu-link">
                        <div data-i18n="All News">Semua Berita</div>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="menu-item {{ request()->routeIs('news.create') ? 'active' : '' }}">
                        <a href="{{ route('news.create') }}" class="menu-link">
                            <div data-i18n="Add News">Tambah Berita</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        <li class="menu-item {{ request()->routeIs('complaints.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-message-dots"></i>
                <div data-i18n="Complaints">Pengaduan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('complaints.index') ? 'active' : '' }}">
                    <a href="{{ route('complaints.index') }}" class="menu-link">
                        <div data-i18n="All Complaints">Semua Pengaduan</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('complaints.create') ? 'active' : '' }}">
                    <a href="{{ route('complaints.create') }}" class="menu-link">
                        <div data-i18n="Create Complaints">Tambah Pengaduan</div>
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="menu-item {{ request()->routeIs('mail-submissions.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div data-i18n="Mail Submissions">Pengajuan Surat</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('mail-submissions.index') ? 'active' : '' }}">
                    <a href="{{ route('mail-submissions.index') }}" class="menu-link">
                        <div data-i18n="All Mail Submissions">Semua Pengajuan</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('mail-submissions.create') ? 'active' : '' }}">
                    <a href="{{ route('mail-submissions.create') }}" class="menu-link">
                        <div data-i18n="Create Mail Submission">Buat Pengajuan</div>
                    </a>
                </li>
            </ul>
        </li>

        @if (Auth::user()->role == 'admin')
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Admin</span>
            </li>
            
            <li class="menu-item {{ request()->routeIs('complaint-response.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Complaint Responses">Tanggapan</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('complaint-response.index') ? 'active' : '' }}">
                        <a href="{{ route('complaint-response.index') }}" class="menu-link">
                            <div data-i18n="All Responses">Semua Tanggapan</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('complaint-response.create') ? 'active' : '' }}">
                        <a href="{{ route('complaint-response.create') }}" class="menu-link">
                            <div data-i18n="Create Response">Tambah Tanggapan</div>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="menu-item {{ request()->routeIs('aboutvillage.*') ? 'active' : '' }}">
                <a href="{{ route('aboutvillage.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-building-house"></i>
                    <div data-i18n="About Village">Tentang KUA</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('kuastructure.*') ? 'active' : '' }}">
                <a href="{{ route('kuastructure.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-sitemap"></i>
                    <div data-i18n="KUA Structure">Struktur KUA</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Users">Pengguna</div>
                </a>
            </li>
        @endif

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Akun</span>
        </li>
        <li class="menu-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <a href="{{ route('profile.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Profile">Profile Saya</div>
            </a>
        </li>
    </ul>
</aside>