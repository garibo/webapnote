<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
<table width="100%" style="background: #1E1E1E;">
	<tbody>
		<tr>
			<td>
				<table></table>
				<table style="font-family: open sans, arial, verdana, sans-serif; background: #161616; height: 34px; text-align: center; height: 34px; width: 100%;">
					<tbody>
						<tr>
							<td>
								<form style="color: #8C8C8C; font-size: 13px;">
									Se ve mal el email? <input type="submit" style="text-decoration: none; background: none !important; margin-bottom: 3px;border:0;color: #164EDD; cursor: pointer;" value="Entra aquí" />
								</form>
							</td>
						</tr>
					</tbody>
				</table>
				<table style="width: 50%; margin: 0 auto;">
					<tbody>
						<tr>
							<td style="text-align: center; padding-top: 40px;">
								<a href="#"><img src="<?=base_url('assets/img/typeform.png');?>" width="300" /></a>
								<br />
								<br />
								<img src="<?=base_url('assets/img/imagemail.jpg');?>" width="100%" />
								<table style="background: #24282E; padding: 10px 30px; width: 100%; margin-top: -4px;">
									<tr>
										<td>
											<h1 style="font-family: open sans, arial, verdana, sans-serif;text-align: left; color: #F0514F; ">Enhorabuena!</h1>
											<p style="color: white; font-family: open sans, arial, verdana, sans-serif;text-align: left;">Hola <?=$nombre?>, Bienvenido(a) a nuestra aplicación!</p>
											<p style="color: white;font-family: open sans, arial, verdana, sans-serif;text-align: left;">Es un honor tenerte con nosotros. A partir de ahora, podrás hacer uso de nuestra
											aplicación, para ello, primeramente debes verificar tu cuenta para tener acceso a la plataforma.</p>
											<p style="color: white;font-family: open sans, arial, verdana, sans-serif;text-align: left;">Tus datos de acceso a la plataforma son: </p>
											<blockquote style="font-family: open sans, arial, verdana, sans-serif;text-align: left; color: white; margin: 0;padding-left: 30px !important; border-left: 4px solid #FFFFFF;">
												<p><b>Email:</b> <a href="#" style="text-decoration: none; color: white;"><?=$email?></a></p>
												<p><b>Usuario: </b> <?=$usuario?></p>
												<p><b>Password:</b> <?=$pass?></p>
											</blockquote>
											<p style="font-family: open sans, arial, verdana, sans-serif;text-align: left;color: white;">Para continuar y disfrutar de los recursos de Apnote, solo presiona el botón inferior para 
											activar tu cuenta.</p>
											<a href="http://apnote.recyclerscoders.com/API/activation/<?=$usuario?>" class="btn btn-primary col-lg-12" style="font-family: open sans, arial, verdana, sans-serif;margin-top: 15px;margin-bottom: 15px; padding:15px; font-size: 16px;background: #F0514F;color: white;display: block;border-radius: 3px;text-decoration: none;">Verificar mi cuenta</a>
											<p style="font-family: open sans, arial, verdana, sans-serif;text-align: left;color: white;width: 160px;">Saludos Cordiales</p>
											<p style="margin-top: -10px;font-family: open sans, arial, verdana, sans-serif;text-align: left;color: white;width: 160px;">Equipo de Desarrollo</p>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<br />
				<br/>
				<table style="font-family: open sans, arial, verdana, sans-serif; background: #161616; height: 34px; text-align: center; height: 34px; width: 100%; margin: 0 auto;">
					<tbody>
						<tr>
							<td>
								<table style="font-family: open sans, arial, verdana, sans-serif; background: #161616; height: 34px; text-align: center; height: 34px; width: 50%; margin: 0 auto; padding-top: 15px; padding-bottom: 15px;">
									<tbody>
										<tr>
											<td width="60%">
												<p style="color: white;">Recyclers Coders 
												Lázaro Cárdenas, 60990
												Michoacán, México</p>
												<p style="color: #394048 !important;font-size: 12px; font-style: italic;">Este correo fue enviado solo para verificar la cuenta de acceso a la plataforma.</p>
											</td>
											<td width="40%">
												<img src="<?=base_url('assets/img/sello.png');?>" style="width: 50%;" >
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>