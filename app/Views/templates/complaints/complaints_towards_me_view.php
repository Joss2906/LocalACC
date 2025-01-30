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
            <?php $i = 1; if($complaints){ ?>
               <?php foreach($complaints as $c){ ?>
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
                     <td><span class="badge badge-secondary"><?= lang('Home.'.$c['status'].''); ?></span></td>
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
                              <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="cambiar_status(<?= $c['complaint_id']; ?>, 2);">
                                 <i class="fa fa-wrench" aria-hidden="true"></i> <?= lang('Home.Resolver');?>
                              </a>
                           <?php } ?>
                           <?php if($c['complaint_status_id'] == 2){ ?>
                              <a class="dropdown-item text-secondary" href="javascript:void(0);" onclick="cambiar_status(<?= $c['complaint_id']; ?>, 3);">
                                 <i class="fa fa-wrench" aria-hidden="true"></i> <?= lang('Home.Resuelto');?>
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

<script>
    var label_eliminar = '<?= lang('Home.¿Desea eliminar el registro?'); ?>';
    var label_cambiar = '<?= lang('Home.¿Desea cambiar el estatus del registro?'); ?>';
</script>                
   
