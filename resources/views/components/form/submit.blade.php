<div class="d-flex justify-content-between gap-y-4">
  <div class="form-check">
    <input type="checkbox" class="form-check-input small" value="" id="check" required {{ $checked ? 'checked' : '' }}>
    <label for="check" class="form-check-label">Saya yakin sudah mengisi dengan benar</label>
  </div>
  <x-form.button type="submit" class="btn btn-md btn-primary">{{ $label ?? 'Simpan' }}</x-form.button>
</div>
