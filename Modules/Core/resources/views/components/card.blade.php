<div class="card mb-5 shadow rounded-md {{ $class ?? '' }}">
  @if (isset($header))
      <div class="card-header bg-white p-4 {{ $headerClass ?? '' }}">
          <h5 class="mb-0 text-capitalize d-flex gap-1 fw-bold">{{ $header }}</h5>
      </div>
  @endif

  <div class="card-body">
      {{ $slot }}
  </div>

  @if (isset($footer))
      <div class="card-footer bg-white p-4 {{ $footerClass ?? '' }}">
          {{ $footer }}
      </div>
  @endif
</div>
