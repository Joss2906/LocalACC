<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title col-md-12">
      <div class="row">
         <div class="col-md-12 row mb-2 mt-2">
            <div class="col-md-3 mt-3">
               <h3 class="col-md-3"><span class="badge badge-pill badge-primary" style="text-transform: none !important;"><?= $title; ?></span></h3>
            </div>
            <div class="col-md-9 mt-3">
               <a href="<?= base_url() . '/Tasks/form_view/0'; ?>" class="btn btn-success col-md-4 pull-right"><i class="fa fa-plus" aria-hidden="true"></i> <?= lang('Home.Nueva solicitud de función o servicio'); ?></a>
            </div>
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
                        <!--id-->
                        <td><?= $i++; ?></td>
                        <!--Descripicion de servicio-->
                        <td><?= $t['description']; ?></td>
                        <!--fecha de peticion-->
                        <td><?= $t['delivery_date']; ?></td>
                        <!--fecha de inicio-->
                        <td><?= $t['start_date']; ?></td>
                        <!--fecha de termino-->
                        <td><?= $t['finish_date']; ?></td>
                        <!--tiempo transcurrido-->
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

                           // Calcular el tiempo transcurrido si 'delivery_date' está disponible
                           if (!empty($t['delivery_date'])) {
                              $currentDate = new DateTime(); // Fecha y hora actual
                              $currentDate->modify('-1 hour'); // Restar una hora
                              $deliveryDate = new DateTime($t['delivery_date']);

                              // Calcular diferencia
                              $interval = $currentDate->diff($deliveryDate);

                              // Mostrar el tiempo transcurrido
                              echo '<p>';
                              echo 'Tiempo transcurrido: ';
                              echo $interval->y . ' ' . lang('Home.Años') . ' / ';
                              echo $interval->m . ' ' . lang('Home.Meses') . ' / ';
                              echo $interval->d . ' ' . lang('Home.Días') . ' / ';
                              echo $interval->h . ' ' . lang('Home.Hrs') . ' / ';
                              echo $interval->i . ' ' . lang('Home.Min') . ' / ';
                              echo $interval->s . ' ' . lang('Home.Seg');
                              echo '</p>';
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
                                    <a class="dropdown-item text-info" href="<?= base_url() . '/Tasks/form_view/' . $t['task_id']; ?>">
                                       <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?= lang('Home.Editar'); ?>
                                    </a>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="eliminar_datos(<?= $t['task_id']; ?>);">
                                       <i class="fa fa-ban" aria-hidden="true"></i> <?= lang('Home.Eliminar'); ?>
                                    </a>
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
</script>