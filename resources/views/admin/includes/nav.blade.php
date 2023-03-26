<nav id="side">
    <ul id="navi">
        <li>
            <span class="parent">申し込み</span>
            <ul class="pull">
                <li><a href="{{ route('admin.registration.index') }}">一覧</a></li>
            </ul>
        </li>
        <li>
            <span class="parent">お知らせ</span>
            <ul class="pull">
                <li><a href="{{ route('admin.news.index') }}">一覧</a></li>
                <li><a href="{{ route('admin.news.edit') }}">新規追加</a></li>
            </ul>
        </li>
        <li>
            <span class="parent">マニュアル</span>
            <ul class="pull">
                <li><a href="{{ route('admin.manual.index') }}">一覧</a></li>
                <li><a href="{{ route('admin.manual.edit') }}">新規追加</a></li>
            </ul>
        </li>
        <li>
            <span class="parent">お問い合わせ</span>
            <ul class="pull">
                <li><a href="{{ route('admin.contact.index') }}">一覧</a></li>
                <li><a href="{{ route('admin.contact.edit') }}">新規追加</a></li>
            </ul>
        </li>
    </ul>
    <!-- / #navi -->
</nav>
