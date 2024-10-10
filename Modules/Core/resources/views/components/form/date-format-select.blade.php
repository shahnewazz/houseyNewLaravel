<select {{ $attributes->merge(['class' => 'form-control']) }}>
  @foreach($formats as $format => $label)
      <option value="{{ $format }}" {{ $format == $selected ? 'selected' : '' }}>
          {{ $label }}
      </option>
  @endforeach
</select>
