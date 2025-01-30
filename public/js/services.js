$(document).ready(function() {
	$('#datatable').DataTable();

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

    get_empleados_organizacion();

    if($('.input-ponderacion').val() == 1){
   		get_ponderaciones();
    }
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

function eliminar_datos(service_id, user_id, position_id){
	var res = confirm(label_eliminar);

	if (res == true) {
		$.ajax({
			async: true, 
			url: base_url+'/services/eliminar_datos',
			type: 'POST',
			dataType: 'JSON',
			data: {service_id: service_id, user_id: user_id, position_id: position_id},
			success: function(res){
				location.reload();
			}
		});
	}
}

function get_empleados_organizacion(){
	$('.position_id option').remove();
	$('.customer_id option').remove();
	$('.user_id option').remove();
	$('.cliente').remove();
	$('.competidor').remove();

	$.ajax({
		url: base_url+'/services/get_empleados_organizacion',
		type: 'POST',
		dataType: 'JSON',
		data: {organization_id: $('.organization_id option:selected').val()},
		success: function(res){
			if(res['employees'] == 0){
				$('.user_id option').remove();
				$('.div-employees').hide();
			}else{
				$.each(res['employees'], function(index, val) {
					$('.user_id').append('<option value="'+val['user_id']+'">'+val['first_name']+' '+val['second_name']+' '+val['last_name']+' '+val['second_last_name']+'</option>');
				});
				$('.div-employees').show();
			}

			if(res['positions'] == 0){
				$('.position_id option').remove();
				$('.div-positions').hide();
				$('.div-costo').hide();
			}else{
				$('.position_id').append('<option value="">'+label_seleccionar+'</option>');
				$.each(res['positions'], function(index, val) {
					$('.position_id').append('<option value="'+val['position_id']+'">'+val['position']+'</option>');
				});
				$('.div-positions').show();

				if(res['employees'] == 0){
					$('.div-costo').show();
				}

				$('.position_id option[value='+$('.position').val()+']').prop('selected', true);
			}

			$('.customer_id').append('<option value="">'+label_seleccionar+'</option>');
			$.each(res['employees_organization'], function(index, val) {
				$('.customer_id').append('<option data-user_id="'+val['user_id']+'" data-user="'+val['first_name']+' '+val['second_name']+' '+val['last_name']+' '+val['second_last_name']+'" data-position="'+val.position+'" data-position_id="'+val.position_id+'" value="'+val['user_id']+'">'+val['first_name']+' '+val['second_name']+' '+val['last_name']+' '+val['second_last_name']+'</option>');
			});

			$('.employee_cost').val(res['employee_cost']);
		}
	});
}

function add_cliente(){

	user_id = $('.customer_id option:selected').data('user_id');
	user = $('.customer_id option:selected').data('user');
	position = $('.customer_id option:selected').data('position');
	position_id = $('.customer_id option:selected').data('position_id');

	$('.tbody-clientes').append('<tr class="tr-cliente">'
		+'<td>'
			+user
			+'<input type="hidden" class="form-control service_customer_id" name="service_customer_id[]" value="0">'
			+'<input type="hidden" class="form-control customer_id" name="customer_id[]" value="'+user_id+'">'
		+'</td>'
		+'<td>'
			+position
			+'<input type="hidden" class="form-control position_customer_id" name="position_customer_id[]" value="'+position_id+'">'
		+'</td>'
		+'<td>'
			+'<a href="javascript:void(0);" style="color: red;" onclick="delete_service_customer(this, 0);"><i class="fa fa-trash-o" aria-hidden="true"></i></a>'
		+'</td>'
	+'</tr>');
}

function add_competidor(){
	$('.tbody-competidores').append('<tr class="tr-competidor">'
		+'<td>'
			+'<input type="hidden" class="form-control service_competitor_id" name="service_competitor_id[]" value="0">'
			+'<input type="text" class="form-control company" name="company[]" onkeyup="this.value=caracteres_numeros_validos(this.value)">'
		+'</td>'
		+'<td>'
			+'<input type="text" class="form-control guarantee" name="guarantee[]" onkeyup="this.value=caracteres_numeros_validos(this.value)">'
		+'</td>'
		+'<td>'
			+'<input type="text" class="form-control offered_price" name="offered_price[]" onkeypress="return justDecimals(event);">'
		+'</td>'
		+'<td>'
			+'<a href="javascript:void(0);" style="color: red;" onclick="delete_service_competitor(this, 0);"><i class="fa fa-trash-o" aria-hidden="true"></i></a>'
		+'</td>'
	+'</tr>');
}

function get_clientes_competidores(type, service_id){
	$.ajax({
		url: base_url+'/services/get_clientes_competidores',
		type: 'POST',
		dataType: 'JSON',
		data: {service_id: service_id},
		success: function(res){
			if(type == 1){
				$('.tbody-clientes tr').remove();
			}

			if(type == 1 || type == 0){			
				$.each(res['services_customers'], function(index, val) {
					console.log(val);
					$('.tbody-clientes').append('<tr class="tr-cliente">'
						+'<td>'
							+val['user']
							+'<input type="hidden" class="form-control service_customer_id" name="service_customer_id[]" value="'+val['service_customer_id']+'">'
							+'<input type="hidden" class="form-control customer_id" name="customer_id[]" value="'+val['customer_id']+'">'
						+'</td>'
						+'<td>'
							+val['position']
							+'<input type="hidden" class="form-control position_customer_id" name="position_customer_id[]" value="'+val['position_customer_id']+'">'
						+'</td>'
						+'<td>'
							+'<a href="javascript:void(0);" style="color: red;" onclick="delete_service_customer(this, '+val['service_customer_id']+');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>'
						+'</td>'
					+'</tr>');
				});

				if(type == 1){
					$('.modal-clientes').modal('show');
				}
			}

			if(type == 2){
				$('.tbody-competidores tr').remove();
			}

			if(type == 2 || type == 0){			
				$.each(res['services_competitors'], function(index, val) {
					$('.tbody-competidores').append('<tr class="tr-competidor">'
						+'<td>'
							+'<input type="hidden" class="form-control service_competitor_id" name="service_competitor_id[]" value="'+val['service_competitor_id']+'">'
							+'<input type="text" class="form-control company" name="company[]" value="'+val['company']+'">'
						+'</td>'
						+'<td>'
							+'<input type="text" class="form-control guarantee" name="guarantee[]" value="'+val['guarantee']+'">'
						+'</td>'
						+'<td>'
							+'<input type="text" class="form-control offered_price" name="offered_price[]" onkeypress="return justDecimals(event);" value="'+val['offered_price']+'">'
						+'</td>'
						+'<td>'
							+'<a href="javascript:void(0);" style="color: red;" onclick="delete_service_competitor(this, '+val['service_competitor_id']+');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>'
						+'</td>'
					+'</tr>');
				});

				if(type == 2){
					$('.modal-competidores').modal('show');
				}
			}
		}
	});
}

function delete_service_customer(obj, service_customer_id){
	$.ajax({
		url: base_url+'/services/delete_service_customer',
		type: 'POST',
		dataType: 'JSON',
		data: {service_customer_id: service_customer_id},
		success: function(res){
			$(obj).closest('.tr-cliente').remove();
		}
	});	
}

function delete_service_competitor(obj, service_competitor_id){
	user_id = $('.user_id option:selected').val();
	position_id = $('.position_id option:selected').val();

	$.ajax({
		url: base_url+'/services/delete_service_competitor',
		type: 'POST',
		dataType: 'JSON',
		data: {service_competitor_id: service_competitor_id, user_id: user_id, position_id: position_id},
		success: function(res){
			$(obj).closest('.tr-competidor').remove();
		}
	});
}

function get_detalles(service_id){
	$('.tbody-detalles tr').remove();
	
	$.ajax({
		url: base_url+'/services/get_detalles',
		type: 'POST',
		dataType: 'JSON',
		data: {service_id: service_id},
		success: function(res){
			$('.tbody-detalles').append('<tr class="tr-detalle">'
				+'<td>'+res['productivity']+'</td>'
				+'<td>'+res['quality']+'</td>'
				+'<td>'+res['innovation']+'</td>'
				+'<td>'+res['service']+'</td>'
			+'</tr>');

			$('.modal-detalles').modal('show');
		}
	});
}

function sumar_ponderaciones(obj){
    res = 0;
    $(".tbody-datos tr").each(function () {
        if($(this).find('.weighing').val() == ''){
            weighing = 0;
        }else{
            weighing = $(this).find('.weighing').val();
        }

        res = parseFloat(res) + parseFloat(weighing);
    });

    console.log(res);

    if(res > 100){
    	$(obj).val(0);
    	alert(label_sumatoria_ponderaciones);
    }
}

function actualizar_ponderaciones(){
    res = 0;

    $(".tbody-datos tr").each(function () {
        if($(this).find('.weighing').val() == ''){
            weighing = 0;
        }else{
            weighing = $(this).find('.weighing').val();
        }

        res = parseFloat(res) + parseFloat(weighing);
    });

    if(res == 100){
    	$.ajax({
    		url: base_url+'/services/actualizar_ponderaciones',
    		type: 'POST',
    		dataType: 'JSON',
    		data: $('.form-datos-ponderaciones').serialize(),
    		success: function(res){
    			location.reload();
    		}
    	});
    }else{
		$('.alert-text-error').html(label_validar_ponderaciones);
		$('.alert-danger').show();
		setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
    }
}

function get_ponderaciones(){ 
  $.ajax({
     url: base_url+'/services/get_ponderaciones',
     type: 'POST',
     dataType: 'JSON',
     data: {user_id: $('.user_id').val()},
     success: function(services){
        var contador = Math.ceil(services.length / 10);
        for (i=0; i < contador; i++) {
           $('.div-graficas').append('<div class="col-md-12 mb-1" style="text-align: center;">'
              +'<div id="chart-ponderaciones-'+i+'" style="height: 450px!important;"></div>'
           +'</div>');
        }

        grafica_ponderaciones(services);
     }
  });
}

var pons = 0;

function grafica_ponderaciones(services){
	console.log(pons);

  var weighings = [];
  var descriptions = [];

  if(services.length > 10){
     contador = 10;
  }else{
     contador = services.length;
  }

  for (i = 0; i < contador; i++) {
     weighings.push(parseInt(services[i]['weighing']));
     descriptions.push(''+services[i]['description']+'');
  }

  var options = {
       series: [{
       data: weighings,
     }],
       chart: {
       type: 'bar',
       height: 300
     },
     plotOptions: {
       bar: {
         borderRadius: 4,
         horizontal: true,
       }
     },
     dataLabels: {
       enabled: true
     },
     xaxis: {
       categories: descriptions,
       labels: {
         style: {
           // colors: colors,
           fontSize: '12px'
         }
       }
     }
  };

  var chart = new ApexCharts(document.querySelector("#chart-ponderaciones-"+pons+""), options);
  chart.render();

  pons++;
  services = services.slice(10);

  if(services.length != 0){
     grafica_ponderaciones(services, pons);
  }
}

function modal_imagen(service_id){
	$('.service_id_imagen').val(service_id);
	$('.modal-imagen').modal('show');
}

function add_imagen(){
	alert(label_imagen);
	var files = $('.profile_picture')[0].files;

	var data = new FormData();
	var csrfName = $('.txt_csrfname_imagen').attr('name');
	var csrfHash = $('.txt_csrfname_imagen').val();
	var csrfHash = $('.txt_csrfname_imagen').val();
	var service_id = $('.service_id_imagen').val();
	data.append('profile_picture',files[0]);
	data.append('service_id',service_id);
	data.append([csrfName],csrfHash);

	$('#loading').show();

	$.ajax({
		url: base_url+'/services/add_imagen',
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
		$('.alert-text-error').html(label_validar_imagen);
		$('.alert-danger').show();
		setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
		$('#loading').hide();
	});
}