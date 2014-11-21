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
							<li><a href="<?=base_url('organizaciones');?>">Organizaciones</a></li>
							<li class="current"><a href="#">Equipo de Trabajo en <span style="font-weight: bold;"><?=$porg['c_name'];?></span></a></li>
						</ul>
					</div>
				</div>
				<div class="row" id="add-user-te">
					<div class="large-10 columns">
						<div class="row">
							<div class="large-10 column">
								<h5 class="subheader">Registro de <b>Nuevo Usuario</b> al Equipo de Trabajo</h5>
							</div>
						</div>
						<div class="panel">
							<form id="add-team-user" class="add-uteam" value="<?=$porg['c_rfc'];?>">
								<div class="row">
									<div class="large-4 columns group" id="group-email">
										<label>Correo Electrónico</label>
										<input type="text" name="t_email" placeholder="">
										<i class="fi-mail app-icon-input-edit"></i>
										<span class="warning label alert radius span-error hide"></span>
									</div>
									<div class="large-6 columns group" id="group-username">
										<label>Nombre de Usuario</label>
										<input type="text" id="user-inputname" name="t_username" placeholder="">
										<span class="label success radius" id="counter"></span>
										<i class="fi-torso app-icon-input-edit"></i>
										<span class="warning label alert radius span-error hide"></span>
									</div>
								</div>
								<div class="row">
									<div class="large-4 columns group" id="group-name">
										<label>Nombre</label>
										<input type="text" name="t_name" placeholder="">
										<i class="fi-align-left app-icon-input-edit"></i>
										<span class="warning label alert radius span-error hide"></span>
									</div>
									<div class="large-3 columns group" id="group-apep">
										<label>Apellido Paterno</label>
										<input type="text" name="t_apep" placeholder="">
										<i class="fi-align-left app-icon-input-edit"></i>
										<span class="warning label alert radius span-error hide"></span>
									</div>
									<div class="large-3 columns group" id="group-apem">
										<label>Apellido Materno</label>
										<input type="text" name="t_apem" placeholder="">
										<i class="fi-align-left app-icon-input-edit"></i>
										<span class="warning label alert radius span-error hide"></span>
									</div>
								</div>
								<div class="row">
									<div class="large-10 columns">
										<input id="sub-team" type="submit" class="button radius small large-10" value="Registrar Usuario al Equipo de Trabajo">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-10 column">
						<h5 class="subheader">Equipo de Trabajo <a href="#" id="reg-user-t" class="button radius tiny right btn-new"><i></i> Añadir Usuario</a></h5>
						<br/>
						<?php if(!empty($team)): ?>
							<table class="large-10">
								<thead>
									<tr>
										<th>Usuario</th>
										<th>Nombre</th>
										<th>Apellido Paterno</th>
										<th>Apellido Materno</th>
										<th>Correo Electrónico</th>
										<th style="text-align: center;"></th>
									</tr>
								</thead>
								<tbody id="body-org">
									<?php foreach($team as $row): ?>
									<tr>
										<td><?=$row['user'];?></td>
										<td><?=$row['nombre'];?></td>
										<td><?=$row['apep'];?></td>
										<td><?=$row['apem'];?></td>
										<td><?=$row['email']?></td>
										<td style="text-align: center; font-size: 20px;"><a href="#" id="del" data-org="<?=$this->uri->segment(3);?>" data-user="<?=$row['user'];?>" data-email="<?=$row['email']?>" class="btn-delete"><i class="fi-trash"></i></a> <a href="<?=base_url('organizaciones/profileTeam');?>/<?=$row['user'];?>" data-reveal-id="modal-demo" data-reveal-ajax="true"><i class="fi-torso"></i></a></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						<?php else: ?>
						<div class="panel callout">
							<p class="text-center" style="line-height: inherit !important;"><i class="fi-torsos-all" style="font-size: 50px;color: #AAAAAA;"></i></p>
							<h6 style="color: #AAAAAA;" class="text-center">Aún no tiene usuarios asignados a esta organización.</h6>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="row">
					<div class="large-10 column">
						<h5 class="subheader">Mis Organizaciones </h5>
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
									<th>Teléfono</th>
									<th style="text-align:center;">Clase</th>
									<th style="text-align:center;"></th>
									<th width="80"></th>
								</tr>
							</thead>
							<tbody id="records-org">
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
				<br />
			</div>
		</div>
	</div>

	<?php $this->load->view('dropdown'); ?>
	<div class="reveal-modal small" id="modal-demo" data-reveal>
		<a href="#" class="close-reveal-modal">&#215;</a>
	</div>

<?php $this->load->view('footer'); ?>