<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog {{ $class ?? '' }}" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label-{{ $id }}">{{ $title ?? '' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @isset($body)
          {{ $body }}
        @endisset
      </div>
      @isset($footer)
        <div class="modal-footer d-flex">
          {{ $footer }}
          {{-- @else
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">
            Tutup
          </button> --}}
        </div>
      @endisset
    </div>
  </div>
</div>
