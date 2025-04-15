<x-app>

  <x-slot:css>
    <link href="{{ asset('datatables/dataTables.bootstrap5.css') }}">
  </x-slot:css>

  <x-partials.header-page title="Data Admin" desc="lorem ipsum dolor sit amet" />

  <div class="card" id="card">
    <div class="card-header border-bottom">
      <x-form.button href="{{ route('user.create') }}" class="btn-sm btn-primary">
        <x-partials.icon class="bx-plus me-1" />
        Tambah
      </x-form.button>
      <x-form.button class="btn-sm btn-secondary" id="btn-select-multiple">
        <x-partials.icon class="bx-check me-1" />
        Tandai
      </x-form.button>
      <x-form.button class="btn-sm btn-secondary d-none" id="btn-cancel-select">
        <x-partials.icon class="bx-x me-1" />
        Batal Tandai
      </x-form.button>
      <x-form.button class="btn-sm btn-danger d-none" id="btn-delete-selected">
        <x-partials.icon class="bx-trash me-1" />
        Hapus Ditandai (<span id="selected-count">0</span>)
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
              <th id="td-select-all" class=""><input type="checkbox" id="select-all" class="d-none"></th>
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

          </tbody>
        </table>
      </div>
    </div>
  </div>

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
      <x-form.button type="button" class="btn btn-danger flex-fill" id="btn-delete-submit">
        Ya, hapus!
      </x-form.button>
    </x-slot:footer>
  </x-partials.modal>


  <x-partials.modal id="modal-filter" title="Filter">
    <x-slot:body>
      <x-form.filter-select id="filter-jk" label="Jenis Kelamin" :option="['L' => 'Laki-laki', 'P' => 'Perempuan']" />
      <x-form.filter-select class="mt-2" id="filter-role" label="Role" :option="['admin' => 'Admin', 'customer' => 'Customer']" />
      <x-form.filter-select class="mt-2" id="filter-verified" label="Terverifikasi" :option="['true' => 'Sudah', 'false' => 'Belum']" />
    </x-slot:body>
    <x-slot:footer>
      <x-form.button type="button" class="btn btn-primary" id="btn-filter-submit">
        Terapkan
      </x-form.button>
    </x-slot:footer>
  </x-partials.modal>

  {{-- Delete Banyak --}}
  <x-partials.modal id="modal-delete-multiple" title="Konfirmasi Hapus" class="modal-dialog-centered">
    <x-slot:body>
      <p>Anda yakin ingin menghapus data berikut?</p>
      <ul id="selected-names" class="text-danger"></ul>
    </x-slot:body>
    <x-slot:footer class="d-flex mt-4">
      <x-form.button type="button" class="btn btn-secondary flex-fill" data-bs-dismiss="modal">
        Batal
      </x-form.button>
      <x-form.button type="button" class="btn btn-danger flex-fill" id="btn-delete-multiple-submit">
        Ya, hapus!
      </x-form.button>
    </x-slot:footer>
  </x-partials.modal>


  <x-slot:js>
    <script src="{{ asset('datatables/dataTables.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap5.js') }}"></script>
    <script>
      $(document).ready(function() {

        let selectedUsers = []; // Simpan ID yang dipilih

        // Inisialisasi DataTable
        let table = $('#table-index').DataTable({
          processing: true,
          serverSide: true,
          ordering: false,
          ajax: {
            url: "{{ route('user.index') }}",
            data: function(d) {
              d.jk = $('#filter-jk').val();
              d.role = $('#filter-role').val();
              d.is_verified = $('#filter-verified').val();
            }
          },
          columns: [{
              data: 'id',
              name: 'id',
              orderable: false,
              searchable: false,
              render: function(data) {
                return `<input type="checkbox" class="select-row d-none" value="${data}">`;
              }
            },
            {
              data: 'DT_RowIndex',
              name: 'DT_RowIndex',
              orderable: false,
              searchable: false
            },
            {
              data: 'name',
              name: 'name'
            },
            {
              data: 'email',
              name: 'email'
            },
            {
              data: 'jk',
              name: 'jk'
            },
            {
              data: 'role',
              name: 'role'
            },
            {
              data: 'verified',
              name: 'verified',
              orderable: false,
              searchable: false
            },
            {
              data: 'aksi',
              name: 'aksi',
              orderable: false,
              searchable: false
            },
          ],
          drawCallback: function() {
            if (!$('#select-all').hasClass('d-none')) {
              $('.select-row').removeClass('d-none');
              // $('.td-select-row').removeClass('d-none');
            }
            $('.select-row').each(function() {
              if (selectedUsers.includes($(this).val())) {
                $(this).prop('checked', true);
              }
            });
            updateSelectedButton();
            $('#table-index tbody td:nth-child(1)').each(function() {
              $(this).addClass('td-select-row');
            });
          }
        });

        $('#btn-select-multiple').on('click', function() {
          showCheckbox();
          $('#btn-select-multiple').addClass('d-none');
          $('#btn-cancel-select, #btn-delete-selected').removeClass('d-none');
        });

        $('#btn-cancel-select').on('click', function() {
          $('#selected-names').html('');
          selectedUsers = [];
          $('.select-row:checked').prop('checked', false);
          updateSelectedButton();
          hideCheckbox();
          $('#btn-select-multiple').removeClass('d-none');
          $('#btn-cancel-select, #btn-delete-selected').addClass('d-none');
        });

        $('#select-all').on('change', function() {
          $('.select-row').prop('checked', $(this).prop('checked')).trigger('change');
          if (!$(this).prop('checked')) {
            selectedUsers = [];
            $('#btn-delete-selected').addClass('d-none');
            $('#selected-names').html('');
          }
        });

        $(document).on('change', '.select-row', function() {
          let id = $(this).val();
          if ($(this).is(':checked')) {
            if (!selectedUsers.includes(id)) {
              selectedUsers.push(id);
              let name = $(`input[value="${id}"]`).closest('tr').find('td:nth-child(3)').text();
              $('#selected-names').append(`<li>${name}</li>`);
            }
          } else {
            selectedUsers = selectedUsers.filter(userId => userId !== id);
            $(`li:contains("${$(this).closest('tr').find('td:nth-child(3)').text()}")`).remove();
          }
          updateSelectedButton();
        });

        function updateSelectedButton() {
          $('#selected-count').text(selectedUsers.length);
          if (selectedUsers.length > 0) {
            $('#btn-delete-selected').removeClass('d-none');
          } else {
            $('#btn-delete-selected').addClass('d-none');
          }
        }

        function showCheckbox() {
          $('#select-all').removeClass('d-none');
          // $('#td-select-all').removeClass('d-none');
          $('.select-row').removeClass('d-none');
          // $('.td-select-row').removeClass('d-none');
        }

        function hideCheckbox() {
          $('#select-all').addClass('d-none');
          // $('#td-select-all').addClass('d-none');
          $('.select-row').addClass('d-none');
          // $('.td-select-row').addClass('d-none');
        }

        $('#btn-delete-selected').on('click', function() {
          if (selectedUsers.length > 0) {
            showModal('modal-delete-multiple');
          }
        });

        $('#btn-delete-multiple-submit').on('click', function() {
          $.ajax({
            url: "{{ route('user.deleteMultiple') }}",
            type: 'POST',
            data: {
              ids: selectedUsers,
              _token: "{{ csrf_token() }}"
            },
            success: function(response) {
              $('#deleteModal').modal('hide');
              selectedUsers = [];
              table.ajax.reload();
              updateSelectedButton();
              hideCheckbox();
              $('.select-row').addClass('d-none');
              // $('.td-select-row').addClass('d-none');
              $('#selected-names').html('');
              $('#btn-select-multiple').removeClass('d-none');
              $('#btn-cancel-select, #btn-delete-selected').addClass('d-none');
              showToast('Berhasil', response.success, 'bg-success');
              hideModal('modal-delete-multiple');
            },
            error: function(xhr) {
              showToast('Error', 'Terjadi kesalahan! ' + xhr.status, 'bg-danger');
            },
            complete: function() {
              hideLoader();
            }
          });
        });

        $('#btn-filter').on('click', function() {
          showModal('modal-filter');
        });
      });
    </script>
  </x-slot:js>

</x-app>
