<?php $this->load->view('header'); ?>
		<!-- Incorrect Datas Login -->
			<div class="large-4 large-centered columns" id="bad-msg">
				<div class="bad">
					<p><i class="fi-x" style="font-size: 15px; padding-right: 5px;"></i> Correo Electrónico y/o Contraseña Incorrecta, Intenta nuevamente</p>
				</div>
			</div>
		<!-- Main body -->
		<div class="app-main-body clearfix">
			<div class="small-4 medium-4 large-2 columns app-sidebar-main">
				<div class="row">
					<div class="large-10 column">
						<a href="#" class="app-logotype">Apnote</a>
					</div>
				</div>
				<div class="row app-info-main">
					<div class="large-10 column">
						<video autoplay loop id="bgVideo">
							<source src="<?=base_url('assets/img/variousways.mp4');?>" type="video/mp4">
						</video>
					</div>
				</div>
				<div class="row app-form-main">
					<div class="large-10 column">
						<form id="app-signin">
							<div class="row">
								<i class="fi-mail app-icon-input"></i>
								<input class="radius" type="text" name="emailsign" placeholder="Correo Electrónico" />
							</div>
							<div class="row">
								<i class="fi-lock app-icon-input"></i>
								<input class="radius" type="password" name="passign" placeholder="Contraseña" />
							</div>
							<div class="row">
								<input type="submit" class="button radius small expand" value="Iniciar Sesión" />
							</div>
							<div class="row">
								<p class="app-message">¿No estas registrado? <a href="#" data-reveal-id="register-modal" data-reveal>Crea una cuenta</a></p>
							</div>
						</form>
					</div>
				</div>
				<div class="row app-footer-main">
					<div class="large-2 columns">
						<a href="#" class="app-info-button" data-reveal-id="modal-information" data-reveal><i class="fi-info"></i></a>
					</div>
					<div class="large-8 columns">
						<p class="app-message app-copyright">Copyright &copy; <?=date('Y');?> by Apnote, Devs.</p>
					</div>
				</div>
			</div>
			<div class="small-6 medium-6 large-8 columns app-content-main">
				<div class="row app-info-movilapp">
					<div class="large-4 columns">
						<div class="phone">
							<div class="app-slider-main">
								<!-- Slider Here -->
								<ul class="example-orbit" data-orbit data-options="animation_speed: 500;timer_speed: 5000; pause_on_hover: true; resume_on_mouseout: true; navigation_arrows: false; slide_number: false; bullets: false; timer: true;">
									<li>
										<img src="<?=base_url('assets/img/mobile/dashboard.png');?>" alt="Screenshot 2">
									</li>
									<li class="active">
										<img src="<?=base_url('assets/img/mobile/login.png');?>" alt="Screenshot 1">
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="large-6 columns">
						<h2 style="font-weight: 800;">La aplicación para gestionar tus proyectos, organizar tus reportes y aumentar tu productividad</h2>
						<br />
						<h4 style="color: #FFFFFF; text-shadow: 1px 1px 5px #000000;" class="subheader text-justify">Únete y mira por qué aumenta tu productividad y tu eficiencia en el trabajo, una interfaz amigable
						que te encantara.</h4>
						<br />
						<span><a href="#" class="large-5 button radius right" style="margin-top: 15px;" data-reveal-id="register-modal" data-reveal>Inscribete Gratis</a></span>
						<br />
						<p style="color: #FFFFFF; text-shadow: 1px 1px 5px #000000;text-align: left;">Disponible en <a href="#" style="color: #FDE534;">Android</a> y Web. Por ahora!</p>
					</div>
				</div>
				<div class="row app-services-sub">
					<div class="large-10 columns">
						<h2 class="text-center">Gestiona, Colabora y Planifica</h2>
						<h5 class="subheader text-center">Apnote proporciona las herramientas necesarias para cumplir tus objetivos.
						Utiliza la interfaz sencilla para controlarlo todo, desde la generación de los reportes a la autorización.</h5>
					</div>
				</div>
				<div class="row app-services-main" data-equalizer>
					<div class="large-3 columns">
						<div class="panel radius text-center" data-equalizer-watch>
							<span class="icon-services"><i class="fi-clipboard-pencil"></i> <i class="fi-arrow-right"></i> <i class="fi-clipboard-notes"></i></span>
							<p class="text-justify app-info-service">Crea tus reportes apartir de anotaciones y fotografías, en cada uno de los proyectos
							en los que colaboras de una forma mucho más sencilla.</p>
						</div>
					</div>
					<div class="large-4 columns">
						<div class="panel callout radius text-center" data-equalizer-watch>
							<span class="icon-services"><i class="fi-torso-business"></i> <i class="fi-arrow-right"></i> <i class="fi-torsos-all"></i> </span>
							<p class="text-justify app-info-service">Publica tus proyectos y compartelos solo con tu equipo, con esto
							tu equipo de trabajo podrá seleccionar en que proyecto participar, haciendose responsable de culminar el proyecto.</p>
						</div>
					</div>
					<div class="large-3 columns">
						<div class="panel radius" data-equalizer-watch>
							<span class="icon-services"><i class="fi-"></i></span>
							<p class="text-justify app-info-service">Además tendrás las siguientes opciones:</p>
							<p class="text-justify app-info-service">
								<ul class="app-info-service">
									<li>Gestión de tus proyectos.</li>
									<li>Interacción entre los equipos de trabajo.</li>
									<li>Comunicación mediante Mensajes y Comentarios.</li>
								</ul>
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-10 large-centered column">
						<p class="text-center app-span-main">La primer aplicación que mejorará tu productividad en la realización de tus reportes, 
						sin demoras, ni contratiempos, usando la tecnología móvil como principal intermediario. </p>
					</div>
				</div>
			</div>
		</div>
		<!-- End Main body -->
		<!-- Modal of Sign Up -->
			<div id="register-modal" class="reveal-modal tiny" data-reveal>
				<div id="app-wrap-modal">
					<div class="app-modal-header">
						<a href="#" class="app-logotype-reg">Apnote</a>
					</div>
					<div class="row" id="app-error-msg">
						<div class="app-error-data panel radius"></div>
						<div class="row">
							<div class="large-10 column">
								<a href="#" class="close-error-msg button radius large-10">Regresar al Formulario</a>
							</div>
						</div>
					</div>
					<div class="row" id="app-success-msg">
						<div class="app-success panel radius callout">
							<p class="text-center" style="font-weight: 700; color: #707070;">¡Enhorabuena!</p>
							<p class="text-center" style="margin-bottom: -17px; margin-top: -40px;margin-left: 10px;"><i class="fi-checkbox" style="font-size: 70px;color: #88C788;"></i></p>
							<p class="text-center" style="color: #707070;">Tu información ha sido guardada con éxito, te hemos enviado un correo con la información de tu cuenta.</p>
						</div>
						<p class="text-center" style="margin-top: 83px; color: #707070;">Para cualquier información o ayuda, comunícate por email <a href="">support@getapnote.mx</a></p>
					</div>
					<form id="addUsuario" class="app-form">
						<div class="row">
							<div class="large-10 column">
								<i class="fi-torso app-icon-input app-icon-input-reg"></i>
								<input type="text" name="nombre" placeholder="Nombre" />
							</div>
						</div>
						<div class="row">
							<div class="large-10 column">
								<i class="fi-torsos app-icon-input app-icon-input-reg"></i>
								<input type="text" name="username" placeholder="Nombre de Usuario" />
							</div>
						</div>
						<div class="row">
							<div class="large-10 column">
								<i class="fi-mail app-icon-input app-icon-input-reg"></i>
								<input type="email" name="email" placeholder="Correo Electrónico" />
							</div>
						</div>
						<div class="row">
							<div class="large-10 column">
								<i class="fi-lock app-icon-input app-icon-input-reg"></i>
								<input type="password" name="passwr" placeholder="Contraseña" />
							</div>
						</div>
						<div class="row">
							<div class="large-10 column">
								<input type="submit" class="button small radius large-10" value="Registrar" />
							</div>
						</div>
					</form>
					<div class="row" id="app-policy">
						<div class="large-10 column">
							<p class="text-center">Al suscribirte aceptas nuestras <a href="#">Condiciones de Uso</a> y 
							<a href="#">Política de Privacidad</a> </p>
						</div>
					</div>
				</div>
				<a href="#" class="close-reveal-modal">&#215;</a>
			</div>
		<!-- End Modal -->
		<!-- Modal for Information -->
		<div id="modal-information" class="reveal-modal medium" data-reveal>
			<div class="app-modal-header" style="margin: -31px;background: #2E2E2E;">
				<a href="#" class="app-logotype-info">Apnote - Información</a>
			</div>
			<h3 class="text-center subheader" style="padding-top: 40px; border-bottom:1px solid #e3e3e3">Colaboradores</h3>
			<div class="row" style="margin-top: 30px;">
				<div class="large-10 column">
					<div class="row">
						<div class="large-5 columns">
							<div class="row">
								<div class="large-4 columns">
									<img class="th radius" src="<?=base_url('assets/img/1901273.png');?>" />
								</div>
								<div class="large-6 columns">
									<h5>Javier Diaz</h5>
									<h6 class="subheader">Co-Fundador y Developer</h6>
									<span class="app-social-net"><i class="fi-social-facebook"></i> <i class="fi-social-twitter"></i> <i class="fi-social-github"></i> </span>
								</div>
							</div>
						</div>
						<div class="large-5 columns">
							<div class="row">
								<div class="large-4 columns">
									<img class="th radius" src="<?=base_url('assets/img/1609566.jpg');?>" />
								</div>
								<div class="large-6 columns">
									<h5>Daniel Corona</h5>
									<h6 class="subheader">Co-Fundador y Bug Tester</h6>
									<span class="app-social-net"><i class="fi-social-facebook"></i> <i class="fi-social-github"></i> </span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<h3 class="text-center subheader" style="padding-top: 40px; border-bottom:1px solid #e3e3e3">Objetivo del Proyecto</h3>
			<div class="row" style="margin-top: 30px;">
				<div class="large-10 column">
					<p class="text-justify app-obj">Diseñar, desarrollar e implementar una aplicación móvil funcional con la tecnología 
					<span>ANDROID</span> en un dispositivo móvil  inalámbrico, aplicando una <span>Metodología MOBILE-D</span> que nos permita el enviar 
					los informes de avances y desarrollo de una obra de <span>Ingeniería Civil</span> de forma inmediata a una plataforma 
					web mediante conexión WI-FI, teniendo disponibilidad de la información en todo momento y pertinencia de 
					la misma.</p>
				</div>
			</div>
			<a href="#" class="close-reveal-modal">&#215;</a>
		</div>
		<!-- End Modal -->

<?php $this->load->view('footer'); ?>