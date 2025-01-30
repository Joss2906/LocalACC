$(document).ready(function() {
	$('#datatable').DataTable();

    $(".form-datos").on("submit", function(e) {
    	$('.btn-form').prop('disabled', true);
    	e.preventDefault();
    	$.ajax({
    		url: base_url+'/organizations/form_datos',
    		type: 'POST',
    		dataType: 'JSON',
			data: $('.form-datos').serialize(),
			success: function(res){
				$('.alert-text-exito').html(res);
				$('.alert-success').show();
				setTimeout(function(){ window.location.replace(base_url+'/organizations'); }, 2000);
			}
    	});
    });
});

function modal_organizaciones(organization_id, organization, maturity_id, quiz, titulo_boton){
	$('.organization_id').val(organization_id);
	$('.organization').val(organization);
	$('.maturity_id option[value='+maturity_id+']').prop('selected', true);
	if (quiz == 1) {
		$('.quiz').prop('checked', true);
	}else{
		$('.quiz').prop('checked', false);
	}
	$('.btn-form').html('<i class="fa fa-plus-circle" aria-hidden="true"></i>'+ titulo_boton);
	$('.modal-organizaciones').modal('show');
}

function validar_form(){
	$.ajax({
		url: base_url+'/organizations/validar_form',
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

function eliminar_datos(organization_id){
	var res = confirm(label_eliminar);

	if (res == true) {
		$.ajax({
			async: true, 
			url: base_url+'/organizations/eliminar_datos',
			type: 'POST',
			dataType: 'JSON',
			data: {organization_id: organization_id},
			success: function(res){
				location.reload();
			}
		});
	}
}