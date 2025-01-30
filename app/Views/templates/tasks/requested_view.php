<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title col-md-12">
      <div class="row">
         <div class="col-md-12 row mb-2 mt-2">
            <h3 class="card-title col-md-2"><span class="badge badge-pill badge-primary" style="text-transform: none !important;"><?= $title; ?></span></h3>
         </div>
      </div>
   </div>
</div>
<div class="iq-card iq-card-block iq-card-stretch">
   <div class="iq-card-body" style="width: 100% !important;">
      <div class="table-responsive">
         <table id="datatable" class="table table-bordered">
            <thead class="table-dark">
               <tr>
                  <!-- Titulos de las columnas  -->
                  <th style="width: 3%">#</th>
                  <th style="width: 22%"><?= lang('Home.Servicio'); ?></th>
                  <th style="width: 10%"><?= lang('Home.Fecha de petición'); ?></th>
                  <th style="width: 10%"><?= lang('Home.Fecha de inicio'); ?></th>
                  <th style="width: 10%"><?= lang('Home.Fecha de termino'); ?></th>
                  <th style="width: 25%"><?= lang('Home.Tiempo transcurrido'); ?></th>
                  <th style="width: 10%"><?= lang('Home.Estatus'); ?></th>
                  <th style="width: 10%"><?= lang('Home.Acciones'); ?></th>
               </tr>
            </thead>
            <tbody class="tbody-datos">
               <?php if ($tasks) {
                  $i = 1; ?>
                  <?php foreach ($tasks as $t) { ?>
                     <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $t['description']; ?></td>
                        <td><?= $t['delivery_date']; ?></td>
                        <td><?= $t['start_date']; ?></td>
                        <td><?= $t['finish_date']; ?></td>
                        <!--calculo de tiempo transcurrido desde inicio de tarea-->

                        <td>
                           <?php
                           if ($t['finish_date'] != '0000-00-00 00:00:00') {
                              // Configura las fechas sin aplicar zona horaria
                              $delivery_date = new DateTime($t['delivery_date']);
                              $finish_date = new DateTime($t['finish_date']);

                              // Restar una hora a la fecha de finalización
                              $finish_date->modify('-1 hour');

                              // Calcula la diferencia entre las fechas
                              $intvl = $delivery_date->diff($finish_date);

                              // Verifica si terminó antes o después de la fecha de entrega
                              if ($intvl->invert == 1) {
                                 echo lang('Home.Finalizado antes de la fecha de entrega:');
                              } else {
                                 echo lang('Home.Finalizado después de la fecha de entrega:');
                              }

                              // Imprime la diferencia de tiempo
                              echo '<p>' . $intvl->y . ' ' . lang('Home.Años') . '/' . $intvl->m . ' ' . lang('Home.Meses') . '/' . $intvl->d . ' ' . lang('Home.Días') . '<br>' . $intvl->h . ' ' . lang('Home.Hrs') . ':' . $intvl->i . ' ' . lang('Home.Min') . ':' . $intvl->s . ' ' . lang('Home.Seg') . '</p>';
                           }
                           ?>
                        </td>



                        <td>
                           <?php
                           if ($t['status_id'] == 1) {
                              echo '<span class="badge badge-warning" style="color: white;">' . lang("Home." . $t['status']) . '</span>';
                           } else {
                              if ($t['status_id'] == 2) {
                                 echo '<span class="badge badge-info">' . lang("Home." . $t['status']) . '</span>';
                              } else {
                                 if ($t['status_id'] == 3) {
                                    echo '<span class="badge badge-success">' . lang("Home." . $t['status']) . '</span>';
                                 } else {
                                    if ($t['status_id'] == 4) {
                                       echo '<span class="badge badge-primary">' . lang("Home." . $t['status']) . '</span>';
                                    } else {
                                       if ($t['status_id'] == 5) {
                                          echo '<span class="badge badge-danger">' . lang("Home." . $t['status']) . '</span>';
                                       }
                                    }
                                 }
                              }
                           }
                           ?>
                        </td>
                        <td>
                           <div class="btn-group" role="group">
                              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <?= lang('Home.Desplegar'); ?>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                 <a class="dropdown-item text-primary" href="javascript:void(0);" onclick="get_detalles(<?= $t['task_id']; ?>);">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i> <?= lang('Home.Detalles'); ?>
                                 </a>
                                 <?php if ($t['status_id'] == 1) { ?>
                                    <a class="dropdown-item text-info" href="javascript:void(0);" onclick="cambiar_status(<?= $t['task_id']; ?>, 2, <?= $t['user_id']; ?>, <?= $t['created_by']; ?>);">
                                       <i class="fa fa-wrench" aria-hidden="true"></i> <?= lang('Home.Cambiar estatus En progreso'); ?>
                                    </a>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="cambiar_status(<?= $t['task_id']; ?>, 5, <?= $t['user_id']; ?>, <?= $t['created_by']; ?>);">
                                       <i class="fa fa-times-circle" aria-hidden="true"></i> <?= lang('Home.Cambiar estatus Rechazado'); ?>
                                    </a>
                                 <?php } ?>
                                 <?php if ($t['status_id'] == 2) { ?>
                                    <a class="dropdown-item text-success" href="javascript:void(0);" onclick="modal_finalizar(<?= $t['task_id']; ?>, 3, <?= $t['user_id']; ?>, <?= $t['created_by']; ?>);">
                                       <i class="fa fa-check-circle-o" aria-hidden="true"></i> <?= lang('Home.Cambiar estatus Finalizado'); ?>
                                    </a>
                                 <?php } ?>
                                 <?php if ($t['status_id'] == 3) { ?>
                                    <?php if (!empty($t['document'])) { ?>
                                       <a class="dropdown-item text-info" href="<?= base_url() . '/public/tareas/' . $t['task_id'] . '/' . $t['document']; ?>" target="blank">
                                          <i class="fa fa-file-text-o" aria-hidden="true"></i> <?= lang('Home.Documento'); ?>
                                       </a>
                                    <?php } ?>

                                    <?php if (!empty($t['commentary'])) { ?>
                                       <a class="dropdown-item text-primary" href="javascript:void(0);" onclick="alert(<?= '`' . $t['commentary'] . '`'; ?>);">
                                          <i class="fa fa-commenting-o" aria-hidden="true"></i> <?= lang('Home.Comentario'); ?>
                                       </a>
                                    <?php } ?>
                                 <?php } ?>
                              </div>
                           </div>
                        </td>
                     </tr>
                  <?php } ?>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>
</div>

<div class="modal fade bd-example-modal-xl modal-finalizar" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Finalizar'); ?></h5>
         </div>
         <div class="modal-body">
            <form class="form-datos" autocomplete="off">
               <div class="col-md-12 row">
                  <div class="form-group col-md-12 mb-3">
                     <label for="organization"><?= lang('Home.Documento'); ?>*</label>
                     <input type="hidden" class="form-control task_id" name="task_id" value="0">
                     <input type="hidden" class="form-control user_id" name="user_id" value="0">
                     <input type="hidden" class="form-control created_by" name="created_by" value="0">
                     <input type="hidden" class="form-control txt_csrfname_formulario" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                     <input type="file" class="form-control-file document" name="document">
                     <p>*<?= lang('Home.El tamaño máximo del documento es de 2MB'); ?></p>
                     <p>**<?= lang('Home.Las extenciones permitidas son pdf, xlsx, docx, doc, xls, jpg, png, jpeg'); ?></p>
                  </div>
                  <div class="form-group col-md-12 mb-3">
                     <label for="organization"><?= lang('Home.Comentario'); ?>*</label>
                     <textarea class="form-control commentary" name="commentary" rows="5" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)"></textarea>
                  </div>
                  <!-- alert success -->
                  <div class="col-md-12 alert bg-white alert-success" role="alert" style="display: none;">
                     <div class="iq-alert-icon">
                        <i class="ri-information-line"></i>
                     </div>
                     <div class="iq-alert-text alert-text-exito"></div>
                     <button type="button" class="close text-muted" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                     </button>
                  </div>
                  <!-- alert danger -->
                  <div class="col-md-12 alert bg-white alert-danger" role="alert" style="display: none;">
                     <div class="iq-alert-icon">
                        <i class="ri-information-line"></i>
                     </div>
                     <div class="iq-alert-text alert-text-error"></div>
                     <button type="button" class="close text-muted" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                     </button>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-success btn-form" onclick="validar_form_documentos();"><i class="ri-add-circle-fill"></i> <?= lang('Home.Guardar'); ?></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> <?= lang('Home.Cerrar'); ?></button>
         </div>
      </div>
   </div>
