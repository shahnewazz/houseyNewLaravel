<div class="alert alert-{{ $style === 'fill' ? 'fill-' : '' }}{{ $type }}"  role="alert">

  @if($message)
    <span>{{ $message }}</span>
  @endif

  @if($slot->isNotEmpty())
    {{ $slot }}
  @endif
</div>
