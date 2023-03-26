<form class="{{ !empty($class) ? $class : '' }}"
    method="{{ in_array($method, ['put', 'patch', 'delete', 'post']) ? 'post' : 'get' }}"
    action="{{ $action ?? '' }}" onsubmit="return (typeof submitted == 'undefined') ? (submitted = true) : !submitted"
    autocomplete="off">
    @if ($method == 'put')
        @method('PUT')
    @elseif($method == 'patch')
        @method('PATCH')
    @elseif($method == 'delete')
        @method('DELETE')
    @endif
    @if ($method !== 'get')
        @csrf
    @endif
    {{ $slot }}

    @if ($showBtnSubmit == 'show')
        <div style="width:310px;" class="clearfix auto">
            <button id="buttonSubmit" type="submit" name="submit" value="confirm"
                class="auto button blue2 mb0">{{ $btnSubmit }}</button>
        </div>
    @endif
</form>
