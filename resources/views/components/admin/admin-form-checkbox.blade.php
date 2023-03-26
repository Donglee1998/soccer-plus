@if($show)
<tr class="titleTxt">
    <th class="left w20">{!! $label . $require !!}</th>
    <td>
        @if(!empty($attribute['notice']))<p class="notice">{!! $attribute['notice'] !!}</p>@endif
        @foreach($option as $key => $val)
        <span class="checkbox {{ $class }}">
            <input type="checkbox" name="{{ $name }}[]" value="{{ $key }}" id="checkbox_{{ $name }}_{{ $key }}" {{ is_array($value) && in_array($key,$value) ? 'checked' : '' }}>
            <label for="checkbox_{{ $name }}_{{ $key }}">{{ $val }}</label>
        </span>
        @endforeach
        @if(!empty($attribute['example']))<p class="example">{!! $attribute['example'] !!}</p>@endif
        {{ $slot }}
    </td>
</tr>
@endif
