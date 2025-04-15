<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
  <div class="d-flex justify-content-center">
    @isset($href)
      <a href="{{ $href ?: 'javascript:history.back()' }}" class="text-decoration-none text-primary mt-1 me-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
        </svg>
      </a>
    @endisset
    <div class="">
      <h4 class="fw-bold my-0">
        {{ $title ?? 'Title' }}
      </h4>
      @isset($desc)
        <p class="mb-0">{{ $desc }}</p>
      @endisset
    </div>
  </div>
  @isset($comps)
    <div class="d-flex align-content-center flex-wrap gap-2">
      {{ $comps }}
    </div>
  @endisset
</div>
