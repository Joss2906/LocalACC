$(document).ready(function() {
	$('.initial_date').datetimepicker({
		timepicker:false,
		format:'Y-m-d',
	});
	$('.final_date').datetimepicker({
		timepicker:false,
		format:'Y-m-d',
	});

	get_empleados_organizacion();
});

function load_datos(){
	window.open(base_url+'/statistics/statistics_employees_view/'+$('.user_id option:selected').val()+'/'+$('.user_id option:selected').data('position_id'), '_blank');

	// location.reload();
}

function get_servicios(){
	$('.tbody-datos tr').remove();
	$('.total_evaluaciones').text('');
	$.ajax({
		url: base_url+'/statistics/get_servicios',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			console.log(res);
			mejor_promedio = 0;
			total_services = 0;
			total_productivity = 0;
			total_quality = 0;
			total_innovation = 0;
			total_service = 0;

			get_ponderaciones(res['tasks_weighings']);

			if(res['tasks'] == '' || res['tasks'] == null){			
				$('.tbody-datos').append('<tr><td colspan="6">No se encontraron resultados</td></tr>');
			}else{
				$('.total_evaluaciones').text(res['total']['total']);

				$.each(res['tasks'], function(index, val) {
					$('.tbody-datos').append('<tr>'
						+'<td>'+val.service+'</td>'
						+'<td>'+val.average_productivity+'</td>'
						+'<td>'+val.average_quality+'</td>'
						+'<td>'+val.average_service+'</td>'
						+'<td>'+val.average_innovation+'</td>'
						+'<td>'+val.updated_at+'</td>'
					+'</tr>');

					total_productivity = parseFloat(total_productivity) + parseFloat(val.average_productivity);

					total_quality = parseFloat(total_quality) + parseFloat(val.average_quality);

					total_innovation = parseFloat(total_innovation) + parseFloat(val.average_innovation);

					total_service = parseFloat(total_service) + parseFloat(val.average_service);

				    total_services++;
				});

				total_productivity = total_productivity / total_services;
				total_productivity = total_productivity.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
			  total_productivity = precise_round(total_productivity, 2);

				total_quality = total_quality / total_services;
				total_quality = total_quality.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
			  total_quality = precise_round(total_quality, 2);

				total_innovation = total_innovation / total_services;
				total_innovation = total_innovation.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
			  total_innovation = precise_round(total_innovation, 2);

				total_service = total_service / total_services;
				total_service = total_service.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
			  total_service = precise_round(total_service, 2);

				mejor_promedio = parseFloat(total_productivity) + parseFloat(total_quality) + parseFloat(total_innovation) + parseFloat(total_service);

				mejor_promedio = mejor_promedio / 4;
				mejor_promedio = mejor_promedio.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
			  mejor_promedio = precise_round(mejor_promedio, 2);

				$('.tbody-datos').append('<tr>'
					+'<td>Totales</td>'
					+'<td>'+total_productivity+'</td>'
					+'<td>'+total_quality+'</td>'
					+'<td>'+total_service+'</td>'
					+'<td>'+total_innovation+'</td>'
					+'<td></td>'
				+'</tr>');

				get_estadisticas();

			}

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
	  $('.div-graficas').append('<div class="col-md-6 mb-1" style="text-align: center;">'
	    +'<p>'+label_servicios_funciones_ponderadas+'</p>'
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

function get_estadisticas(){
	$.ajax({
		url: base_url+'/statistics/get_estadisticas',
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

			grafica_generales(res['promedio'], res['employee']);
			grafica_semanal(res['semanal']);
			grafica_estadisticas(res['estadisticas']);

      var contador = Math.ceil(item_innovacion.length / 10);
      for (i=0; i < contador; i++) {
        $('.div-graficas').append('<div class="col-md-4 mb-3" style="text-align: center;">'
          +'<p>'+label_innovacion+'</p>'
          +'<div class="chart-innovacion-'+i+'" style="height: 200px!important;"></div>'
        +'</div>');
      }
      grafica_innovacion(res['tasks_general'], $('.user_id').val());

      var contador = Math.ceil(item_servicio.length / 10);
      for (i=0; i < contador; i++) {
        $('.div-graficas').append('<div class="col-md-4 mb-3" style="text-align: center;">'
          +'<p>'+label_servicio+'</p>'
          +'<div id="chart-servicio-'+i+'" style="height: 200px!important;"></div>'
        +'</div>');
      }
      grafica_servicio(res['tasks_general'], $('.user_id').val());

      var contador = Math.ceil(item_calidad.length / 10);
      for (i=0; i < contador; i++) {
        $('.div-graficas').append('<div class="col-md-4 mb-3" style="text-align: center;">'
          +'<p>'+label_calidad+'</p>'
          +'<div id="chart-calidad-'+i+'" style="height: 200px!important;"></div>'
        +'</div>');
      }
      grafica_calidad(res['tasks_general'], $('.user_id').val());

      var contador = Math.ceil(item_produccion.length / 10);
      for (i=0; i < contador; i++) {
        $('.div-graficas').append('<div class="col-md-4 mb-3" style="text-align: center;">'
          +'<p>'+label_productividad+'</p>'
          +'<div id="chart-productividad-'+i+'" style="height: 200px!important;"></div>'
        +'</div>');
      }
      grafica_productividad(res['tasks_general'], $('.user_id').val());

			get_competencias();
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
	    columnWidth: '45%',
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
	    columnWidth: '45%',
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
	    columnWidth: '45%',
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
	    columnWidth: '45%',
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
	  data: [parseFloat(estadisticas['average_productivity']),parseFloat(estadisticas['average_quality']),parseFloat(estadisticas['average_service']),parseFloat(estadisticas['average_innovation'])]
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
	    columnWidth: '45%',
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
	  data: [parseFloat(semanal['average_productivity']),parseFloat(semanal['average_quality']),parseFloat(semanal['average_service']),parseFloat(semanal['average_innovation'])]
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
	    columnWidth: '45%',
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

function grafica_generales(promedio, employee){
	if(employee['profile_picture'] == ''){
		image_url = base_url+'/public/fotos/foto_perfil.jpg';
	}else{
		image_url = base_url+'/public/fotos/'+employee['user_id']+'/'+employee['profile_picture'];
	}

	var options = {
	  series: [{
	  data: [promedio]
	}],
	  chart: {
	  height: 550,
	  type: 'bar',
	  events: {
	    click: function(chart, w, e) {
	      // console.log(chart, w, e)
	    }
	  }
	},
    grid: {
      borderColor: "#00447c"
    },
	fill: {
	  type: 'image',
	  image: {
	    src: [image_url],
	    // width: undefined,
	    // height: undefined
	  }
	},
	plotOptions: {
	  bar: {
	    columnWidth: '45%',
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
	var categories = [];
	var average_qualification = [];

	for (i = 0; i < res.length; i++) {
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
	colors: '#00447c',
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
	  categories: categories
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-competencias"), options);
	chart.render();
}

function get_empleados_organizacion(){
	$('.user_id option').remove();

	$.ajax({
		url: base_url+'/statistics/get_empleados_organizacion',
		type: 'POST',
		dataType: 'JSON',
		data: {organization_id: $('.organization_id option:selected').val()},
		success: function(res){
	    $('.user_id').append('<option value="">'+label_seleccionar+'</option>');

			$.each(res, function(index, val) {
				$('.user_id').append('<option data-position_id="'+val['position_id']+'" value="'+val['user_id']+'">'+val['first_name']+' '+val['second_name']+' '+val['last_name']+' '+val['second_last_name']+'</option>');
			});
		}
	});
}

function get_competencias(){
	$.ajax({
		url: base_url+'/employees/get_competencias',
		type: 'POST',
		dataType: 'JSON',
		data: {user_id: $('.user_id').val()},
		success: function(res){
			if(res != ''){
				grafica_competencias(res);
			}
		}
	});
}

function grafica_competencias(res){
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
	  categories: categories
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-competencias"), options);
	chart.render();
}

// scripts del panorama general

function get_grafica_general(){
	$('#loading').show();

	$.ajax({
		url: base_url+'/statistics/get_grafica_general',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			// console.log(res);
			var options = {
			  series: [{
			  data: [parseFloat(res['estadisticas']['average_productivity']),parseFloat(res['estadisticas']['average_quality']),parseFloat(res['estadisticas']['average_service']),parseFloat(res['estadisticas']['average_innovation'])]
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
			    columnWidth: '45%',
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

			var chart = new ApexCharts(document.querySelector("#chart-desempeño-general"), options);
			chart.render();
		}
	});
}

function get_grafica_educacion(){
	$.ajax({
		url: base_url+'/statistics/get_grafica_educacion',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			var data = [];

			var categories = [];
			var average_productivity = [];
			var average_quality = [];
			var average_service = [];
			var average_innovation = [];

			for (i = 0; i < res.length; i++) {
		   	categories.push(res[i]['schooling']);
		   	average_productivity.push(parseFloat(res[i]['average_productivity']));
		   	average_quality.push(parseFloat(res[i]['average_quality']));
		   	average_service.push(parseFloat(res[i]['average_service']));
		   	average_innovation.push(parseFloat(res[i]['average_innovation']));
			}

			var options = {
			  series: [{
			  name: label_productividad,
			  data: average_productivity
			}, {
			  name: label_calidad,
			  data: average_quality
			}, {
			  name: label_servicio,
			  data: average_service
			}, {
			  name: label_innovacion,
			  data: average_innovation
			}],
			  chart: {
			  type: 'bar',
			  height: 350
			},
			plotOptions: {
			  bar: {
			    horizontal: false,
			    columnWidth: '55%',
			    endingShape: 'rounded'
			  },
			},
			dataLabels: {
			  enabled: false
			},
			stroke: {
			  show: true,
			  width: 2,
			  colors: ['transparent']
			},
			xaxis: {
			  categories,
			},
			fill: {
			  opacity: 1
			}
			};

			var chart = new ApexCharts(document.querySelector("#chart-desempeño-educacion"), options);
			chart.render();
		}
	});
}

function get_grafica_edades(){
	$.ajax({
		url: base_url+'/statistics/get_grafica_edades',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			var data = [];

			var categories = [];
			var average_productivity = [];
			var average_quality = [];
			var average_service = [];
			var average_innovation = [];

			for (i = 0; i < res.length; i++) {
		   	categories.push(res[i]['age']);
		   	average_productivity.push(parseFloat(res[i]['average_productivity']));
		   	average_quality.push(parseFloat(res[i]['average_quality']));
		   	average_service.push(parseFloat(res[i]['average_service']));
		   	average_innovation.push(parseFloat(res[i]['average_innovation']));
			}

			var options = {
			  series: [{
			  name: label_productividad,
			  data: average_productivity
			}, {
			  name: label_calidad,
			  data: average_quality
			}, {
			  name: label_servicio,
			  data: average_service
			}, {
			  name: label_innovacion,
			  data: average_innovation
			}],
			  chart: {
			  type: 'bar',
			  height: 350
			},
			plotOptions: {
			  bar: {
			    horizontal: false,
			    columnWidth: '55%',
			    endingShape: 'rounded'
			  },
			},
			dataLabels: {
			  enabled: false
			},
			stroke: {
			  show: true,
			  width: 2,
			  colors: ['transparent']
			},
			xaxis: {
			  categories,
			},
			fill: {
			  opacity: 1
			}
			};

			var chart = new ApexCharts(document.querySelector("#chart-desempeño-edades"), options);
			chart.render();
		}
	});
}

function get_grafica_generos(){
	$.ajax({
		url: base_url+'/statistics/get_grafica_generos',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			var data = [];

			var categories = [];
			var average_productivity = [];
			var average_quality = [];
			var average_service = [];
			var average_innovation = [];

			for (i = 0; i < res.length; i++) {
		   	categories.push(res[i]['gender']);
		   	average_productivity.push(parseFloat(res[i]['average_productivity']));
		   	average_quality.push(parseFloat(res[i]['average_quality']));
		   	average_service.push(parseFloat(res[i]['average_service']));
		   	average_innovation.push(parseFloat(res[i]['average_innovation']));
			}

			var options = {
			  series: [{
			  name: label_productividad,
			  data: average_productivity
			}, {
			  name: label_calidad,
			  data: average_quality
			}, {
			  name: label_servicio,
			  data: average_service
			}, {
			  name: label_innovacion,
			  data: average_innovation
			}],
			  chart: {
			  type: 'bar',
			  height: 350
			},
			plotOptions: {
			  bar: {
			    horizontal: false,
			    columnWidth: '55%',
			    endingShape: 'rounded'
			  },
			},
			dataLabels: {
			  enabled: false
			},
			stroke: {
			  show: true,
			  width: 2,
			  colors: ['transparent']
			},
			xaxis: {
			  categories,
			},
			fill: {
			  opacity: 1
			}
			};

			var chart = new ApexCharts(document.querySelector("#chart-desempeño-generos"), options);
			chart.render();
		}
	});
}

function get_grafica_departamentos(){
	$.ajax({
		url: base_url+'/statistics/get_grafica_departamentos',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			departamentos(res);
		}
	});
}

var d=0;

function departamentos(res){
	var data = [];

	var categories = [];
	var average_productivity = [];
	var average_quality = [];
	var average_service = [];
	var average_innovation = [];

	$('.div-chart-departamentos').append('<div id="chart-desempeño-departamentos-'+d+'" style="height: 450px!important; "></div>');
	$('.div-chart-departamentos-productividad').append('<div id="chart-desempeño-departamentos-productividad-'+d+'" style="height: 400px!important; "></div>');
	$('.div-chart-departamentos-calidad').append('<div id="chart-desempeño-departamentos-calidad-'+d+'" style="height: 400px!important; "></div>');
	$('.div-chart-departamentos-servicio').append('<div id="chart-desempeño-departamentos-servicio-'+d+'" style="height: 400px!important; "></div>');
	$('.div-chart-departamentos-innovacion').append('<div id="chart-desempeño-departamentos-innovacion-'+d+'" style="height: 400px!important; "></div>');

	if(res.length > 10){
		contador = 10;
	}else{
		contador = res.length;
	}
	
	for (i = 0; i < contador; i++) {	
		categories.push(res[i]['department']);
		average_productivity.push(parseFloat(res[i]['average_productivity']));
		average_quality.push(parseFloat(res[i]['average_quality']));
		average_service.push(parseFloat(res[i]['average_service']));
		average_innovation.push(parseFloat(res[i]['average_innovation']));
	}

	var options = {
	  series: [{
	  name: label_productividad,
	  data: average_productivity
	}, {
	  name: label_calidad,
	  data: average_quality
	}, {
	  name: label_servicio,
	  data: average_service
	}, {
	  name: label_innovacion,
	  data: average_innovation
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-departamentos-"+d+""), options);
	chart.render();

	// productividad

	var options = {
	  series: [{
	  name: label_productividad,
	  data: average_productivity
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	colors: '#008ffb',
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-departamentos-productividad-"+d+""), options);
	chart.render();

	// calidad

	var options = {
	  series: [{
	  name: label_calidad,
	  data: average_quality
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	colors: '#25e6a5',
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-departamentos-calidad-"+d+""), options);
	chart.render();

	// servicio

	var options = {
	  series: [{
	  name: label_servicio,
	  data: average_service
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	colors: '#fcba39',
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-departamentos-servicio-"+d+""), options);
	chart.render();

	// innovacion

	var options = {
	  series: [{
	  name: label_innovacion,
	  data: average_innovation
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	colors: '#ff6178',
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-departamentos-innovacion-"+d+""), options);
	chart.render();

	d++;
	res = res.slice(10);

	if(res.length != 0){
		departamentos(res);
	}
}

function get_grafica_puestos(){
	$.ajax({
		url: base_url+'/statistics/get_grafica_puestos',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			puestos(res);
		}
	});
}

var p=0;

function puestos(res){
	var data = [];

	var categories = [];
	var average_productivity = [];
	var average_quality = [];
	var average_service = [];
	var average_innovation = [];

	$('.div-chart-puestos').append('<div id="chart-desempeño-puestos-'+p+'" style="height: 450px!important; "></div>');
	$('.div-chart-puestos-productividad').append('<div id="chart-desempeño-puestos-productividad-'+p+'" style="height: 400px!important; "></div>');
	$('.div-chart-puestos-calidad').append('<div id="chart-desempeño-puestos-calidad-'+p+'" style="height: 400px!important; "></div>');
	$('.div-chart-puestos-servicio').append('<div id="chart-desempeño-puestos-servicio-'+p+'" style="height: 400px!important; "></div>');
	$('.div-chart-puestos-innovacion').append('<div id="chart-desempeño-puestos-innovacion-'+p+'" style="height: 400px!important; "></div>');

	if(res.length > 10){
		contador = 10;
	}else{
		contador = res.length;
	}
	
	for (i = 0; i < contador; i++) {	
		categories.push(res[i]['position']);
		average_productivity.push(parseFloat(res[i]['average_productivity']));
		average_quality.push(parseFloat(res[i]['average_quality']));
		average_service.push(parseFloat(res[i]['average_service']));
		average_innovation.push(parseFloat(res[i]['average_innovation']));
	}

	var options = {
	  series: [{
	  name: label_productividad,
	  data: average_productivity
	}, {
	  name: label_calidad,
	  data: average_quality
	}, {
	  name: label_servicio,
	  data: average_service
	}, {
	  name: label_innovacion,
	  data: average_innovation
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-puestos-"+p+""), options);
	chart.render();

	// productividad

	var options = {
	  series: [{
	  name: label_productividad,
	  data: average_productivity
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	colors: '#008ffb',
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-puestos-productividad-"+p+""), options);
	chart.render();

	// calidad

	var options = {
	  series: [{
	  name: label_calidad,
	  data: average_quality
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	colors: '#25e6a5',
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-puestos-calidad-"+p+""), options);
	chart.render();

	// servicio

	var options = {
	  series: [{
	  name: label_servicio,
	  data: average_service
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	colors: '#fcba39',
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-puestos-servicio-"+p+""), options);
	chart.render();

	// innovacion

	var options = {
	  series: [{
	  name: label_innovacion,
	  data: average_innovation
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	colors: '#ff6178',
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-puestos-innovacion-"+p+""), options);
	chart.render();

	p++;
	res = res.slice(10);

	if(res.length != 0){
		puestos(res);
	}
}

function get_grafica_periodo(){
	$.ajax({
		url: base_url+'/statistics/get_grafica_periodo',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			var data = [];

			var categories = [];
			var average_productivity = [];
			var average_quality = [];
			var average_service = [];
			var average_innovation = [];

			var total_average_productivity = 0;
			var total_average_quality = 0;
			var total_average_service = 0;
			var total_average_innovation = 0;

			for (i = 0; i < res.length; i++) {
				if(res[i]['month'] == 'January'){
					month = 'Enero';
				}else if(res[i]['month'] == 'February'){
					month = 'Febrero';
				}else if(res[i]['month'] == 'March'){
					month = 'Marzo';
				}else if(res[i]['month'] == 'April'){
					month = 'Abril';
				}else if(res[i]['month'] == 'May'){
					month = 'Mayo';
				}else if(res[i]['month'] == 'June'){
					month = 'Junio';
				}else if(res[i]['month'] == 'July'){
					month = 'Julio';
				}else if(res[i]['month'] == 'August'){
					month = 'Agosto';
				}else if(res[i]['month'] == 'September'){
					month = 'Septiembre';
				}else if(res[i]['month'] == 'October'){
					month = 'Octubre';
				}else if(res[i]['month'] == 'November'){
					month = 'Noviembre';
				}else{
					month = 'Diciembre';
				}

		   	categories.push(month);
		   	average_productivity.push(parseFloat(res[i]['average_productivity']));
		   	average_quality.push(parseFloat(res[i]['average_quality']));
		   	average_service.push(parseFloat(res[i]['average_service']));
		   	average_innovation.push(parseFloat(res[i]['average_innovation']));

				var total_average_productivity = parseFloat(total_average_productivity) + parseFloat(res[i]['average_productivity']);
				var total_average_quality = parseFloat(total_average_quality) + parseFloat(res[i]['average_quality']);
				var total_average_service = parseFloat(total_average_service) + parseFloat(res[i]['average_service']);
				var total_average_innovation = parseFloat(total_average_innovation) + parseFloat(res[i]['average_innovation']);
			}

			if(res.length > 0){			
				var total_average_productivity = parseFloat(total_average_productivity) / res.length;
				// total_average_productivity = total_average_productivity.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
				// total_average_productivity = precise_round(total_average_productivity, 2);

				var total_average_quality = parseFloat(total_average_quality) / res.length;
				// total_average_quality = total_average_quality.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
				// total_average_quality = precise_round(total_average_quality, 2);

				var total_average_service = parseFloat(total_average_service) / res.length;
				// total_average_service = total_average_service.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
				// total_average_service = precise_round(total_average_service, 2);

				var total_average_innovation = parseFloat(total_average_innovation) / res.length;
				// total_average_innovation = total_average_innovation.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
				// total_average_innovation = precise_round(total_average_innovation, 2);
			}

	   	categories.push(label_promedio);
	   	average_productivity.push(parseFloat(total_average_productivity));
	   	average_quality.push(parseFloat(total_average_quality));
	   	average_service.push(parseFloat(total_average_service));
	   	average_innovation.push(parseFloat(total_average_innovation));

			var options = {
			  series: [{
			  name: label_productividad,
			  data: average_productivity
			}, {
			  name: label_calidad,
			  data: average_quality
			}, {
			  name: label_servicio,
			  data: average_service
			}, {
			  name: label_innovacion,
			  data: average_innovation
			}],
			  chart: {
			  type: 'bar',
			  height: 350
			},
			plotOptions: {
			  bar: {
			    horizontal: false,
			    columnWidth: '55%',
			    endingShape: 'rounded'
			  },
			},
			dataLabels: {
			  enabled: false
			},
			stroke: {
			  show: true,
			  width: 2,
			  colors: ['transparent']
			},
			xaxis: {
			  categories,
			},
			fill: {
			  opacity: 1
			}
			};

			var chart = new ApexCharts(document.querySelector("#chart-desempeño-periodo"), options);
			chart.render();

			// productividad

			var options = {
			  series: [{
			  name: label_productividad,
			  data: average_productivity
			}],
			  chart: {
			  type: 'bar',
			  height: 350
			},
    	colors: '#008ffb',
			plotOptions: {
			  bar: {
			    horizontal: false,
			    columnWidth: '55%',
			    endingShape: 'rounded'
			  },
			},
			dataLabels: {
			  enabled: false
			},
			stroke: {
			  show: true,
			  width: 2,
			  colors: ['transparent']
			},
			xaxis: {
			  categories,
			},
			fill: {
			  opacity: 1
			}
			};

			var chart = new ApexCharts(document.querySelector("#chart-desempeño-periodo-productividad"), options);
			chart.render();

			// calidad

			var options = {
			  series: [{
			  name: label_calidad,
			  data: average_quality
			}],
			  chart: {
			  type: 'bar',
			  height: 350
			},
    	colors: '#25e6a5',
			plotOptions: {
			  bar: {
			    horizontal: false,
			    columnWidth: '55%',
			    endingShape: 'rounded'
			  },
			},
			dataLabels: {
			  enabled: false
			},
			stroke: {
			  show: true,
			  width: 2,
			  colors: ['transparent']
			},
			xaxis: {
			  categories,
			},
			fill: {
			  opacity: 1
			}
			};

			var chart = new ApexCharts(document.querySelector("#chart-desempeño-periodo-calidad"), options);
			chart.render();

			// servicio

			var options = {
			  series: [{
			  name: label_servicio,
			  data: average_service
			}],
			  chart: {
			  type: 'bar',
			  height: 350
			},
    	colors: '#fcba39',
			plotOptions: {
			  bar: {
			    horizontal: false,
			    columnWidth: '55%',
			    endingShape: 'rounded'
			  },
			},
			dataLabels: {
			  enabled: false
			},
			stroke: {
			  show: true,
			  width: 2,
			  colors: ['transparent']
			},
			xaxis: {
			  categories,
			},
			fill: {
			  opacity: 1
			}
			};

			var chart = new ApexCharts(document.querySelector("#chart-desempeño-periodo-servicio"), options);
			chart.render();

			// innovacion

			var options = {
			  series: [{
			  name: label_innovacion,
			  data: average_innovation
			}],
			  chart: {
			  type: 'bar',
			  height: 350
			},
    	colors: '#ff6178',
			plotOptions: {
			  bar: {
			    horizontal: false,
			    columnWidth: '55%',
			    endingShape: 'rounded'
			  },
			},
			dataLabels: {
			  enabled: false
			},
			stroke: {
			  show: true,
			  width: 2,
			  colors: ['transparent']
			},
			xaxis: {
			  categories,
			},
			fill: {
			  opacity: 1
			}
			};

			var chart = new ApexCharts(document.querySelector("#chart-desempeño-periodo-innovacion"), options);
			chart.render();
		}
	});
}

function get_grafica_empleados(){
	$.ajax({
		url: base_url+'/statistics/get_grafica_empleados',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			empleados(res);
		}
	});
}

var e=0;

function empleados(res){
	var data = [];

	var categories = [];
	var average_productivity = [];
	var average_quality = [];
	var average_service = [];
	var average_innovation = [];

	$('.div-chart-empleados').append('<div id="chart-desempeño-empleados-'+e+'" style="height: 450px!important; "></div>');
	$('.div-chart-empleados-productividad').append('<div id="chart-desempeño-empleados-productividad-'+e+'" style="height: 400px!important; "></div>');
	$('.div-chart-empleados-calidad').append('<div id="chart-desempeño-empleados-calidad-'+e+'" style="height: 400px!important; "></div>');
	$('.div-chart-empleados-servicio').append('<div id="chart-desempeño-empleados-servicio-'+e+'" style="height: 400px!important; "></div>');
	$('.div-chart-empleados-innovacion').append('<div id="chart-desempeño-empleados-innovacion-'+e+'" style="height: 400px!important; "></div>');

	if(res.length > 10){
		contador = 10;
	}else{
		contador = res.length;
	}
	
	for (i = 0; i < contador; i++) {	
		categories.push(res[i]['name']);
		average_productivity.push(parseFloat(res[i]['average_productivity']));
		average_quality.push(parseFloat(res[i]['average_quality']));
		average_service.push(parseFloat(res[i]['average_service']));
		average_innovation.push(parseFloat(res[i]['average_innovation']));
	}

	var options = {
	  series: [{
	  name: label_productividad,
	  data: average_productivity
	}, {
	  name: label_calidad,
	  data: average_quality
	}, {
	  name: label_servicio,
	  data: average_service
	}, {
	  name: label_innovacion,
	  data: average_innovation
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-empleados-"+e+""), options);
	chart.render();

	// productividad

	var options = {
	  series: [{
	  name: label_productividad,
	  data: average_productivity
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	colors: '#008ffb',
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-empleados-productividad-"+e+""), options);
	chart.render();

	// calidad

	var options = {
	  series: [{
	  name: label_calidad,
	  data: average_quality
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	colors: '#25e6a5',
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-empleados-calidad-"+e+""), options);
	chart.render();

	// servicio

	var options = {
	  series: [{
	  name: label_servicio,
	  data: average_service
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	colors: '#fcba39',
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-empleados-servicio-"+e+""), options);
	chart.render();

	// innovacion

	var options = {
	  series: [{
	  name: label_innovacion,
	  data: average_innovation
	}],
	  chart: {
	  type: 'bar',
	  height: 350
	},
	colors: '#ff6178',
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	    endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories,
	},
	fill: {
	  opacity: 1
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart-desempeño-empleados-innovacion-"+e+""), options);
	chart.render();

	e++;
	res = res.slice(10);

	if(res.length != 0){
		empleados(res);
	}
}

function get_grafica_competencias(res){
	$.ajax({
		url: base_url+'/statistics/get_grafica_competencias',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			console.log(res);
			var data = [];

			var categories = [];
			var average_qualification = [];

			for (i = 0; i < res.length; i++) {
		   	categories.push(res[i]['competency']);
		   	average_qualification.push(parseFloat(res[i]['qualification']));
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
	});
}

function get_grafica_general_clientes(){
	$.ajax({
		url: base_url+'/statistics/get_grafica_general_clientes',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			// console.log(res);
			var options = {
			  series: [{
			  data: [parseFloat(res['estadisticas']['average_productivity']),parseFloat(res['estadisticas']['average_quality']),parseFloat(res['estadisticas']['average_service']),parseFloat(res['estadisticas']['average_innovation'])]
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
			    columnWidth: '45%',
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

			var chart = new ApexCharts(document.querySelector("#chart-desempeño-clientes"), options);
			chart.render();
		}
	});
}

function get_grafica_general_proveedores(){
	$.ajax({
		url: base_url+'/statistics/get_grafica_general_proveedores',
		type: 'POST',
		dataType: 'JSON',
		data: $('.form-datos').serialize(),
		success: function(res){
			// console.log(res);
			var options = {
			  series: [{
			  data: [parseFloat(res['estadisticas']['average_productivity']),parseFloat(res['estadisticas']['average_quality']),parseFloat(res['estadisticas']['average_service']),parseFloat(res['estadisticas']['average_innovation'])]
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
			    columnWidth: '45%',
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

			var chart = new ApexCharts(document.querySelector("#chart-desempeño-proveedores"), options);
			chart.render();
			$('#loading').hide();
		}
	});
}