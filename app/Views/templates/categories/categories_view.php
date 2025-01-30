<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title col-md-12">
      <div class="row">
         <div class="col-md-12 row mb-2 mt-2">
            <div class="col-md-3 mt-3">
               <h3 class="col-md-2"><span class="badge badge-pill badge-primary" style="text-transform: none !important;"><?= $title; ?></span></h3>
            </div>
         </div>
         <div class="col-md-12 mb-3">
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
            <div class="col-md-12 alert bg-white alert-danger" id="alert-danger" role="alert" style="display: none;">
               <div class="iq-alert-icon">
                  <i class="ri-information-line"></i>
               </div>
               <div class="iq-alert-text alert-text-error"></div>
               <button type="button" class="close text-muted" data-dismiss="alert" aria-label="Close">
                  <i class="ri-close-line"></i>
               </button>
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
                  <th style="width: 10%">#</th>
                  <th style="width: 50%"><?= lang('Home.Categoría'); ?></th>
                  <th style="width: 40%"><?= lang('Home.Acciones'); ?></th>
               </tr>
            </thead>
            <tbody class="tbody-datos">
               <?php if ($categories) {
                  $i = 1; ?>
                  <?php foreach ($categories as $c) { ?>
                     <tr>

                        <!--id-->
                        <td><?= $i++; ?></td>

                        <!--categorias-->

                        <td><?= lang('Home.' . $c['category'] . ''); ?></td>

                        <!--acciones-->

                        <td>
                           <form class="form-<?= $c['satisfaction_category_id']; ?>">
                              <input type="hidden" class="form-control txt_csrfname_foto_<?= $c['satisfaction_category_id'] ?>" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                              <label for=""><?= lang('Home.Imagen'); ?></label>
                              <input type="file" class="form-control-file image_<?= $c['satisfaction_category_id']; ?>" name="image" accept="image/*">
                              <button type="button" class="btn btn-info mt-3" onclick="actualizar_imagen(<?= $c['satisfaction_category_id'] ?>);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><?= lang('Home.Actualizar'); ?></button>
                           </form>
                        </td>
                     </tr>
                  <?php } ?>
               <?php } ?>
            </tbody>
         </table>
      </div>
      <div class="col-md-12 mb-3">
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
         <div class="col-md-12 alert bg-white alert-danger" id="alert-danger" role="alert" style="display: none;">
            <div class="iq-alert-icon">
               <i class="ri-information-line"></i>
            </div>
            <div class="iq-alert-text alert-text-error"></div>
            <button type="button" class="close text-muted" data-dismiss="alert" aria-label="Close">
               <i class="ri-close-line"></i>
            </button>
         </div>
      </div>
   </div>
</div>


<script>
   var label_validar_archivo = '<?= lang('Home.Validar que el archivo no excede el tamaño permitido'); ?>';
</script>