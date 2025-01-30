$(document).ready(function() {
	$('#datatable').DataTable();

	$('.date_service').datetimepicker({
		timepicker:true,
		format:'Y-m-d H:i:s',
	});

    $(".form-datos").on("submit", function(e) {
    	// $('.btn-form').prop('disabled', true);
    	e.preventDefault();
    	$.ajax({
    		url: base_url+'/providers/form_datos',
    		type: 'POST',
    		dataType: 'JSON',
			data: $('.form-datos').serialize(),
			success: function(res){
				$('.alert-text-exito').html(res);
				$('.alert-success').show();
				setTimeout(function(){ window.location.replace(base_url+'/providers'); }, 2000);
			}
    	});
    });

    if($('.organization_id option:selected').val() != ''){
    	get_empleados_organizacion();
    }
});

function validar_form(){
	$.ajax({
		url: base_url+'/providers/validar_form',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			if(res.status == 'ERROR'){
				$('.alert-text-error').html(res.message);
				$('.alert-danger').show();
				setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
			}

			if(res.status == 'OK'){
                $('.form-datos').submit();
			}
		}
	});
}

function eliminar_datos(service_provider_id){
	var res = confirm(label_eliminar);

	if (res == true) {
		$.ajax({
			async: true, 
			url: base_url+'/providers/eliminar_datos',
			type: 'POST',
			dataType: 'JSON',
			data: {service_provider_id: service_provider_id},
			success: function(res){
				location.reload();
			}
		});
	}
}

function get_empleados_organizacion(){
	$('.user_id option').remove();
	$('.service_id option').remove();

	$.ajax({
		url: base_url+'/providers/get_empleados_organizacion',
		type: 'POST',
		dataType: 'JSON',
		data: {organization_id: $('.organization_id option:selected').val()},
		success: function(res){
			$('.user_id').append('<option value="">'+label_seleccionar+'</option>');
			$.each(res['employees'], function(index, val) {
				selected = '';
				if($('.user_provider_id').val() == val['user_id']){
					selected = 'selected';
				}

				$('.user_id').append('<option '+selected+' value="'+val['user_id']+'">'+val['first_name']+' '+val['second_name']+' '+val['last_name']+' '+val['second_last_name']+'</option>');
			});

    		organization_employees = '<option value="">'+label_seleccionar+'</option>'

			$.each(res['organization_employees'], function(index, val) {
				organization_employees += '<option value="'+val['user_id']+'">'+val['first_name']+' '+val['second_name']+' '+val['last_name']+' '+val['second_last_name']+'</option>';
			});

    		get_servicio_empleados();

		}
	});
}

function get_servicio_empleados(){
	$('.service_id option').remove();

	$.ajax({
		url: base_url+'/providers/get_servicio_empleados',
		type: 'POST',
		dataType: 'JSON',
		data: {user_id: $('.user_id option:selected').val(), service_id: $('.service_id_provider_id').val()},
		success: function(res){
			$('.service_id').append('<option value="">'+label_seleccionar+'</option>');

			$.each(res, function(index, val) {
				selected = '';

				if($('.service_id_provider_id').val() == val['service_id']){
					selected = 'selected';
				}

				$('.service_id').append('<option '+selected+' value="'+val['service_id']+'">'+val['description']+'</option>');
			});
		}
	});
}

function add_supplies(){
	s = 0;

	if($('.div-suministro').length > 0){
		s = $('.div-suministro').length;
	}

	$('.div-suministros').append('<div class="div-suministro row s-'+s+'" style="margin-top: 20px;">'
		+'<div class="col-md-3" style="border: 1px #dee2e6 solid; padding-bottom: 10px;">'
			+'<input type="hidden" class="form-control supply_id" name="supplies['+s+'][supply_id]" value="0">'
			+'<label>'+label_tipo_suministro+'</label>'
			+'<select class="form-control type_supply_id" name="supplies['+s+'][type_supply_id]">'
			+option
			+'</select>'
		+'</div>'
		+'<div class="col-md-7" style="border: 1px #dee2e6 solid; padding-bottom: 10px;">'
			+'<label>'+label_suministro+'</label>'
			+'<input type="text" class="form-control supply" name="supplies['+s+'][supply]" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)">'
		+'</div>'
		+'<div class="col-md-2" style="border: 1px #dee2e6 solid; padding-bottom: 10px;">'
			+'<div class="col-md-12"><label>'+label_acciones+'</label></div>'
        	+'<div class="btn-group" role="group">'
           	+'<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+label_desplegar+'</button>'
           	+'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">'
				+'<a class="dropdown-item text-success"  href="javascript:void(0);" onclick="add_provider(this, '+s+', 0);">'
				+'<i class="fa fa-plus-circle" aria-hidden="true"></i> '+label_agregar_proveedor
				+'</a>'
				+'<a class="dropdown-item text-danger" href="javascript:void(0);" onclick="delete_supply(this, 0);">'
				+'<i class="fa fa-trash-o" aria-hidden="true"></i> '+label_eliminar_button
				+'</a>'
           	+'</div>'
        +'</div>'
		+'</div>'
		+'<div class="col-md-12 div-proveedores"></div>'
	+'</div>');
}

