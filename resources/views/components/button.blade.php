@props(['theme' => 'primary'])

<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => "btn btn-soft-{$theme} btn-sm"
    ]) }}>
    {{ $slot }}
</button>
