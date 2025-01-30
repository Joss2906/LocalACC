<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title col-md-12">
      <div class="row">
          <div class="col-md-12 row mb-2 mt-2">
            <div class="col-md-3 mt-3">
               <h3 class="card-title col-md-2"><span class="badge badge-pill badge-primary" style="text-transform: none !important;"><?= $title; ?></span></h3>
         	</div>
            <div class="col-md-9 mt-3">
            <?php if($_SESSION['credential_id'] == 1){ ?>
            <a href="<?= base_url().'/Statistics/general_view'; ?>" class="btn btn-success col-md-4 pull-right" onclick="modal_puestos('', '', '', 'Agregar');">
            	<i class="fa fa-info-circle" aria-hidden="true"></i> <?= lang('Home.Panorama general.');?>
            </a>
         	<?php } ?>
         	</div>
         </div>
      </div>
   </div>
</div>
<div class="iq-card iq-card-block iq-card-stretch">                    
   <div class="iq-card-body" style="width: 100% !important;">
	  	<div class="col-md-12 row mb-6">
			<form class="form-datos row col-md-12">  				
	      	<div class="form-group col-md-6 mb-3">
					<label for="organization_id"><?= lang('Home.Organización');?>*</label>
					<select class="form-control organization_id" name="organization_id" id="organization_id" onchange="get_empleados_organizacion();">
						<option value=""><?= lang('Home.Seleccione una opción');?></option>
						<?php foreach ($organizations as $o) { ?>
							<?php if($_SESSION['organization_id'] == $o['organization_id']){ $selected = 'selected';}else{ $selected = ''; } ?>
							<option <?= $selected; ?> value="<?= $o['organization_id']; ?>"><?= $o['organization']; ?></option>
						<?php } ?>
					</select>
	      	</div>
	      	<div class="form-group col-md-6 mb-3">
	      		<label for=""><?= lang('Home.Socio');?></label>
	      		<select class="form-control user_id" name="user_id" id="user_id" onchange="load_datos();"><?= lang('Home.Seleccione un empleado');?></select>
	      	</div>
			</form>	
	  	</div>
   </div>
</div> 

<script>
   var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
	var label_productividad = '<?= lang('Home.Productividad') ?>';
	var label_calidad = '<?= lang('Home.Calidad') ?>';
	var label_servicio = '<?= lang('Home.Servicio') ?>';
	var label_innovacion = '<?= lang('Home.Innovación') ?>';
	var label_promedio = '<?= lang('Home.Promedio') ?>';
	var label_obtenido = '<?= lang('Home.Obtenido') ?>';
	var label_faltante = '<?= lang('Home.Faltante') ?>';
	var label_yo = '<?= lang('Home.Yo') ?>';
	var label_otros = '<?= lang('Home.Otros') ?>';
</script>               
