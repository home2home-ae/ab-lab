<input type="radio" id="{{ $id }}" name="{{ $name }}"
       {{ $attributes->merge(['class' => 'mr-3']) }}
       {{ isset($checked) && $checked ? 'checked' : '' }}
       value="{{ $value }}"> <label
    for="{{ $id }}">{{ $label }}</label>
