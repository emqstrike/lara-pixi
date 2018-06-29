<script type="text/javascript">
	
	$(document).ready(function () {

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

		let message, messageStyle;

		const hexRed = 0xFF0000,
			hexBlue = 0x0000FF,
			hexGreen = 0x008000;

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

		// Change Canva BG Color
		$('#canvas-red-btn').on('click', canvasRed);
		$('#canvas-blue-btn').on('click', canvasBlue);
		$('#canvas-green-btn').on('click', canvasGreen);

		// Change Font Style
		$('.font-btn').on('click', changeFont);

		// Move Image
		$('#mvm-btn-right').on('click', right);
		$('#mvm-btn-left').on('click', left);
		$('#mvm-btn-up').on('click', up);
		$('#mvm-btn-down').on('click', down);

		function changeFont() {
			var font = $(this).data('data');
			var newFont = defaultStyle(font);
			message.style = newFont;
		}

		function defaultStyle(font) {
			switch (font) {
				case 'spirax': font={fill:'white', stroke:'#ff3300', strokeThickness:4, fontSize:50, fontFamily:'Spirax'};
				break;

				case 'pressstart2p': font={fill:'white', stroke:'#ff3300', strokeThickness:4, fontSize:50, fontFamily:'Press Start 2P'};
				break;				

				case 'eater': font={fill:'white', stroke:'#ff3300', strokeThickness:4, fontSize:50, fontFamily:'Eater'};
				break;

				default: font={fill:'white', stroke:'#ff3300', strokeThickness:4, fontSize:50, fontFamily:'Arial'};
			}
			return font;
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

		function canvasRed() {
			app.renderer.backgroundColor=hexRed;
		}

		function canvasBlue() {
			app.renderer.backgroundColor=hexBlue;
		}

		function canvasGreen() {
			app.renderer.backgroundColor=hexGreen;
		}

	});

</script>