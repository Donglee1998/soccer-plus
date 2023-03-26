@php
    $noDisplay  = $hidden ? 'noDisplay' : '';
    $classTh    = $centerLabel ? 'center'  : 'left';
@endphp
@if($show)
<tr class="titleTxt {{$noDisplay}}" >
    <th  class="{{$classTh}} w20" >{!! $label . $require !!}</th>
    <td class="{{ $type=='password' ? 'input-password': '' }} ">
        @if ($borderNone === 'true')
            {{ old($name, $value) }}
        @else
            @if(!empty($attribute['notice']))<p class="notice">{!! $attribute['notice'] !!}</p>@endif
            @if ($type == 'password')
                <input name="{{ $name }}" id="{{ $name }}" type="{{ $type }}" autocomplete="new-password" class="{{ $class }}" value="{{ old($name, $value) }}" {{ @$attribute['old_pass'] ? 'placeholder=********' : '' }} {{ $disable === 'true' ? 'disabled' : '' }}>
                @if(!empty($attribute['example']))<p class="example">{!! $attribute['example'] !!}</p>@endif
                <img class="icon-showpass" src="/assets/admin/img/admin/icon/eye1.png" alt="" srcset="">  
            @else
                <input name="{{ $name }}" id="{{ $name }}" type="{{ $type }}" class="{{ $class }}" value="{{ old($name, $value) }}" {{ $disable === 'true' ? 'disabled' : '' }}>
                @if(!empty($attribute['example']))<p class="example">{!! $attribute['example'] !!}</p>@endif
            @endif
        @endif
    </td>
</tr>
@endif
