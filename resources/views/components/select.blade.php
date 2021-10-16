@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'form-control']) !!}>
    @if(isset($placeholder))
        <option value="">{{$placeholder}}</option>
    @endif

    @foreach($list as $selectValue => $selectLabel)
        <option
            value="{{$selectValue}}" {{ isset($value) && $selectValue === $value ? 'selected="selected"' : '' }}>{{$selectLabel}}</option>
    @endforeach
</select>
