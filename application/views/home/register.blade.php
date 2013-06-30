@layout('master')

@section('content_form')

<h1>Log In</h1>
{{ Form::open('verify.php') }}
{{ Form::label('email', 'Email Address') }}
{{ Form::text('email') }}
<br>
{{ Form::label('pass', 'Password')}}
{{ Form::password('pass')}}
<br>
{{ Form::label('confirm', 'Confirm Password')}}
{{ Form::password('confirm')}}
<br>
{{ Form::submit('Register') }}
{{ Form::close() }}

<p>
	or <a href=".">Log in</a>
</p>


@endsection
*/