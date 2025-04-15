<x-app>

  <x-slot:css>
    <link href="{{ asset('datatables/dataTables.bootstrap5.css') }}">
  </x-slot:css>

  <x-partials.header-page title="Data User" desc="lorem ipsum dolor sit amet" />

  <div class="card" id="card">
    <div class="card-header border-bottom">
      <x-form.button href="{{ route('user.create') }}" class="btn-sm btn-primary">
        <x-partials.icon class="bx-plus me-1" />
        Tambah
      </x-form.button>
      <x-form.button class="btn btn-info btn-sm float-end" id="btn-filter">
        <x-partials.icon class="bx-filter me-1" />
        Filter
      </x-form.button>
    </div>
    <div class="card-body">
      <div class="table-responsive nowrap">
        <table class="table table-striped table-hover" id="table-index">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Email</th>
              <th>JK</th>
              <th>Role</th>
              <th>Verified</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="table-border bottom-0">
            @foreach ($users as $user)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->jk }}</td>
                <td>{{ $user->role }}</td>
                <td>
                  @if ($user->email_verified_at)
                    <span class="badge bg-label-success">Terverifikasi</span>
                  @else
                    <span class="badge bg-label-danger">Belum Terverifikasi</span>
                  @endif
                </td>
                <td>
                  <div class="btn-group">
                    <x-form.button href="{{ route('user.show', $user->id) }}" class="btn-sm btn-info">
                      <x-partials.icon class="bx-show" />
                    </x-form.button>
                    <x-form.button href="{{ route('user.edit', $user->id) }}" class="btn-sm btn-warning btn-edit">
                      <x-partials.icon class="bx-pencil" />
                    </x-form.button>
                    <x-form.button class="btn-sm btn-danger btn-delete" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                      <x-partials.icon class="bx-trash" />
                    </x-form.button>
                  </div>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <form action="" method="POST" id="form-delete">
    @csrf
    @method('DELETE')
    <x-partials.modal id="modal-delete" title="Hapus" class="modal-dialog-centered modal-sm">
      <x-slot:body>
        <span class="d-block">Data:</span>
        <b id="delete-name" class="text-danger"></b>
        <p class="mt-3">Apakah anda yakin ingin menghapus data tersebut?</p>
      </x-slot:body>

      <x-slot:footer class="d-flex mt-4">
        <x-form.button type="button" class="btn btn-secondary flex-fill" data-bs-dismiss="modal">
          Batal
        </x-form.button>
        <x-form.button type="submit" class="btn btn-danger flex-fill" id="btn-delete-submit">
          Ya, hapus!
        </x-form.button>
      </x-slot:footer>
    </x-partials.modal>
  </form>


  <form action="{{ route('user.index') }}" method="GET" id="form-filter">
    <x-partials.modal id="modal-filter" title="Filter">
      @csrf
      <x-slot:body>
        <x-form.filter-select id="filter-jk" name="jk" label="Jenis Kelamin" :option="['L' => 'Laki-laki', 'P' => 'Perempuan']" :selected="request('jk')" />
        <x-form.filter-select class="mt-2" id="filter-role" name="role" label="Role" :option="['admin' => 'Admin', 'customer' => 'Customer']" :selected="request('role')" />
        <x-form.filter-select class="mt-2" id="filter-verified" name="is_verified" label="Terverifikasi" :option="['true' => 'Sudah', 'false' => 'Belum']" :selected="request('is_verified')" />
      </x-slot:body>
      <x-slot:footer class="justify-content-between">
        <x-form.button href="{{ route('user.index') }}" class="btn btn-secondary" id="btn-filter-reset">
          Reset
        </x-form.button>
        <x-form.button type="submit" class="btn btn-primary" id="btn-filter-submit">
          Terapkan
        </x-form.button>
      </x-slot:footer>
    </x-partials.modal>
  </form>

  <x-slot:js>
    <script src="{{ asset('datatables/dataTables.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap5.js') }}"></script>
    <script>
      $(document).ready(function() {

        // Datatable
        initDataTable('#table-index');

        // Delete
        $(document).on('click', '.btn-delete', function() {
          let id = $(this).data('id');
          let name = $(this).data('name');
          $('#delete-name').text(name);
          $('#form-delete').attr('action', '{{ url('user') }}/' + id);
          showModal('modal-delete');
        });

        // Filter
        $('#btn-filter').on('click', function() {
          showModal('modal-filter')
        });
      });
    </script>
  </x-slot:js>

</x-app>
