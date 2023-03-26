@if (count($errors))
<ul class="error">
    @php
    $errors = array_map('unserialize', array_unique(array_map('serialize', $errors->messages())));
    @endphp
    @foreach ($errors as $error)
    <li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ $error[0] }}</li>
    @endforeach
</ul>
@endif
