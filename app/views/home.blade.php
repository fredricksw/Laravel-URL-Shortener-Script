<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>URL Shortner</title>
		<link rel="stylesheet" href="{{ URL::to('css/global.css') }}">
	</head>
	<body>
		<div class="container">
			<h1 class="title">Smashin' your long URL's!</h1>

			@if($errors->has('url'))
				<p>{{ $errors->first('url') }}</p>
			@endif

			@if(Session::has('global'))
				<p>{{ Session::get('global') }}</p>
			@endif
			{{Form::open(['action' => 'LinkController@make', 'method' => 'post'])}}
			  {{Input::text('url', e(Input::old('url') or ''))}}
				{{Input::submit('Smash it!')}}
			{{Form::close()}}
		</div>
	</body>
</html>
