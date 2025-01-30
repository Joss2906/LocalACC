function actualizar_imagen(satisfaction_category_id){
	var files = $('.image_'+satisfaction_category_id+'')[0].files;

	var data = new FormData();
	var csrfName = $('.txt_csrfname_foto_'+satisfaction_category_id+'').attr('name');
	var csrfHash = $('.txt_csrfname_foto_'+satisfaction_category_id+'').val();
	var csrfHash = $('.txt_csrfname_foto_'+satisfaction_category_id+'').val();
	data.append('image',files[0]);
	data.append('satisfaction_category_id',satisfaction_category_id);
	data.append([csrfName],csrfHash);

	$('#loading').show();

	$.ajax({
		url: base_url+'/categories/validar_form',
	  	method: 'POST',
	  	data: data,
	  	contentType: false,
	  	processData: false,
	  	dataType: 'JSON',
		success: function(res){
			if(res.status == 'ERROR'){
				$('.alert-text-error').html(res.message);
				$('.alert-danger').show();
				setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
			}

			if(res.status == 'OK'){
				$('.alert-text-exito').html(res.message);
				$('.alert-success').show();
				setTimeout(function(){ location.reload(); }, 1000);
			}

			$('#loading').hide();

		}
	}).fail(function() {
		$('.btn-form').prop('disabled', false);
		$('.alert-text-error').html(label_validar_archivo);
		$('.alert-danger').show();
		setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
		$('#loading').hide();
	});
}