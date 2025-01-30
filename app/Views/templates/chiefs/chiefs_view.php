<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title col-md-12">
      <div class="row">
          <div class="col-md-12 row mb-2 mt-2">
            <div class="col-md-3 mt-3">
               <h3 class="col-md-2"><span class="badge badge-pill badge-primary" style="text-transform: none !important;"><?= $title; ?></span></h3>
            </div>
            <div class="col-md-9 mt-3">
               <button type="button" class="btn btn-success col-md-4 pull-right" onclick="modal_jefes('', <?= $_SESSION['organization_id']; ?>, '', '', '<?= lang('Home.Agregar'); ?>');"><i class="fa fa-plus" aria-hidden="true"></i> <?= lang('Home.Nuevo jefe/empleado'); ?></button>
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
                  <th style="width: 40%"><?= lang('Home.Organización'); ?></th>
                  <th style="width: 40%"><?= lang('Home.Jefe'); ?></th>
                  <th style="width: 35%"><?= lang('Home.Empleado'); ?></th>
                  <th style="width: 20%"><?= lang('Home.Acciones'); ?></th>
               </tr>
            </thead>
            <tbody class="tbody-datos">
            <?php if($chiefs){ $i = 1;?>
               <?php foreach($chiefs as $c){ ?>
                  <tr>
                     <td><?= $i++; ?></td>
                     <td><?= $c['organization']; ?></td>
                     <td><?= $c['chief']; ?></td>
                     <td><?= $c['employee']; ?></td>
                     <td>
                        <div class="btn-group" role="group">
                           <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?= lang('Home.Desplegar'); ?>
                           </button>
                           <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                              <a class="dropdown-item text-info" href="javascript:void(0);" onclick="modal_jefes(<?= $c['chief_id']; ?>, <?= $c['organization_id']; ?>, <?= $c['chief_user_id']; ?>, <?= $c['employee_user_id']; ?>, '<?= lang('Home.Actualizar'); ?>');">
                                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?= lang('Home.Editar'); ?>
                              </a>
                              <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="eliminar_datos(<?= $c['chief_id']; ?>);">
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
    
<div class="modal fade bd-example-modal-xl modal-jefes" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
     <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Jefe/Empleados'); ?> </h5>
           </button>
        </div>
        <div class="modal-body">
         <form class="form-datos" autocomplete="off">
           <div class="col-md-12 row">
             <div class="col-md-12 mb-3">
               <input type="hidden" class="form-control chief_id" name="chief_id" value="0">
               <label for="organization_id"><?= lang('Home.Organización'); ?></label>
               <select class="form-control organization_id" name="organization_id" id="organization_id" onchange="get_empleados('', '');">
                  <option value=""><?= lang('Home.Seleccione una opción'); ?></option>
                  <?php foreach ($organizations as $o) { ?>
                  <option value="<?= $o['organization_id']; ?>"><?= $o['organization']; ?></option>
                  <?php } ?>
               </select>
             </div>
             <div class="col-md-12 mb-3">
               <label for="chief_user_id"><?= lang('Home.Jefe'); ?></label>
               <select class="form-control chief_user_id" name="chief_user_id" id="chief_user_id" onchange="bloquear_opcion();">
                  <option value=""><?= lang('Home.Seleccione una opción'); ?></option>
               </select>
             </div>
             <div class="col-md-12 mb-3">
               <label for="employee_user_id"><?= lang('Home.Empleado'); ?></label>
               <select class="form-control employee_user_id" name="employee_user_id" id="employee_user_id" onchange="bloquear_opcion();">
                  <option value=""><?= lang('Home.Seleccione una opción'); ?></option>
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
   var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
   var label_validacion_jefe_empleado = '<?= lang('Home.Ya existe una relacion de Jefe/Empleado'); ?>';
</script>
