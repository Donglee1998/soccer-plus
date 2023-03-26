<form method="{{ in_array($method, ['put', 'patch', 'delete']) ? 'post' : 'post' }}" action="{{ $action ?? '' }}" onsubmit="return (typeof submitted == 'undefined') ? (submitted = true) : !submitted">
    @if($method == 'put')
        @method('PUT')
    @elseif($method == 'patch')
        @method('PATCH')
    @elseif($method == 'delete')
        @method('DELETE')
    @endif
    @csrf
    {{ $slot }}
    <div style="width:310px;" class="clearfix auto">
        <button type="submit" name="submit" value="back" class="leftBox button gray2 mr10 mb0">{{ $btnBack }}</button>
        <button type="submit" name="submit" value="done" class="rigthBox button blue2 mb0">{{ $btnSubmit }}</button>
    </div>
</form>