</div>

<div class="modal modal-detalles">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title"><?= lang('Home.Detalle del servicio'); ?></h4>
         </div>
         <div class="modal-body">
            <div class="panel panel-default">
               <div class="panel-body panel-datos table-responsive">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th scope="col"><?= lang('Home.Productividad'); ?></th>
                           <th scope="col"><?= lang('Home.Calidad'); ?></th>
                           <th scope="col"><?= lang('Home.Innovación'); ?></th>
                           <th scope="col"><?= lang('Home.Servicio'); ?></th>
                           <th scope="col"><?= lang('Home.Comentario'); ?></th>
                           <th scope="col"><?= lang('Home.Documento'); ?></th>
                        </tr>
                     </thead>
                     <tbody class="tbody-detalles"></tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ri-close-circle-fill"></i> <?= lang('Home.Cerrar'); ?></button>
         </div>
      </div>
   </div>
</div>

<script>
   var label_eliminar = '<?= lang('Home.¿Desea eliminar el registro?'); ?>';
   var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
   var label_documento = '<?= lang('Home.Favor de esperar la carga del documento, puede tardar según la velocidad del internet. El sistema le mostrará un mensaje cuando la carga haya finalizado.'); ?>';
   var label_validar = '<?= lang('Home.Validar que el archivo no excede el tamaño permitido'); ?>';
   var label_cambiar_aprobar = '<?= lang('Home.¿Desea aprobar el estatus del registro?'); ?>';
   var label_cambiar_rechazar = '<?= lang('Home.¿Desea rechazar el estatus del registro?'); ?>';
   var label_cambiar_estatus = '<?= lang('Home.¿Desea cambiar el estatus del registro?'); ?>';
</script>