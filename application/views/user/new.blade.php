@layout('master')

@section('content_form')

<h1>Register</h1>
{{ Form::open('/users/') }}
{{ Form::label('email', 'Email Address') }}
{{ Form::text('email') }}
{{ $errors->first('email', '<p class="error">:message</p>') }}
<br>
{{ Form::label('pass', 'Password')}}
{{ Form::password('pass')}}
{{ $errors->first('pass', '<p class="error">:message</p>') }}
<br>
{{ Form::label('confirm', 'Confirm Password')}}
{{ Form::password('confirm')}}
{{ $errors->first('confirm', '<p class="error">:message</p>') }}
<br>
{{ Form::text('captchatest', '', array('class' => 'captchainput', 'placeholder' => 'Insert captcha...')) }}
{{ Form::image(LaraCaptcha\Captcha::img(), 'captcha', array('class' => 'captchaimg')) }}
{{ $errors->first('captchatest', '<p class="error">:message</p>') }}
<br>
{{ Form::submit('Register') }}
{{ Form::close() }}

<p>
	{{ HTML::link('/', 'login' ) }}
</p>




@endsection
