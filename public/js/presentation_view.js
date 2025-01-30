$(document).ready(function() {
  $('#datatable').DataTable();

  $('#loading').show();

  get_estadisticas();
  get_servicios();

  $('.slider-clientes').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.slider-valores').slick({
    dots: true,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.slider-testimonios').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.slider-innovaciones').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.slider-resolucion').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.slider-mecanismos').not('.slick-initialized').slick({
    dots: true,
    prevArrow: true,
    nextArrow: true,
    infinite: true,
    speed: 100,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 3000,
  });

  $('.slider-mecanismos-dos').not('.slick-initialized').slick({
    dots: true,
    prevArrow: true,
    nextArrow: true,
    infinite: true,
    speed: 100,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 3000,
  });

  $('.slider-quejas').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

});

function ver_funciones(){
  if($('.div_service').val() == 0){
    $('.collapse').show();
    $('.div_service').val(1);
  }else{
    $('.collapse').hide();
    $('.div_service').val(0);
  }
}

function graficar_competencias(list_competencias){
  console.log(list_competencias);

  if(list_competencias != ''){  
        var options = {
          series: [{
          data: [list_competencias[0][1],list_competencias[1][1],list_competencias[2][1],list_competencias[3][1],list_competencias[4][1],list_competencias[5][1],list_competencias[6][1],list_competencias[7][1],list_competencias[8][1],list_competencias[9][1]]
        }],
          chart: {
          type: 'bar',
          height: 500
        },
        plotOptions: {
          bar: {
            barHeight: '100%',
            distributed: true,
            horizontal: true,
            borderRadius: 4,
            dataLabels: {
              position: 'bottom'
            },
          }
        },
        colors: ['#008ffb', '#008ffb', '#008ffb', '#008ffb', '#008ffb', '#008ffb', '#008ffb', '#008ffb',
          '#008ffb', '#008ffb'
        ],
        dataLabels: {
          enabled: true,
          textAnchor: 'start',
          style: {
            colors: ['#fff']
          },
          formatter: function (val, opt) {
            return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
          },
          offsetX: 0,
          dropShadow: {
            enabled: false
          }
        },
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        xaxis: {
          categories: [list_competencias[0][0],list_competencias[1][0],list_competencias[2][0],list_competencias[3][0],list_competencias[4][0],list_competencias[5][0],list_competencias[6][0],list_competencias[7][0],list_competencias[8][0],list_competencias[9][0]],
        },
        yaxis: {
          labels: {
            show: false
          }
        },
        // title: {
        //     text: 'Custom DataLabels',
        //     align: 'center',
        //     floating: true
        // },
        // subtitle: {
        //     text: 'Category Names as DataLabels inside bars',
        //     align: 'center',
        // },
        tooltip: {
          theme: 'dark',
          x: {
            show: false
          },
          y: {
            title: {
              formatter: function () {
                return ''
              }
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#competencies_chart_me"), options);
        chart.render();
      
    
  }
}

function get_estadisticas(){
  $.ajax({
    url: base_url+'/employees/get_estadisticas',
    type: 'POST',
    dataType: 'JSON',
    data: {user_id: $('.user_id_presentation').val(), position_id: $('.position_id_presentation').val()},
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
        $('.slider-graficas').append('<div class="col-md-4 slider_grafica" style="text-align: center; background: white; margin-left: 5px!important; margin-right: 5px!important;">'
          +'<p>'+label_innovacion+'</p>'
          +'<div class="chart-innovacion-'+i+'" style="height: 50vh!important;"></div>'
        +'</div>');
      }
      grafica_innovacion(res['tasks_general'], $('.user_id').val());

      var contador = Math.ceil(item_servicio.length / 10);
      for (i=0; i < contador; i++) {
        $('.slider-graficas').append('<div class="col-md-4 slider_grafica" style="text-align: center; background: white; margin-left: 5px!important; margin-right: 5px!important;">'
          +'<p>'+label_servicio+'</p>'
          +'<div id="chart-servicio-'+i+'" style="height: 50vh!important;"></div>'
        +'</div>');
      }
      grafica_servicio(res['tasks_general'], $('.user_id').val());

      var contador = Math.ceil(item_calidad.length / 10);
      for (i=0; i < contador; i++) {
        $('.slider-graficas').append('<div class="col-md-4 slider_grafica" style="text-align: center; background: white; margin-left: 5px!important; margin-right: 5px!important;">'
          +'<p>'+label_calidad+'</p>'
          +'<div id="chart-calidad-'+i+'" style="height: 50vh!important;"></div>'
        +'</div>');
      }
      grafica_calidad(res['tasks_general'], $('.user_id').val());

      var contador = Math.ceil(item_produccion.length / 10);
      for (i=0; i < contador; i++) {
        $('.slider-graficas').append('<div class="col-md-4 slider_grafica" style="text-align: center; background: white; margin-left: 5px!important; margin-right: 5px!important;">'
          +'<p>'+label_productividad+'</p>'
          +'<div id="chart-productividad-'+i+'" style="height: 50vh!important;"></div>'
        +'</div>');
      }
      grafica_productividad(res['tasks_general'], $('.user_id').val());

      $('.slider-graficas').slick({
        dots: true,
        prevArrow: true,
        nextArrow: true,
        infinite: true,
        speed: 100,
        slidesToShow: 3,
        slidesToScroll: 3,
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
      height: 200,
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
    height: 200,
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
    height: 200,
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
    height: 200,
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
    height: 200,
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
    height: 200,
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
      [label_productividad],[label_calidad],[label_servicio],['Innovación'],
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
    height: 200,
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

function modal_cuestionario(){
  $('.modal_cuestionario').modal('show');
}

function cargar_excel_mecanismos(){
  var files = $('.archivo_excel')[0].files;

  var data = new FormData();
  var csrfName = $('.txt_csrfname_file').attr('name');
  var csrfHash = $('.txt_csrfname_file').val();
  var csrfHash = $('.txt_csrfname_file').val();
  var user_id = $('.user_id').val();
  data.append('archivo_excel',files[0]);
  data.append('user_id',user_id);
  data.append([csrfName],csrfHash);

  $('.btn-masivos-excel').prop('disabled', true);

  $.ajax({
    url: base_url+'/employees/cargar_excel_mecanismos',
      method: 'POST',
      data: data,
      contentType: false,
      processData: false,
      dataType: 'JSON',
      success: function(res){
        if(res.status == 'ERROR'){
          $('.btn-masivos-excel').prop('disabled', false);
          $('.alert-text-error').html(res.message);
          $('.alert-danger').show();
          setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
        }

        if(res.status == 'OK'){
          porcentaje = 100 / res.data.length;
          eliminar_mecanismos(res.data, porcentaje);
        }
      }
  });
}

function eliminar_mecanismos(data, porcentaje){
  $.ajax({
    url: base_url+'/employees/eliminar_mecanismos',
    type: 'POST',
    dataType: 'JSON',
    success: function(res){
      guardar_respuestas_mecanismos(data, porcentaje);
    }
  });
}

var total_porcentaje = 0;

function guardar_respuestas_mecanismos(data, porcentaje){
  $.ajax({
    url: base_url+'/employees/guardar_respuestas_mecanismos',
    type: 'POST',
    dataType: 'JSON',
    data: data[0],
    success: function(res){
      data = data.slice(1);
      if(data.length == 0){
        $('.alert-text-exito').html(label_guardaron_correctamente);
        $('.alert-success').show();
        setTimeout(function(){ location.reload(); }, 1000);
      }else{
        guardar_respuestas_mecanismos(data, porcentaje);
        barra_porcentaje(porcentaje);
      }
    }
  });
}

function guardar_calificacion(obj, satisfaction_response_id, chief_user_id){
  $.ajax({
    url: base_url+'/employees/guardar_calificacion',
    type: 'POST',
    dataType: 'JSON',
    data: $(obj).closest('form').serialize(),
    success: function(res){

        if(res.status == 'ERROR'){
          $('.alert-text-error-'+satisfaction_response_id+'-'+chief_user_id).html(res.message);
          $('.alert-danger-'+satisfaction_response_id+'-'+chief_user_id).show();
          setTimeout(function(){ $('.alert-danger-'+satisfaction_response_id+'-'+chief_user_id).hide(); }, 3000);
        }

        if(res.status == 'OK'){
          $('.alert-text-exito-'+satisfaction_response_id+'-'+chief_user_id).html(res.message);
          $('.alert-success-'+satisfaction_response_id+'-'+chief_user_id).show();
          setTimeout(function(){ $('.alert-success-'+satisfaction_response_id+'-'+chief_user_id).hide(); }, 3000);
        }

      $(obj).closest('form').find('.satisfaction_response_rating_id').val(res['satisfaction_response_rating_id']);
      $(obj).closest('form').find('.satisfaction_response_id').val(res['satisfaction_response_id']);
      $(obj).closest('form').find('.satisfaction_id').val(res['satisfaction_id']);
      $(obj).closest('form').find('.user_id').val(res['user_id']);
      $(obj).closest('form').find('.satisfaction_response_id').val(res['satisfaction_response_id']);
      $(obj).closest('form').find('.rating').val(res['rating']);
      $(obj).closest('form').find('.description').text(res['description']);
    }
  });
}

function barra_porcentaje(porcentaje){
    total_porcentaje = parseFloat(total_porcentaje) + parseFloat(porcentaje);
    total_porcentaje = total_porcentaje.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
    total_porcentaje = precise_round(total_porcentaje, 2);

    $('.progress-bar-mecanismos').css('width', total_porcentaje+'%');
    $('.progress-bar-mecanismos').attr('aria-valuenow', total_porcentaje);
    $('.progress-bar-mecanismos').text(total_porcentaje+'%');
}

function collapse(satisfaction_id){
  $('.collapse-'+satisfaction_id+'').collapse('toggle');
}

function collapse_chiefs(satisfaction_id, chief_id){
  // console.log(chief_id);
  $('.collapse_'+satisfaction_id+'_'+chief_id+'').collapse('toggle');
}

function get_servicios(){
  // $('.tbody-datos tr').remove();
  $('.total_evaluaciones').text('');
  $.ajax({
    url: base_url+'/employees/get_servicios',
    type: 'POST',
    dataType: 'JSON',
    data: {user_id: $('.user_id_presentation').val(), position_id: $('.position_id').val()},
    success: function(res){
      console.log(res);
      $('.total_evaluaciones').text(label_evaluaciones+': '+res['total']['total']);
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

  grafica_ponderaciones(service, weight_obtained, missing_weight);
}

function grafica_ponderaciones(list_service, list_weight_obtained, list_missing_weight){
  var categories = [];
  var data_weight_obtained = [];
  var data_missing_weigh = [];

  for (i = 0; i < list_service.length; i++) {
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

  var chart = new ApexCharts(document.querySelector("#chart-ponderaciones"), options);
  chart.render();
  
}

function ver_respuestas_empleados(satisfaction_response_id, pregunta){
  $('.tbody-datos tr').remove();
  $('#datatable').DataTable();
  
  $.ajax({
    url: base_url+'/employees/ver_respuestas_empleados',
    type: 'POST',
    dataType: 'JSON',
    data: {satisfaction_response_id: satisfaction_response_id},
    success: function(res){
      console.log(res);
      $('.text-respuesta').text(pregunta);

      $.each(res, function(index, val) {
        $('.tbody-datos').append('<tr>'
          +'<td>'+val.description+'</td>'
          +'<td>'+val.rating+'</td>'
        +'</tr>');
      });
      
      $('.modal-respuestas-empleados').modal('show');
    }
  });
  
}

function justIntegers(evt,input){
  // var charCode = (evt.which) ? evt.which : evt.keyCode
  // if (charCode > 31 && (charCode < 48 || charCode > 56)){
  //    return false;
  // }else{
  //    return true;
  // }
  
  var key = evt.charCode;
  console.log(key);
  return key >= 48 && key <= 57;
}

function justDecimals(e){
  var keynum = window.event ? window.event.keyCode : e.which;
  if ((keynum == 8) || (keynum == 46))
  return true;
  return /\d/.test(String.fromCharCode(keynum));
}

function precise_round(value, decPlaces) {
  var val = value * Math.pow(10, decPlaces);
  var fraction = (Math.round((val - parseInt(val)) * 10) / 10);

  if (fraction == -0.5) fraction = -0.6;

  val = Math.round(parseInt(val) + fraction) / Math.pow(10, decPlaces);
  return val;
}
