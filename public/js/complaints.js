$(document).ready(function() {
	$('#datatable').DataTable();

    $(".form-datos").on("submit", function(e) {
    	$('.btn-form').prop('disabled', true);
    	e.preventDefault();
    	$.ajax({
    		url: base_url+'/complaints/form_datos',
    		type: 'POST',
    		dataType: 'JSON',
			data: $('.form-datos').serialize(),
			success: function(res){
				$('.alert-text-exito').html(res);
				$('.alert-success').show();
				setTimeout(function(){ window.location.replace(base_url+'/complaints'); }, 2000);
			}
    	});
    });
});

function modal_quejas(complaint_id, complaint_type_id, category_id, user_id, complaint, titulo_boton){
	$('.complaint').text('');
	$('.complaint_id').val(complaint_id);
	$('.complaint_type_id option[value='+complaint_type_id+']').prop('selected', true);
	$('.category_id option[value='+category_id+']').prop('selected', true);
	$('.user_id option[value='+user_id+']').prop('selected', true);
	$('.complaint').val(complaint);
	$('.complaint').text(complaint);
	$('.btn-form').html('<i class="fa fa-plus-circle" aria-hidden="true"></i>'+ titulo_boton);
	$('.modal-quejas').modal('show');
}

function validar_form(){
	$.ajax({
		url: base_url+'/complaints/validar_form',
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

function eliminar_datos(complaint_id){
	var res = confirm(label_eliminar);

	if (res == true) {
		$.ajax({
			async: true, 
			url: base_url+'/complaints/eliminar_datos',
			type: 'POST',
			dataType: 'JSON',
			data: {complaint_id: complaint_id},
			success: function(res){
				location.reload();
			}
		});
	}
}

function cambiar_status(complaint_id, complaint_status_id){
	var res = confirm(label_cambiar);

	if (res == true) {
		$.ajax({
			async: true, 
			url: base_url+'/complaints/cambiar_status',
			type: 'POST',
			dataType: 'JSON',
			data: {complaint_id: complaint_id, complaint_status_id: complaint_status_id},
			success: function(res){
				location.reload();
			}
		});
	}	
}