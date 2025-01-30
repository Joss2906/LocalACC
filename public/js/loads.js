function descargar_archivo(){
  text = $('.alert-text-error').text();

  var element = document.createElement('a');
  element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
  element.setAttribute('download', ''+label_listado+'');
  element.style.display = 'none';
  document.body.appendChild(element);
  element.click();
  document.body.removeChild(element);
}

var total_porcentaje = 0;

function barra_porcentaje(porcentaje){
    total_porcentaje = parseFloat(total_porcentaje) + parseFloat(porcentaje);
    total_porcentaje = total_porcentaje.toString().match(/^-?\d+(?:\.\d{0,3})?/)[0];
    total_porcentaje = precise_round(total_porcentaje, 2);

    $('.progress-bar-mecanismos').css('width', total_porcentaje+'%');
    $('.progress-bar-mecanismos').attr('aria-valuenow', total_porcentaje);
    $('.progress-bar-mecanismos').text(total_porcentaje+'%');
}

function validar_documento(){
  var files = $('.archivo_excel')[0].files;

  var data = new FormData();
  var csrfName = $('.txt_csrfname_file').attr('name');
  var csrfHash = $('.txt_csrfname_file').val();
  var csrfHash = $('.txt_csrfname_file').val();
  data.append('archivo_excel',files[0]);
  data.append([csrfName],csrfHash);

  $('.btn-form').prop('disabled', true);

  $.ajax({
    url: base_url+'/loads/validar_documento',
      method: 'POST',
      data: data,
      contentType: false,
      processData: false,
      dataType: 'JSON',
      success: function(res){
        $('.btn-form').prop('disabled', false);
        
        if(res.status == 'ERROR'){
          $('.alert-text-error').html(res.message);
          $('.alert-danger').show();
          setTimeout(function(){ $('.alert-danger').hide(); }, 4000);
        }else{  
          if(res['organizations'] == undefined){
            $('.alert-text-error').html(loads_1);
            $('.alert-danger').show();
            descargar_archivo();
            setTimeout(function(){ location.reload(); }, 4000);
          }else{
            if(res['departments'] == undefined){
              $('.alert-text-error').html(loads_2);
              $('.alert-danger').show();
              descargar_archivo();
              setTimeout(function(){ location.reload(); }, 4000);
            }else{
              if(res['positions'] == undefined){
                $('.alert-text-error').html(loads_3);
                $('.alert-danger').show();
                descargar_archivo();
                setTimeout(function(){ location.reload(); }, 4000);
              }else{
                if(res['users'] == undefined){
                  $('.alert-text-error').html(loads_4);
                  $('.alert-danger').show();
                  descargar_archivo();
                  setTimeout(function(){ location.reload(); }, 4000);
                }else{
                  if(res['employees'] == undefined){
                    $('.alert-text-error').html(loads_5);
                    $('.alert-danger').show();
                    descargar_archivo();
                    setTimeout(function(){ location.reload(); }, 4000);
                  }else{
                    if(res['employees_competencies'] == undefined){
                      $('.alert-text-error').html(loads_6);
                      $('.alert-danger').show();
                      descargar_archivo();
                      setTimeout(function(){ location.reload(); }, 4000);
                    }else{
                      if(res['innovations'] == undefined){
                        $('.alert-text-error').html(loads_7);
                        $('.alert-danger').show();
                        descargar_archivo();
                        setTimeout(function(){ location.reload(); }, 4000);
                      }else{
                        if(res['resolutions'] == undefined){
                          $('.alert-text-error').html(loads_8);
                          $('.alert-danger').show();
                          descargar_archivo();
                          setTimeout(function(){ location.reload(); }, 4000);
                        }else{
                          if(res['services'] == undefined){
                            $('.alert-text-error').html(loads_9);
                            $('.alert-danger').show();
                            descargar_archivo();
                            setTimeout(function(){ location.reload(); }, 4000);
                          }else{
                            if(res['emails'] == 'error'){
                              $('.alert-text-error').html(loads_10);
                              $('.alert-danger').show();
                              descargar_archivo();
                              setTimeout(function(){ location.reload(); }, 4000);
                            }else{
                              if(res['emails_registrados'] != ''){
                                $('.alert-text-error').html(res['emails_registrados']);
                                $('.alert-danger').show();
                                descargar_archivo();
                                setTimeout(function(){ location.reload(); }, 4000);
                              }else{                              
                                validar_organizacion(res);
                                barra_porcentaje(5.26);
                              }
                            }
                          }
                        }
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

function validar_organizacion(data){
  formData = new FormData();

  formData.append('organization', data['organizations']['organization']);

  if(data['organizations']['maturity_id'] != '' && data['organizations']['maturity_id'] != null){
    formData.append('maturity_id', data['organizations']['maturity_id'][0]);
  }else{
    formData.append('maturity_id', '');
  }

  $.ajax({
    url: base_url+'/loads/validar_organizacion',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();

        html2canvas(document.body, {
          onrendered (canvas) {
            var link = document.getElementById('alert-danger');
            var image = canvas.toDataURL();
            link.href = image;
            link.download = 'screenshot.png';
          }
        });

        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_departaments = data['departments'];
        validar_departamentos(data, list_departaments);
        barra_porcentaje(5.26);
      }
    }
  });
}

function validar_departamentos(data, list_departaments){
  // console.log(list_departaments);
  formData = new FormData();
  if(list_departaments == ''){
    formData.append('department', '');
  }else{
    formData.append('department', list_departaments[0]);
  }

  $.ajax({
    url: base_url+'/loads/validar_departamentos',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_departaments = list_departaments.slice(1);

        if(list_departaments.length == 0){
          list_positions = data['positions'];
          validar_puestos(data, list_positions);
          barra_porcentaje(5.26);
        }else{
          validar_departamentos(data, list_departaments);
        }
      }
    }
  });
}

function validar_puestos(data, list_positions){
  formData = new FormData();
  if(list_positions == ''){
    formData.append('position', '');
  }else{
    formData.append('position', list_positions[0]);
  }
  
  $.ajax({
    url: base_url+'/loads/validar_puestos',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_positions = list_positions.slice(1);

        if(list_positions.length == 0){
          list_users = data['users'];
          validar_usuarios(data, list_users);
          barra_porcentaje(5.26);
        }else{
          validar_puestos(data, list_positions);
        }
      }
    }
  });
}

function validar_usuarios(data, list_users){
  formData = new FormData();
  console.log(data);
  console.log(list_users);
  formData.append('user', list_users[0]['user']);
  formData.append('password', list_users[0]['password']);

  // formData.append('credential_id', list_users[0]['credential_id'][0]);
  if(list_users[0]['credential_id'] != '' && list_users[0]['credential_id'] != null){
    formData.append('credential_id', list_users[0]['credential_id'][0]);
  }else{
    formData.append('credential_id', '');
  }

  $.ajax({
    url: base_url+'/loads/validar_usuarios',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_users = list_users.slice(1);

        if(list_users.length == 0){
          list_employees = data['employees'];
          validar_empleados(data, list_employees);
          barra_porcentaje(5.26);
        }else{
          validar_usuarios(data, list_users);
        }
      }
    }
  });
}

function validar_empleados(data, list_employees){
  formData = new FormData();

  formData.append('first_name', list_employees[0]['first_name']);
  formData.append('second_name', list_employees[0]['second_name']);
  formData.append('last_name', list_employees[0]['last_name']);
  formData.append('second_last_name', list_employees[0]['second_last_name']);
  formData.append('business_name', list_employees[0]['business_name']);
  formData.append('gender_id', list_employees[0]['gender_id']);
  formData.append('birthday', list_employees[0]['birthday']);
  formData.append('email', list_employees[0]['email']);
  formData.append('street', list_employees[0]['street']);
  formData.append('number', list_employees[0]['number']);
  formData.append('suburb', list_employees[0]['suburb']);
  formData.append('estate', list_employees[0]['estate']);
  formData.append('delegation', list_employees[0]['delegation']);
  formData.append('country_id', list_employees[0]['country_id']);
  formData.append('nationality_id', list_employees[0]['nationality_id']);
  formData.append('postal_code', list_employees[0]['postal_code']);
  formData.append('phone', list_employees[0]['phone']);
  formData.append('mobile', list_employees[0]['mobile']);

  if(list_employees[0]['civil_status_id'] != '' && list_employees[0]['civil_status_id'] != null){
    formData.append('civil_status_id', list_employees[0]['civil_status_id'][0]);
  }else{
    formData.append('civil_status_id', '');
  }

  formData.append('economic_dependents', list_employees[0]['economic_dependents']);

  // if(list_employees[0]['type_user_id'] != '' && list_employees[0]['type_user_id'] != null){
  //   formData.append('type_user_id', list_employees[0]['type_user_id'][0]);
  // }else{
  //   formData.append('type_user_id', '');
  // }

  formData.append('salary_amount', list_employees[0]['salary_amount']);
  formData.append('social_security', list_employees[0]['social_security']);
  formData.append('benefit_1', list_employees[0]['benefit_1']);
  formData.append('benefit_amount_1', list_employees[0]['benefit_amount_1']);
  formData.append('benefit_2', list_employees[0]['benefit_2']);
  formData.append('benefit_amount_2', list_employees[0]['benefit_amount_2']);
  formData.append('benefit_3', list_employees[0]['benefit_3']);
  formData.append('benefit_amount_3', list_employees[0]['benefit_amount_3']);
  formData.append('benefit_4', list_employees[0]['benefit_4']);
  formData.append('benefit_amount_4', list_employees[0]['benefit_amount_4']);
  formData.append('total', list_employees[0]['total']);
  formData.append('position_id', list_employees[0]['position_id']);
  formData.append('date_admission', list_employees[0]['date_admission']);

  if(list_employees[0]['schooling_id'] != '' && list_employees[0]['schooling_id'] != null){
    formData.append('schooling_id', list_employees[0]['schooling_id'][0]);
  }else{
    formData.append('schooling_id', '');
  }
  formData.append('department_id', list_employees[0]['department_id']);
  formData.append('disc', list_employees[0]['disc']);
  formData.append('mission', list_employees[0]['mission']);
  formData.append('vision', list_employees[0]['benefit_amount_4']);
  formData.append('competitive_advantages', list_employees[0]['competitive_advantages']);
  formData.append('comparative_advantages', list_employees[0]['comparative_advantages']);

  $.ajax({
    url: base_url+'/loads/validar_empleados',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_employees = list_employees.slice(1);

        if(list_employees.length == 0){
          list_employees_competencies = data['employees_competencies'];
          validar_calificaciones(data, list_employees_competencies);
          barra_porcentaje(5.26);
        }else{
          validar_empleados(data, list_employees);
        }
      }
    }
  });
}

function validar_calificaciones(data, list_employees_competencies){
  formData = new FormData();

  j = 1;
  for (i = 0; i < 50; i++) {
    formData.append('competency_id'+j, list_employees_competencies[0]['competency_id'][i]);
    formData.append('qualification'+j, list_employees_competencies[0]['qualification'][i]);
    j++;
  }

  $.ajax({
    url: base_url+'/loads/validar_calificaciones',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_employees_competencies = list_employees_competencies.slice(1);

        if(list_employees_competencies.length == 0){
          list_innovations = data['innovations'];
          validar_innovaciones(data, list_innovations);
          barra_porcentaje(5.26);
        }else{
          validar_calificaciones(data, list_employees_competencies);
        }
      }
    }
  });
}

