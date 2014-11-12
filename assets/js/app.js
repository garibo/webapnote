$(document).ready(function() {

	/*Funcion para resetear formularios;*/
	$.fn.reset = function() {
		$(this).each(function() { this.reset(); });
	};

	//limit for inputs
	$('#rfc-input').limitar({limite: 13, id_counter: 'counter', clase_alert: 'alert'});
	$('#user-inputname').limitar({limite: 10, id_counter: "counter", clase_alert: "alert"});
	
	/*Nuevo registro de usuarios;*/
	$('#addUsuario').submit(function(e) {
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

	/*************************************************************************
	 * @return 				Esta función retorna una alerta al realizar un inicio
	 *								de sesión de forma satisfactoria.
	 * @author				Javier Diaz Chamorro
	 * @modify				30102014
	 ************************************************************************/
	$('#app-signin').submit(function(e){
		e.preventDefault();
		$.post(
			'welcome/addLogin', 
			$(this).serialize(),
			function(data){
				if(data == 1){
					location.href='dashboard';
				}else {
					swal("Error", "Correo Electrónico y/o Contraseña incorrectos", "error");
				}
			}
		);
	});

	$('html').click(function(){
		$('.app-icon-widget').removeClass('app-icon-widget-base');
		$('.app-icon-comment').removeClass('app-icon-widget-base');
	});	

	/*************************************************
	* @author 	Javier Diaz
	* @return 	Retorna el resultado de agregar nueva
	*						Organización
	*************************************************/
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
					$('#add-form-org').reset();
					var fila = $('<tr/>');
					$.each(data[0].datos, function(key, value){
						$('<td/>', {
							text: value
						}).appendTo(fila);
					});
					$('<td/>',{html: '<a href="/organizaciones/team/'+data[0].datos.arfc+'"><i class="fi-torsos-all"></i></a>'}).css('text-align','center').css('font-size','20px').appendTo(fila);
					$('<td/>', {html: '<a href="#" id="del" value="'+data[0].datos.arfc+'" class="btn-delete"><i class="fi-trash"></i></a> <a href="/organizaciones/edit/'+data[0].datos.arfc+'"><i class="fi-pencil"></i></a>'}).css('text-align', 'center').css('font-size', '20px').appendTo(fila);
					fila.appendTo('#records-org');
					swal({
						title: 'Good Job',
						type: 'success',
						text: 'Organización agregada correctamente',
						showCancelButton: false, 
						confirmButtonText: 'Ok',
						closeOnConfirm: true
					}, function(){
						$('#app-add-org').foundation('reveal', 'close');
					});
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

	/****************************************************************
	* @return 		Retorna la confirmación, sobre la eliminación
	* 						de una organización, además aviso de si se puede
	* 						eliminar o no.
	* @author			Javier Díaz Chamorro
	* @modify			29102014
	*****************************************************************/
	$('#records-org').on('click', 'a#del', function(){
		var value = $(this).attr('value');
		var element = $(this);
		swal({
			title: 'Estas seguro?',
			text: 'Una vez eliminado, ya no podrás recuperarlo.',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: "Si, Eliminar",
			cancelButtonText: "Cancelar",
			closeOnConfirm: false,
		},function(){
			$.ajax({
				url: 'organizaciones/delete/'+value,
				dataType: 'text',
				success: function(data) {
					if(data == 1){
						$(element).parent('td').parent('tr').remove();
						swal("Buen Trabajo!", "Organización eliminada correctamente", "success");
					}else{
						swal('Lo siento', 'No se puede eliminar la organización', 'error');
					}
				}
			});
		});
		
	});

	/****************************************************************
	* @return 		Retorna la confirmación sobre el registro de usuario
	*							previamente solicitado, o errores que conforman, el
	*							formulario de envio de los datos.
	* @author			Javier Díaz Chamorro
	* @modify			30s102014
	*****************************************************************/
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
						var fila = $('<tr/>');
						$.each(data[0].datos, function(key, value){
							$('<td/>', {
								text: value
							}).appendTo(fila);
						});
						$('<td/>',{html: '<a href="#" id="del" data-user="'+data[0].datos.ausername+'" data-email="'+data[0].datos.eemail+'" data-org="'+data[0].rfc+'" class="btn-delete"><i class="fi-trash"></i></a><a href="/organizaciones/profileTeam/'+data[0].datos.ausername+'"data-reveal-id="modal-demo" data-reveal-ajax="true"><i class="fi-torso"></i></a>'}).css('text-align','center').css('font-size','20px').appendTo(fila);
						fila.appendTo('#body-org');
						swal("Buen Trabajo!", "Usuario agregado correctamente", "success");
					}
			}
		});
	});

	/*******************************************
	* Eliminación de usuarios de una organización
	* desde el boton de eliminar;
	*******************************************/
	$('#body-org').on('click', 'a#del', function(){
		var org = $(this).data('org');
		var usr = $(this).data('user');
		var mail = $(this).data('email');
		var element = $(this);
		swal({
			title: 'Estas seguro?',
			text: 'Una vez eliminado ya no podras recuperarlo.',
			type: 'warning',
			showCancelButton: true, 
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Si, Eliminar',
			closeOnConfirm: false,
			closeOnCancel: true
		},function(){
			$.ajax({
				url: '/organizaciones/deleteTUser/'+usr+'/'+org,
				type: 'POST',
				data: {email: mail},
				dataType: 'json',
				success: function(data){
					console.log(data);
					if(data.value === 1){
						$(element).parent('td').parent('tr').remove();
						swal("Buen Trabajo!", "Usuario eliminado correctamente", "success");
					}else{
						swal("Lo siento!", "No se puede eliminar este usuario, tiene proyectos asignados.", "error");
					}
				}
			});
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

	/************************************
	* Registro de nuevo proyecto a la organización.
	************************************/
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
						$('#agregarProy').reset();
						var fila = $('<li/>');
						var chtml = '<div id="block-item"><div class="swatch-preview swatch-preview-c"></div><h6 class="text-right title">'+data[0].datos.nombre+'</h6><hr /><div class="info-tasks"><p><b>Sin Tareas</b></p><p><span>'+data[0].datos.fecha+'</span></p></div><div class="opciones"><p><a href="#" id="getParent" data-id="'+data[0].datos.proyid+'" class="btn-delete btn-absolute"><i style="font-size: 18px !important;padding: 10px !important;" class="fi-x"></i></a> <a href="/proyectos/view/'+data[0].datos.proyid+'/'+com+'"><i class="fi-eye"></i></a></p></div></div>';
						$(chtml).appendTo(fila);
						fila.appendTo('#body-projects');
						swal("Buen Trabajo!", "Proyecto agregado correctamente", "success");
					}

			}
		});
	});

	/******************************************
	 * Eliminación de un proyecto por id.
	 *****************************************/
	 $('ul.list-projects').on('click', 'a#getParent', function(e){
	 	e.preventDefault();
	 	var proyid = $(this).data('id');
	 	var element = $(this);
	 	swal({
	 		title: 'Estas seguro?',
	 		text: 'Una vez eliminado, no podrás recuperarlo.',
	 		type: 'warning',
	 		showCancelButton: true,
	 		confirmButtonColor: '#DD6B55',
	 		confirmButtonText: 'Si, Eliminar',
	 		closeOnConfirm: false,
	 		closeOnCancel: true
	 	}, function(){
	 		$.ajax({
	 			url: '/proyectos/delete/'+proyid,
	 			dataType: 'text',
	 			success: function(data){
	 				if(data === '1'){
	 					$(element).parent('p').parent('div').parent('div').parent('li').remove();
	 					swal("Muy bien!", "Proyecto eliminado correctamente.", "success");
	 				}else {
	 					swal("Lo siento!", "Este proyecto no puede ser eliminado.", "error");
	 				}
	 			}
	 		});
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

	$('#sub-side-nav').toggle();

	$('#proyectosli').click(function(e){
		if($('#sub-side-nav').hasClass('open')){
			//Esta Abierto
			$('#icon-toggle-icon').css('transform', 'rotate(360deg)');
			$('#sub-side-nav').removeClass('open');
			$('#sub-side-nav').slideToggle();
		}else{
			//Esta Cerrado
			$('#sub-side-nav').addClass('open');
			$('#icon-toggle-icon').css('transform', 'rotate(90deg)');
			$('#sub-side-nav').slideToggle();
		}
		e.preventDefault();
	});

	$('#sub-side-nav li').on('mouseover', function(e){
		var hijos = $(e.target).children();
		hijos.css('color', '#C72626');
		e.preventDefault();
	});

	$('#sub-side-nav li').on('mouseleave', function(e){
		var hijos = $(e.target).children();
		hijos.css('color', '#909090');
		e.preventDefault();
	});

	$('#completesIcon').on('click', function(e){
		$('#body-projects').slideUp(200);
		$('#proyectscompletes').slideDown(200);
		e.preventDefault();
	});

	$('#pendientesIcon').on('click', function(e){
		$('#proyectscompletes').slideUp(200);
		$('#body-projects').slideDown(200);
		e.preventDefault();
	});

});