<?php
/*
@layout('master')

@section('content_form')

<h1>Log In</h1>
{{ Form::open('/') }}
{{ Form::label('email', 'Email Address') }}
{{ Form::text('email') }}
<br>
{{ Form::label('pass', 'Password')}}
{{ Form::password('pass')}}
<br>
{{ Form::submit('Log in') }}
{{ Form::close() }}

<p>
	{{HTML::link('register', 'register')}}
</p>


@endsection

*/
