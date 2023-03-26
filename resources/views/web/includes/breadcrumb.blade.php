@if(!empty($breadcrumbs))
<ol class="breadcrumbs">
    @foreach ($breadcrumbs as $key => $value)
        @php
            $active = $key == count($breadcrumbs)-1 ? 'active' : '';
        @endphp
    <li>
        @if($active)
        <em>{{ $value['name'] }}</em>
        @else
        <a href="{{ $value['link'] ?? 'javascript:;' }}">{{ $value['name'] }}</a>
        @endif
    </li>
    @endforeach
</ol>
@endif