function validar_innovaciones(data, list_innovations){
  formData = new FormData();

  for(i = 0; i < list_innovations[0]['annual_value'].length; i++) {
    formData.append('annual_value'+i, list_innovations[0]['annual_value'][i]);
    formData.append('description'+i, list_innovations[0]['description'][i]);
    formData.append('innovation'+i, list_innovations[0]['innovation'][i]);
  }

  formData.append('total', i);

  $.ajax({
    url: base_url+'/loads/validar_innovaciones',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_innovations = list_innovations.slice(1);

        if(list_innovations.length == 0){
          list_resolutions = data['resolutions'];
          validar_resoluciones(data, list_resolutions);
          barra_porcentaje(5.26);
        }else{
          validar_innovaciones(data, list_innovations);
        }
      }
    }
  });
}

function validar_resoluciones(data, list_resolutions){
  formData = new FormData();

  for(i = 0; i < list_resolutions[0]['resolution'].length; i++) {
    formData.append('resolution'+i, list_resolutions[0]['resolution'][i]);
    formData.append('description'+i, list_resolutions[0]['description'][i]);
  }
  
  formData.append('total', i);

  $.ajax({
    url: base_url+'/loads/validar_resoluciones',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_resolutions = list_resolutions.slice(1);

        if(list_resolutions.length == 0){
          list_services = data['services'];
          validar_servicios(data, list_services);
          barra_porcentaje(5.26);
        }else{
          validar_resoluciones(data, list_resolutions);
        }
      }
    }
  });
}

