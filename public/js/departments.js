$(document).ready(function() {
	$('#datatable').DataTable();

    $(".form-datos").on("submit", function(e) {
    	$('.btn-form').prop('disabled', true);
    	e.preventDefault();
    	$.ajax({
    		url: base_url+'/departments/form_datos',
    		type: 'POST',
    		dataType: 'JSON',
			data: $('.form-datos').serialize(),
			success: function(res){
				$('.alert-text-exito').html(res);
				$('.alert-success').show();
				setTimeout(function(){ window.location.replace(base_url+'/departments'); }, 2000);
			}
    	});
    });
});

function modal_departamentos(department_id, department, organization_id, titulo_boton){
	$('.department_id').val(department_id);
	$('.department').val(department);
	$('.organization_id option[value='+organization_id+']').prop('selected', true);
	$('.btn-form').html('<i class="fa fa-plus-circle" aria-hidden="true"></i>'+ titulo_boton);
	$('.modal-departamentos').modal('show');
}

function validar_form(){
	$.ajax({
		url: base_url+'/departments/validar_form',
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

function eliminar_datos(department_id){
	var res = confirm(label_eliminar);

	if (res == true) {
		$.ajax({
			async: true, 
			url: base_url+'/departments/eliminar_datos',
			type: 'POST',
			dataType: 'JSON',
			data: {department_id: department_id},
			success: function(res){
				location.reload();
			}
		});
	}
}