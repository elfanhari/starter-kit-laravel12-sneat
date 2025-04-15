<label class="form-label fs-15{{ $attributes->has('required') ? 'required' : '' }}" for="{{ $field }}">{{ $title }}</label>
<textarea id="{{ $field }}" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror {{ $attributes->get('class') }}" placeholder="{{ $placeholder ?? 'Masukkan ' . $title }}" {{ $attributes->except('class', 'title', 'field') }}>{{ old($field, $value ?? '') }}</textarea>
@error($field)
  <span class="invalid-feedback mt-1">{{ $message }}</span>
@enderror
