<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title">
      <div class="row">
          <div class="col-sm-12 col-md-12">
            <!-- <a href="<?= base_url().'/Services/weighing_view' ?>" class="btn mb-6 btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Ponderación de servicios</a> -->
               <input type="hidden" class="input-ponderacion" value="1">
               <input type="hidden" class="user_id" value="<?= $user_id; ?>">
         </div>
      </div>
   </div>
</div>
<div class="iq-card iq-card-block iq-card-stretch">                    
   <div class="iq-card-body" style="width: 100% !important;">
      <div class="table-responsive">
         <table class="table table-bordered">
            <thead class="table-dark">
               <tr>
                  <th style="width: 2%">#</th>
                  <th style="width: 41%"><?= lang('Home.Organización');?></th>
                  <th style="width: 41%"><?= lang('Home.Descripción');?></th>
                  <th style="width: 8%"><?= lang('Home.Ponderación');?></th>
                  <th style="width: 8%"><?= lang('Home.Acciones');?></th>
               </tr>
            </thead>
            <tbody class="tbody-datos">
               <form class="form-datos-ponderaciones">               
               <?php if($services){ ?>
                  <?php $i = 1; foreach($services as $s){ ?>
                     <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $s['organization']; ?></td>
                        <td><?= $s['description']; ?></td>
                        <td>
                           <input type="hidden" class="form-control service_id" name="service_id[]" value="<?= $s['service_id']; ?>">   
                        	<input type="text" class="form-control weighing" name="weighing[]" onkeypress="return justIntegers(event);" onkeyup="sumar_ponderaciones(this);" value="<?= $s['weighing']; ?>">		
                        </td>
                        <td>
                           <div class="btn-group" role="group">
                              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Desplegar
                              </button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                 <a class="dropdown-item text-primary" href="javascript:void(0);" onclick="get_detalles(<?= $s['service_id']; ?>);">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i> <?= lang('Home.Detalles');?>
                                 </a>
                              </div>
                           </div>
                        </td>
                     </tr>
                  <?php } ?>
               <?php } ?>
               </form>
            </tbody>
         </table>
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
            <div class="col-md-12 pull-right">     
                <div class="form-group div-button">
                  <input type="hidden" class="form-active" value="1">
                  <button class="btn btn-success btn-form" type="button" onclick="actualizar_ponderaciones();">
                     <i class="ri-add-circle-fill"></i> <?= lang('Home.Actualizar');?>
                  </button>
                </div>
            </div>
         </div>
         <div class="col-md-12 div-graficas row"></div>
      </div>
   </div>
</div>

<div class="modal modal-detalles">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title"><?= lang('Home.Detalle del servicio');?></h4>
         </div>
         <div class="modal-body">
            <div class="panel panel-default">
               <div class="panel-body panel-datos table-responsive">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th scope="col"><?= lang('Home.Productividad');?></th>
                           <th scope="col"><?= lang('Home.Calidad');?></th>
                           <th scope="col"><?= lang('Home.Innovación');?></th>
                           <th scope="col"><?= lang('Home.Servicio');?></th>
                        </tr>
                     </thead>
                     <tbody class="tbody-detalles"></tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ri-close-circle-fill"></i> <?= lang('Home.Cerrar');?></button>
         </div>
      </div>
   </div>
</div>

<script>
   var label_eliminar = '<?= lang('Home.¿Desea eliminar el registro?'); ?>';
   var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
   var label_sumatoria_ponderaciones = '<?= lang('Home.La sumatoria de las ponderaciones dan mas del 100%'); ?>';
   var label_validar_ponderaciones = '<?= lang('Home.Favor de validar las ponderaciones de lo servicios debe ser mayor a 0.'); ?>';
   var label_imagen = '<?= lang('Home.Favor de esperar la carga de la imagen, puede tardar según la velocidad del internet. El sistema le mostrará un mensaje cuando la carga haya finalizado.'); ?>';
   var label_validar_imagen = '<?= lang('Home.Validar que el archivo no excede el tamaño permitido'); ?>';
</script>  


