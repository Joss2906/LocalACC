$(document).ready(function() {
	// $('#datatable-asignar').DataTable();
	// $('#datatable-comunes').DataTable();
	// $('#datatable-hibridos').DataTable();
	// $('#datatable-esporadicos').DataTable();

    $(".form-datos").on("submit", function(e) {
    	$('.btn-form').prop('disabled', true);
    	e.preventDefault();
    	$.ajax({
    		url: base_url+'/services/form_datos',
    		type: 'POST',
    		dataType: 'JSON',
			data: $('.form-datos').serialize(),
			success: function(res){
				$('.alert-text-exito').html(res);
				$('.alert-success').show();
				setTimeout(function(){ window.location.replace(base_url+'/services'); }, 2000);
			}
    	});
    });

    get_empleados();

});

function validar_form(){
	$.ajax({
		url: base_url+'/services/validar_form',
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

function get_empleados(){
	$('.user_id option').remove();

	$.ajax({
		url: base_url+'/services/get_empleados',
		type: 'POST',
		dataType: 'JSON',
		data: {organization_id: $('.organization_id option:selected').val()},
		success: function(res){
			$('.user_id').append('<option value="">'+label_seleccionar+'</option>');

			$.each(res, function(index, val) {
				$('.user_id').append('<option data-user_id="'+val['user_id']+'" data-user="'+val['first_name']+' '+val['second_name']+' '+val['last_name']+' '+val['second_last_name']+'" data-position="'+val.position+'" data-position_id="'+val.position_id+'" value="'+val['user_id']+'">'+val['first_name']+' '+val['second_name']+' '+val['last_name']+' '+val['second_last_name']+'</option>');
			});
		}
	});
}

function get_servicios(){
	$('.tbody-datos-asignar tr').remove();
	$('.tbody-datos-comunes tr').remove();
	$('.tbody-datos-esporadicos tr').remove();
	$('.tbody-datos-hibridos tr').remove();

	$.ajax({
		url: base_url+'/services/get_servicios',
		type: 'POST',
		dataType: 'JSON',
		data: {user_id: $('.user_id option:selected').val()},
		success: function(res){
			$.each(res['asignar'], function(index, val) {
				if(val.status_validated == 1){
					validated = '<span class="badge border border-info text-info">'+label_pendiente+'</span>';
				}

				if(val.status_validated == 2){
					validated = '<span class="badge border border-success text-success">'+label_aprobado+'</span>';
				}

				if(val.status_validated == 3){
					validated = '<span class="badge border border-danger text-danger">'+label_rechazado+'</span>';
				}

				option = '';

				$.each(services_status, function(index, val) {
					if(val.status == 'Sin clasificar'){
						val.status = label_sin_clasificar;
					}
					if(val.status == 'Común'){
						val.status = label_comun;
					}
					if(val.status == 'Híbrido'){
						val.status = label_hibrido;
					}
					if(val.status == 'Esporádico'){
						val.status = label_esporadico;
					}
					console.log(val.status);
					option += '<option value="'+val.service_status_id+'">'+val.status+'</option>';
				});

				$('.tbody-datos-asignar').append('<tr>'
					+'<td>'+val.service_id+'</td>'
					+'<td>'+val.description+'</td>'
					+'<td>'+val.frequency+'</td>'
					+'<td>'+val.monthly_amount+'</td>'
					+'<td>'+validated+'</td>'
					+'<td>'
					+'<select class="form-control service_status_id" name="service_status_id" id="service_status_asignar" onchange="cambiar_status(this.value, '+val.service_id+');">'
					+option
					+'</select>'
					+'</td>'
				+'</tr>');
			});

			$.each(res['comunes'], function(index, val) {
				if(val.status_validated == 1){
					validated = '<span class="badge border border-info text-info">'+label_pendiente+'</span>';
				}

				if(val.status_validated == 2){
					validated = '<span class="badge border border-success text-success">'+label_aprobado+'</span>';
				}

				if(val.status_validated == 3){
					validated = '<span class="badge border border-danger text-danger">'+label_rechazado+'</span>';
				}

				disabled = '';

				if(val.status_validated == 1 || val.status_validated == 2){
					disabled = 'disabled';
				}

				option = '';

				$.each(services_status, function(index, val) {
					if(val.status == 'Sin clasificar'){
						val.status = label_sin_clasificar;
					}
					if(val.status == 'Común'){
						val.status = label_comun;
					}
					if(val.status == 'Híbrido'){
						val.status = label_hibrido;
					}
					if(val.status == 'Esporádico'){
						val.status = label_esporadico;
					}
					console.log(val.status);
					if(val.service_status_id == 2){ selected = 'selected'; }else{ selected = ''; }
					option += '<option '+selected+' value="'+val.service_status_id+'">'+val.status+'</option>';
				});

				$('.tbody-datos-comunes').append('<tr>'
					+'<td>'+val.service_id+'</td>'
					+'<td>'+val.description+'</td>'
					+'<td>'+val.frequency+'</td>'
					+'<td>'+val.monthly_amount+'</td>'
					+'<td>'+validated+'</td>'
					+'<td>'
					+'<select '+disabled+' class="form-control service_status_id" name="service_status_id" id="service_status_comunes" onchange="cambiar_status(this.value, '+val.service_id+');">'
					+option
					+'</select>'
					+'</td>'
				+'</tr>');
			});

			$.each(res['hibridos'], function(index, val) {
				if(val.status_validated == 1){
					validated = '<span class="badge border border-info text-info">'+label_pendiente+'</span>';
				}

				if(val.status_validated == 2){
					validated = '<span class="badge border border-success text-success">'+label_aprobado+'</span>';
				}

				if(val.status_validated == 3){
					validated = '<span class="badge border border-danger text-danger">'+label_rechazado+'</span>';
				}

				disabled = '';

				if(val.status_validated == 1 || val.status_validated == 2){
					disabled = 'disabled';
				}

				option = '';

				$.each(services_status, function(index, val) {
					if(val.status == 'Sin clasificar'){
						val.status = label_sin_clasificar;
					}
					if(val.status == 'Común'){
						val.status = label_comun;
					}
					if(val.status == 'Híbrido'){
						val.status = label_hibrido;
					}
					if(val.status == 'Esporádico'){
						val.status = label_esporadico;
					}

					if(val.service_status_id == 3){ selected = 'selected'; }else{ selected = ''; }
					option += '<option '+selected+' value="'+val.service_status_id+'">'+val.status+'</option>';
				});

				$('.tbody-datos-hibridos').append('<tr>'
					+'<td>'+val.service_id+'</td>'
					+'<td>'+val.description+'</td>'
					+'<td>'+val.frequency+'</td>'
					+'<td>'+val.monthly_amount+'</td>'
					+'<td>'+validated+'</td>'
					+'<td>'
					+'<select '+disabled+' class="form-control service_status_id" name="service_status_id" id="service_status_esporadicos" onchange="cambiar_status(this.value, '+val.service_id+');">'
					+option
					+'</select>'
					+'</td>'
				+'</tr>');
			});

			$.each(res['esporadicos'], function(index, val) {
				if(val.status_validated == 1){
					validated = '<span class="badge border border-info text-info">'+label_pendiente+'</span>';
				}

				if(val.status_validated == 2){
					validated = '<span class="badge border border-success text-success">'+label_aprobado+'</span>';
				}

				if(val.status_validated == 3){
					validated = '<span class="badge border border-danger text-danger">'+label_rechazado+'</span>';
				}

				disabled = '';

				if(val.status_validated == 1 || val.status_validated == 2){
					disabled = 'disabled';
				}

				option = '';

				$.each(services_status, function(index, val) {
					if(val.status == 'Sin clasificar'){
						val.status = label_sin_clasificar;
					}
					if(val.status == 'Común'){
						val.status = label_comun;
					}
					if(val.status == 'Híbrido'){
						val.status = label_hibrido;
					}
					if(val.status == 'Esporádico'){
						val.status = label_esporadico;
					}
					console.log(val.status);
					if(val.service_status_id == 4){ selected = 'selected'; }else{ selected = ''; }
					option += '<option '+selected+' value="'+val.service_status_id+'">'+val.status+'</option>';
				});

				$('.tbody-datos-esporadicos').append('<tr>'
					+'<td>'+val.service_id+'</td>'
					+'<td>'+val.description+'</td>'
					+'<td>'+val.frequency+'</td>'
					+'<td>'+val.monthly_amount+'</td>'
					+'<td>'+validated+'</td>'
					+'<td>'
					+'<select '+disabled+' class="form-control service_status_id" name="service_status_id" id="service_status_hibridos" onchange="cambiar_status(this.value, '+val.service_id+');">'
					+option
					+'</select>'
					+'</td>'
				+'</tr>');
			});

			$('#datatable-asignar').DataTable();
			$('#datatable-comunes').DataTable();
			$('#datatable-hibridos').DataTable();
			$('#datatable-esporadicos').DataTable();
		}
	});
}

function cambiar_status(service_status_id, service_id){
	// service_status_id = $(obj+' option:selected').val();

	var res = confirm(label_cambiar_estatus);

	if (res == true) {
		$.ajax({
			async: true, 
			url: base_url+'/services/cambiar_status',
			type: 'POST',
			dataType: 'JSON',
			data: {service_id: service_id, service_status_id: service_status_id},
			success: function(res){
				get_servicios();
			}
		});
	}
}
