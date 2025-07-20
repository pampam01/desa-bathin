@include('backend.partials.head')

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    
    @include('backend.partials.sidebar')

    <!-- Layout page -->
    <div class="layout-page">
      
      @include('backend.partials.navbar')

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          
          <!-- Page Header -->
          @hasSection('page-header')
            <div class="row">
              <div class="col-12">
                @yield('page-header')
              </div>
            </div>
          @endif

          <!-- Breadcrumb -->
          @hasSection('breadcrumb')
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                @yield('breadcrumb')
              </ol>
            </nav>
          @endif

          <!-- Flash Messages -->
          @include('backend.partials.alerts')

          <!-- Main Content -->
          @yield('content')
          
        </div>
        <!-- / Content -->

        @include('backend.partials.footer')

        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Global Modals and Components -->
@include('backend.partials.modals')

@include('backend.partials.scripts')