function validar_servicios(data, list_services){
  formData = new FormData();

  for(i = 0; i < list_services[0]['description'].length; i++) {
    formData.append('description'+i, list_services[0]['description'][i]);
    formData.append('frequency'+i, list_services[0]['frequency'][i]);
    formData.append('monthly_amount'+i, list_services[0]['monthly_amount'][i]);
    formData.append('productivity'+i, list_services[0]['productivity'][i]);
    formData.append('quality'+i, list_services[0]['quality'][i]);
    formData.append('innovation'+i, list_services[0]['innovation'][i]);
    formData.append('service'+i, list_services[0]['service'][i]);
  }
  
  formData.append('total', i);

  $.ajax({
    url: base_url+'/loads/validar_servicios',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_services = list_services.slice(1);

        if(list_services.length == 0){
          guardar_organizacion(data);
          barra_porcentaje(5.26);
        }else{
          validar_servicios(data, list_services);
        }
      }
    }
  });
}

var organization_id;

function guardar_organizacion(data){
  formData = new FormData();

  formData.append('organization', data['organizations']['organization']);
  formData.append('maturity_id', data['organizations']['maturity_id'][0]);

  $.ajax({
    url: base_url+'/loads/guardar_organizacion',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();

        html2canvas(document.body, {
          onrendered (canvas) {
            var link = document.getElementById('alert-danger');
            var image = canvas.toDataURL();
            link.href = image;
            link.download = 'screenshot.png';
          }
        });

        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        organization_id = res;
        barra_porcentaje(5.26);
        list_departaments = data['departments'];
        guardar_departamentos(data, list_departaments);
      }
    }
  });
}

