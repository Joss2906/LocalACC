<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title col-md-12">
      <div class="row">
          <div class="col-md-12 row mb-2 mt-2">
            <div class="col-md-3 mt-3">
               <h3 class="card-title col-md-2"><span class="badge badge-pill badge-primary" style="text-transform: none !important;"><?= $title; ?></span></h3>
            </div>
            <div class="col-md-9 mt-3">
               <a href="<?= base_url().'/Providers/form_view/0' ?>" class="btn btn-success col-md-4 pull-right"><i class="fa fa-plus" aria-hidden="true"></i> <?= lang('Home.Nuevo proveedor');?></a>
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
                  <th style="width: 40%"><?= lang('Home.Servicio');?></th>
                  <th style="width: 15%"><?= lang('Home.Fecha del servicio');?></th>
                  <th style="width: 8%"><?= lang('Home.Acciones');?></th>
               </tr>
            </thead>
            <tbody class="tbody-datos">
            <?php if($services_providers){ $i = 1;?>
               <?php foreach($services_providers as $s){ ?>
                  <tr>
                     <td><?= $i++; ?></td>
                     <td><?= $s['service']; ?></td>
                     <td><?= $s['date_service']; ?></td>
                     <td>
                        <div class="btn-group" role="group">
                           <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?= lang('Home.Desplegar');?>
                           </button>
                           <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                              <a class="dropdown-item text-primary" href="<?= base_url().'/providers/details_view/'.$s['service_id']; ?>">
                                 <i class="fa fa-info-circle" aria-hidden="true"></i> <?= lang('Home.Detalles');?>
                              </a>
                              <?php if($s['created_by'] == $_SESSION['user_id']){ ?>
                                 <a class="dropdown-item text-info" href="<?= base_url().'/providers/form_view/'.$s['service_provider_id']; ?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?= lang('Home.Editar');?>
                                 </a>
                                 <?php if($s['user_id'] == NULL || empty($s['user_id'])){ $s['user_id'] = 0; } ?>
                                 <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="eliminar_datos(<?= $s['service_provider_id']; ?>);">
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

<script>
   var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
   var label_eliminar = '<?= lang('Home.¿Desea eliminar el registro?'); ?>';
   var label_tipo_suministro = '<?= lang('Tipo de suministro'); ?>';
   var label_acciones = '<?= lang('Acciones'); ?>';
   var label_desplegar = '<?= lang('Desplegar'); ?>';
   var label_agregar_proveedor = '<?= lang('Agregar proveedor'); ?>';
   var label_eliminar_button = '<?= lang('Eliminar'); ?>';
   var label_proveedor = '<?= lang('Proveedor'); ?>';
   var label_productividad = '<?= lang('Productividad'); ?>';
   var label_calidad = '<?= lang('Calidad'); ?>';
   var label_innovacion = '<?= lang('Innovación '); ?>';
   var label_servicio = '<?= lang('Servicio'); ?>';
</script>           