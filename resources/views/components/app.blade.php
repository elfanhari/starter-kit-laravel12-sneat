<!doctype html>

<html lang="en" class="layout-menu-fixed layout-wide" data-assets-path="{{ asset('sneat') }}" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>
    @isset($title)
      {{ config('app.name') }} - {{ $title }}
    @else
      {{ config('app.name') }}
    @endisset
  </title>

  <meta name="description" content="" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('sneat/img/favicon/favicon.ico') }}" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('sneat/vendor/fonts/iconify-icons.css') }}" />
  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('sneat/vendor/css/core.css') }}" />
  <link rel="stylesheet" href="{{ asset('sneat/css/demo.css') }}" />
  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <!-- Page CSS -->
  <link rel="stylesheet" href="{{ asset('customize/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('customize/css/loader.css') }}" />
  <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/select2/style.css') }}" />

  <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  @isset($css)
    {{ $css }}
  @endisset

  <!-- Helpers -->
  <script src="{{ asset('sneat/vendor/js/helpers.js') }}"></script>

  <script src="{{ asset('sneat/js/config.js') }}"></script>
</head>

<body class="figtree">
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <x-sidebar />

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <x-navbar />
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-fluid flex-grow-1 container-p-y">
            {{ $slot }}
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <x-footer />
          <!-- / Footer -->

          @include('pages.auth.logout')

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <x-partials.toast />

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

  </div>


  <div id="loader" class="loader"></div>

  <!-- Core JS -->

  <script src="{{ asset('sneat/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('sneat/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('sneat/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('sneat/vendor/js/menu.js') }}"></script>

  <script src="{{ asset('sneat/js/main.js') }}"></script>
  <script src="{{ asset('customize/js/script.js') }}"></script>
  <script src="{{ asset('customize/js/toast.js') }}"></script>
  <script src="{{ asset('customize/js/loader.js') }}"></script>
  <script src="{{ asset('sneat/vendor/libs/select2/script.js') }}"></script>

  <!-- Page JS -->

  <!-- Place this tag before closing body tag for github widget button. -->
  {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      @foreach (['success' => 'bg-success', 'error' => 'bg-danger', 'warning' => 'bg-warning', 'info' => 'bg-info'] as $key => $type)
        @if (session($key))
          showToast("{{ strtoupper($key) }}", "{{ session($key) }}", "text-white", "{{ $type }}", "top-0 end-0");
        @endif
      @endforeach
    });
  </script>
  <script>
    $(document).ready(function() {
      $(".select2").select2();
    });
  </script>

  @isset($js)
    {{ $js }}
  @endisset
</body>

</html>
