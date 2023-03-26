@php
    $no_display = $hidden ? 'noDisplay' : "";
@endphp
@if($show)
<tr class="titleTxt {{$no_display}}">
    <th class="left w20">{!! $label . $require !!}</th>
    <td class="{{ $type === 'textarea_ckeditor' ? 'ck-content' : '' }}">
        {!! $value_show !!}
        <div class="noDisplay">
        @switch($type)
            @case('select')
                <select name="{{ $name }}">
                    <option></option>
                    @foreach($option as $key => $val)
                    <option value="{{ $key }}" {{ $key == $value ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
                @break
            @case('checkbox')
                @foreach($option as $key => $val)
                <input type="checkbox" name="{{ $name }}[]" value="{{ $key }}" {{ in_array($key, (array) $value)? 'checked' : '' }}>
                @endforeach
                @break
            @case('radio')
                @foreach($option as $key => $val)
                <input type="radio" name="{{ $name }}" value="{{ $key }}" {{ $key == $value ? 'checked' : '' }}>
                @endforeach
                @break
            @case('textarea')
            @case('textarea_ckeditor')
                <textarea name="{{ $name }}" cols="30" rows="10">{{ $value }}</textarea>
                @break
            @default
                <input name="{{ $name }}" type="hidden" value="{{ $value }}">
        @endswitch
        </div>
    </td>
</tr>
@endif
