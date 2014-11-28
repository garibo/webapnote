		<!-- Scripts for the app -->
		<script type="text/javascript" src="<?=base_url('assets/js/vendor/jquery.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/holder.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/validations.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/foundation.min.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/app.min.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/foundation/foundation.equalizer.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/foundation/foundation.dropdown.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/foundation/foundation.reveal.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/foundation/foundation.tooltip.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/limitar.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/sweet-alert.min.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/Chart.min.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/imagenesChart.min.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/proyectosChart.min.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/pusherdist/pusher.min.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/jquery.inputlimiter.min.js');?>"></script>
		<script>$(document).foundation();</script>
		<script type="text/javascript">
		$(function(){
			var pusher  = new Pusher('03fe18e686c444d57188');
			var canal = pusher.subscribe('canal_prueba');

			canal.bind('notify', function(respuesta){
				
			});
		});
		</script>
	</body>
</html>