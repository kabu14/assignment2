@layout('master')

@section('user_content')
<div id="wrapper">
	<h2 id="header">{{ $email }} - {{ HTML::link('/logout', 'logout' ) }}</h2>
	
	<div id="section1">

		<div id="column1">
			<h2>Notes</h2>
			<p>{{ $note }}</p>
		</div><!--close column1-->

		<div id="column2">
			<h2>Websites</h2>
			<ul>
			@foreach ($websites as $site)
				<li>{{ $site->url }}</li>
			@endforeach
			</ul>
			
		</div><!--close column2-->

	</div><!--close section1-->

	<div id="section2">
		
		<div id="column3">
			<h2>Images</h2>
			<h3>click for full size</h3>
			{{ Form::file('i')}}
		</div>

		<div id="column4">
			<h2>tbd</h2>
			<p>{{ $tbd }}</p>
		</div>

	</div>
	<div id="footer">
			{{ HTML::link('/users/profile/edit', 'Edit') }}
	</div>
</div>


@endsection