$(document).ready(function() {
	get_estadisticas();
	get_competencias();
	get_servicios();
});

function get_competencias(){
	$.ajax({
		url: base_url+'/employees/get_competencias',
		type: 'POST',
		dataType: 'JSON',
		data: {user_id: $('.user_id').val()},
		success: function(res){
			if(res != ''){
				grafica_competencias(res);
			}else{
				$('#chart-competencias').append('<span>'+label_no_se_encontraron+'</span>');
			}
		}
	});
}

function get_estadisticas(){
	$.ajax({
		url: base_url+'/employees/get_estadisticas',
		type: 'POST',
		dataType: 'JSON',
		data: {user_id: $('.user_id').val(), position_id: $('.position_id').val()},
		success: function(res){
			var item_innovacion = [];
			var item_servicio = [];
			var item_calidad = [];
			var item_produccion = [];

			for (i = 0; i < res['tasks_general'].length; i++) {
				item_innovacion.push(parseFloat(res['tasks_general'][i]['average_innovation']));
				item_servicio.push(parseFloat(res['tasks_general'][i]['average_service']));
				item_calidad.push(parseFloat(res['tasks_general'][i]['average_quality']));
				item_produccion.push(parseFloat(res['tasks_general'][i]['average_productivity']));
			}

			grafica_generales(res['promedio']);
			grafica_semanal(res['semanal']);
			grafica_estadisticas(res['estadisticas']);

			var contador = Math.ceil(item_innovacion.length / 10);
			for (i=0; i < contador; i++) {
				$('.slider-graficas').append('<div class="col-md-12" style="text-align: center;">'
					+'<p>'+label_innovacion+'</p>'
					+'<div class="chart-innovacion-'+i+'" style="height: 375px!important; "></div>'
				+'</div>');
			}
			grafica_innovacion(res['tasks_general'], $('.user_id').val());

			var contador = Math.ceil(item_servicio.length / 10);
			for (i=0; i < contador; i++) {
				$('.slider-graficas').append('<div class="col-md-12" style="text-align: center;">'
					+'<p>'+label_servicio+'</p>'
					+'<div id="chart-servicio-'+i+'" style="height: 375px!important; "></div>'
				+'</div>');
			}
			grafica_servicio(res['tasks_general'], $('.user_id').val());

			var contador = Math.ceil(item_calidad.length / 10);
			for (i=0; i < contador; i++) {
				$('.slider-graficas').append('<div class="col-md-12" style="text-align: center;">'
					+'<p>'+label_calidad+'</p>'
					+'<div id="chart-calidad-'+i+'" style="height: 375px!important; "></div>'
				+'</div>');
			}
			grafica_calidad(res['tasks_general'], $('.user_id').val());

			var contador = Math.ceil(item_produccion.length / 10);
			for (i=0; i < contador; i++) {
				$('.slider-graficas').append('<div class="col-md-12" style="text-align: center;">'
					+'<p>'+label_productividad+'</p>'
					+'<div id="chart-productividad-'+i+'" style="height: 375px!important; "></div>'
				+'</div>');
			}
			grafica_productividad(res['tasks_general'], $('.user_id').val());
			
			$('.slider-graficas').not('.slick-initialized').slick({
			  dots: true,
			  prevArrow: true,
			  nextArrow: true,
			  infinite: true,
			  speed: 100,
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  autoplay: true,
			  autoplaySpeed: 3000,
			});
		}
	});
}

var inn=0;

function grafica_innovacion(tasks_general, user_id){
	var categories = [];
	var innovacion = [];
	var colors = [];

	if(tasks_general.length > 10){
		contador = 10;
	}else{
		contador = tasks_general.length;
	}

	for (i = 0; i < contador; i++) {
		if(user_id == tasks_general[i]['user_id']){
			categories.push(''+label_yo+'');
			colors.push('#008ffb');
		}else{
			categories.push(''+label_otros+'');
			colors.push('#fcba39');
		}

		innovacion.push(parseFloat(tasks_general[i]['average_innovation']));
	}

	var options = {
		  series: [{
		  data: innovacion
		}],
		  chart: {
		  height: 350,
		  type: 'bar',
		  events: {
		    click: function(chart, w, e) {
		      // console.log(chart, w, e)
		    }
		  }
		},
		colors: colors,
		plotOptions: {
		  bar: {
		    columnWidth: '80%',
		    distributed: true,
		  }
		},
		dataLabels: {
		  enabled: false
		},
		legend: {
		  show: false
		},
		xaxis: {
		  categories,
		  labels: {
		    style: {
		      // colors: colors,
		      fontSize: '12px'
		    }
		  }
		}
	};

	console.log(inn);
	var chart = new ApexCharts(document.querySelector(".chart-innovacion-"+inn+""), options);
	chart.render();

	inn++;
	tasks_general = tasks_general.slice(10);

	if(tasks_general.length != 0){
		grafica_innovacion(tasks_general, user_id);
	}
}

