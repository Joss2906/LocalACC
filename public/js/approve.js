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
			console.log(services_status);

			option = '<option value="">'+label_seleccionar+'</option>';
			option += '<option value="2">'+label_aprobar+'</option>';
			option += '<option value="3">'+label_rechazar+'</option>';

			$.each(res['comunes'], function(index, val) {
				if(val.status_validated == 1){
					validated = '<span class="badge border border-info text-info">Pendiente</span>';
				}

				if(val.status_validated == 2){
					validated = '<span class="badge border border-success text-success">Aprobado</span>';
				}

				if(val.status_validated == 3){
					validated = '<span class="badge border border-danger text-danger">Rechazado</span>';
				}

				disabled = '';

				if(val.status_validated == 2){
					disabled = 'disabled';
				}

				$('.tbody-datos-comunes').append('<tr>'
					+'<td>'+val.service_id+'</td>'
					+'<td>'+val.description+'</td>'
					+'<td>'+val.frequency+'</td>'
					+'<td>'+val.monthly_amount+'</td>'
					+'<td>'+validated+'</td>'
					+'<td>'
					+'<select '+disabled+' class="form-control status_validated" name="status_validated" id="service_status_comunes" onchange="cambiar_status_admin(this.value, '+val.service_id+');">'
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

				if(val.status_validated == 2){
					disabled = 'disabled';
				}

				$('.tbody-datos-hibridos').append('<tr>'
					+'<td>'+val.service_id+'</td>'
					+'<td>'+val.description+'</td>'
					+'<td>'+val.frequency+'</td>'
					+'<td>'+val.monthly_amount+'</td>'
					+'<td>'+validated+'</td>'
					+'<td>'
					+'<select '+disabled+' class="form-control status_validated" name="status_validated" id="service_status_esporadicos" onchange="cambiar_status_admin(this.value, '+val.service_id+');">'
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

				if(val.status_validated == 2){
					disabled = 'disabled';
				}

				$('.tbody-datos-esporadicos').append('<tr>'
					+'<td>'+val.service_id+'</td>'
					+'<td>'+val.description+'</td>'
					+'<td>'+val.frequency+'</td>'
					+'<td>'+val.monthly_amount+'</td>'
					+'<td>'+validated+'</td>'
					+'<td>'
					+'<select '+disabled+' class="form-control status_validated" name="status_validated" id="service_status_hibridos" onchange="cambiar_status_admin(this.value, '+val.service_id+');">'
					+option
					+'</select>'
					+'</td>'
				+'</tr>');
			});

			$('#datatable-comunes').DataTable();
			$('#datatable-hibridos').DataTable();
			$('#datatable-esporadicos').DataTable();
		}
	});
}

function cambiar_status_admin(status_validated, service_id){
	// status_validated = $(obj).val();

	text = '';

	if(status_validated == 3){
		text = label_cambiar_rechazar;
	}

	if(status_validated == 2){
		text = label_cambiar_aprobar;
	}

	var res = confirm(text);

	if (res == true) {
		$.ajax({
			async: true, 
			url: base_url+'/services/cambiar_status_admin',
			type: 'POST',
			dataType: 'JSON',
			data: {service_id: service_id, status_validated: status_validated},
			success: function(res){
				get_servicios();
			}
		});
	}
}
