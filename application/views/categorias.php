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
							<li class="current"><a href="<?=base_url('proyectos/categorias');?>">Categorías</a></li>
						</ul>
					</div>
				</div>
				<div class="row" id="add-user-te">
					<div class="large-10 column">
						<div class="row">
							<h5 style="margin-left: 15px;" class="subheader">Nueva Categoría</h5>
						</div>
						<div class="panel">
							<form id="new-category">
								<div class="row">
									<div class="large-10 column group" id="category-group">
										<label>Nombre de la Categoría</label>
										<input style="margin-top: 0 !important" type="text" name="categoria" placeholder="Escribe el nombre de la Categoria" />
										<span class="warning label alert radius span-error hide"></span>
									</div>
								</div>
								<!-- <div class="row">
									<div class="large-10 column">
										<label>Descripcion</label>
										<br />
										<textarea cols="5" rows="2" placeholder="Describe la categoria a ingresar"></textarea>
									</div>
								</div>-->
								<div class="row">
									<div class="large-10 column">
										<input style="margin: 0 !important;" type="submit" class="button small large-10 radius" value="Registrar Categoría" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-10 column">
						<h5 class="subheader" style="margin-bottom: 15px;">Categorías de Proyectos <a href="#" id="reg-user-t" class="button radius tiny right" style="position: absolute; right: 15px; top: -8px;"><i></i> Agregar Categoría</a></h5>
						<?php if(!empty($categorias)): ?>
							<table class="large-10">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th>Nombre</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($categorias as $row): ?>
										<tr>
											<td width="50" class="text-center"><?=$row['id_category']?></td>
											<td><?=$row['cat_name']?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<ul class="pagination right">
								<?=$pages?>
							</ul>
						<?php else: ?>
						<?php endif; ?>
					</div>
				</div>

			</div>
		</div>
	</div>

	<?php $this->load->view('dropdown'); ?>

<?php $this->load->view('footer'); ?>