var departaments_push = [];
var num_departament = 0;
function guardar_departamentos(data, list_departaments){
  formData = new FormData();

  formData.append('department', list_departaments[0]);
  formData.append('organization_id', organization_id);

  $.ajax({
    url: base_url+'/loads/guardar_departamentos',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_departaments = list_departaments.slice(1);

        departaments_push[num_departament] = res;
        num_departament++;

        if(list_departaments.length == 0){
          list_positions = data['positions'];
          guardar_puestos(data, list_positions);
          barra_porcentaje(5.26);
        }else{
          guardar_departamentos(data, list_departaments);
        }
      }
    }
  });
}

var positions_push = [];
var num_position = 0;
function guardar_puestos(data, list_positions){
  formData = new FormData();

  formData.append('position', list_positions[0]);
  formData.append('organization_id', organization_id);

  $.ajax({
    url: base_url+'/loads/guardar_puestos',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_positions = list_positions.slice(1);

        positions_push[num_position] = res;
        num_position++;

        if(list_positions.length == 0){
          list_users = data['users'];
          guardar_usuarios(data, list_users);
          barra_porcentaje(5.26);
        }else{
          guardar_puestos(data, list_positions);
        }
      }
    }
  });
}

var users_push = [];
var num_user = 0;
function guardar_usuarios(data, list_users){
  formData = new FormData();

  formData.append('user', list_users[0]['user']);
  formData.append('password', list_users[0]['password']);
  formData.append('credential_id', list_users[0]['credential_id'][0]);

  $.ajax({
    url: base_url+'/loads/guardar_usuarios',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_users = list_users.slice(1);

        users_push[num_user] = res;
        num_user++;

        if(list_users.length == 0){
          list_employees = data['employees'];
          users_push_list = users_push;
          guardar_empleados(data, list_employees, users_push_list);
          barra_porcentaje(5.26);
        }else{
          guardar_usuarios(data, list_users);
        }
      }
    }
  });
}

