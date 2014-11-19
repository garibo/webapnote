		<?php 
			function evalActive($uri){ 
				if(strstr($_SERVER['REQUEST_URI'], $uri)){echo 'class="active"';}
			}
		?>
		<div class="large-2 columns app-sidebar-main">
			<div class="row dash-app">
				<div class="large-4 columns">
					<img class="th radius" src="<?=base_url('assets/img/thumbs');?>/<?=$this->session->userdata('u_photo');?>" height="70" width="70" style="margin-left: 12px;" />
				</div>
				<div class="large-6 columns dash-app-profile">
					<h6 style="color: #EEE; font-weight: 600; font-size: 14px;"><?=$this->session->userdata('u_nombre');?> <?=$this->session->userdata('u_apep');?></h6>
					<h6 class="subheader" style="font-size: 12px;"><?=$this->session->userdata('u_username');?></h6>
					<h6 class="subheader" style="font-size: 13px;"><span style="color: #ADADAD;"><i style="color: #FFCC4D;padding-right: 5px;" class="fi-stop"></i> Conectado</span></h6>
				</div>
			</div>
			<div class="row">
				<div class="large-10 column">
					<ul class="side-nav">
						<li class="separator-li"><a href="#">Principal</a></li>
						<li <?php evalActive('dashboard'); ?>><a href="<?=base_url('dashboard');?>"><i class="icon-home4 icon-menu-nav"></i> Dashboard</a></li>
						<li <?php evalActive('profile'); ?>><a href="<?=base_url('profile');?>"><i class="icon-head icon-menu-nav"></i> Mi Perfil</a></li>
						<br />
						<li class="separator-li"><a href="#">Administración</a></li>
						<li <?php evalActive('proyectos'); ?> id="proyectosli"><a href="#"><i class="icon-bulb icon-menu-nav"></i> Proyectos <i id="icon-toggle-icon" class="icon-arrow-right9"></i></a></li>
						<ul id="sub-side-nav" class="side-nav" style="margin-bottom: 0 !important;margin-left: -40px;padding-left: 10px">
							<li class="categoryli"><a style="padding: 12px 100px;" href="<?=base_url('proyectos');?>"><i class="icon-lab2 icon-menu-nav" style="top: 13px; left: 100px;"></i>En Proceso</a></li>
							<li class="categoryli"><a style="padding: 12px 100px;" href="<?=base_url('proyectos');?>"><i class="icon-check icon-menu-nav" style="top: 13px; left: 100px;"></i>Terminados</a></li>
							<li class="categoryli"><a style="padding: 12px 100px;" href="<?=base_url('proyectos');?>/categorias"><i class="icon-stack2 icon-menu-nav" style="top: 13px; left: 100px;"></i> Categorias</a></li>
						</ul>
						<li <?php evalActive('organizaciones'); ?>><a href="<?=base_url('organizaciones');?>"><i class="icon-briefcase icon-menu-nav"></i> Organizaciones</a></li>
						<li <?php evalActive('reportes'); ?>><a href="<?=base_url('reportes');?>"><i class="icon-paper icon-menu-nav"></i>Reportes <!-- <span class="box-notification">23</span>--></a></li>
						<br />
						<li class="separator-li"><a href="#">Logs</a></li>
						<li <?php evalActive('eventos'); ?>><a href="#"><i class="icon-clock icon-menu-nav"></i>Eventos <span class="box-notification">Soon</span></a></li>
					</ul>
				</div>
			</div>
		</div>