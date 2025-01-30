<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title col-md-12">
      <div class="row">
          <div class="col-md-12 row mb-2 mt-2">
            <div class="col-md-3 mt-3">
               <h3 class="col-md-3"><span class="badge badge-pill badge-primary" style="text-transform: none !important;"><?= $title; ?></span></h3>
             </div>
            <div class="col-md-9 mt-3">
         	<?php if($_SESSION['language'] == 'es'){ ?>
            	<a href="<?= base_url().'/public/formatos/plantilla_sistema.xlsx'; ?>" class="btn btn-success col-md-4 pull-right"><i class="fa fa-file-excel-o" aria-hidden="true"></i> <?= lang('Home.Descargar formato'); ?></a>
            <?php }else{ ?>
            	<a href="<?= base_url().'/public/formatos/plantilla_sistema_ingles.xlsx'; ?>" class="btn btn-success col-md-4 pull-right"><i class="fa fa-file-excel-o" aria-hidden="true"></i> <?= lang('Home.Descargar formato'); ?></a>
            <?php } ?>
         	</div>
         </div>
      </div>
   </div>
</div>
<div class="iq-card iq-card-block iq-card-stretch" id="contenedor2">                    
   <div class="iq-card-body" style="width: 100% !important;">
		<div class="col-md-12 mb-3 progress">
			<div class="progress-bar progress-bar-mecanismos" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
		</div>
	   	<div class="form-group mb-3">
	   		<label for=""><?= lang('Home.Formato'); ?></label>
				<input type="hidden" class="form-control txt_csrfname_file" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
				<input type="file" class="form-control-file archivo_excel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="archivo_excel">
	   	</div>
	   	<div class="form-group mb-3">
            <button type="button" class="btn-form btn mb-6 btn-success" onclick="validar_documento();">
            	<i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Guardar'); ?>
            </button>
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
	// variables de mensajes
	var loads_1 = '<?= lang('Home.No se encontraron registros ubicado en la hoja organización.'); ?>';
	var loads_2 = '<?= lang('Home.No se encontraron registros de los departamentos, ubicado en la hoja de usuarios.'); ?>';
	var loads_3 = '<?= lang('Home.No se encontraron registros de los puestos, ubicado en la hoja de usuarios.'); ?>';
	var loads_4 = '<?= lang('Home.No se encontraron registros de los usuarios, ubicado en la hoja de usuarios.'); ?>';
	var loads_5 = '<?= lang('Home.No se encontraron registros de los empleados, ubicado en la hoja de usuarios.'); ?>';
	var loads_6 = '<?= lang('Home.No se encontraron registros de las calificaciones de las competencias, ubicado en la hoja de calificar competencias en.'); ?>';
	var loads_7 = '<?= lang('Home.No se encontraron registros ubicado en la hoja de innovaciones.'); ?>';
	var loads_8 = '<?= lang('Home.No se encontraron registros ubicado en la hoja de resoluciones.'); ?>';
	var loads_9 = '<?= lang('Home.No se encontraron registros ubicado en la hoja de funciones.'); ?>';
	var loads_10 = '<?= lang('Home.Favor de validar el excel, se encontraron emails repetidos, ubicado en la hoja de usuarios.'); ?>';
	var label_listado = '<?= lang('Home.Lista de errores del formato'); ?>';
	var label_listado = '<?= lang('Home.Lista de errores del formato'); ?>';
	var label_guardado = '<?= lang('Home.Los datos se guardaron correctamente.') ?>';
</script>             
