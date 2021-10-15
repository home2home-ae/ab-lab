<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        @if(isset($links))
            <div class="">
                @foreach($links as $link)
                    <a class=""
                       href="{{ \Illuminate\Support\Arr::get($link, 'url', '#')  }}">
                        {{ \Illuminate\Support\Arr::get($link, 'label', 'Label')  }}
                    </a>

                    @if(!$loop->last)
                        <span class="mx-1"> / </span>
                    @endif
                @endforeach
            </div>
        @endif

        @if(isset($title))
            @section('title', $title)
        <h2 class="text-xl text-gray-800 leading-tight mt-2">{{ $title }}</h2>
        @endif

    </div>
</header>
