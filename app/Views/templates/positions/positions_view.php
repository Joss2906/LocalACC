<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title col-md-12">
      <div class="row">
          <div class="col-md-12 row mb-2 mt-2">
            <div class="col-md-3 mt-3">
               <h3 class="col-md-2"><span class="badge badge-pill badge-primary" style="text-transform: none !important;"><?= $title; ?></span></h3>
            </div>
            <div class="col-md-9 mt-3">
               <button type="button" class="btn btn-success col-md-4 pull-right" onclick="modal_puestos('', '', '', '<?= lang('Home.Agregar'); ?>');"><i class="fa fa-plus" aria-hidden="true"></i> <?= lang('Home.Nuevo puesto'); ?></button>
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
                  <th style="width: 40%"><?= lang('Home.Puesto'); ?></th>
                  <th style="width: 40%"><?= lang('Home.Organización'); ?></th>
                  <th style="width: 15%"><?= lang('Home.Acciones'); ?></th>
               </tr>
            </thead>
            <tbody class="tbody-datos">
            <?php if($positions){ $i = 1;?>
               <?php foreach($positions as $d){ ?>
                  <tr>
                     <td><?= $i++; ?></td>
                     <td><?= $d['position']; ?></td>
                     <td><?= $d['organization']; ?></td>
                     <td>
                        <div class="btn-group" role="group">
                           <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?= lang('Home.Desplegar'); ?>
                           </button>
                           <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                              <a class="dropdown-item text-info" href="javascript:void(0);" onclick="modal_puestos(<?= $d['position_id']; ?>, '<?= $d['position']; ?>', <?= $d['organization_id']; ?>, '<?= lang('Home.Actualizar'); ?>');">
                                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?= lang('Home.Editar'); ?>
                              </a>
                              <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="eliminar_datos(<?= $d['position_id']; ?>);">
                                 <i class="fa fa-ban" aria-hidden="true"></i> <?= lang('Home.Eliminar'); ?>
                              </a>
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
    
<div class="modal fade bd-example-modal-xl modal-puestos" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
     <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Puestos'); ?> </h5>
           </button>
        </div>
        <div class="modal-body">
         <form class="form-datos" autocomplete="off">
           <div class="col-md-12 row">
             <div class="col-md-12 mb-3">
               <label for="position"><?= lang('Home.Puesto'); ?>*</label>
               <input type="hidden" class="form-control position_id" name="position_id" value="0">
               <input type="text" class="form-control position" name="position" maxlength="250" onkeyup="this.value=caracteres_validos(this.value)">
             </div>
             <div class="col-md-12 mb-3">
               <label for="organization_id"><?= lang('Home.Organización'); ?>*</label>
               <select class="form-control organization_id" name="organization_id" id="organization_id">
                  <option value=""><?= lang('Home.Seleccione una opción'); ?></option>
                  <?php foreach ($organizations as $o) { ?>
                  <option value="<?= $o['organization_id']; ?>"><?= $o['organization']; ?></option>
                  <?php } ?>
               </select>
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> <?= lang('Home.Cerrar'); ?></button>
        </div>
     </div>
  </div>
</div>

<script>
   var label_eliminar = '<?= lang('Home.¿Desea eliminar el registro?'); ?>';
</script>
