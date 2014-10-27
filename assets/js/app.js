$(document).ready(function(){

	// Funcion para resetear formularios;
	$.fn.reset = function() {
		$(this).each(function(){ this.reset(); });
	};

	//limit for inputs
	$('#rfc-input').limitar({limite: 13, id_counter: "counter", clase_alert: "alert"});
	$('#user-inputname').limitar({limite: 10, id_counter: "counter", clase_alert: "alert"});
	
	// Nuevo registro de usuarios ;
	$('#addUsuario').submit(function(e){
		e.preventDefault();
		$.post(
			"welcome/registrarUsuario", 
			$(this).serialize(),
			function(data){
				if(data == 1){
					//alert(data);
					$('#addUsuario').animate({'opacity': '0','display': 'none'}, 500);
					$('#app-policy').animate({'opacity': '0', 'display' : 'none'}, 500);
					$('#app-success-msg').delay(300).animate({'opacity': '1', 'display': 'inherit', 'z-index': '9999'}, 500).delay(2000);
					$('#register-modal').delay(5000).foundation('reveal', 'close');
					$('#addUsuario').reset();
					$('#app-success-msg').delay(5000).animate({'opacity': '0', 'display': 'none', 'z-index': '0'}, 500);
					$('#addUsuario').delay(5000).animate({'opacity': '1', 'display': 'inherit'}, 500);
					$('#app-policy').delay(5000).animate({'opacity': '1', 'display': 'inherit'}, 500);
				}else{
					$('.app-error-data').html(data);
					$('#addUsuario').animate({'opacity': '0','display': 'none'}, 500);
					$('#app-policy').animate({'opacity': '0', 'display' : 'none'}, 500);
					$('#app-error-msg').delay(300).animate({'opacity': '1', 'display': 'inherit', 'z-index': '9999'}, 500);
				}
			}
		);
	});

	$('.close-error-msg').click(function(){
		$('#app-error-msg').animate({'opacity': '0', 'display': 'none'}, 500).css('z-index', '0');
		$('#addUsuario').delay(500).animate({'opacity': '1', 'display': 'inherit'}, 500);
		$('#app-policy').animate({'opacity': '1', 'display': 'inherit'}, 500);
	});

	// Inicio de Sesion;
	$('#app-signin').submit(function(e){
		e.preventDefault();
		$.post(
			'welcome/addLogin', 
			$(this).serialize(),
			function(data){
				if(data == 1){
					location.href='dashboard';
				}else {
					setTimeout(function() {
						var notification = new NotificationFx({
							message: '<p style="font-size: 14px;">El Correo eletronico y/o Contraseña son incorrectos.</p>',
							layout: 'growl',
							effect: 'jelly',
							type: 'notice'
						});
						notification.show();
					}, 100);
				}
			}
		);
	});

	$('html').click(function(){
		$('.app-icon-widget').removeClass('app-icon-widget-base');
		$('.app-icon-comment').removeClass('app-icon-widget-base');
	});	

	// Form de Organizaciones - Agregar organización ;
	$('#add-form-org').submit(function(e){
		e.preventDefault();
		var errors;
		$.ajax({
			type: 'POST',
			url: 'organizaciones/addO',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(data) {
				errors = 0;
				console.log(data);
				for(var i=0;i<data.length;i++){
					if(data[i].error === ""){
						$('#'+data[i].campo+' .span-error').html('').removeClass('show').addClass('hide');
					}else{
						$('#'+data[i].campo+' .span-error').html(data[i].error).removeClass('hide').addClass('show');
						errors = errors + 1;
					}
				}

				console.log(errors);

				if(errors === 0){
					$('#app-add-org').foundation('reveal', 'close');
					$('#add-form-org').reset();
					alert('Registro Correcto');
					location.href = 'organizaciones';
				}
			}
		});
	});

	$('.close-error-msg-org').click(function(){
		$('#app-error-msg-org').animate({'opacity': '0', 'display': 'none'}, 500).css('z-index', '0');
		$('#add-form-org').delay(500).animate({'opacity': '1', 'display': 'inherit'}, 500);
		$('.error-title').animate({'opacity': '1', 'display': 'inherit'}, 500);
	});

	$('#reg-user-t').click(function(){
		//$('#add-user-te').fadeIn(500);
		$('#add-user-te').slideToggle('slow');
	});

	$('#cancel-team').click(function(){
		//$('#add-user-te').fadeOut(500);
		$('#add-user-te').slideToggle('slow');

	});

	// Selector de Organizaciones ;
	$('#org-options').change(function(){
		var blue = "";
		var url = "";
		$('#org-options option:selected').each(function(){
			blue += $(this).val()+"";
			if(blue === 0){
				console.log(blue);
			}else{
				url = '/proyectos/selected/'+blue;
				location.href=url;
			}
		});
	});

	$('#btn-open-pro').click(function(){
		$('#panel-form-id').slideToggle('slow');
	});

	//Validaciones de Campos;
	$('#phone-edit').validations('0123456789');
	$('#phone-input').validations('0123456789');

	// Eliminar Organización ;
	$('a#del').click(function(e){
		var value = $(this).attr('value');
		$.ajax({
			url: 'organizaciones/delete/'+value,
			dataType: 'text',
			success: function(data) {
				if(data == 1){
					location.href="organizaciones";
				}else{
					setTimeout(function() {
						var notification = new NotificationFx({
							message: '<p style="font-size: 14px;">La organización contiene Usuarios o Proyectos registrados. No se puede eliminar la organización.</p>',
							layout: 'growl',
							effect: 'slide',
							type: 'notice'
						});
						notification.show();
					}, 100);
				}
			}
		});
		e.preventDefault();
	});

	// Nuevo usuario al equipo de trabajo ;
	$('#add-team-user').submit(function(e){
		e.preventDefault();
		var objective = $(this).attr('value');
		var errors;
		$.ajax({
			type: 'POST',
			url: '/organizaciones/updateUsers/'+objective,
			data: $(this).serialize(),
			dataType: 'json',
			success: function(data){
				errors = 0;
				console.log(data);
				for(var i=0;i<data.length;i++){
					if(data[i].error === ""){
						$('#'+data[i].campo+' .span-error').html('').removeClass('show').addClass('hide');
					}else{
						$('#'+data[i].campo+' .span-error').html(data[i].error).removeClass('hide').addClass('show');
						errors = errors + 1;
					}
				}

				if(errors === 0){
						$('#add-user-te').slideToggle('slow');
						$('#add-team-user').reset();
						setTimeout(function() {
						var notification = new NotificationFx({
							message: '<p style="font-size: 14px;">Nuevo usuario agregado al equipo de trabajo.</p>',
							layout: 'growl',
							effect: 'slide',
							type: 'notice',
							onClose: function(){
								setTimeout(function(){
									location.href="/organizaciones/team/"+objective;
								}, 200);
							}
						});
						notification.show();
						}, 100);
					}
			}
		});
	});

	// Profile change hover profile picture;
	$('#th-profile').mouseenter(function(){
		$('#th-profile a').fadeIn(250);
	}).mouseleave(function(){
		$('#th-profile a').fadeOut(250);
	});

	// Profile edit profile change attr;
	var n = 0;
	$('#edit-profile').click(function(){
		if(n===0){
			$('.group-profile-info input').removeAttr('disabled');
			$(this).html('<i class="fi-x" style="position: absolute; top: 5px; left: 10px; font-size: 20px;"></i>  Cancelar');
			$('#save-profile').fadeIn(200);
			n++;
		}else{
			$('.group-profile-info input').prop('disabled', true);
			$(this).html('<i class="fi-page-edit" style="position: absolute; top: 5px; left: 25px; font-size: 20px;"></i> Editar');
			$('#save-profile').fadeOut(200);
			setTimeout(function(){location.href="profile";}, 200);
			n = 0;
		}
	});

	//Profile edit;
	$('#save-profile').click(function(e){
		e.preventDefault();
		var errors;
		$.ajax({
			type: 'POST',
			url: '/profile/actualizar',
			data: $('#sv-profile').serialize(),
			dataType: 'json',
			success: function(data){
				errors = 0;
				console.log(data);
				for(var i=0;i<data.length;i++){
					if(data[i].error === ""){
						$('#'+data[i].campo+' .span-error').html('').removeClass('show').addClass('hide');
					}else{
						$('#'+data[i].campo+' .span-error').html(data[i].error).removeClass('hide').addClass('show');
						errors = errors + 1;
					}
				}

					if(errors === 0){
						setTimeout(function() {
						var notification = new NotificationFx({
							message: '<p style="font-size: 14px;">Cambios realizados correctamente. Espere un momento, se volvera a cargar la pagina.</p>',
							layout: 'growl',
							effect: 'slide',
							type: 'notice',
							onClose: function(){
								setTimeout(function(){
									location.href="profile";
								}, 200);
							}
						});
						notification.show();
						}, 100);
					}

			}
		});
	});

	//Category add to profile;
	$('#add-category').submit(function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST', 
			url: '/profile/category',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(data){
				$('#dynitem').before('<button class="button radius small disabled" id="procat">'+data.nombre+'</button>');
				$('#addcategory').foundation('reveal','close');
				setTimeout(function() {
					var notification = new NotificationFx({
						message: '<p style="font-size: 14px;">Cambios realizados correctamente. Espere un momento, se volvera a cargar la pagina.</p>',
						layout: 'growl',
						effect: 'slide',
						type: 'notice',
						onClose: function(){
							setTimeout(function(){
								location.href="profile";
							}, 200);
						}
					});
					notification.show();
				}, 100);
			}
		});
	});

	//Upload file to profile picture;
	$('#uploadfile').on('click',function(e){
		e.preventDefault();
		$('#userfile').click();
	});

	$('input[type=file]').change(function(){
		var file = (this.files[0].name).toString();
		var reader = new FileReader();

		reader.onload = function(e){
			$('#preview').attr('src', e.target.result);
		};

		reader.readAsDataURL(this.files[0]);
		$('#save-pp').fadeIn();

	});

	// Obtiene responsables dependiendo la categoría 
	// seleccionada.
	$('#cat').change(function(e){
		e.preventDefault();
		var id = document.getElementById('agregarProy');
		var com = id.getAttribute('data-company');
		var category = "";
		$('#new .newop').remove();
		$('#cat option:selected').each(function(){
			category = $(this).val();
			$.ajax({
				url: '/proyectos/obtenerResponsables/'+category+'/'+com,
				dataType: 'json',
				success: function(data){
					console.log(data);
					for(var i = 0; i < data.length ; i++){
						$('#new').append('<option class="newop" value="'+data[i].u_email+'">'+data[i].u_nombre+' '+data[i].u_apep+' '+data[i].u_apem+'</option>');
					}
				}
			});
		});
	});

	// Registro de nuevo proyecto ;
	$('#agregarProy').submit(function(e){
		var id = document.getElementById('agregarProy');
		var com = id.getAttribute('data-company');
		var errors;
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '/proyectos/agregarProyecto/'+com,
			data: $(this).serialize(),
			dataType: 'json',
			success: function(data){
				errors = 0;
				console.log(data);
				for(var i=0;i<data.length;i++){
					if(data[i].error === ""){
						$('#'+data[i].campo+' .span-error').html('').removeClass('show').addClass('hide');
					}else{
						$('#'+data[i].campo+' .span-error').html(data[i].error).removeClass('hide').addClass('show');
						errors = errors + 1;
					}
				}

					if(errors === 0){
						$('#panel-form-id').slideToggle('slow');
						setTimeout(function() {
						var notification = new NotificationFx({
							message: '<p style="font-size: 14px;">Cambios realizados correctamente. Espere un momento, se volvera a cargar la pagina.</p>',
							layout: 'growl',
							effect: 'slide',
							type: 'notice',
							onClose: function(){
								setTimeout(function(){
									location.href="/proyectos/selected/"+com;
								}, 200);
							}
						});
						notification.show();
						}, 100);
					}

			}
		});
	});

	// Agregar Nueva Categoria
	$('#new-category').submit(function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '/proyectos/agregarCategoria',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data.error == '1'){
					$('#'+data.campo+' .span-error').html(data.msg).addClass('show').removeClass('hide');
				}else{
					$('#'+data.campo+' span').addClass('hide').removeClass('show');
					$('#add-user-te').slideToggle('slow');
					setTimeout(function() {
						var notification = new NotificationFx({
							message: '<p style="font-size: 14px;">Categoria agregada correctamente. Espere un momento.</p>',
							layout: 'growl',
							effect: 'slide',
							type: 'notice',
							onClose: function(){
								setTimeout(function(){
									location.href="/proyectos/categorias/";
								}, 200);
							}
						});
						notification.show();
						}, 100);
				}
			}
		});
	});

	// Agregar nueva tarea a un proyecto;
	$('#form-activity').submit(function(e){
		e.preventDefault();
		var data = document.getElementById('form-activity');
		var proid = data.getAttribute('data-id-proyecto');
		var activity = $('#txt-task').val();
		console.log(proid+' '+activity);
		$.ajax({
			url: '/proyectos/agregarTarea',
			dataType: 'json',
			type: 'POST',
			data: {tarea: activity, proyid: proid},
			success: function(response){
			console.log(response);
			}
		});
	});

});