<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Laravel and PixiJS - Demo</title>
<meta name="_token" content="{{ csrf_token() }}"/>

@include('includes.head')
</head>
<body>
	<div class="uk-section">
		<div class="uk-container">

			@yield('content')

		</div>
	</div>

@include('includes.footer')
</body>
</html>