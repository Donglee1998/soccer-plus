@php
    $member_position = config('constants.member_position.label');
@endphp
@foreach($member_position as $key => $position)
    @if($key > 0 && @$starting_substitute[$key])
        @php
            $count = count($starting_substitute[$key]);
        @endphp
        @foreach($starting_substitute[$key] as $keys => $value)
            <tr>
                @if($keys == 0)
                <th class="ttl2" rowspan="{{ $count }}">{{ $position }}</th>
                @endif
                <td class="ttl3">{{ $value['number_official'] ?? '' }}</td>
                <td>{{ $value['first_name'] ?? '' }} {{ $value['last_name'] ?? '' }}</td>
            </tr>
        @endforeach
    @endif
@endforeach