function guardar_empleados(data, list_employees, users_push_list){
  formData = new FormData();

  formData.append('organization_id', organization_id);
  formData.append('user_id', users_push_list[0]['user_id']);
  formData.append('employee_id', users_push_list[0]['employee_id']);
  formData.append('first_name', list_employees[0]['first_name']);
  formData.append('second_name', list_employees[0]['second_name']);
  formData.append('last_name', list_employees[0]['last_name']);
  formData.append('second_last_name', list_employees[0]['second_last_name']);
  formData.append('business_name', list_employees[0]['business_name']);
  formData.append('gender_id', list_employees[0]['gender_id']);
  formData.append('birthday', list_employees[0]['birthday']);
  formData.append('email', list_employees[0]['email']);
  formData.append('street', list_employees[0]['street']);
  formData.append('number', list_employees[0]['number']);
  formData.append('suburb', list_employees[0]['suburb']);
  formData.append('estate', list_employees[0]['estate']);
  formData.append('delegation', list_employees[0]['delegation']);
  formData.append('country_id', list_employees[0]['country_id'].substr(0,3));
  formData.append('nationality_id', list_employees[0]['nationality_id'].substr(0,3));
  formData.append('postal_code', list_employees[0]['postal_code']);
  formData.append('phone', list_employees[0]['phone']);
  formData.append('mobile', list_employees[0]['mobile']);
  formData.append('civil_status_id', list_employees[0]['civil_status_id'][0]);
  formData.append('economic_dependents', list_employees[0]['economic_dependents']);
  // formData.append('type_user_id', list_employees[0]['type_user_id'][0]);
  formData.append('salary_amount', list_employees[0]['salary_amount']);
  formData.append('social_security', list_employees[0]['social_security']);
  formData.append('benefit_1', list_employees[0]['benefit_1']);
  formData.append('benefit_amount_1', list_employees[0]['benefit_amount_1']);
  formData.append('benefit_2', list_employees[0]['benefit_2']);
  formData.append('benefit_amount_2', list_employees[0]['benefit_amount_2']);
  formData.append('benefit_3', list_employees[0]['benefit_3']);
  formData.append('benefit_amount_3', list_employees[0]['benefit_amount_3']);
  formData.append('benefit_4', list_employees[0]['benefit_4']);
  formData.append('benefit_amount_4', list_employees[0]['benefit_amount_4']);
  formData.append('total', list_employees[0]['total']);

  $.each(positions_push, function(index, val) {
    if(val['position'] == list_employees[0]['position_id']){
      formData.append('position_id', val['position_id']);
    }
  });

  formData.append('date_admission', list_employees[0]['date_admission']);
  formData.append('schooling_id', list_employees[0]['schooling_id'][0]);

  $.each(departaments_push, function(index, val) {
    if(val['department'] == list_employees[0]['department_id']){
      formData.append('department_id', val['department_id']);
    }
  });

  formData.append('disc', list_employees[0]['disc']);
  formData.append('mission', list_employees[0]['mission']);
  formData.append('vision', list_employees[0]['vision']);
  formData.append('competitive_advantages', list_employees[0]['competitive_advantages']);
  formData.append('comparative_advantages', list_employees[0]['comparative_advantages']);

  $.ajax({
    url: base_url+'/loads/guardar_empleados',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_employees = list_employees.slice(1);
        users_push_list = users_push_list.slice(1);

        if(list_employees.length == 0){
          list_employees_competencies = data['employees_competencies'];
          users_push_list = users_push;
          guardar_calificaciones(data, list_employees_competencies, users_push_list);
          barra_porcentaje(5.26);
        }else{
          guardar_empleados(data, list_employees, users_push_list);
        }
      }
    }
  });
}

