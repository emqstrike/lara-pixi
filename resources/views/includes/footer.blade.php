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

	var fonts = ['Eater', 'Press Start 2P', 'Spirax'];

	WebFont.load({
			custom: {
			families: fonts,
			urls: ['/css/myFonts.css']
		},
		active: function() {
			console.log('fonts loaded');
		}
	});

	$('#canvas-container').html(app.view);

	var sheets = document.styleSheets
	var myFontsSheet = sheets[1];
	var myStylesSheet = sheets[3];

	let message, messageStyle;

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

	// Change image color
	$('#red-btn').on('click', imageRed);
	$('#blue-btn').on('click', imageBlue);
	$('#green-btn').on('click', imageGreen);
	$('#default-btn').on('click', imageDefault);

	// Change Font Style
	// $('.font-btn').on('click', changeFont);

	// Move Image
	$('#mvm-btn-right').on('click', right);
	$('#mvm-btn-left').on('click', left);
	$('#mvm-btn-up').on('click', up);
	$('#mvm-btn-down').on('click', down);

	$('#upload-form').submit(function(event) {
		event.preventDefault();

		var method = 'post';
		var url = "/upload";

		var formData = new FormData($(this)[0]);

		ajax_cb(method, url, formData, function(data) {
			console.log(data.length);
			var button;
			_.each(data, function(val, key) {

				// $('[style type="text/css"]' + demo + '[/style]').appendTo('head');

				// addCSSRule(myFontsSheet, '@font-face', 'font-family: ' +  + );

				button = '<button class="uk-button uk-button-default uk-width-1-1 uk-margin-small '+val+' font-btn" data-data="'+val+'">';
				button += val;
				button += '</button>';
			});
			$('#fonts-container').html(button);
		});
		
	});

	function changeFont(font) {
		var newFont = defaultStyle(font);
		message.style = newFont;
	}

	function defaultStyle(font) {
		// switch (font) {
		// 	case 'spirax': font={fill:'white', stroke:'#ff3300', strokeThickness:4, fontSize:50, fontFamily:'Spirax'};
		// 	break;

		// 	case 'pressstart2p': font={fill:'white', stroke:'#ff3300', strokeThickness:4, fontSize:50, fontFamily:'Press Start 2P'};
		// 	break;				

		// 	case 'eater': font={fill:'white', stroke:'#ff3300', strokeThickness:4, fontSize:50, fontFamily:'Eater'};
		// 	break;

		// 	default: font={fill:'white', stroke:'#ff3300', strokeThickness:4, fontSize:50, fontFamily:'Arial'};
		// }
		newFont = {fill:'white', stroke:'#ff3300', strokeThickness:4, fontSize:50, fontFamily: font};
		return newFont;
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
			dataTyoe: 'JOSN',
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

</script>