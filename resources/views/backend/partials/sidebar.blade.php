<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/favicon/favicon.ico') }}" alt="Logo" class="logo"
                    style="width: 30px; height: 30px; aspect-ratio: 1/1; object-fit: contain;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2 text-capitalize fs-3 text-2xl">Pengaduan</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
            <a href="{{ route('dashboard.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Berita -->
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

        <!-- Pengaduan -->
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

        @if (Auth::user()->role == 'admin')
            <!-- Tanggapan Pengaduan -->
            <li class="menu-item {{ request()->routeIs('complaint-response.*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Complaint Reports">Tanggapan Pengaduan</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('complaint-response.index') ? 'active' : '' }}">
                        <a href="{{ route('complaint-response.index') }}" class="menu-link">
                            <div data-i18n="All Reports">Semua Tanggapan</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('complaint-response.create') ? 'active' : '' }}">
                        <a href="{{ route('complaint-response.create') }}" class="menu-link">
                            <div data-i18n="Create Report">Tambah Tanggapan</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        <!-- Pengajuan Surat -->
        <li class="menu-item {{ request()->routeIs('mail-submissions.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div data-i18n="Complaint Reports">Pengajuan Surat</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('mail-submissions.index') ? 'active' : '' }}">
                    <a href="{{ route('mail-submissions.index') }}" class="menu-link">
                        <div data-i18n="All Reports">Semua Pengajuan Surat</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('mail-submissions.create') ? 'active' : '' }}">
                    <a href="{{ route('mail-submissions.create') }}" class="menu-link">
                        <div data-i18n="Create Report">Tambah Pengajuan Surat</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Manajemen</span>
        </li>

        <!-- Admin -->
        @if (Auth::user()->role === 'admin')
            <li class="menu-item {{ request()->routeIs('aboutvillage.*') ? 'active' : '' }}">
                <a href="{{ route('aboutvillage.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-building-house"></i>
                    <div data-i18n="AboutVillage">Tentang Desa</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('villagestructure.*') ? 'active' : '' }}">
                <a href="{{ route('villagestructure.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-building"></i>
                    <div data-i18n="VillageStruktur">Struktur BPD Desa</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Users">Pengguna</div>
                </a>
            </li>
        @endif

        <!-- Profile -->
        <li class="menu-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <a href="{{ route('profile.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Profile">Profile</div>
            </a>
        </li>

        <!-- Settings -->
        {{-- <li class="menu-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
      <a href="{{ route('settings.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div data-i18n="Settings">Pengaturan</div>
      </a>
    </li> --}}
    </ul>
</aside>
<!-- / Menu -->
