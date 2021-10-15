@props(['method', 'action'])

<form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST'  }}" {{ $attributes }}>

    @csrf
    @if(!in_array($method, ['GET', 'POST']))
        <input type="hidden" name="_method" value="{{ $method  }}">
    @endif

    {{$slot}}
</form>
