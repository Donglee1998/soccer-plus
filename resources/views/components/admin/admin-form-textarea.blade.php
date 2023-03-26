<tr class="titleTxt">
    <th class="left w20">{!! $label . $require !!}</th>
    <td>
        @if ($borderNone === 'true')
            {!! nl2br(e($value)) !!}
        @else
            <textarea class="form-control" name="{{ $name }}" {{ $disable === 'true' ? 'disabled' : '' }}>{{ $value }}</textarea>
        @endif
    </td>
</tr>
