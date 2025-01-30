<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title col-md-12">
      <div class="row">
          <div class="col-md-12 row mb-2 mt-2">
            <div class="col-md-3 mt-3">
               <h3 class="card-title col-md-2"><span class="badge badge-pill badge-primary" style="text-transform: none !important;"><?= $title; ?></span></h3>
            </div>
            <div class="col-md-9 mt-3">
               <button type="button" class="btn btn-success col-md-4 pull-right" onclick="modal_quejas('', '', '', '', '', '<?= lang('Home.Agregar'); ?>');"><i class="fa fa-plus" aria-hidden="true"></i> <?= lang('Home.Nueva queja');?></button>
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
                  <th style="width: 5%">#</th>
                  <th><?= lang('Home.Tipo de queja');?></th>
                  <th><?= lang('Home.Autor');?></th>
                  <th><?= lang('Home.Categoría');?></th>
                  <th><?= lang('Home.Queja');?></th>
                  <th><?= lang('Home.Responsable');?></th>
                  <th><?= lang('Home.Estatus');?></th>
                  <th><?= lang('Home.Acciones');?></th>
               </tr>
            </thead>
            <tbody class="tbody-datos">
            <?php if($complaints){ ?>
               <?php $i = 1; foreach($complaints as $c){ ?>
                  <tr>
                     <td><?= $i++; ?></td>
                     <?php if($c['complaint_type_id'] == 1){ ?>
                     <td><span class="badge badge-primary"><?= lang('Home.'.$c['type'].''); ?></span></td>
                     <?php }else{ ?>
                     <td><span class="badge badge-success"><?= lang('Home.'.$c['type'].''); ?></span></td>
                     <?php } ?>
                     <td><?= $c['author']; ?></td>
                     <td><?= $c['category']; ?></td>
                     <td><?= $c['complaint']; ?></td>
                     <td><?= $c['responsible']; ?></td>
                     <?php if($c['complaint_status_id'] == 1){ ?>
                     <td><span class="badge badge-danger"><?= lang('Home.'.$c['status'].''); ?></span></td>
                     <?php } ?>
                     <?php if($c['complaint_status_id'] == 2){ ?>
                     <td><span class="badge badge-warning"><?= lang('Home.'.$c['status'].''); ?></span></td>
                     <?php } ?>
                     <?php if($c['complaint_status_id'] == 3){ ?>
                     <td><span class="badge badge-primary"><?= lang('Home.'.$c['status'].''); ?></span></td>
                     <?php } ?>
                     <?php if($c['complaint_status_id'] == 4){ ?>
                     <td><span class="badge badge-info"><?= lang('Home.'.$c['status'].''); ?></span></td>
                     <?php } ?>
                     <?php if($c['complaint_status_id'] == 5){ ?>
                     <td><span class="badge badge-success"><?= lang('Home.'.$c['status'].''); ?></span></td>
                     <?php } ?>
                     <td>
                        <div class="btn-group" role="group">
                           <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?= lang('Home.Desplegar');?>
                           </button>
                           <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                           <?php if($c['complaint_status_id'] == 1){ ?>
                              <a class="dropdown-item text-info" href="javascript:void(0);" onclick="modal_quejas(<?= $c['complaint_id']; ?>, <?= $c['complaint_type_id']; ?>, <?= $c['category_id']; ?>, <?= $c['user_id']; ?>, '<?= $c['complaint']; ?>', '<?= lang('Home.Actualizar'); ?>');">
                                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?= lang('Home.Editar');?>
                              </a>
                              <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="eliminar_datos(<?= $c['complaint_id']; ?>);">
                                 <i class="fa fa-ban" aria-hidden="true"></i> <?= lang('Home.Eliminar');?>
                              </a>
                           <?php } ?>
                           <?php if($c['complaint_status_id'] == 3){ ?>
                              <a class="dropdown-item text-primary" href="javascript:void(0);" onclick="cambiar_status(<?= $c['complaint_id']; ?>, 4);">
                                 <i class="fa fa-check-circle" aria-hidden="true"></i> <?= lang('Home.Finalizar');?>
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
    
<div class="modal fade bd-example-modal-xl modal-quejas" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
     <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Quejas');?> </h5>
           </button>
        </div>
        <div class="modal-body">
         <form class="form-datos" autocomplete="off">
           <div class="col-md-12 row">
             <div class="col-md-6 mb-3">
               <label for="complaint_type_id"><?= lang('Home.Tipo de queja');?>*</label>
               <input type="hidden" class="form-control complaint_id" name="complaint_id" value="0">
               <select class="form-control complaint_type_id" name="complaint_type_id" id="complaint_type_id">
                  <option value=""><?= lang('Home.Seleccione una opción');?></option>
                  <?php foreach ($types as $t) { ?>
                  <option value="<?= $t['complaint_type_id']; ?>"><?= lang('Home.'.$t['type'].''); ?></option>
                  <?php } ?>
               </select>
             </div>
             <div class="col-md-6 mb-3">
               <label for="category_id"><?= lang('Home.Categoría');?>*</label>
               <select class="form-control category_id" name="category_id" id="category_id">
                  <option value=""><?= lang('Home.Seleccione una opción');?></option>
                  <?php foreach ($categories as $c) { ?>
                  <option value="<?= $c['category_id']; ?>"><?= lang('Home.'.$c['category'].''); ?></option>
                  <?php } ?>
               </select>
             </div>
             <div class="col-md-12 mb-3">
               <label for="user_id"><?= lang('Home.Socio');?>*</label>
               <select class="form-control user_id" name="user_id" id="user_id">
                  <option value=""><?= lang('Home.Seleccione una opción');?></option>
                  <?php foreach ($employees as $e) { ?>
                  <option value="<?= $e['user_id']; ?>"><?= $e['responsible']; ?></option>
                  <?php } ?>
               </select>
             </div>
             <div class="col-md-12 mb-3">
               <label for="complaint"><?= lang('Home.Queja');?>*</label>
               <textarea class="form-control complaint" name="complaint" rows="2" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)"></textarea>
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
            <button type="button" class="btn btn-success btn-form" onclick="validar_form();"> </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> <?= lang('Home.Cerrar');?></button>
        </div>
     </div>
  </div>
</div>

<script>
    var label_eliminar = '<?= lang('Home.¿Desea eliminar el registro?'); ?>';
    var label_cambiar = '<?= lang('Home.¿Desea cambiar el estatus del registro?'); ?>';
</script>    
