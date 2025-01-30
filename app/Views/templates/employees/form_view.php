<div class="iq-card">
	<div class="iq-card-body">
		<ul class="nav nav-tabs justify-content-center" id="myTab-three" role="tablist">
			<!--pestaña datos usuario-->
			<li class="nav-item">
				<a class="nav-link active" id="user-tab-three" onclick="active_form(1);" data-toggle="tab" href="#user-three" role="tab" aria-controls="user" aria-selected="false">
					<?= lang('Home.Datos usuario'); ?>
				</a>
			</li>
						<!--pestaña datos personales-->

			<li class="nav-item">
				<a class="nav-link" id="personal-tab-three" onclick="active_form(2);" data-toggle="tab" href="#personal-three" role="tab" aria-controls="personal" aria-selected="true"><?= lang('Datos personales'); ?></a>
			</li>
						<!--pestaña datos socio-->

			<li class="nav-item">
				<a class="nav-link" id="employee-tab-three" onclick="active_form(3); validate_seguridad();" data-toggle="tab" href="#employee-three" role="tab" aria-controls="employee" aria-selected="false"><?= lang('Home.Datos socio'); ?></a>
			</li>
		</ul>

		<!-- Formulario credenciales -->
		<div class="tab-content" id="myTabContent-4">
			<div class="tab-pane fade active show" id="user-three" role="tabpanel" aria-labelledby="user-tab-three">
				<form class="form-user" id="form-user" autocomplete="off">
					<div class="col-md-12 row">
				<!-- campo user-->
						<div class="col-md-4 mb-3">
							<label for="user"><?= lang('Home.Usuario'); ?>*</label>
							<input type="hidden" class="form-control user_id" name="user_id" value="<?= $employee['user_id']; ?>">
							<input type="text" class="form-control user" name="user" maxlength="25" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)" value="<?= $employee['user']; ?>">
						</div>
				<!-- campo password-->
						<div class="col-md-4 mb-3">
							<label for="password"><?= lang('Home.Contraseña'); ?>*</label>
							<input type="text" class="form-control" name="password">
						</div>
					<!-- campo credencial-->
						<div class="col-md-4 mb-3">
							<label for="credential_id"><?= lang('Home.Credencial'); ?></label>
							<select class="form-control credential_id" name="credential_id" id="credential_id" onchange="view_razon_social();">
								<option value=""><?= lang('Home.Seleccione una opción'); ?></option>
								<?php foreach ($credentials as $c) { ?>
									<option <?= ($employee['credential_id'] == $c['credential_id']) ? 'selected' : ''; ?> value="<?= $c['credential_id']; ?>"><?= lang('Home.' . $c['credential']); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</form>
			</div>

			<!-- Formulario datos personales -->
			<div class="tab-pane fade" id="personal-three" role="tabpanel" aria-labelledby="personal-tab-three">
				<form class="form-personal" id="form-personal" autocomplete="off">
					<div class="col-md-12 row">
						<div class="col-md-3 mb-3">
							<label for="first_name"><?= lang('Home.Nombre'); ?>*</label>
							<input type="hidden" class="form-control employee_id" name="employee_id" value="<?= $employee['employee_id']; ?>">
							<input type="text" class="form-control first_name" name="first_name" maxlength="75" onkeyup="this.value=caracteres_validos(this.value)" value="<?= $employee['first_name']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="second_name"><?= lang('Home.Segundo nombre'); ?></label>
							<input type="text" class="form-control second_name" name="second_name" maxlength="75" onkeyup="this.value=caracteres_validos(this.value)" value="<?= $employee['second_name']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="last_name"><?= lang('Home.Apellido paterno'); ?>*</label>
							<input type="text" class="form-control last_name" name="last_name" maxlength="75" onkeyup="this.value=caracteres_validos(this.value)" value="<?= $employee['last_name']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="second_last_name"><?= lang('Home.Apellido materno'); ?></label>
							<input type="text" class="form-control second_last_name" name="second_last_name" maxlength="75" onkeyup="this.value=caracteres_validos(this.value)" value="<?= $employee['second_last_name']; ?>">
						</div>
						
								<!--Razon social-->		

							<div class="col-md-12 mb-3 div-razon-social">
							<label for="business_name"><?= lang('Home.Razón social'); ?>*</label>
							<input type="text" class="form-control business_name" name="business_name" maxlength="75" onkeyup="this.value=caracteres_validos(this.value)" value="<?= $employee['business_name']; ?>">
						</div>
						
						

						<div class="col-md-3 mb-3">
							<label for="gender_id"><?= lang('Home.Género'); ?>*</label>
							<select class="form-control gender_id" name="gender_id" id="gender_id">
								<option value=""><?= lang('Home.Seleccione una opción'); ?></option>
								<?php foreach ($genders as $g) { ?>
									<option <?= ($employee['gender_id'] == $g['gender_id']) ? 'selected' : ''; ?> value="<?= $g['gender_id']; ?>"><?= lang('Home.' . $g['gender']); ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="col-md-3 mb-3">
							<label for="birthday"><?= lang('Home.Fecha de nacimiento'); ?>*</label>
							<input type="text" class="form-control birthday" name="birthday" maxlength="75" value="<?= $employee['birthday']; ?>">
						</div>

						<div class="col-md-6 mb-3">
							<label for="email"><?= lang('Home.Correo electrónico'); ?>*</label>
							<input type="text" class="form-control email" name="email" maxlength="75" value="<?= $employee['email']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="phone"><?= lang('Home.Teléfono'); ?>*</label>
							<input type="text" class="form-control phone" name="phone" maxlength="13" onkeypress="return justIntegers(event);" value="<?= $employee['phone']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="mobile"><?= lang('Home.Celular'); ?>*</label>
							<input type="text" class="form-control mobile" name="mobile" maxlength="13" onkeypress="return justIntegers(event);" value="<?= $employee['mobile']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="civil_status_id"><?= lang('Home.Estado civil'); ?>*</label>
							<select class="form-control civil_status_id" name="civil_status_id" id="civil_status_id">
								<option value=""><?= lang('Home.Seleccione una opción'); ?></option>
								<?php foreach ($civil_status as $cs) { ?>
									<option <?= ($employee['civil_status_id'] == $cs['civil_status_id']) ? 'selected' : ''; ?> value="<?= $cs['civil_status_id']; ?>"><?= lang('Home.' . $cs['civil_status']); ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="col-md-3 mb-3">
							<label for="economic_dependents"><?= lang('Home.Dependientes económicos'); ?>*</label>
							<input type="text" class="form-control economic_dependents" name="economic_dependents" maxlength="2" value="<?= $employee['economic_dependents']; ?>" onkeypress="return justIntegers(event);">
						</div>

						<div class="col-md-3 mb-3">
							<label for="street"><?= lang('Home.Calle'); ?>*</label>
							<input type="text" class="form-control street" name="street" maxlength="75" value="<?= $employee['street']; ?>" onkeyup="this.value=caracteres_numeros_validos(this.value)">
						</div>

						<div class="col-md-3 mb-3">
							<label for="number"><?= lang('Home.Número'); ?>*</label>
							<input type="text" class="form-control number" name="number" maxlength="75" value="<?= $employee['number']; ?>" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)">
						</div>

						<div class="col-md-3 mb-3">
							<label for="suburb"><?= lang('Home.Colonia'); ?>*</label>
							<input type="text" class="form-control suburb" name="suburb" maxlength="75" value="<?= $employee['suburb']; ?>" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)">
						</div>

						<div class="col-md-3 mb-3">
							<label for="postal_code"><?= lang('Home.Código postal'); ?>*</label>
							<input type="text" class="form-control postal_code" name="postal_code" maxlength="5" value="<?= $employee['postal_code']; ?>" onkeypress="return justIntegers(event);">
						</div>

						<div class="col-md-3 mb-3">
							<label for="estate"><?= lang('Home.Estado'); ?>*</label>
							<input type="text" class="form-control estate" name="estate" maxlength="75" value="<?= $employee['estate']; ?>" onkeyup="this.value=caracteres_validos(this.value)">
						</div>

						<div class="col-md-3 mb-3">
							<label for="delegation"><?= lang('Home.Delegación'); ?>*</label>
							<input type="text" class="form-control delegation" name="delegation" maxlength="75" value="<?= $employee['delegation']; ?>" onkeyup="this.value=caracteres_signos_numeros_validos(this.value)">
						</div>

						<div class="col-md-3 mb-3">
							<label for="country_id"><?= lang('Home.País'); ?>*</label>
							<select class="form-control country_id" name="country_id" id="country_id">
								<option value=""><?= lang('Home.Seleccione una opción'); ?></option>
								<?php foreach ($countries as $c) { ?>
									<option <?= ($employee['country_id'] == $c['country_id']) ? 'selected' : ''; ?> value="<?= $c['country_id']; ?>"><?= $c['country']; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="col-md-3 mb-3">
							<label for="nationality_id"><?= lang('Home.Nacionalidad'); ?>*</label>
							<select class="form-control nationality_id" name="nationality_id" id="nationality_id">
								<option value=""><?= lang('Home.Seleccione una opción'); ?></option>
								<?php foreach ($nationalities as $n) { ?>
									<option <?= ($employee['nationality_id'] == $n['nationality_id']) ? 'selected' : ''; ?> value="<?= $n['nationality_id']; ?>"><?= $n['nationality']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</form>
			</div>

			<!-- Formulario datos del empleado -->
			<div class="tab-pane fade" id="employee-three" role="tabpanel" aria-labelledby="employee-tab-three">
				<form class="form-employee" id="form-employee" autocomplete="off">
					<div class="col-md-12 row">
						<div class="col-md-3 mb-3">
							<label for="schooling_id"><?= lang('Home.Educación'); ?>*</label>
							<select class="form-control schooling_id" name="schooling_id" id="schooling_id">
								<option value=""><?= lang('Home.Seleccione una opción'); ?></option>
								<?php foreach ($schooling as $s) { ?>
									<option <?= ($employee['schooling_id'] == $s['schooling_id']) ? 'selected' : ''; ?> value="<?= $s['schooling_id']; ?>"><?= lang('Home.' . $s['schooling']); ?></option>
								<?php } ?>
							</select>
						</div>

						<!--ORGANIZACIÓN-->
						<div class="col-md-3 mb-3">
							<label for="organization_id"><?= lang('Home.Organización'); ?>*</label>
							<select class="form-control organization_id" name="organization_id" id="organization_id" onchange="get_departamentos_puestos();">
								<option value=""><?= lang('Home.Seleccione una opción'); ?></option>
								<?php foreach ($organizations as $o) { ?>
									<option <?= ($employee['organization_id'] == $o['organization_id']) ? 'selected' : ''; ?> value="<?= $o['organization_id']; ?>"><?= $o['organization']; ?></option>
								<?php } ?>

								
							</select>
						</div>

						<div class="col-md-3 mb-3">
							<label for="department_id"><?= lang('Home.Departamento'); ?>*</label>
							<select class="form-control department_id" data-department_id="<?= $employee['department_id']; ?>" name="department_id" id="department_id">
							</select>
						</div>

						<div class="col-md-3 mb-3">
							<label for="position_id"><?= lang('Home.Puesto'); ?>*</label>
							<select class="form-control position_id" data-position_id="<?= $employee['position_id']; ?>" name="position_id" id="position_id">
							</select>
						</div>

						<div class="col-md-3 mb-3">
							<label for="date_admission"><?= lang('Home.Fecha de ingreso'); ?>*</label>
							<input type="text" class="form-control date_admission" name="date_admission" maxlength="75" value="<?= $employee['date_admission']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="salary_amount"><?= lang('Home.Salario o cantidad comprada'); ?>*</label>
							<input type="text" class="form-control salary_amount" name="salary_amount" onkeyup="monto_total();" onkeypress="return justDecimals(event);" maxlength="75" value="<?= $employee['salary_amount']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="social_security"><?= lang('Home.Monto seguro social'); ?>*</label>
							<input type="text" class="form-control social_security" name="social_security" onkeyup="monto_total();" onkeypress="return justDecimals(event);" maxlength="75" value="<?= $employee['social_security']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="benefit_1"><?= lang('Home.Prestación'); ?> #1</label>
							<input type="text" class="form-control benefit_1" name="benefit_1" maxlength="75" value="<?= $employee['benefit_1']; ?>" placeholder="<?= lang('Home.Nombre de la prestación'); ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="benefit_amount_1"><?= lang('Home.Monto prestación'); ?> #1</label>
							<input type="text" class="form-control benefit_amount_1" name="benefit_amount_1" onkeyup="monto_total();" onkeypress="return justDecimals(event);" maxlength="75" value="<?= $employee['benefit_amount_1']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="benefit_2"><?= lang('Home.Prestación'); ?> #2</label>
							<input type="text" class="form-control benefit_2" name="benefit_2" maxlength="75" value="<?= $employee['benefit_2']; ?>" placeholder="<?= lang('Home.Nombre de la prestación'); ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="benefit_amount_2"><?= lang('Home.Monto prestación'); ?> #2</label>
							<input type="text" class="form-control benefit_amount_2" name="benefit_amount_2" onkeyup="monto_total();" onkeypress="return justDecimals(event);" maxlength="75" value="<?= $employee['benefit_amount_2']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="benefit_3"><?= lang('Home.Prestación'); ?> #3</label>
							<input type="text" class="form-control benefit_3" name="benefit_3" maxlength="75" value="<?= $employee['benefit_3']; ?>" placeholder="<?= lang('Home.Nombre de la prestación'); ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="benefit_amount_3"><?= lang('Home.Monto prestación'); ?> #3</label>
							<input type="text" class="form-control benefit_amount_3" name="benefit_amount_3" onkeyup="monto_total();" onkeypress="return justDecimals(event);" maxlength="75" value="<?= $employee['benefit_amount_3']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="benefit_4"><?= lang('Home.Prestación'); ?> #4</label>
							<input type="text" class="form-control benefit_4" name="benefit_4" maxlength="75" value="<?= $employee['benefit_4']; ?>" placeholder="<?= lang('Home.Nombre de la prestación'); ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="benefit_amount_4"><?= lang('Home.Monto prestación'); ?> #4</label>
							<input type="text" class="form-control benefit_amount_4" name="benefit_amount_4" onkeyup="monto_total();" onkeypress="return justDecimals(event);" maxlength="75" value="<?= $employee['benefit_amount_4']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="total"><?= lang('Home.Total'); ?>*</label>
							<input type="text" class="form-control total" name="total" onkeyup="monto_total();" onkeypress="return justDecimals(event);" maxlength="75" readonly value="<?= $employee['total']; ?>">
						</div>

						<div class="col-md-3 mb-3">
							<label for="disc">Disc*</label>
							<input type="text" class="form-control disc" name="disc" onkeypress="return justIntegers(event);" maxlength="75" value="<?= $employee['disc']; ?>">
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<!-- Botones de acción -->
		<div class="col-md-12 row">
			<div class="col-md-12 alert bg-white alert-success" role="alert" style="display: none;">
				<div class="iq-alert-icon">
					<i class="ri-information-line"></i>
				</div>
				<div class="iq-alert-text alert-text-exito"></div>
				<button type="button" class="close text-muted" data-dismiss="alert" aria-label="Close">
					<i class="ri-close-line"></i>
				</button>
			</div>

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
					<button class="btn btn-success btn-form" type="button" onclick="validar_form();"><i class="ri-add-circle-fill"></i> <?= lang('Home.Agregar'); ?></button>
					<a href="<?= base_url(); ?>/Employees" class="btn btn-secondary"><i class="ri-close-circle-fill"></i> <?= lang('Home.Cancelar'); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>				
<!-- scripts-->
<script>
	var label_favor_registrar = '<?= lang('Home.Favor de registrar los datos del usuario.'); ?>';
	var label_error_nuevamente = '<?= lang('Home.Error, Intente nuevamente'); ?>';
	var label_guardaron_correctamente = '<?= lang('Home.Se guardaron correctamente los datos.'); ?>';
	var label_deshabilitar = '<?= lang('Home.¿Desea deshabilitar el registro?'); ?>';
	var label_habilitar = '<?= lang('Home.¿Desea habilitar el registro?'); ?>';
	var label_200 = '<?= lang('Home.La calificación no puede ser mayor a 200') ?>';
	var label_100 = '<?= lang('Home.La calificación no puede ser mayor a 100') ?>';
	var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
</script>
