<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
	#modal_window
	{
		display: none;
	}
	body > div.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-draggable.ui-resizable > div.ui-dialog-titlebar.ui-corner-all.ui-widget-header.ui-helper-clearfix.ui-draggable-handle > button {
		width: 10%;
		float: right;
		font-size: 0;
		height: 20px;
	}
	#modal_window > div.titulo1 {
		padding-top: 4px;
		color: dodgerblue;
		font-weight: bold;
		margin-left: 5px;
	}
	#modal_window > div > div.logo-servicio > img {
		height: 60px;
		width: 60px;
	}
	#modal_window > div > div.logo-servicio {
		float: left;
		margin-left: 5px;
		width: 30%;
	}
	#modal_window > div.servicio {
		border-bottom: 1px solid lightgrey;
		padding: 4px;
		margin-left: 2px;
		margin-right: 2px;
	}
	#modal_window > div > div.descripcion-servicio {
		float: right;
		text-align: left;
		width: 70%;
		padding-top: 16px;
		font-weight: bold;
	}
	#modal_window > div {
		width: 100% !important;
		display: inline-flex;
	}
	#modal_window {
		border: none;
	}
	#modal_window > div.links {
		display: block;
		float: right;
	}
	#modal_window > div.links > div.link1,
	#modal_window > div.links > div.link2 {
		float: right;
		color: dodgerblue;
		font-weight: bold;
		margin-left: 10px;
	}
	#modal_window > div.links > div.link1 {
		margin-right: 10px;
	}
</style>
<div class="bubble-message">
  <h3><?php echo t('Bienvenido');?></h3>
</div>

			<a href="/spotify/login" class="blues-button"><?php echo t('Iniciar');?></a><br>
			<a href="/spotify/followplay" class="blues-button"><?php echo t('Seguir');?></a><br>
			<a href="#" id="MostrarModal">Ventana Modal</a>


<div id="modal_window">
	<div class="titulo1">
		Complete action using
	</div>
	<br><br>
	<div class="servicio">
		<div class="logo-servicio">
			<img class="img-responsive" src="/sites/all/themes/mobile/images/servicios/deezer.png" >
		</div>
		<div class="descripcion-servicio">
			Deezer
		</div>
	</div>
	<div class="servicio">
		<div class="logo-servicio">
			<img class="img-responsive" src="/sites/all/themes/mobile/images/servicios/spotify.png" >
		</div>
		<div class="descripcion-servicio">
			Spotify
		</div>
	</div>
	<div class="servicio">
		<div class="logo-servicio">
			<img class="img-responsive" src="/sites/all/themes/mobile/images/servicios/apple.png" >
		</div>
		<div class="descripcion-servicio">
			Apple Music
		</div>
	</div>
	<div class="servicio">
		<div class="logo-servicio">
			<img class="img-responsive" src="/sites/all/themes/mobile/images/servicios/google.png" >
		</div>
		<div class="descripcion-servicio">
			Google Music
		</div>
	</div>
	<div class="servicio">
		<div class="logo-servicio">
			<img class="img-responsive" src="/sites/all/themes/mobile/images/servicios/tunein.png" >
		</div>
		<div class="descripcion-servicio">
			TuneIn Radio
		</div>
	</div>
	<br><br>
	<div class="links">
		<div class="link1">
			ALWAYS
		</div>
		<div class="link2">
			JUST ONCE
		</div>
	</div>
</div>
