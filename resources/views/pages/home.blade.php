@extends('layouts.master')

@section('content')
<h3>PIXI Test</h3>
<div class="uk-grid-match uk-child-width-expand@s" uk-grid>
	<div class="uk-width-1-3">
		<div class="uk-padding">
			<h5 class="uk-margin-remove uk-text-capitalize uk-text-bold">Change Canvas Color</h5>
			<button class="red uk-button uk-button-default uk-width-1-1 uk-margin-small" id="canvas-red-btn">Red</button>
			<button class="blue uk-button uk-button-default uk-width-1-1 uk-margin-small" id="canvas-blue-btn">Blue</button>
			<button class="green uk-button uk-button-default uk-width-1-1 uk-margin-small" id="canvas-green-btn">Green</button>

			<h5 class="uk-margin-remove uk-text-capitalize uk-text-bold">Move Image</h5>
			<button class="uk-button uk-button-default uk-width-1-1 uk-margin-small" id="mvm-btn-right">Right</button>
			<button class="uk-button uk-button-default uk-width-1-1 uk-margin-small" id="mvm-btn-left">Left</button>
			<button class="uk-button uk-button-default uk-width-1-1 uk-margin-small" id="mvm-btn-up">Up</button>
			<button class="uk-button uk-button-default uk-width-1-1 uk-margin-small" id="mvm-btn-down">Down</button>

			<h5 class="uk-margin-remove uk-text-capitalize uk-text-bold">
				Change Message Font | <a href="#upload-modal" uk-toggle>Add</a>
			</h5>
	        
			@foreach($fontNames as $font)
				<button class="uk-button uk-button-default uk-width-1-1 uk-margin-small {{ $font }} font-btn" data-data="{{$font}}">{{ ucfirst($font) }}</button>
			@endforeach

			<h5 class="uk-margin-remove uk-text-capitalize uk-text-bold">Font URL</h5>
			<input class="uk-input uk-form-success uk-width-1-1" type="text" placeholder="Enter URL">
		</div>
	</div>
	<div class="uk-width-expand uk-height-large" id="canvas-container"> </div>
</div>

<!-- This is the modal -->
<div id="upload-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <form method="POST" action="upload" enctype="multipart/form-data">
			@csrf
			<span class="uk-text-capitalize uk-text-bold" style="color:#000">Upload .ttf file</span>
	        <div uk-form-custom>
	            <input type="file" name="font">
	            <span class="uk-link">upload</span>
	        </div>	
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" type="submit">Upload</button>
        </p>
		</form>
    </div>
</div>
@endsection