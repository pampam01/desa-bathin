@include('auth.partials.head')

<!-- Content -->
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Auth Card -->
            <div class="card">
                <div class="card-body">

                    @include('auth.partials.logo')

                    <h4 class="mb-2 text-center">@yield('heading')</h4>
                    <p class="mb-4 text-center">@yield('subheading')</p>

                    @yield('content')

                    @hasSection('footer-links')
                        @yield('footer-links')
                    @endif

                </div>
            </div>
            <!-- /Auth Card -->
        </div>
    </div>
</div>
<!-- / Content -->

@include('auth.partials.scripts')
