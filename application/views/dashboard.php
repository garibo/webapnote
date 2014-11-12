<?php $this->load->view('header'); ?>
	
	<!-- Main body -->
	<div class="app-main-body clearfix">

		<?php $this->load->view('dash-sidebar');?>

		<div class="large-8 columns app-content-main app-content">
			<div id="options-menu-dash-app">
				
				<?php $this->load->view('bartop'); ?> 

				<div class="row" style="margin-top: 20px;">
					<div class="large-10 column">
						<!-- <ul class="breadcrumbs">
							<li class="current"><a href="#">Dashboard</a></li>
						</ul> -->
					</div>
				</div>
				<!-- Init Dashboard -->
				<div class="row">
					<div class="large-2 columns">
						<div class="panel panel-item">
							<h6>Usuarios</h6>
							<h4><i class="icon-user7"></i> <?=$allUsers;?></h4>
						</div>
					</div>
					<div class="large-2 columns">
						<div class="panel panel-item">
							<h6>Organizaciones</h6>
							<h4><i class="icon-briefcase"></i> <?=$allCompany->Organizaciones;?></h4>
						</div>
					</div>
					<div class="large-2 column">
						<div class="panel panel-item">
							<h6>Proyectos</h6>
							<h4><i class="icon-bulb"></i> <?=$allProjects->Proyectos;?></h4>
						</div>
					</div>
					<div class="large-2 column">
						<div class="panel panel-item">
							<h6>Imágenes Alojadas</h6>
							<h4><i class="icon-camera6"></i> <?=$allImages->Imagenes;?></h4>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-4 columns">
						<div class="panel panel-item panel-date">
							<h6><?=date('D');?></h6>
							<h5><?=date('d');?></h5>
							<h4><?=date('M');?></h4>
						</div>
					</div>
					<div class="large-6 columns">
						<div class="panel panel-item">
							<h6>Recuento de Imagenes</h6>
							<canvas id="imagenesChart" class="large-10" width="528" height="160"></canvas>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-3 columns">
						<div class="panel panel-item">
							<h6>Acerca de Proyectos</h6>
							<canvas id="proyectosChart" class="large-10" width="230" height="120"></canvas>
						</div>
					</div>
				</div>
				<!-- Ending Dashboard -->
			</div>
		</div>
	</div>

	<?php $this->load->view('dropdown'); ?>

<?php $this->load->view('footer'); ?>