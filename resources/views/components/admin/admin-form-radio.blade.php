@php
    $classTh    = $centerLabel ? 'center'  : 'left';
@endphp
@if($show)
<tr class="titleTxt">
    <th class="{{$classTh}} w20">{!! $label . $require !!}</th>
    <td>
        @if(!empty($attribute['notice']))<p class="notice">{!! $attribute['notice'] !!}</p>@endif
        @foreach($option as $key => $val)
        <span class="checkbox">
            <input type="radio" name="{{ $name }}" value="{{ $key }}" id="radio_{{ $name }}_{{ $key }}" {{ $key == $value ? 'checked' : '' }} {{ $disable === 'true' ? 'disabled' : '' }}>
            <label for="radio_{{ $name }}_{{ $key }}">{{ $val }}</label>
        </span>
        @endforeach
        @if(!empty($attribute['example']))<p class="example">{!! $attribute['example'] !!}</p>@endif
        {{ $slot }}
    </td>
</tr>
@endif
