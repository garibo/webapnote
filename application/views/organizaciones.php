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
							<li class="current"><a href="<?=base_url('organizaciones');?>">Organizaciones</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="large-10 column">
						<h5 class="subheader">Mis Organizaciones <a href="#" data-reveal-id="app-add-org" class="button radius tiny right btn-new"><i></i> Añadir Organización</a></h5>
					</div>
				</div>
				<div class="row">
					<div class="large-10 column">
						<?php if(!empty($datos)){ ?>
						<table class="large-10">
							<thead>
								<tr>
									<th>RFC Compañia</th>
									<th>Nombre</th>
									<th>Descripción</th>
									<th>Telefono</th>
									<th>Clase</th>
									<th style="text-align:center;"></th>
									<th width="80"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($datos as $row){?>
									<tr>
										<td><?=$row['c_rfc'];?></td>
										<td><?=$row['c_name'];?></td>
										<td><?=$row['c_descri'];?></td>
										<td><?=$row['c_phone'];?></td>
										<td style="text-align:center;"><?php
										switch ($row['id_clase']) {
											case 1:
												echo "A";
												break;

											case 2:
												echo "B";
												break;
											
											case 3:
												echo "C";
												break;

											case 4: 
												echo "D";
												break;
										}
										?></td>
										<td style="text-align: center;font-size: 20px;"><a href="<?=base_url('organizaciones/team');?>/<?=$row['c_rfc'];?>"><i class="fi-torsos-all"></i></a></td>
										<td style="text-align: center; font-size: 20px;"><a href="#" id="del" value="<?=$row['c_rfc'];?>" class="btn-delete"><i class="fi-trash"></i></a> <a href="<?=base_url('organizaciones/edit');?>/<?=$row['c_rfc'];?>"><i class="fi-pencil"></i></a></td>
									</tr>
								<?php }?>
							</tbody>
						</table>
						<?php }else {?>
						<div class="panel callout">
							<p class="text-center" style="line-height: inherit !important;"><i class="fi-annotate" style="font-size: 50px;color: #AAAAAA;"></i></p>
							<h6 style="color: #AAAAAA;" class="text-center">Aún no tienes organizaciones asignadas a tu cuenta.</h6>
						</div>
						<?php	} ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view('dropdown'); ?>
	
	<!-- Modal Main body -->
	<div id="app-add-org" class="reveal-modal medium" data-reveal>
		<div class="row" id="app-error-msg-org" style="padding-top: 20px;">
			<div class="app-error-data-org panel radius" style="margin-right: 60px;"></div>
			<div class="row" style="margin-right: 45px;">
				<div class="large-10 column">
					<a href="#" class="close-error-msg-org button small radius large-10">Regresar al Formulario</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-10 column">
				<h5 class="subheader error-title" style="padding-bottom: 10px; position: relative; top: -10px; text-transform:uppercase; text-align: center; font-weight: 700; font-size: 14px;">Registro de Organizaciones</h5>
			</div>
		</div>
		<form id="add-form-org">
			<div class="row">
				<div class="large-6 columns group" id="group-rfc">
					<label>RFC de la Compañía</label>
					<input type="text" id="rfc-input" name="rfc" placeholder="RFC Compañía" class="radius" />
					<span style="top: 41px !important" class="label success radius" id="counter"></span>
					<span class="warning label alert radius span-error hide"></span>
				</div>
				<div class="large-4 columns group" id="group-phone">
					<label>Teléfono</label>
					<input type="text" name="phone" placeholder="Telefono" id="phone-input" class="radius" />
					<span class="warning label alert radius span-error hide"></span>
				</div>
			</div>
			<div class="row">
				<div class="large-6 columns group" id="group-name">
					<label>Nombre de la Compañía</label>
					<input type="text" name="name" placeholder="Nombre de la Compañía" id="name-input" class="radius" />
					<span class="warning label alert radius span-error hide"></span>
				</div>
				<div class="large-4 columns group" id="group-clases">
					<label>Clase</label>
					<select name="clases">
						<option value="">Selecciona una clase</option>
						<?php foreach($clases as $row): ?>
						<option value="<?=$row['id_clase'];?>"><?=$row['cla_name'];?></option>
						<?php endforeach;?>
					</select>
					<span class="warning label alert radius span-error hide"></span>
				</div>
			</div>
			<div class="row">
				<div class="large-10 columns group" id="group-descripcion">
					<label>Descripción de la Organización</label>
					<textarea rows="5" name="descripcion" placeholder="Descripción" id="des-input" class="radius"></textarea>
					<span class="label alert warning radius span-error hide"></span>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="large-10 column">
					<input type="submit" class="button radius small large-10" id="submit-input" value="Añadir Compañía" />
				</div>
			</div>
		</form>
		<a href="#" class="close-reveal-modal">&#215;</a>
	</div>
	<!-- End Modal Main body -->

<?php $this->load->view('footer'); ?>