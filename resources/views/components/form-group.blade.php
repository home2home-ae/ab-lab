<div {{ $attributes->merge(['class' => 'd-block']) }}>
    @if(isset($label))
        <x-label>{{ $label }}</x-label>
    @endif

    @if(isset($type) && $type === 'textarea')
        <x-textarea name="{{ $name }}"
                    {{ $attributes->merge(['class' => 'mt-2']) }}
                    rows="{{ $rows ?? 3 }}"
                    value="{{ old($name) ?? ($value ?? '') }}"></x-textarea>
    @elseif(isset($type) && $type === 'select')
        <x-select name="{{ $name }}"
                  :list="$list"
                  {{ $attributes->merge(['class' => 'mt-2']) }}
                  value="{{ old($name) ?? ($value ?? '') }}"></x-select>
    @else
        <x-input type="{{ $type ?? 'text' }}" name="{{ $name }}"
                 {{ $attributes->merge(['class' => 'mt-2']) }} value="{{ old($name) ?? ($value ?? '') }}"></x-input>
    @endif
</div>
