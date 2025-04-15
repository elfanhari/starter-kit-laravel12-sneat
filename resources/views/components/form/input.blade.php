<label class="form-label fs-15 {{ $attributes->has('required') ? 'required' : '' }}" for="{{ $field }}">{{ $title }}</label>
<input type="{{ $type ?? 'text' }}" name="{{ $field }}" id="{{ $field }}" class="form-control @error($field) is-invalid @enderror {{ $attributes->get('class') }}" value="{{ $value ?? old($field, '') }}" placeholder="{{ $placeholder ?? 'Masukkan ' . $title }}"
  {{ $attributes->except('class', 'value', 'title', 'field') }} />
@error($field)
  <span class="invalid-feedback mt-1">{{ $message }}</span>
@enderror
