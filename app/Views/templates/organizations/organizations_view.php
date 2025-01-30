<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title col-md-12">
      <div class="row">
          <div class="col-md-12 row mb-2 mt-2">

               <div class="col-md-3 mt-3">
                  <h3 class="col-md-12"><span class="badge badge-pill badge-primary" style="text-transform: none !important;"><?= $title; ?></span></h3>
               </div>
               <?php if($_SESSION['user_id'] == 1){ ?>
               <div class="col-md-9 mt-3">
                  <button type="button" class="btn btn-success col-md-4 pull-right" onclick="modal_organizaciones('', '', '', 0, '<?= lang('Home.Agregar'); ?>');"><i class="fa fa-plus" aria-hidden="true"></i> <?= lang('Home.Nueva organización'); ?></button>
               </div>
               <?php } ?>
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
                  <th style="width: 20%"><?= lang('Home.Madurez empresarial'); ?></th>
                  <th style="width: 25%"><?= lang('Home.Cuestionario'); ?></th>
                  <th style="width: 10%"><?= lang('Home.Acciones'); ?></th>
               </tr>
            </thead>
            <tbody class="tbody-datos">
            <?php if($organizations){ $i = 1;?>
               <?php foreach($organizations as $o){ ?>
                  <tr>
                     <td><?= $i++; ?></td>
                     <td><?= $o['organization']; ?></td>
                     <td><?= lang('Home.'.$o['maturity'].''); ?></td>
                     <td>
                        <?php  
                           if($o['quiz'] == 1){
                              echo '<span class="badge badge-info" style="color: white;">'.lang("Home.Activo").'</span>';
                           }else{
                              echo '<span class="badge badge-danger" style="color: white;">'.lang("Home.Inactivo").'</span>';
                           }
                        ?>
                     </td>
                     <td>
                        <div class="btn-group" role="group">
                           <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?= lang('Home.Desplegar'); ?>
                           </button>
                           <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                              <a class="dropdown-item text-info" href="javascript:void(0);" onclick="modal_organizaciones(<?= $o['organization_id']; ?>, '<?= $o['organization']; ?>', <?= $o['maturity_id']; ?>, <?= $o['quiz']; ?>, '<?= lang('Home.Actualizar'); ?>');">
                                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?= lang('Home.Editar'); ?>
                              </a>
                              <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="eliminar_datos(<?= $o['organization_id']; ?>);">
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
    
<div class="modal fade bd-example-modal-xl modal-organizaciones" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
     <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Organizaciones'); ?> </h5>
        </div>
        <div class="modal-body">
         <form class="form-datos" autocomplete="off">
           <div class="col-md-12 row">
             <div class="col-md-12 mb-3">
               <label for="organization"><?= lang('Home.Organización'); ?>*</label>
               <input type="hidden" class="form-control organization_id" name="organization_id" value="0">
               <input type="text" class="form-control organization" name="organization" maxlength="250" onkeyup="this.value=caracteres_validos(this.value)">
             </div>
             <div class="col-md-12 mb-3">
               <label for="maturity_id"><?= lang('Home.Madurez empresarial'); ?></label>
               <select class="form-control maturity_id" name="maturity_id" id="maturity_id">
                  <option value=""><?= lang('Home.Seleccione una opción'); ?></option>
                  <?php foreach ($business_maturity as $b) { ?>
                  <option value="<?= $b['maturity_id']; ?>"><?= lang('Home.'.$b['maturity'].''); ?></option>
                  <?php } ?>
               </select>
             </div>
             <div class="col-md-12 mb-3">
               <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" class="custom-control-input quiz" id="quiz" name="quiz" value="">
                  <label class="custom-control-label" for="quiz"><?= lang('Home.Ver cuestionario(Vista de Presentación)'); ?></label>
               </div>
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> <?= lang('Home.Cerrar'); ?> </button>
        </div>
     </div>
  </div>
</div>

<script>
   var label_eliminar = '<?= lang('Home.¿Desea eliminar el registro?'); ?>';

</script>