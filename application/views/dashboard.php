<?php $this->load->view('header'); ?>
	
	<!-- Main body -->
	<div class="app-main-body clearfix">
		<div class="large-2 columns app-sidebar-main">
			<div class="row dash-app">
				<div class="large-4 columns">
					<img class="th" src="<?=base_url('assets/img/thumbs');?>/<?=$this->session->userdata('u_photo');?>" height="70" width="70" />
				</div>
				<div class="large-6 columns dash-app-profile">
					<h6 style="color: #EEE; font-weight: 600; font-size: 14px;"><?=$this->session->userdata('u_nombre');?> <?=$this->session->userdata('u_apep');?></h6>
					<h6 class="subheader" style="font-size: 12px;"><?=$this->session->userdata('u_username');?></h6>
					<h6 class="subheader" style="font-size: 12px;"><span><i style="color: #59A336;" class="fi-burst"></i> Conectado</span></h6>
				</div>
			</div>
			<div class="row">
				<div class="large-10 column">
					<ul class="side-nav">
						<li class="active"><a href="#"><i class="fi-home icon-menu-nav"></i> Dashboard</a></li>
						<li><a href="#"><i class="fi-database icon-menu-nav"></i> Proyectos</a></li>
						<li><a href="#"><i class="fi-web icon-menu-nav"></i> Organizaciones</a></li>
						<li><a href="#"><i class="fi-page-multiple icon-menu-nav"></i> Reportes</a></li>
						<li><a href="#"><i class="fi-mail icon-menu-nav"></i> Mensajes</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="large-8 columns app-content-main app-content">
			<div id="options-menu-dash-app">
				<div class="row">
					<div class="large-3 columns">
						<input type="text" placeholder="¿Buscabas algo?" style="padding-left: 35px;" />
						<i class="fi-magnifying-glass app-icon-search"></i>
					</div>
					<div class="large-6 columns"></div>
					<div class="large-1 columns">
						<a href="#" data-options="align: left" data-dropdown="app-menu-options" class="app-icon-widget"><i class="fi-widget"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Menu Tooltips Dropdowns -->
	<ul id="app-menu-options" style="border-radius: 5px !important; -webkit-border-radius: 5px !important; -moz-border-radius: 5px !important;" class="small f-dropdown" data-dropdown-content>
		<li><a href="#"><img style="margin-top: -3px;" src="<?=base_url('assets/img/thumbs');?>/<?=$this->session->userdata('u_photo');?>" height="15" width="15" /> Mi Cuenta</a></li>
		<li><a href="#"><i class="fi-torso" style="padding-right: 5px;"></i> Editar Perfil</a></li>
		<li><a href="#"><i class="fi-widget" style="padding-right: 5px;"></i> Configuración de la Cuenta</a></li>
		<li class="divider-li"></li>
		<li class="default-li"><a href="<?=base_url('dashboard/logout');?>"><i class="fi-power" style="padding-right: 5px;"></i> Cerrar Sesión</a></li>
	</ul>
	<!-- End Main body -->

<?php $this->load->view('footer'); ?>