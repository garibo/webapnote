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
						<h6 style="position: absolute; right: 230px; font-size: 12px;"><i class="fi-stop" style="color: #8ABA56; padding-right: 10px; padding-left: 10px;"></i> Proyectos Terminados <i class="fi-stop" style="color: #F1AE47; padding-right: 10px; padding-left: 10px;"></i> Proyectos Pendientes <i class="fi-stop" style="color: #9D201E; padding-right: 10px; padding-left: 10px;"></i>Proyectos en Curso</h6>
						<h5 class="subheader-title">Proyectos <!-- en <?=$orgpro['c_name'];?> --> <a href="#" id="btn-open-pro" class="button radius tiny right btn-new"><i></i>Crear Nuevo Proyecto</a></h5>
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
										<input type="submit" class="button large-10 radius small" value="Registrar Proyecto" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- table to projects -->
				<div class="row">
					<div class="large-10 column">
						<ul class="large-block-grid-3 list-projects" id="body-projects" style="margin-top: 5px;">
						<?php if(!empty($proyectosActivos)){ ?>
							<?php foreach($proyectosActivos as $row): ?>
							<li>
								<div id="block-item">
									<div class="swatch-preview"></div>
									<h6 class="text-right title"><?=$row['Nombre'];?></h6>
									<hr />
									<div class="info-tasks">
										<p><b><?=$row['Tareas']?> Tareas</b></p>
										<p><span><?=$row['CreadoEn'];?></span></p>
									</div>
									<div class="opciones">
										<p><a href="#" id="getParent" data-id="<?=$row['Id']?>" class="btn-delete btn-absolute"><i style="font-size: 22px !important; position: absolute; top: -3px;" class="icon-trash2"></i></a> <a href="<?=base_url('/proyectos');?>/view/<?=$row['Id']?>/<?=$orgpro['c_rfc'];?>"><i class="icon-paper"></i></a></p>
									</div>
								</div>
							</li>
						<?php endforeach;?>
						<?php if(!empty($proyectosInactivos)): ?>
								<?php foreach($proyectosInactivos as $row): ?>
									<li>
										<div id="block-item">
											<div class="swatch-preview swatch-preview-b"></div>
											<h6 class="text-right title"><?=$row['Nombre'];?></h6>
											<hr />
											<div class="info-tasks">
												<p><b>Sin Tareas</b></p>
												<p><span><?=$row['CreadoEn'];?></span></p>
											</div>
											<div class="opciones">
												<p><a href="#" id="getParent" data-id="<?=$row['Id']?>" class="btn-delete btn-absolute"><i style="font-size: 22px !important; position: absolute; top: -3px;" class="icon-trash2"></i></a> <a href="<?=base_url('/proyectos');?>/view/<?=$row['Id']?>/<?=$orgpro['c_rfc'];?>"><i class="icon-paper"></i></a></p>
											</div>
										</div>
									</li>
								<?php endforeach;?>
						<?php endif; ?>
						</ul>
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