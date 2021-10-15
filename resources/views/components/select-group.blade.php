<div class="form-group">
    <label for="">{{ $label }}</label>
    <select
        name="{{ $name }}" id="{{$id}}"
        {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full disabled:bg-gray-500']) !!}>
        @if(isset($placeholder))
            <option value="">{{$placeholder}}</option>
        @endif

        @foreach($list as $key => $label)
            <option
                value="{{$key}}" {{ $isSelected($key) ? 'selected="selected"' : ''  }}>{{$label}}</option>
        @endforeach
    </select>
</div>
