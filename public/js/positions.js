$(document).ready(function() {
	$('#datatable').DataTable();

    $(".form-datos").on("submit", function(e) {
    	$('.btn-form').prop('disabled', true);
    	e.preventDefault();
    	$.ajax({
    		url: base_url+'/positions/form_datos',
    		type: 'POST',
    		dataType: 'JSON',
			data: $('.form-datos').serialize(),
			success: function(res){
				$('.alert-text-exito').html(res);
				$('.alert-success').show();
				setTimeout(function(){ window.location.replace(base_url+'/positions'); }, 2000);
			}
    	});
    });
});

function modal_puestos(position_id, position, organization_id, titulo_boton){
	$('.position_id').val(position_id);
	$('.position').val(position);
	$('.organization_id option[value='+organization_id+']').prop('selected', true);
	$('.btn-form').html('<i class="fa fa-plus-circle" aria-hidden="true"></i>'+ titulo_boton);
	$('.modal-puestos').modal('show');
}

function validar_form(){
	$.ajax({
		url: base_url+'/positions/validar_form',
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

function eliminar_datos(position_id){
	var res = confirm(label_eliminar);

	if (res == true) {
		$.ajax({
			async: true, 
			url: base_url+'/positions/eliminar_datos',
			type: 'POST',
			dataType: 'JSON',
			data: {position_id: position_id},
			success: function(res){
				location.reload();
			}
		});
	}
}