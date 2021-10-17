<div {{ $attributes->merge(['class' => 'card']) }}>
    <div class="card-body">

        @if(isset($title))
            <div class="card-title">
                {{ $title }}
            </div>
        @endif

        {{ $slot }}
    </div>
</div>
