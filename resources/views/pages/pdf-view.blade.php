<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PDF View</title>
	<meta name="_token" content="{{ csrf_token() }}"/>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/css/uikit.min.css" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/js/uikit.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/js/uikit-icons.min.js"></script>

	<style type="text/css">
		img {
			width: {{ $imageData['width']  }}px;
			height: {{ $imageData['height']  }}px;
			background: {{ $imageData['color']}}; 
			opacity: 0.8;
		}

		/*body {
			background-color: black;
		}*/
	</style>
	<link rel="stylesheet" type="text/css" href="/css/myFonts.css" />
</head>
<body>
	<div class="uk-section">
		<div class="container">
			<div class="uk-grid-small uk-child-width-expand@s" uk-grid>
				<div class="uk-margin uk-width-1-1">
					<h1 class="uk-heading-line uk-text-center"><span>Text</span></h1>
					<b class="uk-margin-left" style="font-family: 'Times'; font-size:{{$textData['fontSize']}}; color: {{$textData['fill']}}; text-stroke-fill: red; text-stroke-color: red; text-stroke-width: 3; color: purple;">{{ $textData['text'] }}</b>
					<h4 class="uk-heading-line uk-text-center"><span>Info</span></h4>
					<ul class="uk-list uk-list-bullet">
						@foreach($textData as $key=>$td)
							<li>{{ $key }}: <b>{{ $td }}</b></li>
						@endforeach	
					</ul>	
				</div>
				<hr>
				<div class="uk-margin uk-width-1-1">
					<h1 class="uk-heading-line uk-text-center"><span>Image</span></h1>
					<img class="uk-margin-left" src="{{ base_path() }}/public/images/{{ $imageData['image'] }}" />
					<h4 class="uk-heading-line uk-text-center"><span>Info</span></h4>
					<ul class="uk-list uk-list-bullet">
						@foreach($imageData as $key=>$id)
							<li>{{ $key }}: <b>{{ $id }}</b></li>
						@endforeach	
					</ul>	
				</div>
			</div>
		</div>	
	</div>
</body>
</html>