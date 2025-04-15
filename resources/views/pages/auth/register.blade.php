<!doctype html>

<html lang="en" class="layout-wide customizer-hide" data-assets-path="/sneat/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>
    LOGIN - {{ config('app.name') }}
  </title>

  <meta name="description" content="" />

  <link rel="icon" type="image/x-icon" href="/sneat/img/favicon/favicon.ico" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/sneat/vendor/fonts/iconify-icons.css" />
  <link rel="stylesheet" href="/sneat/vendor/css/core.css" />
  <link rel="stylesheet" href="/sneat/css/demo.css" />
  <link rel="stylesheet" href="/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="/sneat/vendor/css/pages/page-auth.css" />
  <script src="/sneat/vendor/js/helpers.js"></script>
  <script src="/sneat/js/config.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('customize/css/style.css') }}" />

</head>

<body class="figtree">

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <div class="card px-sm-6 px-0">
          <div class="card-body">
            <div class="app-brand justify-content-center">
              <a href="{{ route('home') }}" class="app-brand-link gap-2">
                <span class="app-brand-text demo text-heading fw-bold">{{ config('app.name') }}</span>
              </a>
            </div>
            <h4 class="mb-1">Hi! 👋</h4>
            <p class="mb-6">Please register to have account</p>

            <form id="formAuthentication" class="mb-6" action="{{ route('register') }}" method="POST">
              @csrf
              <div class="mb-6">
                <x-form.input type="text" field="name" title="Nama Anda" :value="old('name')" required oninput="removeValidationError(this)" />
              </div>
              <div class="mb-6">
                <x-form.select field="jk" title="Jenis Kelamin" class="select2" :value="old('jk')" :option="\App\Enums\User::jk()" data-minimum-results-for-search="Infinity" onchange="removeValidationError(this)" required />
              </div>
              <div class="mb-6">
                <x-form.textarea field="alamat" title="Alamat" :value="old('alamat')" oninput="removeValidationError(this)" />
              </div>
              <div class="mb-6">
                <x-form.input type="email" field="email" title="Email" :value="old('email')" required oninput="removeValidationError(this)" required />
              </div>

              <div class="mb-6 form-password-toggle">
                <label class="form-label fs-15 required" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                  <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                </div>
                @error('password')
                  <span class="text-danger mt-1"><small>{{ $message }}</small></span>
                @enderror
              </div>
              <div class="mb-8">
                <div class="d-flex justify-content-between">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="remember-me" required />
                    <label class="form-check-label" for="remember-me"> Saya yakin sudah mengisi dengan benar </label>
                  </div>
                  {{-- <a href="#">
                    <span>Forgot Password?</span>
                  </a> --}}
                </div>
              </div>
              <div class="mb-6">
                <button class="btn btn-primary d-grid w-100" type="submit">Daftar</button>
              </div>
            </form>

            <p class="text-center">
              <span>Sudah punya akun?</span>
              <a href="{{ route('login') }}">
                <span>Login</span>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="/sneat/vendor/libs/jquery/jquery.js"></script>
  <script src="/sneat/vendor/libs/popper/popper.js"></script>
  <script src="/sneat/vendor/js/bootstrap.js"></script>
  <script src="/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="/sneat/vendor/js/menu.js"></script>
  <script src="/sneat/js/main.js"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="{{ asset('customize/js/toast.js') }}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      @foreach (['success' => 'bg-success', 'error' => 'bg-danger', 'warning' => 'bg-warning', 'info' => 'bg-info'] as $key => $type)
        @if (session($key))
          showToast("{{ strtoupper($key) }}", "{{ session($key) }}", "text-white", "{{ $type }}", "top-0 end-0");
        @endif
      @endforeach
    });
  </script>
</body>

</html>
