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
							<li class="current"><a href="<?=base_url('reportes');?>">Reportes</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="large-10 column">
						<iframe src="<?=base_url('reporte/generar');?>/<?=$Id?>" style="width: 100%; height: 500px;"></iframe>
					</div>
				</div>

			</div>
		</div>
	</div>

	<?php $this->load->view('dropdown'); ?>

<?php $this->load->view('footer'); ?>