(function($){
	$.fn.limitar = function(options) {
		defaults = {
			limite: 200, 
			id_counter: false,
			clole_alert: false
		}
		var options = $.extend(defaults, options);
		return this.each(function(){
			var caracteres = options.limite;
			if(options.id_counter != false){
				$('#'+options.id_counter).html(''+caracteres+'');
			}
			$(this).keyup(function(){
				if($(this).val().length > caracteres){
					$(this).val($(this).val().substr(0, caracteres));
				}
				if(options.id_counter != false){
					var quedan = caracteres - $(this).val().length;
					$('#'+options.id_counter).html(''+quedan+'');
					if(quedan === 0){
						$('#'+options.id_counter).removeClass('success').addClass('alert');
					}else{
						$('#'+options.id_counter).removeClass('alert').addClass('success');
					}
				}
			});
		});
	}
})(jQuery);