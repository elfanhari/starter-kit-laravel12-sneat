<div class="input-group {{ $class ?? '' }}">
  <label for="{{ $id }}" class="input-group-text bg-light">{{ $label }}</label>
  <select name="{{ $name ?? $id }}" id="{{ $id }}" class="form-select">
    <option value="">Semua</option>
    @foreach ($option as $key => $value)
      <option value="{{ is_numeric($key) ? $value : $key }}" {{ (string) $selected === (string) (is_numeric($key) ? $value : $key) ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
  </select>
</div>
