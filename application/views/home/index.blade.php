@layout('master')

@section('content_form')

<h1>Log In</h1>
{{ Form::open('/') }}
{{ Form::label('email', 'Email Address') }}
{{ Form::text('email') }}
{{ $errors->first('email', '<p class="error">:message</p>') }}
<br>
{{ Form::label('pass', 'Password')}}
{{ Form::password('pass')}}
{{ $errors->first('pass', '<p class="error">:message</p>') }}
<br>
{{ Form::submit('Log in') }}
{{ Form::close() }}

<p>
	{{HTML::link_to_route('new_user', 'register')}}
</p>


@endsection
