<form method="post" action="{{ route('web.team.save') }}">
    @csrf
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
    <input type="hidden" name="id" value="{{ @$team['id']}}">
    <p>Name<input type="text" name="name" value="{{ old('name', @$team['name']) }}"><p>
    <p>abbreviation<input type="text" name="abbreviation" value="{{ old('abbreviation', @$team['abbreviation']) }}"><p>
    <p>Gender
        @foreach(config('constants.gender.label') as $key => $label)
        <input type="radio" name="gender" value="{{ $key}}" id="gender_{{$key}}" {{ $key == old('gender', @$team['gender']) ? 'checked' : ''}}> <label for="gender_{{$key}}">{{ $label }}</label>
        @endforeach
    <p>
    <p>Hometown<input type="text" name="hometown"  value="{{ old('hometown', @$team['hometown']) }}"><p>
    <p>Coach<input type="text" name="coach"  value="{{ old('coach', @$team['coach']) }}"><p>
    <p>Trainer<input type="text" name="trainer"  value="{{ old('trainer', @$team['trainer']) }}"><p>
    <p>Supervisor<input type="text" name="supervisor"  value="{{ old('supervisor', @$team['supervisor']) }}"><p>
    <p>Manager<input type="text" name="manager"  value="{{ old('manager', @$team['manager']) }}"><p>
    <p>Color home<input type="text" name="color_home"  value="{{ old('color_home', @$team['color_home']) }}"><p>
    <p>Color guest<input type="text" name="color_guest"  value="{{ old('color_guest', @$team['color_guest']) }}"><p>
    <p>Explanation<textarea name="explanation">{{ old('explanation', @$team['explanation']) }}</textarea><p>
    <button type="submit"> Submit</button>
</form>
