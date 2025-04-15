@if (!empty($href))
  <a href="{{ $href }}" {{ $attributes->class(['btn']) }}>
    {{ $slot }}
  </a>
@else
  <button type="{{ $type ?? 'button' }}" {{ $attributes->class(['btn']) }}>
    {{ $slot }}
  </button>
@endif
