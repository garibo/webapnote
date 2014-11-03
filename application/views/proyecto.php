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
							<li><a href="<?=base_url('proyectos/selected');?>/<?=$orgpro['c_rfc'];?>"><?=$orgpro['c_name'];?></a></li>
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
						<table class="large-10 column">
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
				<div class="row">
					<div class="large-6 columns">
						<h5 class="subheader">Actividades del Proyecto <a href="#" class="button small radius right" data-options="align: top" data-dropdown="formdrop" aria-controls="formdrop" aria-expanded="false" style="position: absolute; right: 15px; top: -7px;height: 33px; padding: 10px;"><i class="fi-plus" style="padding-right: 5px;"></i> Agregar una Nueva</a></h5>
						<table class="large-10 column">
							<thead>
								<tr>
									<th>Definición</th>
									<th class="text-center" width="150">% Avance</th>
								</tr>
							</thead>
							<tbody>
							<?php if($tareas != null): ?>
								<?php foreach($tareas as $row): ?>
									<tr>
										<td><?=$row['Titulo'];?></td>
										<td class="text-center">
											<div class="progress success radius" style="margin-bottom: 0 !important;">
												<span class="meter text-center" style="width: <?=$row['Avance'];?>%; color: white; text-shadow: 0 0 2px #131313;"><?=$row['Avance']?>%</span>
											</div>
										</td>
									</tr>
								<?php endforeach;?>
							<?php endif; ?>
							</tbody>
						</table>
					</div>
					<div class="large-4 columns">
						<div class="panel callout">
							<p>Tip: Recuerda que para activar un proyecto, es necesario asignarle actividades/tareas.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="formdrop" data-dropdown-content class="f-dropdown medium content" aria-hidden="true" tabindex="-1">
		<form id="form-activity" style="padding-top: 10px;" data-id-proyecto="<?=$infoProyecto['proy_id'];?>">
			<div class="row">
				<div class="large-7 columns">
					<label>
						<input type="text" id="txt-task" />
					</label>
				</div>
				<div class="large-3 columns">
					<input type="submit" class="button small radius right" style="height: 37px;" value="Registrar" />	
				</div>
			</div>
		</form>
	</div>

	<?php $this->load->view('dropdown'); ?>

<?php $this->load->view('footer'); ?>