<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profile</title>
</head>
<body>
	<div class="row">
		<div class="large-10 column">
			<h5 class="subheader">Información de <?php echo $prteam['u_nombre'];?></h5>
			<div class="panel callout">
				<div class="row">
					<div class="large-3 columns">
						<img src="<?=base_url('assets/img/thumbs');?>/<?php echo $prteam['u_photo']?>">
					</div>
					<div class="large-7 columns">
						<h6><strong>Nombre: </strong></h6>
						<h6 class="subheader"><?php echo $prteam['u_nombre'].' '.$prteam['u_apep'].' '.$prteam['u_apem']; ?></h6>
						<h6><strong>Email: </strong></h6>
						<h6 class="subheader"><?php echo $prteam['u_email']; ?></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>