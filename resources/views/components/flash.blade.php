@if(session('message') || session('info'))
    <div {{ $attributes->merge(['class' => 'alert alert-primary alert-dismissible fade show']) }} role="alert">
        <i class="bi bi-exclamation-circle"></i>

        {{ session('message') ?? session('info') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
@endif

@if(session('success'))
    <div {{ $attributes->merge(['class' => 'alert alert-success alert-dismissible fade show']) }} role="alert">
        <i class="bi bi-check-circle"></i>

        {{ session('success')  }}

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('warning'))
    <div {{ $attributes->merge(['class' => 'alert alert-warning alert-dismissible fade show']) }} role="alert">
        <i class="bi bi-exclamation-triangle"></i>

        {{ session('warning')  }}

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div {{ $attributes->merge(['class' => 'alert alert-danger alert-dismissible fade show']) }} role="alert">
        <i class="bi bi-x-circle"></i>

        {{ session('error')  }}

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'alert alert-danger alert-dismissible fade show']) }} role="alert">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
