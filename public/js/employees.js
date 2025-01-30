$(document).ready(function() {
	$('#datatable').DataTable();

	$('.birthday').datetimepicker({
		timepicker:false,
		format:'Y-m-d',
	});

	$('.date_admission').datetimepicker({
		timepicker:false,
		format:'Y-m-d',
	});

    view_razon_social();

    get_departamentos_puestos();

    validate_seguridad();
});

function active_form(form){
	$('.form-active').val(form);
}

function validar_form(){
	if($('.form-active').val() == 1){
    	var data = $('.form-user').serializeArray();
	}
	if($('.form-active').val() == 2){
    	var data = $('.form-personal').serializeArray();
	}
	if($('.form-active').val() == 3){
    	var data = $('.form-employee').serializeArray();
	}
	if($('.form-active').val() == 4){
    	var data = $('.form-competitivas').serializeArray();
	}
	if($('.form-active').val() == 5){
    	var data = $('.form-comparativas').serializeArray();
	}
	if($('.form-active').val() == 6){
    	var data = $('.form-resoluciones').serializeArray();
	}
	if($('.form-active').val() == 7){
    	var data = $('.form-innovaciones').serializeArray();
	}

	data.push({name: 'form', value: $('.form-active').val()});
	data.push({name: 'user_id', value: $('.user_id').val()});
	data.push({name: 'credential_id', value: $('.credential_id option:selected').val()});

	$.ajax({
		url: base_url+'/employees/validar_form',
		type: 'POST',
		dataType: 'JSON',
		data: data,
		success: function(res){
			console.log(res);

			if(res.status == 'ERROR'){
				$('.alert-text-error').html(res.message);
				$('.alert-danger').show();
				setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
			}

			if(res.status == 'OK'){
				if($('.form-active').val() == 1){
	            	data = $('.form-user').serializeArray();
					data.push({name: 'form', value: $('.form-active').val()});
					data.push({name: 'user_id', value: $('.user_id').val()});
					form_datos(data);
				}else{				
					if($('.form-active').val() == 2 && $('.user_id').val() > 0){
	                	data = $('.form-personal').serializeArray();
						data.push({name: 'form', value: $('.form-active').val()});
						data.push({name: 'user_id', value: $('.user_id').val()});
						form_datos(data);
					}else{
						if($('.form-active').val() == 3 && $('.user_id').val() > 0){
		                	data = $('.form-employee').serializeArray();
							data.push({name: 'form', value: $('.form-active').val()});
							data.push({name: 'user_id', value: $('.user_id').val()});
							form_datos(data);
						}else{
							if($('.form-active').val() == 4 && $('.user_id').val() > 0){
			                	data = $('.form-competitivas').serializeArray();
								data.push({name: 'form', value: $('.form-active').val()});
								data.push({name: 'user_id', value: $('.user_id').val()});
								form_datos(data);
							}else{
								if($('.form-active').val() == 5 && $('.user_id').val() > 0){
				                	data = $('.form-comparativas').serializeArray();
									data.push({name: 'form', value: $('.form-active').val()});
									data.push({name: 'user_id', value: $('.user_id').val()});
									form_datos(data);
								}else{
									if($('.form-active').val() == 6 && $('.user_id').val() > 0){
					                	data = $('.form-resoluciones').serializeArray();
										data.push({name: 'form', value: $('.form-active').val()});
										data.push({name: 'user_id', value: $('.user_id').val()});
										form_datos(data);
									}else{
										if($('.form-active').val() == 7 && $('.user_id').val() > 0){
						                	data = $('.form-innovaciones').serializeArray();
											data.push({name: 'form', value: $('.form-active').val()});
											data.push({name: 'user_id', value: $('.user_id').val()});
											form_datos(data);
										}else{
											// alert('Favor de registrar los datos del usuario.');
											$('.alert-text-error').html(label_favor_registrar);
											$('.alert-danger').show();
											setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
										}
									}
								}
							}
						}
					}
				}
			}
		}
	});
}

function form_datos(data){
	$.ajax({
		url: base_url+'/employees/form_datos',
		type: 'POST',
		dataType: 'JSON',
		data: data,
		success: function(user_id){
			if(user_id == 0){
				// alert('Error, Intente nuevamente');
				$('.alert-text-error').html(label_error_nuevamente);
				$('.alert-danger').show();
				setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
			}else{
				// alert(label_guardaron_correctamente);
				$('.alert-text-exito').html(label_guardaron_correctamente);
				$('.alert-success').show();
				setTimeout(function(){ $('.alert-success').hide(); }, 1000);
				if($('.form-active').val() == 3 && $('.user_id').val() > 0){
					setTimeout(function(){ window.location.replace(base_url+'/employees'); }, 2000);
				}

				$('.user_id').val(user_id);
			}
		}
	});
}

