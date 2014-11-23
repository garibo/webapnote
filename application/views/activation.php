<?php $this->load->view('header'); ?>
	
	<div class="other" style="padding-top: 5%;">
		<div class="panel" style="width: 350px;height: 365px; margin: 0 auto; box-shadow: 0 3px 2px #D3D3D3;">
			<center><img src="<?=base_url('assets/img/logo-reg.png');?>" style="">	</center>
			<br />
			<?php if($success == 1): ?>
				<h5 class="text-center"><b>Bienvenido, <?=$usuario?></h5>
				<p class="text-center">Tu cuenta de usuario a sido activada correctamente, ahora
				puedes acceder desde la página principal.</p>
				<p class="text-center">Disfruta de la aplicación.</p>
				<a href="<?=base_url();?>" class="button large-10 radius">Ir a la página principal</a>
			<?php else: ?>
				<h5 class="text-center"><b>Lo sentimos</b></h5>
				<p class="text-center">Este usuario no esta asociado a ninguna cuenta o no se ha introducido
				un usuario correcto.</p>
				<p class="text-center">Intentalo nuevamente.</p>
				<a href="<?=base_url();?>" class="button large-10 radius">Ir a la página principal</a>
			<?php endif;?>
		</div>
	</div>

<?php $this->load->view('footer'); ?>