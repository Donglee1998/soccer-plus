<div class="wrapperPageLoading" style="display: {{ $display }}">
    <div class="loadingScreen showLoading">
        <div class="loadingBox">
            <p class="ttl">LOADING...</p>
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
</div>
@push('js')
<script>
    function showPopupLoading(isShow = false) {
        $('.wrapperPageLoading').css('display', isShow ? 'block' : 'none');
    }
</script>
@endpush