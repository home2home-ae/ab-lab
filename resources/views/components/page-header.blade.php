@if(isset($links))
    <nav
        style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($links as $link)
                <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}" {{ $loop->last ? 'aria-current="page"' : '' }}>

                    @if(\Illuminate\Support\Arr::get($link, 'url', '#') === '#')
                        {{ \Illuminate\Support\Arr::get($link, 'label', 'Label')  }}
                    @else
                        <a class=""
                           href="{{ \Illuminate\Support\Arr::get($link, 'url', '#')  }}">
                            {{ \Illuminate\Support\Arr::get($link, 'label', 'Label')  }}
                        </a>
                    @endif
                </li>
            @endforeach

        </ol>
    </nav>
@endif

