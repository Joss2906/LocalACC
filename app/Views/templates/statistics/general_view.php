<div class="iq-card iq-card-block iq-card-stretch">                
   <div class="iq-card-body" style="width: 100% !important;">
		<div class="col-md-12 row">
			<form class="form-datos col-md-12 row">			
				<div class="form-group col-md-4 mb-3">
				  <label for=""><?= lang('Home.Fecha inicial');?></label>
				  <input type="text" class="form-control col-md-12 initial_date" name="initial_date" id="initial_date" value="<?= date('Y-m-d'); ?>">
				</div>
				<div class="form-group col-md-4 mb-3">
				  <label for=""><?= lang('Home.Fecha Final');?></label>
				  <input type="text" class="form-control col-md-12 final_date" name="final_date" id="final_date" value="<?= date('Y-m-d'); ?>">
				</div>
				<div class="form-group col-md-4 mb-3">
					<br><br>
				  	<button type="button" class="btn btn-success" onclick="get_datos();">
				  		<i class="fa fa-search" aria-hidden="true"></i>
				  	</button>
				</div>
			</form>
		</div>
		<div class="col-md-12 row mb-6 div-graficas">	
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Desempeño general');?></p>
					<div id="chart-desempeño-general" style="height: 450px!important; "></div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Desempeño Educación Escolar');?></p>
					<div id="chart-desempeño-educacion" style="height: 450px!important; "></div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Desempeño Edades');?></p>
					<div id="chart-desempeño-edades" style="height: 450px!important; "></div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Desempeño Géneros');?></p>
					<div id="chart-desempeño-generos" style="height: 450px!important; "></div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Desempeño Departamentos');?></p>
					<div class="div-chart-departamentos">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Departamentos - Productividad');?></p>
					<div class="div-chart-departamentos-productividad">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Departamentos - Calidad');?></p>
					<div class="div-chart-departamentos-calidad">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Departamentos - Servicio');?></p>
					<div class="div-chart-departamentos-servicio">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Departamentos - Innovación');?></p>
					<div class="div-chart-departamentos-innovacion">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Desempeño puestos');?></p>
					<div class="div-chart-puestos">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Puestos - Productividad');?></p>
					<div class="div-chart-puestos-productividad">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Puestos - Calidad');?></p>
					<div class="div-chart-puestos-calidad">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Puestos - Servicio');?></p>
					<div class="div-chart-puestos-servicio">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Puestos - Innovación');?></p>
					<div class="div-chart-puestos-innovacion">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Período de Tiempo');?></p>
					<div id="chart-desempeño-periodo" style="height: 450px!important; "></div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Período de Tiempo - Productividad');?></p>
					<div id="chart-desempeño-periodo-productividad" style="height: 400px!important; "></div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Período de Tiempo - Calidad');?></p>
					<div id="chart-desempeño-periodo-calidad" style="height: 400px!important; "></div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Período de Tiempo - Servicio');?></p>
					<div id="chart-desempeño-periodo-servicio" style="height: 400px!important; "></div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Período de Tiempo - Innovación');?></p>
					<div id="chart-desempeño-periodo-innovacion" style="height: 400px!important; "></div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Empleados');?></p>
					<div class="div-chart-empleados">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Empleados - Productividad');?></p>
					<div class="div-chart-empleados-productividad">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Empleados - Calidad');?></p>
					<div class="div-chart-empleados-calidad">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Empleados - Servicio');?></p>
					<div class="div-chart-empleados-servicio">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Empleados - Innovación');?></p>
					<div class="div-chart-empleados-innovacion">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Competencias');?></p>
					<div id="chart-competencias" style="height: 400px!important; "></div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Desempeño Clientes');?></p>
					<div id="chart-desempeño-clientes" style="height: 450px!important; "></div>
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12 mb-3" style="text-align: center;">
					<p><?= lang('Home.Desempeño Proveedores');?></p>
					<div id="chart-desempeño-proveedores" style="height: 450px!important; "></div>
				</div>
			</div>
		</div>
   </div>
</div>

<script>
	get_datos();

	function get_datos(){
		initial_date = $('.initial_date').val();
		final_date = $('.final_date').val();

		var initial_date = new Date(initial_date);
		var final_date = new Date(final_date);

		console.log(initial_date);
		console.log(final_date);

		if(initial_date.getTime() <= final_date.getTime()){		
			$(".div-graficas").load(location.href + " .div-graficas");
			setTimeout(function(){  
				get_grafica_general();
				get_grafica_educacion();
				get_grafica_generos();
				get_grafica_edades();
				get_grafica_departamentos();
				get_grafica_puestos();
				get_grafica_periodo();
				get_grafica_empleados();
				get_grafica_competencias();
				get_grafica_general_clientes();
				get_grafica_general_proveedores();
			}, 1000);
		}else{
			alert('<?= lang('Home.La fecha inicial no puede ser mayor a la fecha final');?>');
		}
	}

	var label_productividad = '<?= lang('Home.Productividad') ?>';
	var label_calidad = '<?= lang('Home.Calidad') ?>';
	var label_servicio = '<?= lang('Home.Servicio') ?>';
	var label_innovacion = '<?= lang('Home.Innovación') ?>';
	var label_promedio = '<?= lang('Home.Promedio') ?>';
	var label_obtenido = '<?= lang('Home.Obtenido') ?>';
	var label_faltante = '<?= lang('Home.Faltante') ?>';
	var label_yo = '<?= lang('Home.Yo') ?>';
	var label_otros = '<?= lang('Home.Otros') ?>';
   var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
</script>           
