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
							<li><a href="<?=base_url('proyectos');?>">Proyectos</a></li>
							<li><a href="<?=base_url('proyectos/selected');?>/<?=$orgpro['c_rfc'];?>">Proyectos en <?=$orgpro['c_name'];?></a></li>
							<li class="current"><a href="#"><strong>Proyecto</strong></a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="large-10 column">
						<h5 class="subheader">Información del Proyecto</h5>
						<table class="large-10 column" id="infotable">
							<thead>
								<tr>
									<th class="text-center" width="150">ID de Proyecto</th>
									<th class="text-center">Nombre del Proyecto</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center"><?=$infoProyecto['proy_id'];?></td>
									<td class="text-center"><?=$infoProyecto['proy_name'];?></td>
								</tr>
							</tbody>
						</table>
						<table class="large-10 column" id="infotable">
							<thead>
								<tr><th class="text-center">Descripción</th></tr>
							</thead>
							<tbody>
								<tr><td class="text-justify"><?=$infoProyecto['proy_descri'];?></td></tr>
							</tbody>
						</table>
						<table class="large-10 column" id="infotable">
							<thead>
								<tr>
									<th class="text-center">Responsable</th>
									<th class="text-center">Categoria</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center"><?php echo $infoProyecto['res_name'].' '.$infoProyecto['res_apep'].' '.$infoProyecto['res_apem'];?></td>
									<td class="text-center"><?=$infoProyecto['proy_categoria'];?></td>
								</tr>
							</tbody>
						</table>
						<table class="large-10 column" id="infotable">
							<thead>
								<tr>
									<th class="text-center">Fecha de Creación</th>
									<th class="text-center">Fecha de Inicio</th>
									<th class="text-center">Estado del Proyecto</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center"><?=$infoProyecto['fecha_creado'];?></td>
									<td class="text-center"><?=$infoProyecto['estado'];?></td>
									<td class="text-center"><?=$infoProyecto['estado'];?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view('dropdown'); ?>

<?php $this->load->view('footer'); ?>