<?php $this->load->view('header'); ?>
	
	<!-- Main body -->
	<div class="app-main-body clearfix">

		<?php $this->load->view('dash-sidebar');?>

		<div class="large-8 columns app-content-main app-content">
			<div id="options-menu-dash-app">
				
				<?php $this->load->view('bartop'); ?>

				<div class="row" style="margin-top: 20px;">
					<div class="large-10 column">
						<ul class="breadcrumbs">
							<li><a href="<?=base_url('dashboard');?>">Dashboard</a></li>
							<li class="current"><a href="<?=base_url('notificaciones');?>">Notificaciones</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="large-10 column">
						<h5 class="subheader-title">Notificaciones </h5>
					</div>
				</div>
				<?php if(empty($notificaciones)): ?>
				<div class="row">
					<div class="large-10 column">
						<div id="content-proyecto" class="panel callout">
							<p class="text-center" style="line-height: inherit !important;"><i class="fi-annotate" style="font-size: 50px;color: #AAAAAA;"></i></p>
							<h6 style="color: #AAAAAA;" class="text-center">No tiene notificaciones sin leer</a></h6>
						</div>
					</div>
				</div>
				<?php else: ?>
				<div class="row">
					<div class="large-10 column">
						<ul class="navtimeline">
							<?php foreach($notificaciones as $row): ?>
								<li><span class="avatartimeline"><img src="<?=base_url('assets/img/thumbs');?>/<?=$row['Photo'];?>" /></span><b><?php echo $row['Nombre'].' '.$row['Apep'].' '.$row['Apem']; ?></b> ha enviado un proyecto para su revisión. <span class="clockdate"><i class="icon-clock"></i> <?=$row['Fecha'];?></span> <a href="<?=base_url('reportes/mostrar/')?>/<?=$row['IdProyecto']?>"> Revisar</a> <a href="#" id="checkok" data-id="<?=$row['IdProyecto']?>" style="right: 65px;"><span class="icon-circle-check"></span></a> <a href="#" id="replybad" data-id="<?=$row['IdProyecto']?>" style="right: 35px;"><span class="icon-circle-cross"></span></a></li>
							<?php endforeach; ?>
						</ul>
						<ul class="pagination right" style="margin-top: 30px;">
							<?=$pages?>
						</ul>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php $this->load->view('dropdown'); ?>

<?php $this->load->view('footer'); ?>