<x-app>

  <x-slot:css>
  </x-slot:css>

  <x-partials.header-page :title="$user->name" desc="Kelola data pribadi Anda" />

  <div class="row">
    <div class="col-lg-6">

      <div class="card">
        <form id="formAccountSettings" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
              <img src="{{ $user->url_avatar }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
              <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                  <span class="d-none d-sm-block">Ganti foto profil</span>
                  <i class="icon-base bx bx-upload d-block d-sm-none"></i>
                  <input type="file" id="upload" name="avatar" class="account-file-input" hidden accept="image" />
                </label>
                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                  <i class="icon-base bx bx-reset d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Batal</span>
                </button>
              </div>
            </div>
            @error('avatar')
              <span class="text-danger mt-1">{{ $message }}</span>
            @enderror
          </div>
          <div class="card-body pt-4">
            <div class="mb-6">
              <x-form.input type="text" field="name" title="Nama User" :value="$user->name" required oninput="removeValidationError(this)" />
            </div>
            <div class="mb-6">
              <x-form.select field="jk" title="Jenis Kelamin" class="select2" :value="$user->jk" :option="\App\Enums\User::jk()" data-minimum-results-for-search="Infinity" onchange="removeValidationError(this)" required />
            </div>
            <div class="mb-6">
              <x-form.textarea field="alamat" title="Alamat" :value="$user->alamat" oninput="removeValidationError(this)" />
            </div>
            <div class="mb-6">
              <x-form.input type="email" field="email" title="Email" :value="$user->email" required oninput="removeValidationError(this)" required />
            </div>
            <div class="mb-6">
              <x-form.input type="password" field="password" title="Password Baru" oninput="removeValidationError(this)" />
            </div>

            <div class="mt-6">
              <button type="submit" class="btn btn-primary me-3">Perbarui</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>

  <x-slot:js>
    <script src="/sneat/js/pages-account-settings-account.js"></script>
  </x-slot:js>

</x-app>
