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
      <div class="col-md-12 row">
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
      <div class="table-responsive">
         <table id="datatable" class="table table-bordered">
            <thead class="table-dark">
               <tr>
                  <th style="width: 2%">#</th>
                  <th style="width: 23%"><?= lang('Home.Servicio');?></th>
                  <th style="width: 17%"><?= lang('Home.Calificar Productividad');?></th>
                  <th style="width: 17%"><?= lang('Home.Calificar Calidad');?></th>
                  <th style="width: 17%"><?= lang('Home.Calificar Innovación');?></th>
                  <th style="width: 17%"><?= lang('Home.Calificar Servicio');?></th>
                  <th style="width: 7%"><?= lang('Home.Acciones');?></th>
               </tr>
            </thead>
            <tbody class="tbody-datos">
            <?php if($tasks){ ?>
               <?php $i = 1; foreach($tasks as $t){ ?>
                  <tr>
                     <form class="form-datos-<?= $t['task_id']; ?>" autocomplete="off">
                     <td><?= $i++; ?></td>
                     <td><?= $t['description']; ?></td>
                     <td>
                        <div class="form-group">
                           <input type="hidden" name="task_id" value="<?= $t['task_id']; ?>">
                           <input type="hidden" name="user_id" value="<?= $t['user_id']; ?>">
                           <input type="hidden" class="form-control col-md-3" name="average_productivity" onkeypress="return justIntegers(event);" maxlength="3" placeholder="0" value="<?= $t['average_productivity']; ?>">
                           <input type="hidden" class="form-control col-md-3" name="average_quality" onkeypress="return justIntegers(event);" maxlength="3" placeholder="0" value="<?= $t['average_quality']; ?>">
                           <input type="hidden" class="form-control col-md-3" name="average_innovation" onkeypress="return justIntegers(event);" maxlength="3" placeholder="0" value="<?= $t['average_innovation']; ?>">
                           <input type="hidden" class="form-control col-md-3" name="average_service" onkeypress="return justIntegers(event);" maxlength="3" placeholder="0" value="<?= $t['average_service']; ?>">
                           <textarea name="commentary_productivity" cols="30" rows="5" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)" placeholder="Escribe un comentario"><?= $t['commentary_productivity']; ?></textarea>
                        </div>
                     </td>
                     <td>
                        <div class="form-group">
                           <textarea name="commentary_quality" cols="30" rows="5" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)" placeholder="Escribe un comentario"><?= $t['commentary_quality']; ?></textarea>
                        </div>
                     </td>
                     <td>
                        <div class="form-group">
                           <textarea name="commentary_innovation" cols="30" rows="5" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)" placeholder="Escribe un comentario"><?= $t['commentary_innovation']; ?></textarea>
                        </div>
                     </td>
                     <td>
                        <div class="form-group">
                           <textarea name="commentary_service" cols="30" rows="5" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)" placeholder="Escribe un comentario"><?= $t['commentary_service']; ?></textarea>
                        </div>
                     </td>
                     <td>
                        <button type="button" class="btn btn-success" onclick="add_calificacion(<?= $t['task_id']; ?>);"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Guardar');?></button>
                     </td>
                     </form>
                  </tr>
               <?php } ?>
            <?php } ?>
            </tbody>
         </table>
      </div>
   </div>
</div>

<script>
    var label_eliminar = '<?= lang('Home.¿Desea eliminar el registro?'); ?>';
    var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
    var label_documento = '<?= lang('Home.Favor de esperar la carga del documento, puede tardar según la velocidad del internet. El sistema le mostrará un mensaje cuando la carga haya finalizado.'); ?>';
    var label_validar = '<?= lang('Home.Validar que el archivo no excede el tamaño permitido'); ?>';
    var label_cambiar_aprobar = '<?= lang('Home.¿Desea aprobar el estatus del registro?'); ?>';
    var label_cambiar_rechazar= '<?= lang('Home.¿Desea rechazar el estatus del registro?'); ?>';
</script>                