function eliminar_datos(user_id, estatus){

	if(estatus == 0){
		txt = label_deshabilitar;
	}else{
		txt = label_habilitar;
	}

	var res = confirm(txt);

	if (res == true) {
		$.ajax({
			async: true, 
			url: base_url+'/employees/eliminar_datos',
			type: 'POST',
			dataType: 'JSON',
			data: {user_id: user_id, estatus: estatus},
			success: function(res){
				location.reload();
			}
		});
	}
}

function view_razon_social(){
	if($('.credential_id option:selected').val() == 5 || $('.credential_id option:selected').val() == 6){
		$('.div-razon-social').show();
	}else{
		$('.div-razon-social').hide();
		$('.business_name').val('');
	}
}

function monto_total(){

   	if($('.salary_amount').val() == ''){
   		salary_amount = 0.00;
   	}else{ 
		salary_amount = $('.salary_amount').val(); 
	}

   	if($('.social_security').val() == ''){
   		social_security = 0.00;
   	}else{ 
		social_security = $('.social_security').val(); 
	}

   	if($('.benefit_amount_1').val() == ''){
   		benefit_amount_1 = 0.00;
   	}else{ 
		benefit_amount_1 = $('.benefit_amount_1').val(); 
	}

   	if($('.benefit_amount_2').val() == ''){
   		benefit_amount_2 = 0.00;
   	}else{ 
		benefit_amount_2 = $('.benefit_amount_2').val(); 
	}

   	if($('.benefit_amount_3').val() == ''){
   		benefit_amount_3 = 0.00;
   	}else{ 
		benefit_amount_3 = $('.benefit_amount_3').val(); 
	}

   	if($('.benefit_amount_4').val() == ''){
   		benefit_amount_4 = 0.00;
   	}else{ 
		benefit_amount_4 = $('.benefit_amount_4').val(); 
	}

    var total = 0;

    total = parseFloat(salary_amount) + parseFloat(social_security) + parseFloat(benefit_amount_1) + parseFloat(benefit_amount_2) + parseFloat(benefit_amount_3) + parseFloat(benefit_amount_4);

	total = total.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
    total = precise_round(total, 2);

    $('.total').val(total);
}

function ver_detalles(user_id){
	$('.tbody-datos1 tr').remove();
	$('.tbody-datos2 tr').remove();
	$('.tbody-datos3 tr').remove();
	$('.tbody-datos4 tr').remove();

	$.ajax({
		url: base_url+'/employees/ver_detalles',
		type: 'POST',
		dataType: 'JSON',
		data: {user_id: user_id},
		success: function(val){
			if(val.first_name == 'null'){
				val.first_name = 'S/D';
			}
			if(val.second_name == 'null'){
				val.second_name = 'S/D';
			}
			if(val.last_name == 'null'){
				val.last_name = 'S/D';
			}
			if(val.second_last_name == 'null'){
				val.second_last_name = 'S/D';
			}
			if(val.gender == 'null'){
				val.gender = 'S/D';
			}
			if(val.birthday == 'null'){
				val.birthday = 'S/D';
			}
			if(val.email == 'null'){
				val.email = 'S/D';
			}
			if(val.phone == 'null'){
				val.phone = 'S/D';
			}
			if(val.mobile == 'null'){
				val.mobile = 'S/D';
			}
			if(val.civil_status == 'null'){
				val.civil_status = 'S/D';
			}
			if(val.economic_dependents == 'null'){
				val.economic_dependents = 'S/D';
			}
			if(val.street == 'null'){
				val.street = 'S/D';
			}
			if(val.number == 'null'){
				val.number = 'S/D';
			}
			if(val.suburb == 'null'){
				val.suburb = 'S/D';
			}
			if(val.postal_code == 'null'){
				val.postal_code = 'S/D';
			}
			if(val.country == 'null'){
				val.country = 'S/D';
			}
			if(val.nationality == 'null'){
				val.nationality = 'S/D';
			}
			if(val.credential == 'null'){
				val.credential = 'S/D';
			}
			if(val.schooling == 'null'){
				val.schooling = 'S/D';
			}
			if(val.organization == 'null'){
				val.organization = 'S/D';
			}
			if(val.department == 'null'){
				val.department = 'S/D';
			}
			if(val.position == 'null'){
				val.position = 'S/D';
			}
			if(val.date_admission == 'null'){
				val.date_admission = 'S/D';
			}
			if(val.salary_amount == 'null'){
				val.salary_amount = 'S/D';
			}
			if(val.benefit_1 == 'null'){
				val.benefit_1 = 'S/D';
			}
			if(val.benefit_amount_1 == 'null'){
				val.benefit_amount_1 = 'S/D';
			}
			if(val.benefit_2 == 'null'){
				val.benefit_2 = 'S/D';
			}
			if(val.benefit_amount_2 == 'null'){
				val.benefit_amount_2 = 'S/D';
			}
			if(val.benefit_3 == 'null'){
				val.benefit_3 = 'S/D';
			}
			if(val.benefit_amount_3 == 'null'){
				val.benefit_amount_3 = 'S/D';
			}
			if(val.benefit_4 == 'null'){
				val.benefit_4 = 'S/D';
			}
			if(val.benefit_amount_4 == 'null'){
				val.benefit_amount_4 = 'S/D';
			}
			if(val.total == 'null'){
				val.total = 'S/D';
			}
			if(val.disc == 'null'){
				val.disc = 'S/D';
			}

			$('.tbody-datos1').append('<tr>'
				+'<td>'+val.first_name+' '+val.second_name+' '+val.last_name+' '+val.second_last_name+'</td>'
				+'<td>'+val.gender+'</td>'
				+'<td>'+val.birthday+'</td>'
				+'<td>'+val.email+'</td>'
				+'<td>'+val.phone+'</td>'
			+'</tr>');

			$('.tbody-datos2').append('<tr>'
				+'<td>'+val.mobile+'</td>'
				+'<td>'+val.civil_status+'('+val.economic_dependents+')</td>'
				+'<td>'+val.street+' '+val.number+' '+val.suburb+' '+val.postal_code+'</td>'
				+'<td>'+val.country+'</td>'
				+'<td>'+val.nationality+'</td>'
			+'</tr>');

			$('.tbody-datos3').append('<tr>'
				+'<td>'+val.credential+'</td>'
				+'<td>'+val.schooling+'</td>'
				+'<td>'+val.organization+'</td>'
				+'<td>'+val.department+'</td>'
				+'<td>'+val.position+'</td>'
			+'</tr>');

			$('.tbody-datos4').append('<tr>'
				+'<td>'+val.date_admission+'</td>'
				+'<td>$'+val.salary_amount+'</td>'
				+'<td>'
					+'<p>'+val.benefit_1+' $'+val.benefit_amount_1+'</p>'
					+'<p>'+val.benefit_2+' $'+val.benefit_amount_2+'</p>'
					+'<p>'+val.benefit_3+' $'+val.benefit_amount_3+'</p>'
					+'<p>'+val.benefit_4+' $'+val.benefit_amount_4+'</p>'
				+'</td>'
				+'<td>'+val.total+'</td>'
				+'<td>'+val.disc+'</td>'
			+'</tr>');

			$('.modal-detalles').modal('show');
		}
	});
}