var s=0;

function grafica_servicio(tasks_general, user_id){
	var categories = [];
	var servicios = [];
	var colors = [];

	if(tasks_general.length > 10){
		contador = 10;
	}else{
		contador = tasks_general.length;
	}

	for (i = 0; i < contador; i++) {
		if(user_id == tasks_general[i]['user_id']){
			categories.push(''+label_yo+'');
			colors.push('#008ffb');
		}else{
			categories.push(''+label_otros+'');
			colors.push('#fcba39');
		}

		servicios.push(parseFloat(tasks_general[i]['average_service']));
	}

	var options = {
	  series: [{
	  data: servicios
	}],
	  chart: {
	  height: 350,
	  type: 'bar',
	  events: {
	    click: function(chart, w, e) {
	      // console.log(chart, w, e)
	    }
	  }
	},
	colors: colors,
	plotOptions: {
	  bar: {
	    columnWidth: '80%',
	    distributed: true,
	  }
	},
	dataLabels: {
	  enabled: false
	},
	legend: {
	  show: false
	},
	xaxis: {
	  categories,
	  labels: {
	    style: {
	      // colors: colors,
	      fontSize: '12px'
	    }
	  }
	}
	};

	console.log(s);
	var chart = new ApexCharts(document.querySelector("#chart-servicio-"+s+""), options);
	chart.render();

	s++;
	tasks_general = tasks_general.slice(10);

	if(tasks_general.length != 0){
		grafica_servicio(tasks_general, user_id);
	}
}

var c=0;

function grafica_calidad(tasks_general, user_id){
	var categories = [];
	var calidad = [];
	var colors = [];

	if(tasks_general.length > 10){
		contador = 10;
	}else{
		contador = tasks_general.length;
	}

	for (i = 0; i < contador; i++) {
		if(user_id == tasks_general[i]['user_id']){
			categories.push(''+label_yo+'');
			colors.push('#008ffb');
		}else{
			categories.push(''+label_otros+'');
			colors.push('#fcba39');
		}

		calidad.push(parseFloat(tasks_general[i]['average_quality']));
	}

	var options = {
	  series: [{
	  data: calidad
	}],
	  chart: {
	  height: 350,
	  type: 'bar',
	  events: {
	    click: function(chart, w, e) {
	      // console.log(chart, w, e)
	    }
	  }
	},
	colors: colors,
	plotOptions: {
	  bar: {
	    columnWidth: '80%',
	    distributed: true,
	  }
	},
	dataLabels: {
	  enabled: false
	},
	legend: {
	  show: false
	},
	xaxis: {
	  categories,
	  labels: {
	    style: {
	      // colors: colors,
	      fontSize: '12px'
	    }
	  }
	}
	};

	console.log(c);
	var chart = new ApexCharts(document.querySelector("#chart-calidad-"+c+""), options);
	chart.render();

	c++;
	tasks_general = tasks_general.slice(10);

	if(tasks_general.length != 0){
		grafica_calidad(tasks_general, user_id);
	}
}

var p=0;

function grafica_productividad(tasks_general, user_id){
	var categories = [];
	var productividad = [];
	var colors = [];

	if(tasks_general.length > 10){
		contador = 10;
	}else{
		contador = tasks_general.length;
	}

	for (i = 0; i < contador; i++) {
		if(user_id == tasks_general[i]['user_id']){
			categories.push(''+label_yo+'');
			colors.push('#008ffb');
		}else{
			categories.push(''+label_otros+'');
			colors.push('#fcba39');
		}

		productividad.push(parseFloat(tasks_general[i]['average_productivity']));
	}

	var options = {
	  series: [{
	  data: productividad
	}],
	  chart: {
	  height: 350,
	  type: 'bar',
	  events: {
	    click: function(chart, w, e) {
	      // console.log(chart, w, e)
	    }
	  }
	},
	colors: colors,
	plotOptions: {
	  bar: {
	    columnWidth: '80%',
	    distributed: true,
	  }
	},
	dataLabels: {
	  enabled: false
	},
	legend: {
	  show: false
	},
	xaxis: {
	  categories,
	  labels: {
	    style: {
	      // colors: colors,
	      fontSize: '12px'
	    }
	  }
	}
	};

	console.log(p);
	var chart = new ApexCharts(document.querySelector("#chart-productividad-"+p+""), options);
	chart.render();

	p++;
	tasks_general = tasks_general.slice(10);

	if(tasks_general.length != 0){
		grafica_productividad(tasks_general, user_id);
	}
}

