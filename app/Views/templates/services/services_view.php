<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title col-md-12">
      <div class="row">
          <div class="col-md-12 row mb-2 mt-2">
            <div class="col-md-4 mt-3">
               <h3 class="col-md-3"><span class="badge badge-pill badge-primary" style="text-transform: none !important;"><?= $title; ?></span></h3>
            </div>
            <div class="col-md-4 mt-3">
               <a href="<?= base_url().'/Services/weighing_view' ?>" class="btn btn-dark col-md-12 pull-right">
                  <i class="fa fa-percent" aria-hidden="true"></i> <?= lang('Home.Ponderación de funciones o servicios');?>
               </a>
            </div>
            <div class="col-md-4 mt-3">
               <a href="<?= base_url().'/Services/form_view/0' ?>" class="btn btn-success col-md-12 pull-right">
                  <i class="fa fa-plus" aria-hidden="true"></i> <?= lang('Home.Nueva función o servicio');?>
               </a>
               <input type="hidden" class="input-ponderacion" value="0">
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
                  <th style="width: 2%">#</th>
                  <th style="width: 27%"><?= lang('Home.Organización');?></th>
                  <th style="width: 28%"><?= lang('Home.Empleado');?></th>
                  <th style="width: 27%"><?= lang('Home.Descripción');?></th>
                  <th style="width: 15%"><?= lang('Home.Puesto');?></th>
                  <th style="width: 10%"><?= lang('Home.Frecuencia');?></th>
                  <th style="width: 15%"><?= lang('Home.Cantidad por mes');?></th>
                  <th style="width: 4%"><?= lang('Home.Estatus');?></th>
                  <th style="width: 4%"><?= lang('Home.Acciones');?></th>
               </tr>
            </thead>
            <tbody class="tbody-datos">
            <?php if($services){ $i = 1;?>
               <?php foreach($services as $s){ ?>
                  <tr>
                     <td><?= $i++; ?></td>
                     <td><?= $s['organization']; ?></td>
                     <td><?= $s['author']; ?></td>
                     <td><?= $s['description']; ?></td>
                     <td><?= $s['position']; ?></td>
                     <td><?= $s['frequency']; ?></td>
                     <td><?= $s['monthly_amount']; ?></td>
                     <td>
                        <?php 
                           if($s['status'] == 1){
                              echo '<span class="badge badge-warning" style="color: white;">'.lang("Home.".$s['status_service']).'</span>';
                           }else{
                              if($s['status'] == 2){
                                 echo '<span class="badge badge-success">'.lang("Home.".$s['status_service']).'</span>';
                              }else{
                                 if($s['status'] == 3){
                                    echo '<span class="badge badge-info">'.lang("Home.".$s['status_service']).'</span>';
                                 }else{
                                    if($s['status'] == 4){
                                       echo '<span class="badge badge-danger">'.lang("Home.".$s['status_service']).'</span>';
                                    }
                                 }
                              }
                           }
                        ?>
                     </td>
                     <td>
                        <div class="btn-group" role="group">
                           <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?= lang('Home.Desplegar');?>
                           </button>
                           <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                              <a class="dropdown-item text-primary" href="javascript:void(0);" onclick="get_detalles(<?= $s['service_id']; ?>);">
                                 <i class="fa fa-info-circle" aria-hidden="true"></i> <?= lang('Home.Detalles');?>
                              </a>
                              <a class="dropdown-item text-success" href="javascript:void(0);" onclick="get_clientes_competidores(1, <?= $s['service_id']; ?>);">
                                 <i class="fa fa-users" aria-hidden="true"></i> <?= lang('Home.Clientes');?>
                              </a>
                              <a class="dropdown-item text-warning" href="javascript:void(0);" onclick="get_clientes_competidores(2, <?= $s['service_id']; ?>);">
                                 <i class="fa fa-users" aria-hidden="true"></i> <?= lang('Home.Competidores');?>
                              </a>
                              <?php if($s['user_id'] == $_SESSION['user_id']){ ?>
                                 <a class="dropdown-item text-secondary" href="javascript:void(0);" onclick="modal_imagen(<?= $s['service_id']; ?>);">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i> <?= lang('Home.Imagen');?>
                                 </a>
                                 <a class="dropdown-item text-info" href="<?= base_url().'/Services/form_view/'.$s['service_id']; ?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?= lang('Home.Editar');?>
                                 </a>
                                 <?php if($s['user_id'] == NULL || empty($s['user_id'])){ $s['user_id'] = 0; } ?>
                                 <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="eliminar_datos(<?= $s['service_id']; ?>, <?= $s['user_id']; ?>, <?= $s['position_id']; ?>);">
                                    <i class="fa fa-ban" aria-hidden="true"></i> <?= lang('Home.Eliminar');?>
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

<div class="modal modal-clientes">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title"><?= lang('Home.Clientes');?></h4>
         </div>
         <div class="modal-body">
            <div class="panel panel-default">
               <div class="panel-body panel-datos table-responsive">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th scope="col"><?= lang('Home.Cliente');?></th>
                           <th scope="col"><?= lang('Home.Puesto');?></th>
                           <th scope="col"><?= lang('Home.Acciones');?></th>
                        </tr>
                     </thead>
                     <tbody class="tbody-clientes"></tbody>
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

<div class="modal modal-competidores">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title"><?= lang('Home.Competidores');?></h4>
         </div>
         <div class="modal-body">
            <div class="panel panel-default">
               <div class="panel-body panel-datos table-responsive">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th scope="col"><?= lang('Home.Competidor');?></th>
                           <th scope="col"><?= lang('Home.Garantias ofrecidas');?></th>
                           <th scope="col"><?= lang('Home.Precio ofrecido');?></th>
                           <th scope="col"><?= lang('Home.Acciones');?></th>
                        </tr>
                     </thead>
                     <tbody class="tbody-competidores"></tbody>
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

<div class="modal modal-imagen" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title"><?= lang('Home.Imagen del servicio');?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form class="form-imagen">            
               <div class="col-md-12 form-group">
                  <label for=""><?= lang('Home.Imagen');?></label>
                  <input type="hidden" class="form-control service_id_imagen" id="service_id_imagen" name="service_id_imagen">
                  <input type="file" class="form-control-file profile_picture" id="profile_picture" name="profile_picture"><input type="hidden" class="form-control txt_csrfname_imagen" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                  <p>*<?= lang('Home.Elegir un archivo de imagen igual o menor a 2MB del tipo JPG, GIF o PNG, con las siguientes medidas: 638px de ancho por 335px de alto');?></p>
               </div>
            </form>
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
         <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="add_imagen();"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Actualizar');?></button>
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