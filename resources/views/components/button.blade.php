@props(['theme' => 'primary'])

<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => "btn btn-{$theme} btn-sm"
    ]) }}>
    {{ $slot }}
</button>
