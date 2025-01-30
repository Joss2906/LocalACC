$(document).ready(function() {
	$('#datatable').DataTable();

	$('.delivery_date').datetimepicker({
		minDate: 0,
		// minTime: 0,
		timepicker:true,
		format:'Y-m-d H:i:s',
	});

	$('.delivery_date_past').datetimepicker({
		maxDate: 0,
		// minTime: 0,
		timepicker:true,
		format:'Y-m-d H:i:s',
	});

    $(".form-datos").on("submit", function(e) {
    	$('.btn-form').prop('disabled', true);
    	e.preventDefault();
    	$.ajax({
    		url: base_url+'/tasks/form_datos',
    		type: 'POST',
    		dataType: 'JSON',
			data: $('.form-datos').serialize(),
			success: function(res){
				$('.alert-text-exito').html(res);
				$('.alert-success').show();
				if($('.my_productivity').val() == 0){
					setTimeout(function(){ window.location.replace(base_url+'/tasks'); }, 2000);
				}else{
					setTimeout(function(){ window.location.replace(base_url+'/tasks/register_view'); }, 2000);
				}
			}
    	});
    });
});

function validar_form(){
	$.ajax({
		url: base_url+'/tasks/validar_form',
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

function eliminar_datos(task_id){
	var res = confirm(label_eliminar);

	if (res == true) {
		$.ajax({
			async: true, 
			url: base_url+'/tasks/eliminar_datos',
			type: 'POST',
			dataType: 'JSON',
			data: {task_id: task_id},
			success: function(res){
				location.reload();
			}
		});
	}
}

function get_services(){
	$('.service_id option').remove();

	$.ajax({
		url: base_url+'/tasks/get_services',
		type: 'POST',
		dataType: 'JSON',
		data: {user_id: $('.user_id option:selected').val(), position_id: $('.user_id option:selected').data('position')},
		success: function(res){
			$('.service_id').append('<option value="">'+label_seleccionar+'</option>');
			$.each(res, function(index, val) {
				$('.service_id').append('<option value="'+val['service_id']+'">'+val['description']+'</option>');
			});	

			$('.service_id option[value='+$('.service').val()+']').prop('selected', true);
		}
	});
}

function cambiar_status(task_id, status_id, user_id, created_by){
	var res = confirm(label_cambiar_estatus);

	if (res == true) {
		$.ajax({
			async: true, 
			url: base_url+'/tasks/cambiar_status',
			type: 'POST',
			dataType: 'JSON',
			data: {task_id: task_id, status_id: status_id, user_id: user_id, created_by: created_by},
			success: function(res){
				location.reload();
			}
		});
	}	
}

function modal_finalizar(task_id, status_id, user_id, created_by){
	$('.task_id').val(task_id);
	$('.user_id').val(user_id);
	$('.created_by').val(created_by);
	$('.document').val('');
	$('.modal-finalizar').modal('show');
}

function validar_form_documentos(){
	alert(label_documento);
	var documento = $('.document')[0].files;

	var data = new FormData();
	var csrfName = $('.txt_csrfname_formulario').attr('name');
	var csrfHash = $('.txt_csrfname_formulario').val();
	var csrfHash = $('.txt_csrfname_formulario').val();

	var task_id = $('.task_id').val();
	var user_id = $('.user_id').val();
	var created_by = $('.created_by').val();
	var commentary = $('.commentary').val();

	data.append('document',documento[0]);
	data.append('task_id',task_id);
	data.append('user_id',user_id);
	data.append('created_by',created_by);
	data.append('commentary',commentary);
	data.append([csrfName],csrfHash);

    $('.btn-form').prop('disabled', true);

	$('#loading').show();

	$.ajax({
		url: base_url+'/tasks/validar_form_documentos',
	  	method: 'POST',
	  	data: data,
	  	contentType: false,
	  	processData: false,
	  	dataType: 'JSON',
		success: function(res){
			if(res.status == 'ERROR'){
    			$('.btn-form').prop('disabled', false);
				$('.alert-text-error').html(res.message);
				$('.alert-danger').show();
				setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
			}

			if(res.status == 'OK'){
				$('.alert-text-exito').html(res.message);
				$('.alert-success').show();
				setTimeout(function(){ location.reload(); }, 3000);
			}

			$('#loading').hide();
		}
	}).fail(function() {
		$('.btn-form').prop('disabled', false);
		$('.alert-text-error').html(label_validar);
		$('.alert-danger').show();
		setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
		$('#loading').hide();
	});
}

function add_calificacion(task_id){
	$('#loading').show();

	$.ajax({
		url: base_url+'/tasks/add_calificacion',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos-'+task_id).serialize(),
		success: function(res){
			if(res.status == 'ERROR'){
				$('.alert-text-error').html(res.message);
				$('.alert-danger').show();
				setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
			}

			if(res.status == 'OK'){
				$('.alert-text-exito').html(res.message);
				$('.alert-success').show();
				setTimeout(function(){ location.reload(); }, 3000);
			}

			$('#loading').hide();
		}
	});
}

function get_detalles(task_id){
	$('.tbody-detalles tr').remove();
	
	$.ajax({
		url: base_url+'/tasks/get_detalles',
		type: 'POST',
		dataType: 'JSON',
		data: {task_id: task_id},
		success: function(res){
			doc = '';

			if(res['document'] != ''){
				doc = '<a href="../public/tareas/'+res['task_id']+'/'+res['document']+'" target="_blank"><i class="fa fa-file" aria-hidden="true"></i></a>';
			}

			$('.tbody-detalles').append('<tr class="tr-detalle">'
				+'<td>'+res['productivity']+'</td>'
				+'<td>'+res['quality']+'</td>'
				+'<td>'+res['innovation']+'</td>'
				+'<td>'+res['service']+'</td>'
				+'<td>'+res['commentary']+'</td>'
				+'<td>'+doc+'</td>'
			+'</tr>');

			$('.modal-detalles').modal('show');
		}
	});
}