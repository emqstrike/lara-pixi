<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PDF View</title>
	<meta name="_token" content="{{ csrf_token() }}"/>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/css/uikit.min.css" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/js/uikit.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/js/uikit-icons.min.js"></script>
</head>
<body>
	<div class="uk-section">
		<div class="container">
			<div class="uk-grid-small uk-child-width-expand@s" uk-grid>
				<div class="uk-margin uk-width-1-1">
					<h1 class="uk-heading-line uk-text-center"><span>Text</span></h1>	
				</div>
				<div class="uk-margin uk-width-1-1">
					<h1 class="uk-heading-line uk-text-center"><span>Image</span></h1>	
				</div>
			</div>
		</div>	
	</div>
</body>
</html>