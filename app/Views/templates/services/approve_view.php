<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title col-md-12">
      <div class="row">
          <div class="col-md-12 row mb-2 mt-2">
               <h3 class="card-title col-md-3"><span class="badge badge-pill badge-primary" style="text-transform: none !important;"><?= $title; ?></span></h3>
         </div>
      </div>
   </div>
</div>
<div class="iq-card iq-card-block iq-card-stretch"> 
	<div class="iq-card-body">
	   	<div class="col-md-12 row">
	     	<div class="col-md-6 mb-3">
				<label for="organization_id"><?= lang('Home.Organización');?>*</label>
				<select class="form-control organization_id" name="organization_id" id="organization_id" onchange="get_empleados();">
					<option value=""><?= lang('Home.Seleccione una opción');?></option>
					<?php foreach ($organizations as $o) { ?>
						<?php if($_SESSION['organization_id'] == $o['organization_id']){ $selected = 'selected'; }else{ $selected = ''; } ?>
						<option <?= $selected; ?> value="<?= $o['organization_id']; ?>"><?= $o['organization']; ?></option>
					<?php } ?>
				</select>
	     	</div>
	     	<div class="col-md-6 mb-3">
				<label for="user_id"><?= lang('Home.Socio');?>*</label>
				<select class="form-control user_id" name="user_id" id="user_id" onchange="get_servicios();"></select>
	     	</div>
	   	</div>
		<div class="col-md-12 row"><hr></div>
		<div class="col-md-12 row">
			<div class="col-md-12 table-responsive">
				<h5><?= lang('Home.Servicios comunes');?></h5>
				<table id="datatable-comunes" class="table table-bordered">
					<thead>
						<tr class="table-success">
							<th style="width: 2%">#</th>
							<th style="width: 44%"><?= lang('Home.Descripción');?></th>
							<th style="width: 10%"><?= lang('Home.Frecuencia');?></th>
							<th style="width: 13%"><?= lang('Home.Cantidad por mes');?></th>
							<th style="width: 13%;"><?= lang('Home.Estatus validado');?></th>
							<th style="width: 20%"><?= lang('Home.Acciones');?></th>
						</tr>
					</thead>
					<tbody class="tbody-datos-comunes"></tbody>
				</table>
				<hr>
				<h5><?= lang('Home.Servicios hibrídos');?></h5>
				<table id="datatable-hibridos" class="table table-bordered">
					<thead>
						<tr class="table-info">
							<th style="width: 2%">#</th>
							<th style="width: 44%"><?= lang('Home.Descripción');?></th>
							<th style="width: 10%"><?= lang('Home.Frecuencia');?></th>
							<th style="width: 13%"><?= lang('Home.Cantidad por mes');?></th>
							<th style="width: 13%;"><?= lang('Home.Estatus validado');?></th>
							<th style="width: 20%"><?= lang('Home.Acciones');?></th>
						</tr>
					</thead>
					<tbody class="tbody-datos-hibridos"></tbody>
				</table>
				<hr>
				<h5><?= lang('Home.Servicios esporádicos');?></h5>
				<table id="datatable-esporadicos" class="table table-bordered">
					<thead>
						<tr class="table-danger">
							<th style="width: 2%">#</th>
							<th style="width: 44%"><?= lang('Home.Descripción');?></th>
							<th style="width: 10%"><?= lang('Home.Frecuencia');?></th>
							<th style="width: 13%"><?= lang('Home.Cantidad por mes');?></th>
							<th style="width: 13%;"><?= lang('Home.Estatus validado');?></th>
							<th style="width: 20%"><?= lang('Home.Acciones');?></th>
						</tr>
					</thead>
					<tbody class="tbody-datos-esporadicos"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
    var services_status = '';
    var option = '';
    <?php echo 'var services_status ='.json_encode($services_status).'; '; ?>
    
    var label_eliminar = '<?= lang('Home.¿Desea eliminar el registro?'); ?>';
    var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
    var label_sumatoria_ponderaciones = '<?= lang('Home.La sumatoria de las ponderaciones dan mas del 100%'); ?>';
    var label_validar_ponderaciones = '<?= lang('Home.Favor de validar las ponderaciones de lo servicios debe ser mayor a 0.'); ?>';
    var label_imagen = '<?= lang('Home.Favor de esperar la carga de la imagen, puede tardar según la velocidad del internet. El sistema le mostrará un mensaje cuando la carga haya finalizado.'); ?>';
    var label_validar_imagen = '<?= lang('Home.Validar que el archivo no excede el tamaño permitido'); ?>';
    var label_aprobar = '<?= lang('Home.Aprobar'); ?>';
    var label_rechazar = '<?= lang('Home.Rechazar'); ?>';
    var label_pendiente = '<?= lang('Home.Pendiente'); ?>';
    var label_aprobado = '<?= lang('Home.Aprobado'); ?>';
    var label_rechazado = '<?= lang('Home.Rechazado'); ?>';
    var label_cambiar_estatus = '<?= lang('Home.¿Desea cambiar el estatus del registro?'); ?>';
    var label_cambiar_aprobar = '<?= lang('Home.¿Desea aprobar el estatus del registro?'); ?>';
    var label_cambiar_rechazar= '<?= lang('Home.¿Desea rechazar el estatus del registro?'); ?>';
</script>