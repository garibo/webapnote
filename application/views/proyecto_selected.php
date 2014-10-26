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
							<li class="current"><a href="<?=base_url();?>">Proyectos en <strong><?php echo $orgpro['c_name']; ?></strong></a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="large-10 column">
						<h5 class="subheader">Proyectos en <?=$orgpro['c_name'];?> <a href="#" id="btn-open-pro" class="button radius tiny right" style="position: absolute; right: 15px; top: -8px;"><i></i>Crear Nuevo Proyecto</a></h5>
					</div>
				</div>
				<div class="row" id="panel-form-id">
					<div class="large-10 column">
						<div class="panel">
							<form id="agregarProy" data-company="<?=$orgpro['c_rfc'];?>">
								<div class="row">
									<div class="large-10 column group" id="nombre-cmp">
										<label style="padding: 0 !important;"><b>Nombre del Proyecto</b></label>
										<input type="text" name="pname" placeholder="Introduce el nombre del nuevo proyecto">
										<span class="warning label alert radius span-error hide"></span>
									</div>
								</div>
								<div class="row">
									<div class="large-6 columns group" id="category-cmp">
										<label><b>Categoría</b></label>
										<select name="category" id="cat">
											<option value="">Selecciona una opción</option>
											<?php foreach($categorias as $row): ?>
											<option value="<?=$row['id_category']?>"><?=$row['cat_name']?></option>
											<?php endforeach; ?>
										</select>
										<span class="warning label alert radius span-error hide"></span>
									</div>
									<div class="large-4 columns group" id="responsable-cmp">
										<label><b>Responsable</b></label>
										<select name="responsable" id="new">
											<option value="">Selecciona una opción</option>
										</select>
										<span class="warning label alert radius span-error hide"></span>
									</div>
								</div>
								<br />
								<div class="row">
									<div class="large-10 column group" id="descripcion-cmp">
										<label><b>Descripción</b></label>
										<textarea name="descripcion" cols="10" rows="13" placeholder="Describe los requerimientos o actividades al realizar en este proyecto, también puedes comentar un poco sobre el proyecto."></textarea>
										<span class="warning label alert radius span-error hide"></span>
									</div>
								</div>
								<br />
								<div class="row">
									<div class="large-10 column">
										<input type="submit" class="button large-10" value="Registrar Proyecto" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- table to projects -->
				<div class="row">
					<div class="large-10 column">
						<?php if(!empty($proyectos)){ ?>
						<table>
							<thead>
								<tr>
									<th width="900">Información Básica</th>
									<th width="100">Estado</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($proyectos as $row):?>
								<tr>
									<td>
										<p style="font-size: .875rem !important; margin-bottom: 0 !important;"><?=$row['c_proy_name'];?></p>
									</td>
									<td>
										<?php 
											if($row['c_fecha_ini'] == '0000-00-00 00:00:00'){
												echo "En Espera";
											}else{
												echo "En Curso";
											}
										 ?>
									</td>
									<td><a href="<?=base_url('proyectos/view/');?>/<?=$row['c_proy_id'];?>/<?=$orgpro['c_rfc'];?>" style="margin-bottom: 0 !important;" class="button success tiny radius">Información</a></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<?php }else {?>
						<div class="panel callout">
							<p class="text-center" style="line-height: inherit !important;"><i class="fi-annotate" style="font-size: 50px;color: #AAAAAA;"></i></p>
							<h6 style="color: #AAAAAA;" class="text-center">Usted no tiene proyectos en esta Organización.</h6>
						</div>
						<?php	} ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view('dropdown'); ?>

<?php $this->load->view('footer'); ?>