function validar_form_competiencies(){
	$.ajax({
		url: base_url+'/employees/validar_form_competiencies',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			console.log(res);

			if(res.status == 'ERROR'){
				$('.alert-text-error').html(res.message);
				$('.alert-danger').show();
				setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
			}

			if(res.status == 'OK'){
				form_datos_competiencies();
			}
		}
	});
}

function validar_calificacion(competency_id, qualification){
	if(competency_id == 1 && qualification > 200){
		alert(label_200);
		$('.qualification'+competency_id).val('');
	}

	if(competency_id != 1 && qualification > 100){
		alert(label_100);
		$('.qualification'+competency_id).val('');
	}
	console.log(qualification);
}

function form_datos_competiencies(){
	$.ajax({
		url: base_url+'/employees/form_datos_competiencies',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			$('.alert-text-exito').html(label_guardaron_correctamente);
			$('.alert-success').show();
			setTimeout(function(){ $('.alert-success').hide(); }, 1000);
			setTimeout(function(){ location.reload(); }, 2000);
		}
	});
}

function get_departamentos_puestos(){
	$('.position_id option').remove();
	$('.department_id option').remove();

	$.ajax({
		url: base_url+'/employees/get_departamentos_puestos',
		type: 'POST',
		dataType: 'JSON',
		data: {organization_id: $('.organization_id option:selected').val()},
		success: function(res){
			$('.position_id').append('<option value="">'+label_seleccionar+'</option>');
			$.each(res['positions'], function(index, val) {
				$('.position_id').append('<option value="'+val['position_id']+'">'+val['position']+'</option>');
			});

			$('.department_id').append('<option value="">'+label_seleccionar+'</option>');
			$.each(res['departments'], function(index, val) {
				$('.department_id').append('<option value="'+val['department_id']+'">'+val['department']+'</option>');
			});

			$('.department_id option[value='+$('.department_id').data('department_id')+']').prop('selected', true);
			$('.position_id option[value='+$('.position_id').data('position_id')+']').prop('selected', true);
		}
	});
}

function validate_seguridad(){
	// if($('.type_user_id option:selected').val() == 1){
	// 	$('.social_security').prop('readonly', false);
	// }else{
	// 	$('.social_security').prop('readonly', true);
	// 	$('.social_security').val(0.00);
	// }
	if($('.credential_id option:selected').val() != 5 && $('.credential_id option:selected').val() != 6){
		$('.social_security').prop('readonly', false);
	}else{
		$('.social_security').prop('readonly', true);
		$('.social_security').val(0.00);
	}

	$('.type_user_id').val($('.credential_id option:selected').val());
}
