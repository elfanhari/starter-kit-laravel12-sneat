<x-app>

  <x-slot:css>
  </x-slot:css>

  <x-partials.header-page href="{{ route('user.index') }}" title="Data User" />

  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <!-- Notifications -->
        <div class="card-body text-center">
          <div class="mb-3">
            <img src="{{ $user->url_avatar }}" alt="user-avatar" class="d-block mx-auto w-px-100 h-px-100 rounded" id="uploadedAvatar" />
          </div>
          <h5 class="mb-1">{{ $user->name }}</h5>
          <a href="{{ route('user.edit', $user->id) }}" class="text-decoration-underline">Edit</a>

        </div>
        <div class="table-responsive">
          <table class="table">
            @php
              $userData = [
                  'Email' => $user->email,
                  'Jenis Kelamin' => $user->jk == 'L' ? 'Laki-laki' : 'Perempuan',
                  'Role' => $user->role,
                  'Verified' => $user->email_verified_at ? 'Terverifikasi' : 'Belum Terverifikasi',
              ];
            @endphp
            @foreach ($userData as $k => $v)
              <tr>
                <td class="text-nowrap text-heading fw-bold">{{ $k }}</td>
                <td>
                  <div class="form-check mb-0 d-flex align-items-center">
                    {{ $v }}
                  </div>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>

  <x-slot:js>
    <script>
      function removeValidationError(input) {
        input.classList.remove('is-invalid');
        let feedback = input.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
          feedback.style.display = 'none';
        }
      }
    </script>
  </x-slot:js>

</x-app>
