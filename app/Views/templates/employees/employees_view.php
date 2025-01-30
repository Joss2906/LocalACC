<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title col-md-12">
      <div class="row">
         <div class="col-md-12 row mb-2 mt-2">
            <div class="col-md-3 mt-3">
               <h3 class="card-title col-md-2"><span class="badge badge-pill badge-primary"><?= $title; ?></span></h3>
            </div>
            <div class="col-md-9 mt-3">
               <?php if ($_SESSION['credential_id'] == 1) { ?>
                  <a href="<?= base_url() . '/Employees/form_view/0' ?>" class="btn btn-success col-md-4 pull-right"><i class="fa fa-plus" aria-hidden="true"></i> <?= lang('Home.Nuevo socio'); ?></a>
               <?php } ?>
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
                  <th>#</th>
                  <th><?= lang('Home.Nombre'); ?></th>
                  <th><?= lang('Home.Razón social'); ?></th>
                  <th><?= lang('Home.Credencial'); ?></th>
                  <th><?= lang('Home.Puesto'); ?></th>
                  <th><?= lang('Home.Departamento'); ?></th>
                  <th><?= lang('Home.Promedio'); ?></th>
                  <th><?= lang('Home.ROI'); ?></th>
                  <th><?= lang('Home.Estatus'); ?></th>
                  <th><?= lang('Home.Acciones'); ?></th>
               </tr>
            </thead>
            <tbody class="tbody-datos">
               <?php if ($employees) {
                  $i = 1; ?>
                  <?php foreach ($employees as $e) { ?>
                     <tr>
                        <td><?= $i++; ?></td>
                        <td><?= htmlspecialchars($e['first_name'] . ' ' . $e['second_name'] . ' ' . $e['last_name'] . ' ' . $e['second_last_name']); ?></td>
                        <td><?= htmlspecialchars($e['business_name']); ?></td>
                        <td><?= htmlspecialchars(lang('Home.' . $e['credential'])); ?></td>
                        <td><?= htmlspecialchars($e['position']); ?></td>
                        <td><?= htmlspecialchars($e['department']); ?></td>
                        <td><?= htmlspecialchars($e['average']); ?></td>
                        <td><?= htmlspecialchars($e['roi']); ?></td>
                        <td>
                           <?php if ($e['deleted_at'] == NULL) { ?>
                              <span class="badge border border-success text-success"><?= lang('Home.Activo'); ?></span>
                           <?php } else { ?>
                              <span class="badge border border-danger text-danger"><?= lang('Home.Inactivo'); ?></span>
                           <?php } ?>
                        </td>
                        <td>
                           <?php $block = 'none'; ?>
                           <?php
                           if ($_SESSION['credential_id'] == 1) {
                              $block = 'block';
                           }

                           if ($_SESSION['maturity_id'] == 2 && $_SESSION['credential_id'] == 2) {
                              $block = 'block';
                           }

                           if ($_SESSION['maturity_id'] == 3 && ($_SESSION['credential_id'] == 2 || $_SESSION['credential_id'] == 3)) {
                              $block = 'block';
                           }

                           if ($_SESSION['maturity_id'] == 1 || $_SESSION['maturity_id'] == 4) {
                              $block = 'block';
                           }
                           ?>

                           <div class="btn-group" role="group" style="display: <?= $block; ?>">
                              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <?= lang('Home.Desplegar'); ?>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                 <?php if ($e['deleted_at'] == NULL) { ?>
                                    <?php if ($_SESSION['credential_id'] == 1) { ?>
                                       <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="eliminar_datos(<?= $e['user_id']; ?>, 0);">
                                          <i class="fa fa-ban" aria-hidden="true"></i> <?= lang('Home.Deshabilitar'); ?>
                                       </a>
                                       <a class="dropdown-item text-info" href="<?= base_url() . '/Employees/form_view/' . $e['user_id']; ?>">
                                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?= lang('Home.Editar'); ?>
                                       </a>
                                       <a class="dropdown-item text-secondary" href="<?= base_url() . '/Employees/competencies_view/' . $e['user_id']; ?>">
                                          <i class="fa fa-list-ol" aria-hidden="true"></i> <?= lang('Home.Calificar competencias'); ?>
                                       </a>
                                    <?php } ?>
                                    <a class="dropdown-item text-primary" href="javascript:void(0);" onclick="ver_detalles(<?= $e['user_id']; ?>);">
                                       <i class="fa fa-id-card-o" aria-hidden="true"></i> <?= lang('Home.Detalles'); ?>
                                    </a>
                                    <a class="dropdown-item text-dark" href="<?= base_url() . '/Employees/profile_view/' . $e['user_id'] . '/' . $e['position_id']; ?>">
                                       <i class="fa fa-address-book" aria-hidden="true"> <?= lang('Home.Perfil'); ?></i>
                                    </a>
                                    <a class="dropdown-item text-dark" href="<?= base_url() . '/Employees/presentation_view/' . $e['user_id'] . '/' . $e['position_id']; ?>">
                                       <i class="fa fa-user-circle" aria-hidden="true"></i> <?= lang('Home.Presentación'); ?></i>
                                    </a>
                                 <?php } else { ?>
                                    <?php if ($_SESSION['credential_id'] == 1) { ?>
                                       <a class="dropdown-item text-success" href="javascript:void(0);" onclick="eliminar_datos(<?= $e['user_id']; ?>, 1);">
                                          <i class="fa fa-check" aria-hidden="true"></i> <?= lang('Home.Habilitar'); ?>
                                       </a>
                                    <?php } ?>
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
