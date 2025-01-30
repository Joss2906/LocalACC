<div class="iq-card">
	<div class="iq-card-body">
		<form class="form-datos" autocomplete="off">
		   	<div class="col-md-12 row">
		     	<div class="col-md-4 mb-3">
		       		<input type="hidden" class="form-control service_id" name="service_id" value="<?= $service['service_id']; ?>">
		       		<?php if($service['position_id'] == 0 || $service['position_id'] == ''){ $position_id = $_SESSION['position_id']; }else{ $position_id = $service['position_id']; } ?>
		       		<input type="hidden" class="form-control position" value="<?= $position_id; ?>">
					<label for="organization_id"><?= lang('Home.Organización');?>*</label>
					<select class="form-control organization_id" name="organization_id" id="organization_id" onchange="get_empleados_organizacion();">
						<option value="">Seleccione una opción</option>
						<?php foreach ($organizations as $o) { ?>
							<?php if($service['organization_id'] == $o['organization_id'] || $_SESSION['organization_id'] == $o['organization_id']){ $selected = 'selected'; }else{ $selected = ''; } ?>
							<option <?= $selected; ?> value="<?= $o['organization_id']; ?>"><?= $o['organization']; ?></option>
						<?php } ?>
					</select>
		     	</div>
		     	<div class="col-md-4 mb-3 div-employees" style="display: none;">
					<label for="user_id"><?= lang('Home.Socio');?>*</label>
					<select class="form-control user_id" name="user_id" id="user_id" value="<?= $service['user_id']; ?>">
					</select>
		     	</div>
		     	<div class="col-md-4 mb-3 div-positions" style="display: none;">
					<label for="position_id"><?= lang('Home.Posición');?>*</label>
					<select class="form-control position_id" name="position_id" id="position_id">
					</select>
		     	</div>
		     	<div class="col-md-12 mb-3">
		       		<label for="service"><?= lang('Home.Descripción');?>*</label>
					<textarea class="form-control" name="description" rows="2" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)"><?= $service['description']; ?></textarea>
		     	</div>
		     	<div class="col-md-4 mb-3">
		       		<label for="frequency"><?= lang('Home.Frecuencia');?>*</label>
		     		<input type="text" class="form-control" name="frequency" value="<?= $service['frequency']; ?>">
		     	</div>
		     	<div class="col-md-4 mb-3">
		       		<label for="monthly_amount"><?= lang('Home.Cantidad al mes');?>*</label>
		     		<input type="text" class="form-control" name="monthly_amount" onkeypress="return justDecimals(event);" value="<?= $service['monthly_amount']; ?>">
		     	</div>
		     	<div class="col-md-4 mb-3 div-costo" style="display: none;">
		       		<label for="employee_cost"><?= lang('Home.Costo del empleado');?>*</label>
		     		<input type="text" class="form-control employee_cost" name="employee_cost" onkeypress="return justDecimals(event);" readonly value="<?= $service['employee_cost']; ?>">
		     	</div>
		     	<div class="col-md-6 mb-3">
		       		<label for="productivity"><?= lang('Home.Productividad');?>*</label>
					<textarea class="form-control" name="productivity" rows="2" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)"><?= $service['productivity']; ?></textarea>
		     	</div>
		     	<div class="col-md-6 mb-3">
		       		<label for="quality"><?= lang('Home.Calidad');?>*</label>
					<textarea class="form-control" name="quality" rows="2" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)"><?= $service['quality']; ?></textarea>
		     	</div>
		     	<div class="col-md-6 mb-3">
		       		<label for="innovation"><?= lang('Home.Innovación');?>*</label>
					<textarea class="form-control" name="innovation" rows="2" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)"><?= $service['innovation']; ?></textarea>
		     	</div>
		     	<div class="col-md-6 mb-3">
		       		<label for="service"><?= lang('Home.Servicio');?>*</label>
					<textarea class="form-control" name="service" rows="2" maxlength="999" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)"><?= $service['service']; ?></textarea>
		     	</div>
		     	<div class="col-md-12 mb-3"><hr></div>
		     	<div class="col-md-12 mb-3">
		     		<div class="col-md-12 row">	     			
			     		<div class="col-md-8">	     			
				     		<h5><?= lang('Home.Clientes');?></h5>
				     		<p><?= lang('Home.¿Quién recibe este servicio?');?></p>
			     		</div>
			     		<div class="col-md-4">
			     			<label for=""><?= lang('Home.Socio');?></label>
			     			<select class="form-control customer_id" onchange="add_cliente();">
								<option value=""><?= lang('Home.Seleccione una opción');?></option>
			     			</select>
			     		</div>
			     		<div class="col-md-12 mt-3">		     			
							<table class="table">
								<thead>
									<tr>
									  	<th scope="col"><?= lang('Home.Cliente');?></th>
									  	<th scope="col"><?= lang('Home.Puesto');?></th>
									  	<th scope="col"><?= lang('Home.Acciones');?></th>
									</tr>
								</thead>
								<tbody class="tbody-clientes"></tbody>
							</table>
			     		</div>
		     		</div>
		     	</div>
		     	<div class="col-md-12 mb-3"><hr></div>
		     	<div class="col-md-12 mb-3">
		     		<div class="col-md-12 row">	     			
			     		<div class="col-md-8">	 
				     		<h5><?= lang('Home.Competidores');?></h5>
				     		<p><?= lang('Home.Información');?></p>
				     	</div>
			     		<div class="col-md-4">
			     			<button type="button" class="btn btn-success col-md-12" onclick="add_competidor();">
			     				<i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Agregar competidor');?>
			     			</button>
			     		</div> 
			     		<div class="col-md-12 mt-3">
							<table class="table">
								<thead>
									<tr>
									  	<th scope="col"><?= lang('Home.Competidor');?></th>
									  	<th scope="col"><?= lang('Home.Garantias ofrecidas');?></th>
									  	<th scope="col"><?= lang('Home.Precio ofrecido');?></th>
									  	<th scope="col"><?= lang('Home.Acciones');?></th>
									</tr>
								</thead>
								<tbody class="tbody-competidores"></tbody>
							</table>
			     		</div>
				     </div>
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
					    	<a href="<?=base_url().'/Services'; ?>" class="btn btn-secondary"><i class="ri-close-circle-fill"></i> <?= lang('Home.Cancelar');?></a>
					    </div>
					</div>
			    </div>
		    </div>
		</form>
	</div>
</div>

<script>
	get_clientes_competidores(0, <?= $service['service_id']; ?>);
    var label_eliminar = '<?= lang('Home.¿Desea eliminar el registro?'); ?>';
    var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
    var label_sumatoria_ponderaciones = '<?= lang('Home.La sumatoria de las ponderaciones dan mas del 100%'); ?>';
    var label_validar_ponderaciones = '<?= lang('Home.Favor de validar las ponderaciones de lo servicios debe ser mayor a 0.'); ?>';
    var label_imagen = '<?= lang('Home.Favor de esperar la carga de la imagen, puede tardar según la velocidad del internet. El sistema le mostrará un mensaje cuando la carga haya finalizado.'); ?>';
    var label_validar_imagen = '<?= lang('Home.Validar que el archivo no excede el tamaño permitido'); ?>';
</script>  