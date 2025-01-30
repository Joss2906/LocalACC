$(document).ready(function() {
	$('#datatable').DataTable();

    $(".form-datos").on("submit", function(e) {
    	$('.btn-form').prop('disabled', true);
    	e.preventDefault();
    	$.ajax({
    		url: base_url+'/chiefs/form_datos',
    		type: 'POST',
    		dataType: 'JSON',
			data: $('.form-datos').serialize(),
			success: function(res){
				$('.alert-text-exito').html(res);
				$('.alert-success').show();
				setTimeout(function(){ window.location.replace(base_url+'/chiefs'); }, 2000);
			}
    	});
    });
});

function modal_jefes(chief_id , organization_id, chief_user_id, employee_user_id, titulo_boton){

	$('.chief_id').val(chief_id);
	$('.organization_id option[value='+organization_id+']').prop('selected', true);
	$('.chief_user_id option[value='+chief_user_id+']').prop('selected', true);
	$('.employee_user_id option[value='+employee_user_id+']').prop('selected', true);
	$('.btn-form').html('<i class="fa fa-plus-circle" aria-hidden="true"></i>'+ titulo_boton);
	get_empleados(chief_user_id, employee_user_id);
	$('.modal-jefes').modal('show');
}

function validar_form(){
	$.ajax({
		url: base_url+'/chiefs/validar_form',
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

function eliminar_datos(chief_id){
	var res = confirm('¿Desea eliminar el registro #'+chief_id+'?');

	if (res == true) {
		$.ajax({
			async: true, 
			url: base_url+'/chiefs/eliminar_datos',
			type: 'POST',
			dataType: 'JSON',
			data: {chief_id: chief_id},
			success: function(res){
				location.reload();
			}
		});
	}
}

function get_empleados(chief_user_id, employee_user_id){
	$('.chief_user_id option').remove();
	$('.employee_user_id option').remove();

	$.ajax({
		url: base_url+'/chiefs/get_empleados',
		type: 'POST',
		dataType: 'JSON',
		data: {organization_id: $('.organization_id option:selected').val()},
		success: function(res){
			$('.chief_user_id').append('<option value="">Seleccione una opción</option>');
			$('.employee_user_id').append('<option value="">Seleccione una opción</option>');

			$.each(res['jefes'], function(index, val) {
				$('.chief_user_id').append('<option value="'+val.user_id+'">'+val.first_name+' '+val.second_name+' '+val.last_name+' '+val.second_last_name+'</option>');
			});

			$.each(res['empleados'], function(index, val) {
				$('.employee_user_id').append('<option value="'+val.user_id+'">'+val.first_name+' '+val.second_name+' '+val.last_name+' '+val.second_last_name+'</option>');
			});

			$('.chief_user_id option[value='+chief_user_id+']').prop('selected', true);
			$('.employee_user_id option[value='+employee_user_id+']').prop('selected', true);
		}
	});
}

function modal_imagen(service_id){
	$('.modal-imagen').modal('show');
}