function grafica_estadisticas(estadisticas){
	var options = {
	  series: [{
	  data: [parseInt(estadisticas['average_productivity']),parseInt(estadisticas['average_quality']),parseInt(estadisticas['average_service']),parseInt(estadisticas['average_innovation'])]
	}],
	  chart: {
	  height: 350,
	  type: 'bar',
	  events: {
	    click: function(chart, w, e) {
	      // console.log(chart, w, e)
	    }
	  }
	},
	// colors: colors,
	plotOptions: {
	  bar: {
	    columnWidth: '80%',
	    distributed: true,
	  }
	},
	dataLabels: {
	  enabled: false
	},
	legend: {
	  show: false
	},
	xaxis: {
	  categories: [
	    [label_productividad],[label_calidad],[label_servicio],[label_innovacion],
	  ],
	  labels: {
	    style: {
	      // colors: colors,
	      fontSize: '12px'
	    }
	  }
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño"), options);
	chart.render();
}

function grafica_semanal(semanal){
	var options = {
	  series: [{
	  data: [parseInt(semanal['average_productivity']),parseInt(semanal['average_quality']),parseInt(semanal['average_service']),parseInt(semanal['average_innovation'])]
	}],
	  chart: {
	  height: 350,
	  type: 'bar',
	  events: {
	    click: function(chart, w, e) {
	      // console.log(chart, w, e)
	    }
	  }
	},
	// colors: colors,
	plotOptions: {
	  bar: {
	    columnWidth: '80%',
	    distributed: true,
	  }
	},
	dataLabels: {
	  enabled: false
	},
	legend: {
	  show: false
	},
	xaxis: {
	  categories: [
	    [label_productividad],[label_calidad],[label_servicio],[label_innovacion],
	  ],
	  labels: {
	    style: {
	      // colors: colors,
	      fontSize: '12px'
	    }
	  }
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-semanal"), options);
	chart.render();
}

function grafica_generales(promedio){
	var options = {
	  series: [{
	  data: [promedio]
	}],
	  chart: {
	  height: 350,
	  type: 'bar',
	  events: {
	    click: function(chart, w, e) {
	      // console.log(chart, w, e)
	    }
	  }
	},
	// colors: colors,
	plotOptions: {
	  bar: {
	    columnWidth: '80%',
	    distributed: true,
	  }
	},
	dataLabels: {
	  enabled: false
	},
	legend: {
	  show: false
	},
	xaxis: {
	  categories: [
	    [''+promedio+''],
	  ],
	  labels: {
	    style: {
	      // colors: colors,
	      fontSize: '12px'
	    }
	  }
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-general"), options);
	chart.render();
}

function grafica_competencias(res){
	console.log(res);
	var categories = [];
	var average_qualification = [];

	for (i = 0; i < res['competency'].length; i++) {
		categories.push(res['competency'][i]);
		average_qualification.push(parseFloat(res['value'][i]));
	}

	var options = {
	  series: [{
	  	data: average_qualification
      }],
	  chart: {
	  type: 'bar',
	  height: 1200
	},
	plotOptions: {
	  bar: {
	    borderRadius: 4,
	    horizontal: true,
	  }
	},
	dataLabels: {
	  enabled: false
	},
	xaxis: {
	  categories
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-competencias"), options);
	chart.render();
}

function actualizar_datos(date){
	if(date == 1){
    	var data = $('.form-mision').serializeArray();
	}
	if(date == 2){
    	var data = $('.form-vision').serializeArray();
	}
	if(date == 3){
    	var data = $('.form-competitivas').serializeArray();
	}
	if(date == 4){
    	var data = $('.form-comparativas').serializeArray();
	}
	// if(date == 5){
    // 	var data = $('.form-resoluciones').serializeArray();
	// }
	// if(date == 6){
    // 	var data = $('.form-innovaciones').serializeArray();
	// }

	if(date <= 4){	
		data.push({name: 'user_id', value: $('.user_id').val()});
		data.push({name: 'date', value: date});

		$.ajax({
			url: base_url+'/employees/actualizar_datos',
			type: 'POST',
			dataType: 'JSON',
			data: data,
			success: function(res){
				if(res.status == 'ERROR'){
					$('.alert-text-error').html(res.message);
					$('.alert-danger').show();
					setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
				}
				if(res.status == 'OK'){
					$('.alert-text-exito').html(res.message);
					$('.alert-success').show();
					setTimeout(function(){ $('.alert-success').hide(); }, 2000);
				}
			}
		});
	}else{

		var csrfName = $('.txt_csrfname_foto').attr('name');
		var csrfHash = $('.txt_csrfname_foto').val();
		var csrfHash = $('.txt_csrfname_foto').val();

		var data = new FormData();
		data.append('user_id', $('.user_id').val());
		data.append('date', date);

		if(date == 5){
			var files = $('.imagen_resolucion')[0].files;

			data.append('resolution_id',$('.resolution_id').val());
			data.append('resolution',$('.resolution').val());
			data.append('description',$('.description').val());
			data.append('imagen_resolucion',files[0]);
		}

		if(date == 6){
			var files = $('.imagen_innovacion')[0].files;

			data.append('innovation_id',$('.innovation_id').val());
			data.append('innovation',$('.innovation').val());
			data.append('annual_value',$('.annual_value').val());
			data.append('description',$('.description_innovacion').val());
			data.append('imagen_innovacion',files[0]);
		}

		data.append([csrfName],csrfHash);

		$.ajax({
			url: base_url+'/employees/actualizar_datos',
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
					setTimeout(function(){ 
						$('.alert-success').hide(); 
						location.reload();
					}, 1000);
				}
			}
		});
	}
}

function delete_dato(type, id){
	var res = confirm(label_eliminar);

    if(res == true){
		$.ajax({
			url: base_url+'/employees/delete_dato',
			type: 'POST',
			dataType: 'JSON',
			data: {type: type, id: id},
			success: function(res){
				location.reload();
			}
		});
	}
}

function update_dato(type, dato1, dato2, dato3, dato4){
	if(type == 1){
		$('.resolution_id').val(dato1);
		$('.resolution').val(dato2);
		$('.description').val(dato3);
	}else if(type == 2){
		$('.innovation_id').val(dato1);
		$('.innovation').val(dato2);
		$('.description_innovacion').val(dato3);
		$('.annual_value').val(dato4);
	}
}

function modal_foto(user_id){
	$('.user_id_foto').val(user_id);
	$('.modal-foto').modal('show');
}

function add_foto(){
	// alert(label_favor_cargar);
	var files = $('.profile_picture')[0].files;

	var data = new FormData();
	var csrfName = $('.txt_csrfname_foto').attr('name');
	var csrfHash = $('.txt_csrfname_foto').val();
	var csrfHash = $('.txt_csrfname_foto').val();
	var user_id = $('.user_id').val();
	data.append('profile_picture',files[0]);
	data.append('user_id',user_id);
	data.append([csrfName],csrfHash);

	$('#loading').show();

	$.ajax({
		url: base_url+'/employees/add_foto',
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

function modal_video(user_id){
	$('.user_id_video').val(user_id);
	$('.modal-video').modal('show');
}

function add_video(){
	alert(label_favor_cargar_video);

	var files = $('.profile_video')[0].files;

	var data = new FormData();
	var csrfName = $('.txt_csrfname_video').attr('name');
	var csrfHash = $('.txt_csrfname_video').val();
	var csrfHash = $('.txt_csrfname_video').val();
	var user_id = $('.user_id').val();
	data.append('profile_video',files[0]);
	data.append('user_id',user_id);
	data.append([csrfName],csrfHash);

	$('#loading').show();

	$.ajax({
		url: base_url+'/employees/add_video',
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
		alert(label_validar_archivo);
		$('#loading').hide();
	});
}

function email_recuperar_password(email){
	$.ajax({
		url: base_url+'/employees/email_recuperar_password',
		type: 'POST',
		dataType: 'JSON',
		data: {email: email},
		success: function(res){
			alert(res.message);
			console.log(res.message);
			// location.reload();
		}
	});	
}

function modal_formulario(service_id){
	$('.service_id').val(service_id);
	$('.modal-formulario').modal('show');
}

function add_formulario(){
	alert(label_favor_cargar_documento);

	var files = $('.file_pdf')[0].files;

	var data = new FormData();
	var csrfName = $('.txt_csrfname_formulario').attr('name');
	var csrfHash = $('.txt_csrfname_formulario').val();
	var csrfHash = $('.txt_csrfname_formulario').val();
	var service_id = $('.service_id').val();
	data.append('file_pdf',files[0]);
	data.append('service_id',service_id);
	data.append([csrfName],csrfHash);

	$('#loading').show();

	$.ajax({
		url: base_url+'/employees/add_formulario',
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

function get_servicios(){
	// $('.tbody-datos tr').remove();
	$('.total_evaluaciones').text('');
	$.ajax({
		url: base_url+'/employees/get_servicios',
		type: 'POST',
		dataType: 'JSON',
		data: {user_id: $('.user_id').val(), position_id: $('.position_id').val()},
		success: function(res){
			$('.total_evaluaciones').text(res['total']['total']);
			get_ponderaciones(res['tasks_weighings']);
		}
	});	
}

function get_ponderaciones(tasks_weighings){
	percentage = [];
	service = [];
	weighing = [];
	weight_obtained = [];
	missing_weight = [];

	$.each(tasks_weighings, function(index, val) {
		if(val['average_productivity'] == null){
			val['average_productivity'] = 0;
		}
		if(val['average_quality'] == null){
			val['average_quality'] = 0;
		}
		if(val['average_innovation'] == null){
			val['average_innovation'] = 0;
		}
		if(val['average_service'] == null){
			val['average_service'] = 0;
		}

		porcentaje_weighings = parseFloat(val['average_productivity']) + parseFloat(val['average_quality']) + parseFloat(val['average_innovation']) + parseFloat(val['average_service']);
		porcentaje_weighings = porcentaje_weighings / 4;
		porcentaje_weighings = porcentaje_weighings.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
		porcentaje_weighings = precise_round(porcentaje_weighings, 2);

		res_weight_obtained = val['weighing'] * porcentaje_weighings;

		if( (res_weight_obtained == 0 && porcentaje_weighings == 0) || porcentaje_weighings == 0 ){
			res_weight_obtained = 0;
		}else{		
			res_weight_obtained = res_weight_obtained / 100;
			res_weight_obtained = res_weight_obtained.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
			res_weight_obtained = precise_round(res_weight_obtained, 2);
		}

		res_missing_weight = val['weighing'] - res_weight_obtained;
		res_missing_weight = res_missing_weight.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
		res_missing_weight = precise_round(res_missing_weight, 2);

		percentage.push(parseFloat(porcentaje_weighings));
		service.push(val['service']);
		weighing.push(parseFloat(val['weighing']));
		weight_obtained.push(parseFloat(parseFloat(res_weight_obtained)));
		missing_weight.push(parseFloat(parseFloat(res_missing_weight)));
	});

	var contador = Math.ceil(service.length / 10);
	for (i=0; i < contador; i++) {
	  $('.div-graficas').append('<div class="col-md-12 mb-1" style="text-align: center;">'
	    +'<div id="chart-ponderaciones-'+i+'" style="height: 450px!important;"></div>'
	  +'</div>');
	}

	grafica_ponderaciones(service, weight_obtained, missing_weight);
}

var pon = 0;

function grafica_ponderaciones(list_service, list_weight_obtained, list_missing_weight){
	var categories = [];
	var data_weight_obtained = [];
	var data_missing_weigh = [];

	if(list_service.length > 10){
		contador = 10;
	}else{
		contador = list_service.length;
	}

	for (i = 0; i < contador; i++) {
		categories.push(list_service[i]);
		data_weight_obtained.push(parseFloat(list_weight_obtained[i]));
		data_missing_weigh.push(parseFloat(list_missing_weight[i]));
	}

	// categories = JSON.stringify(categories);
	// data_weight_obtained = JSON.stringify(data_weight_obtained);
	// data_missing_weigh = JSON.stringify(data_missing_weigh);

	// console.log(categories);
	// console.log(data_weight_obtained);
	// console.log(data_missing_weigh);

	var options = {
	  series: [{
	  name: label_obtenido,
	  data: data_weight_obtained
	}, {
	  name: label_faltante,
	  data: data_missing_weigh
	}],
	  chart: {
	  type: 'bar',
	  height: 350,
	  stacked: true,
	},
	plotOptions: {
	  bar: {
	    horizontal: true,
	  },
	},
	stroke: {
	  width: 1,
	  colors: ['#fff']
	},
	title: {
	  text: ''
	},
	xaxis: {
	  categories,
	},
	yaxis: {
	  title: {
	    text: undefined
	  },
	},
	fill: {
	  opacity: 1
	},
	legend: {
	  position: 'top',
	  horizontalAlign: 'left',
	  offsetX: 40
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-ponderaciones-"+pon+""), options);
	chart.render();

	pon++;
	list_service = list_service.slice(10);
	list_weight_obtained = list_weight_obtained.slice(10);
	list_missing_weight = list_missing_weight.slice(10);

	if(list_service.length != 0){
		grafica_ponderaciones(list_service, list_weight_obtained, list_missing_weight);
	}
}