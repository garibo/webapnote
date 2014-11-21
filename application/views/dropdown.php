	<!-- Menu Tooltips Dropdowns -->
	<ul id="app-menu-options" style="border-radius: 5px !important; -webkit-border-radius: 5px !important; -moz-border-radius: 5px !important;" class="small f-dropdown" data-dropdown-content>
		<li><a href="<?=base_url('profile');?>"><i class="icon-user" style="padding-right: 5px;"></i> Ver mi Perfil</a></li>
		<!-- <li><a href="#"><i class="fi-widget" style="padding-right: 5px;"></i> Configuración de la Cuenta</a></li> -->
		<li class="divider-li"></li>
		<li class="default-li"><a href="<?=base_url('dashboard/logout');?>"><i class="fi-power" style="padding-right: 5px;"></i> Cerrar Sesión</a></li>
	</ul>
	<!-- End Main body -->

	<!-- Menu Tooltips Dropdowns -->
	<ul id="app-notify" style="border-radius: 5px !important; -webkit-border-radius: 5px !important; -moz-border-radius: 5px !important;" class="medium f-dropdown" data-dropdown-content>
		<div class="large-10 column" id="header-noty">
			<div class="row title-noty" >
				<div class="large-1 columns text-center"><i class="fi-comment"></i></div>
				<div class="large-8 columns"><p style="font-weight: 700;margin-bottom:0 !important;font-size: 14px;" class="text-center">Notificaciones</p></div>
				<div class="large-1 columns text-center"><i class="fi-x"></i></div>
			</div>
		</div>
		<div style="clear: both;"></div>
		<li>
			<img class="th left" src="<?=base_url('assets/img/thumbs');?>/<?=$this->session->userdata('u_photo');?>" height="50" width="50" />
			<div class="info left">
				<p class=""><b>Javier Diaz</b> ha creado una nueva organización.</p>
				<p class="date"><i class="fi-clock"></i> Hace 30 min.</p>
			</div>
		</li>
		<li>
			<img class="th left" src="<?=base_url('assets/img/thumbs');?>/<?=$this->session->userdata('u_photo');?>" height="50" width="50" />
			<div class="info left">
				<p class=""><b>Javier Diaz</b> ha creado una nueva organización.</p>
				<p class="date"><i class="fi-clock"></i> Hace 30 min.</p>
			</div>
		</li>
		<li>
			<img class="th left" src="<?=base_url('assets/img/thumbs');?>/<?=$this->session->userdata('u_photo');?>" height="50" width="50" />
			<div class="info left">
				<p class=""><b>Javier Diaz</b> ha creado una nueva organización.</p>
				<p class="date"><i class="fi-clock"></i> Hace 30 min.</p>
			</div>
		</li>
		<li>
			<img class="th left" src="<?=base_url('assets/img/thumbs');?>/<?=$this->session->userdata('u_photo');?>" height="50" width="50" />
			<div class="info left">
				<p class=""><b>Javier Diaz</b> ha creado una nueva organización.</p>
				<p class="date"><i class="fi-clock"></i> Hace 30 min.</p>
			</div>
		</li>
		<div style="clear: both;"></div>
		<div class="large-10 column" id="header-noty" style="border-top: 1px solid #D8D8D8;background: #FFF5F5; margin-bottom: -1px; margin-top: -2px">
			<div class="row title-noty" >
				<div class="large-10 column text-center"><b><a class="update-noty" href="#"><i class="fi-refresh"></i> Actualizar</a></b></div>
			</div>
		</div>
	</ul>
	<!-- End Main body -->