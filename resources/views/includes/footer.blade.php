<script type="text/javascript">

	let Application = PIXI.Application,
	Sprite = PIXI.Sprite,
	Text = PIXI.Text,
	TextStyle = PIXI.TextStyle,
	TextureCache = PIXI.utils.TextureCache,
	Texture = PIXI.Texture,
	loader = PIXI.loader,
	resources = PIXI.loader.resources;

	let app = new Application({resolution: 1, antialias: true, transparent: false});
		
	$('#canvas-container').html(app.view);

	var fonts = ['Eater', 'Press Start 2P'];
	webFontLoad(fonts);

	function webFontLoad(fonts) {
		WebFont.load({
			custom: {
				families: fonts,
				urls: ['/css/myFonts.css']
			}
		});
	}

	let message, messageStyle, fontPath;

	const hexRed = 0xFF0000,
		hexBlue = 0x0000FF,
		hexGreen = 0x008000,
		removeTint = 0xFFFFFF;

	let cat = new Sprite(Texture.fromImage('images/cat.png'));

	cat.anchor.set(0.5);
	cat.width = 120;
	cat.height = 120;
	cat.x = app.screen.width / 2;
	cat.y = app.screen.height / 2;

	cat.interactive = true;

	cat.buttonMode = true;

	// cat.on('click', onClickImage);

	cat
	.on('pointerdown', onDragStart)
	.on('pointerup', onDragEnd)
	.on('pointerupoutside', onDragEnd)
	.on('pointermove', onDragMove);	

	messageStyle = defaultStyle('arial');

	message = new Text('Welcome to PIXI Test!!!', messageStyle);

	app.stage.addChild(message, cat);

	// PDF View
	$('#pdf-view-btn').on('click', pdfView);

	// Change image color
	$('#red-btn').on('click', imageRed);
	$('#blue-btn').on('click', imageBlue);
	$('#green-btn').on('click', imageGreen);
	$('#default-color-btn').on('click', imageDefault);

	// Move Image
	$('#mvm-btn-right').on('click', right);
	$('#mvm-btn-left').on('click', left);
	$('#mvm-btn-up').on('click', up);
	$('#mvm-btn-down').on('click', down);

	// Scale Image
	$('#plus-btn').on('click', plus);
	$('#minus-btn').on('click', minus);
	$('#default-scale-btn').on('click', imageScaleDefault);

	// Upload Fonts
	$('#upload-form').submit(function(event) {
		event.preventDefault();

		var method = 'post';
		var url = "/upload";

		var formData = new FormData($(this)[0]);

		ajax_cb(method, url, formData, function(data) {
			var button = '';
			var addFontFaceRules='', addCssRules='';
			_.each(data, function(val, key) {

				if(!fonts.includes(val)) fonts.push(val);

				addFontFaceRules += fontRules(val, key);
				addCssRules += cssRules(val);

				button += '<button onclick="changeFont(\''+val+'\', \''+key+'\')" ';
				button += 'class="uk-button uk-button-default uk-width-1-1 uk-margin-small '+removeSpace(val)+' font-btn" data-data="'+val+'">';
				button += val;
				button += '</button>';

			});

			webFontLoad(fonts);

			$('<style type="text/css">' + addFontFaceRules + '</style>').appendTo('head');
			$('<style type="text/css">' + addCssRules + '</style>').appendTo('head');
			$('#fonts-container').html(button);
		});
		
	});

	function fontRules(font, path) {
		var css = '';
		css += '@font-face';
		css += '{';
			css += 'font-family';
			css += ':';
			css += '"'+font+'"';
			css += '; ';
			css += 'src';
			css += ':';
			css += 'url('+'"/storage/'+path+'")';
			css += ';';
		css += '} ';
		return css;
	}

	function cssRules(cssName) {
		var css = '';
		css += '.' + removeSpace(cssName);
		css += '{';
			css += 'font-family';
			css += ':';
			css += '"'+cssName+'"';
			css += ';';
		css += '} ';
		return css;
	}

	function changeFont(font, path=null) {
		if(path != null) fontPath=path;
		var newFont = defaultStyle(font);
		message.style = newFont;
	}

	function defaultStyle(font) {
		newFont = {
			fill:'white', 
			stroke:'#ff3300', 
			strokeThickness:4, 
			fontSize:50, 
			fontFamily: font
		};
		return newFont;
	}

	function plus() {
		cat.scale.x += 0.5;
		cat.scale.y += 0.5;
	}

	function minus() {
		if( cat.scale.x > 0.375 && cat.scale.y > 0.375) {
			cat.scale.x -= 0.5;
			cat.scale.y -= 0.5;
		}
	}

	function imageScaleDefault() {
		cat.scale.x = 1.875;
		cat.scale.y = 1.875;
	}

	function right() {
		cat.x += 25;
	}

	function left() {
		cat.x += -25;
	}

	function up() {
		cat.y += -25;
	}

	function down() {
		cat.y += 25;
	}

	function onClickImage() {
		alert('Meow');
	}

	function onDragStart(event) {
		this.data = event.data;
		this.alpha = 0.5;
		this.dragging = true;	
	}

	function onDragEnd() {
		this.alpha = 1;
		this.dragging = false;
		this.data = null;
	}

	function onDragMove() {
		if (this.dragging) {
			var newPosition = this.data.getLocalPosition(this.parent);
			this.x = newPosition.x;
			this.y = newPosition.y;
		}
	}

	function imageRed() { cat.tint = hexRed; }
	function imageBlue() { cat.tint = hexBlue; }
	function imageGreen() { cat.tint = hexGreen; }
	function imageDefault() { cat.tint = removeTint; }

	function ajax_cb(method, url, data, callback) {
		$.ajax({
			type: method,
			url: url,
			data: data,
			processData: false,
			contentType: false,
			success: function(data) {
				if (callback(data) === 'success') {
					alert(1);
				}
			},
			error: function(xhr, status, error) {
				console.log(xhr.responseText);
			}
		});
	}

	function addCSSRule(sheet, selector, rules, index) {
		if("insertRule" in sheet) {
			sheet.insertRule(selector + "{" + rules + "}", index);
		}
		else if("addRule" in sheet) {
			sheet.addRule(selector, rules, index);
		}
	}

	function removeSpace(str) {
		return str.replace(/\s+/g, '');
	}

	function pdfView() {
		var $ = jQuery;
		var getStyle, textData, imageData;

		getStyle = message.style;

		if(fontPath != null) {
			textData = {
				text: message.text,
				fontFamily: getStyle._fontFamily,
				fontSource: fontPath.split('/')[1],
				fontSize: getStyle._fontSize,
				fill: getStyle._fill, 
				stroke: getStyle._stroke, 
				strokeThickness: getStyle._strokeThickness, 
			}
		} else {
			textData = {
				text: message.text,
				fontFamily: getStyle._fontFamily,
				fontSize: getStyle._fontSize,
				fill: getStyle._fill, 
				stroke: getStyle._stroke, 
				strokeThickness: getStyle._strokeThickness, 
			}
		}

		imageData = {
			image: 'cat.png',
			width: cat.width,
			height: cat.height,
			color: '#' + ('00000' + (cat.tint.toString(16))).substr(-6),
		}

		// console.log('textData: ' + JSON.stringify(textData));
		// console.log('imageData: ' + JSON.stringify(imageData));

		var url = window.location.href + 'pdf-view';

		window.open(url + "/text/" + $.param(textData) + '/image/' + $.param(imageData), '_blank');
	}

</script>