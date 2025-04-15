<label for="{{ $field }}" class="form-label fs-15 {{ $attributes->has('required') ? 'required' : '' }}">{{ $title }}</label>
<select id="{{ $field }}" name="{{ $field }}" class="form-select @error($field) is-invalid @enderror {{ $attributes->get('class') }}" data-placeholder="{{ $placeholder ?? 'Pilih' }}" {{ $attributes->except(['class', 'title', 'option', 'field']) }}>
  <option selected value="">-- Pilih --</option>
  {{ $slot }}
  @isset($option)
    @foreach ($option as $key => $label)
      <option value="{{ $key }}" {{ old($field, $value ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
    @endforeach
  @endisset
</select>
@error($field)
  <span class="invalid-feedback mt-1">{{ $message }}</span>
@enderror
