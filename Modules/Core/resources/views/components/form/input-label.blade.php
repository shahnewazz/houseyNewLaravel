@props(['value', 'required' => false, 'optional' => false])
<label {{ $attributes->merge(['class' => 'form-label']) }}>
    {{ $value ?? $slot }}
    @if ($required)
        <span class="text-danger">*</span>
    @endif

    @if ($optional)
        <span class="text-dark opacity-50"> (optional)</span>
    @endif
</label>
