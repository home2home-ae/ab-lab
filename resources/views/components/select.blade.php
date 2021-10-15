@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full disabled:bg-gray-500']) !!}>
    @if(isset($placeholder))
        <option value="">{{$placeholder}}</option>
    @endif

    @foreach($list as $selectValue => $selectLabel)
        <option
            value="{{$selectValue}}" {{ isset($value) && $selectValue === $value ? 'selected="selected"' : '' }}>{{$selectLabel}}</option>
    @endforeach
</select>