function add_provider(obj, num, supply_id){
	p = 0;

	if($('.s-'+num).find('.div-proveedor').length > 0){
		p = $('.s-'+num).find('.div-proveedor').length;
	}

	$(obj).closest('.div-suministro').find('.div-proveedores').append('<div class="div-proveedor row p-'+p+'">'
		+'<div class="col-md-3" style="border: 1px #dee2e6 solid; padding-bottom: 10px;">'
			+'<input type="hidden" class="form-control provider_id " name="supplies['+num+'][providers]['+p+'][provider_id]" value="0">'
			+'<label>'+label_proveedor+'</label>'
			+'<select class="form-control user_id" name="supplies['+num+'][providers]['+p+'][user_id]">'
			+organization_employees
			+'</select>'
		+'</div>'
		+'<div class="col-md-2" style="border: 1px #dee2e6 solid; padding-bottom: 10px;">'
			+'<label>'+label_productividad+'</label><br>'
			+'<textarea row="8" maxlength="999" class="productivity" name="supplies['+num+'][providers]['+p+'][productivity]"></textarea>'
		+'</div>'
		+'<div class="col-md-2" style="border: 1px #dee2e6 solid; padding-bottom: 10px;">'
			+'<label>'+label_calidad+'</label><br>'
			+'<textarea row="8" maxlength="999" class="quality" name="supplies['+num+'][providers]['+p+'][quality]"></textarea>'
		+'</div>'
		+'<div class="col-md-2" style="border: 1px #dee2e6 solid; padding-bottom: 10px;">'
			+'<label>'+label_innovacion+'</label><br>'
			+'<textarea row="8" maxlength="999" class="innovation" name="supplies['+num+'][providers]['+p+'][innovation]"></textarea>'
		+'</div>'
		+'<div class="col-md-2" style="border: 1px #dee2e6 solid; padding-bottom: 10px;">'
			+'<label>'+label_servicio+'</label><br>'
			+'<textarea row="8" maxlength="999" class="service" name="supplies['+num+'][providers]['+p+'][service]"></textarea>'
		+'</div>'
		+'<div class="col-md-1" style="border: 1px #dee2e6 solid; padding-bottom: 10px;">'
			+'<br><br>'
			+'<a class="dropdown-item text-danger" href="javascript:void(0);" onclick="delete_provider(this, 0);">'
			+'<i class="fa fa-trash-o" aria-hidden="true"></i>'
			+'</a>'
		+'</div>'
	+'</div>');
}

function delete_supply(obj, supply_id){
	$.ajax({
		url: base_url+'/providers/delete_supply',
		type: 'POST',
		dataType: 'JSON',
		data: {supply_id: supply_id},
		success: function(res){
			$(obj).closest('.div-suministro').remove();
		}
	});	
}

function delete_provider(obj, provider_id){
	$.ajax({
		url: base_url+'/providers/delete_provider',
		type: 'POST',
		dataType: 'JSON',
		data: {provider_id: provider_id},
		success: function(res){
			$(obj).closest('.div-proveedor').remove();
		}
	});
}

function details_delete_supply(supply_id){
	$.ajax({
		url: base_url+'/providers/delete_supply',
		type: 'POST',
		dataType: 'JSON',
		data: {supply_id: supply_id},
		success: function(res){
			location.reload();
		}
	});	
}

function details_delete_provider(provider_id){
	$.ajax({
		url: base_url+'/providers/delete_provider',
		type: 'POST',
		dataType: 'JSON',
		data: {provider_id: provider_id},
		success: function(res){
			location.reload();
		}
	});
}
