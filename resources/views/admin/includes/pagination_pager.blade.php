<dl class="searchUtil pr0 pl0 pb0">
    <dt><strong>{{ $data->total() }}</strong>件中</dt>
    @if ($data->total() == 0)
    <dd> ～ 件目を表示中</dd>
    @elseif($data->total() == 1)
        <dd>1件～ 1 件目を表示中</dd>
    @elseif($data->total() != 1)    
        <dd>{{($data->currentPage() - 1) * $data->perPage() + 1}}件～{{ $data->total() <= $data->perPage() ? $data->total() : ($data->currentPage() * $data->perPage() >= $data->total() ? $data->total() : $data->currentPage() * $data->perPage()) }}件表示
        </dd>
    @endif
</dl>
