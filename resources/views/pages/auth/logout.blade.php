<form action="{{ route('logout') }}" method="POST">
  @csrf
  <x-partials.modal id="modal-logout" title="Logout" class="">
    <x-slot:body>
      <p class="mb-0">Apakah anda yakin ingin keluar?</p>
    </x-slot:body>
    <x-slot:footer>
      <button class="btn btn-danger">Ya, keluar</button>
    </x-slot:footer>
  </x-partials.modal>
</form>
