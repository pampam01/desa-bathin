<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if (auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar"
                                class="rounded-circle">
                        @else
                            <div class="avatar-placeholder w-px-40 h-auto rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: 2.5rem; font-weight: bold;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        @if (auth()->user()->avatar)
                                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar"
                                                class="rounded-circle">
                                        @else
                                            <div class="avatar-placeholder w-px-40 h-auto rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: 2.5rem; font-weight: bold;">
                                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ auth()->user()->name ?? 'Admin' }}</span>
                                    <small class="text-muted">{{ auth()->user()->role ?? 'Administrator' }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">Profil Saya</span>
                        </a>
                    </li>
                    {{-- <li>
            <a class="dropdown-item" href="route('settings.index') ">
              <i class="bx bx-cog me-2"></i>
              <span class="align-middle">Pengaturan</span>
            </a>
          </li> --}}
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item""
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Keluar</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<!-- / Navbar -->
