<div class="form-group">

    @if(isset($label))
        <x-label>{{ $label }}</x-label>
    @endif

    <select
        name="{{ $name }}" id="{{$id}}"
        {!! $attributes->merge(['class' => 'form-control']) !!}>
        @if(isset($placeholder))
            <option value="">{{$placeholder}}</option>
        @endif

        @foreach($list as $key => $label)
            <option
                value="{{$key}}" {{ $isSelected($key) ? 'selected="selected"' : ''  }}>{{$label}}</option>
        @endforeach
    </select>
</div>
