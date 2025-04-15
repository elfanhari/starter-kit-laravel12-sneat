<x-app>

  <x-slot:css>
  </x-slot:css>

  <x-partials.header-page href="{{ route('user.index') }}" title="Data User" />

  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Edit Data User</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('user.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            @include('pages.user._form', ['action' => 'edit'])
            <x-form.submit checked />
          </form>
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
