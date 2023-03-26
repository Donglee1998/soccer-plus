@if($comment)
<div class="blockScroll">
    <table class="tblStyle04">
        <tr>
            <th class="ttl1 custom">戦評</th>
            <td class="custom"></td>
        </tr>
        <tr>
            <th class="ttl4">回戦</th>
            <td>{{ $comment->title ?? '' }}</td>
        </tr>
        <tr>
            <th class="ttl4">戦評</th>
            <td class="comment">{!! nl2br($comment->content ?? '') !!}</td>
        </tr>
        <tr>
            <th class="ttl4">文責</th>
            <td>{{ $comment->name ?? '' }}</td>
        </tr>
    </table>
</div>
@endif
