
@if(session('error'))
    <div {{ $attributes->merge(['class' => 'bg-red-300 px-2 pt-3 pb-2 rounded-lg shadow-lg']) }} role="alert">
        <i class="tio tio-error-outlined"></i> {{ session('error')  }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="tio-clear tio-lg"></i>
        </button>
    </div>
@endif

@if(session('warning'))
    <div {{ $attributes->merge(['class' => 'bg-yellow-500 px-2 pt-3 pb-2 rounded-lg shadow-lg']) }} role="alert">
        <i class="tio tio-info-outined"></i> {{ session('warning')  }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="tio-clear tio-lg"></i>
        </button>
    </div>
@endif

@if(session('message'))
    <div {{ $attributes->merge(['class' => 'bg-blue-300 px-2 pt-3 pb-2 rounded-lg shadow-lg']) }} role="alert">
        <i class="tio tio-email"></i> {{ session('message')  }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="tio-clear tio-lg"></i>
        </button>
    </div>
@endif

@if(session('success'))
    <div {{ $attributes->merge(['class' => 'bg-green-300 px-2 pt-3 pb-2 rounded-lg shadow-lg']) }} role="alert">
        <i class="tio tio-checkmark-circle"></i> {{ session('success')  }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="tio-clear tio-lg"></i>
        </button>
    </div>
@endif

@if(session('info'))
    <div {{ $attributes->merge(['class' => 'bg-blue-200 px-2 pt-3 pb-2 rounded-lg shadow-lg']) }} role="alert">

        <i class="tio tio-info-outined"></i> {{ session('info')  }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="tio-clear tio-lg"></i>
        </button>
    </div>
@endif

@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'bg-red-300 px-2 pt-3 pb-2 rounded-lg shadow-lg']) }} role="alert">

        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="tio-clear tio-lg"></i>
        </button>
    </div>
@endif