function guardar_calificaciones(data, list_employees_competencies, users_push_list){
  formData = new FormData();

  j = 1;
  for (i = 0; i < 50; i++) {
    formData.append('user_id'+j, users_push_list[0]['user_id']);
    formData.append('competency_id'+j, list_employees_competencies[0]['competency_id'][i]);
    formData.append('qualification'+j, list_employees_competencies[0]['qualification'][i]);
    j++;
  }

  $.ajax({
    url: base_url+'/loads/guardar_calificaciones',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_employees_competencies = list_employees_competencies.slice(1);
        users_push_list = users_push_list.slice(1);

        if(list_employees_competencies.length == 0){
          list_innovations = data['innovations'];
          users_push_list = users_push;
          guardar_innovaciones(data, list_innovations, users_push_list);
          barra_porcentaje(5.26);
        }else{
          guardar_calificaciones(data, list_employees_competencies, users_push_list);
        }
      }
    }
  });
}

function guardar_innovaciones(data, list_innovations, users_push_list){
  formData = new FormData();

  for(i = 0; i < list_innovations[0]['annual_value'].length; i++) {
    formData.append('user_id'+i, users_push_list[0]['user_id']);
    formData.append('annual_value'+i, list_innovations[0]['annual_value'][i]);
    formData.append('description'+i, list_innovations[0]['description'][i]);
    formData.append('innovation'+i, list_innovations[0]['innovation'][i]);
  }

  formData.append('total', i);

  $.ajax({
    url: base_url+'/loads/guardar_innovaciones',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_innovations = list_innovations.slice(1);
        users_push_list = users_push_list.slice(1);

        if(list_innovations.length == 0){
          list_resolutions = data['resolutions'];
          users_push_list = users_push;
          guardar_resoluciones(data, list_resolutions, users_push_list);
          barra_porcentaje(5.26);
        }else{
          guardar_innovaciones(data, list_innovations, users_push_list);
        }
      }
    }
  });
}

function guardar_resoluciones(data, list_resolutions, users_push_list){
  formData = new FormData();

  for(i = 0; i < list_resolutions[0]['resolution'].length; i++) {
    formData.append('user_id'+i, users_push_list[0]['user_id']);
    formData.append('resolution'+i, list_resolutions[0]['resolution'][i]);
    formData.append('description'+i, list_resolutions[0]['description'][i]);
  }

  formData.append('total', i);

  $.ajax({
    url: base_url+'/loads/guardar_resoluciones',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_resolutions = list_resolutions.slice(1);
        users_push_list = users_push_list.slice(1);

        if(list_resolutions.length == 0){
          list_services = data['services'];
          users_push_list = users_push;
          guardar_servicios(data, list_services, users_push_list);
          barra_porcentaje(5.26);
        }else{
          guardar_resoluciones(data, list_resolutions, users_push_list);
        }
      }
    }
  });
}

function guardar_servicios(data, list_services, users_push_list){
  formData = new FormData();

  for(i = 0; i < list_services[0]['description'].length; i++) {
    formData.append('user_id'+i, users_push_list[0]['user_id']);
    formData.append('description'+i, list_services[0]['description'][i]);
    formData.append('frequency'+i, list_services[0]['frequency'][i]);
    formData.append('monthly_amount'+i, list_services[0]['monthly_amount'][i]);
    formData.append('productivity'+i, list_services[0]['productivity'][i]);
    formData.append('quality'+i, list_services[0]['quality'][i]);
    formData.append('innovation'+i, list_services[0]['innovation'][i]);
    formData.append('service'+i, list_services[0]['service'][i]);
  }
  
  formData.append('total', i);

  $.ajax({
    url: base_url+'/loads/guardar_servicios',
    type: 'POST',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    data: formData,
    success: function(res){
      if(res.status == 'ERROR'){
        $('.alert-text-error').html(res.message);
        $('.alert-danger').show();
        descargar_archivo();
        setTimeout(function(){ location.reload(); }, 4000);
      }else{
        list_services = list_services.slice(1);
        users_push_list = users_push_list.slice(1);

        if(list_services.length == 0){
          barra_porcentaje(5.32);
          $('.alert-text-exito').html(label_guardado);
          $('.alert-success').show();
          setTimeout(function(){ location.reload(); }, 2000);
        }else{
          guardar_servicios(data, list_services, users_push_list);
        }
      }
    }
  });
}