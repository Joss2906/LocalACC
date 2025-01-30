<div class="iq-card">
	<div class="iq-card-body">
		<form class="form-datos" autocomplete="off">
		   	<div class="col-md-12 row">
		     	<div class="col-md-4 mb-3 div-employees">
					<label for="user_id"><?= lang('Home.Cliente');?>*</label>
		     		<input type="hidden" class="form-control task_id" name="task_id" value="<?= $task['task_id']; ?>">
		     		<input type="hidden" class="form-control service" name="service" value="<?= $task['service_id']; ?>">
		     		<input type="hidden" class="form-control my_productivity" name="my_productivity" value="1">
					<select class="form-control user_id" name="user_id" id="user_id">
					<option value="" data-position=""><?= lang('Home.Seleccione una opción');?></option>
					<?php foreach ($employees as $e) { ?>
						<?php if($e['user_id'] == $task['user_id']){ $selected = 'selected'; }else{ $selected = ''; } ?>
						<option <?= $selected; ?> data-position="<?= $e['position_id']; ?>" value="<?= $e['user_id']; ?>"><?= $e['name']; ?></option>
					<?php } ?>
					</select>
		     	</div>
		     	<div class="col-md-3 mb-3 div-employees">
					<label for="service_id"><?= lang('Home.Servicio o Función');?>*</label>
					<select class="form-control" name="service_id" id="service_id" value="<?= $task['service_id']; ?>">
					<option value="" data-position=""><?= lang('Home.Seleccione una opción');?></option>
					<?php foreach ($services as $s) { ?>
						<?php if($s['service_id'] == $task['service_id']){ $selected = 'selected'; }else{ $selected = ''; } ?>
						<option <?= $selected; ?> value="<?= $s['service_id']; ?>"><?= $s['description']; ?></option>
					<?php } ?>
					</select>
		     	</div>
		     	<div class="col-md-3 mb-3 div-costo">
		       		<label for="delivery_date_past"><?= lang('Home.Fecha para entrega del servicio');?>*</label>
		     		<input type="text" class="form-control delivery_date_past" name="delivery_date" value="<?= $task['delivery_date']; ?>">
		     	</div>
		     	<div class="col-md-2 mb-3 div-costo">
		       		<label for="amount"><?= lang('Home.Cantidad');?>*</label>
		     		<input type="text" class="form-control amount" name="amount" value="<?= $task['amount']; ?>" onkeypress="return justIntegers(event);">
		     	</div>
		     	<div class="col-md-6 mb-3">
		       		<label for="productivity"><?= lang('Home.Productividad');?>*</label>
					<textarea class="form-control" name="productivity" rows="2" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)"><?= $task['productivity']; ?></textarea>
		     	</div>
		     	<div class="col-md-6 mb-3">
		       		<label for="quality"><?= lang('Home.Calidad');?>*</label>
					<textarea class="form-control" name="quality" rows="2" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)"><?= $task['quality']; ?></textarea>
		     	</div>
		     	<div class="col-md-6 mb-3">
		       		<label for="innovation"><?= lang('Home.Innovación');?>*</label>
					<textarea class="form-control" name="innovation" rows="2" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)"><?= $task['innovation']; ?></textarea>
		     	</div>
		     	<div class="col-md-6 mb-3">
		       		<label for="service"><?= lang('Home.Servicio');?>*</label>
					<textarea class="form-control" name="service" rows="2" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)"><?= $task['service']; ?></textarea>
		     	</div>
				<div class="col-md-12 row">
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
					<div class="col-md-12 pull-right">		
					    <div class="form-group div-button">
					    	<input type="hidden" class="form-active" value="1">
					    	<button class="btn btn-success btn-form" type="button" onclick="validar_form();"><i class="ri-add-circle-fill"></i> <?= lang('Home.Agregar');?></button>
					    	<a href="<?=base_url().'/Tasks/register_view'; ?>" class="btn btn-secondary"><i class="ri-close-circle-fill"></i> <?= lang('Home.Cancelar');?></a>
					    </div>
					</div>
			    </div>
		    </div>
		</form>
	</div>
</div>

<script>
    var label_eliminar = '<?= lang('Home.¿Desea eliminar el registro?'); ?>';
    var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
    var label_documento = '<?= lang('Home.Favor de esperar la carga del documento, puede tardar según la velocidad del internet. El sistema le mostrará un mensaje cuando la carga haya finalizado.'); ?>';
    var label_validar = '<?= lang('Home.Validar que el archivo no excede el tamaño permitido'); ?>';
    var label_cambiar_aprobar = '<?= lang('Home.¿Desea aprobar el estatus del registro?'); ?>';
    var label_cambiar_rechazar= '<?= lang('Home.¿Desea rechazar el estatus del registro?'); ?>';
</script>  