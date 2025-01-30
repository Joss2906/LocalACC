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
				<form class="form-datos row col-md-12">
					<input type="hidden" class="user_id" name="user_id" value="<?= $user_id; ?>">
					<input type="hidden" class="position_id" name="position_id" value="<?= $position_id; ?>">
				</form>
         </div>
      </div>
   </div>
</div>
<div class="iq-card iq-card-block iq-card-stretch">                    
   <div class="iq-card-body" style="width: 100% !important;">
	  	<div class="col-md-12 row mb-6">
	   	<div class="col-md-12 mb-3">
	   		<h4><?= lang('Home.Número de evaluciones'); ?> # <span class="total_evaluaciones"></span></h4>
	   	</div>
	  	</div>
	   <div class="table-responsive mb-6">		
	      <table class="table table-bordered mb-6">
	         <thead class="table-dark">
	            <tr>
	               	<th style="width: 45%"><?= lang('Home.Servicio o Función Evaluado');?></th>
	               	<th style="width: 10%"><?= lang('Home.Productividad');?></th>
	               	<th style="width: 10%"><?= lang('Home.Calidad');?></th>
	               	<th style="width: 10%"><?= lang('Home.Servicio');?></th>
	               	<th style="width: 10%"><?= lang('Home.Innovación');?></th>
	                <th style="width: 15%"><?= lang('Home.Fecha de evaluación');?></th>
	            </tr>
	         </thead>
	         <tbody class="tbody-datos">
	         	<tr><td colspan="6"><?= lang('Home.No se encontraron resultados');?></td></tr>
	         </tbody>
	      </table>
	   </div>
	   <div class="col-md-12 mb-6" style="margin-top: 50px; margin-bottom: 35px;">
	   	<h4><i class="fa fa-bar-chart" aria-hidden="true"></i> <?= lang('Home.Gráficas');?></h4>
	   </div>
		<div class="col-md-12 row mb-6 div-contenedor div-graficas">
			<div class="col-md-6 offset-md-3 mb-3" style="text-align: center;">
				<p><?= lang('Home.Desempeño general');?></p>
				<div id="chart-desempeño-general" style="height: 375px!important; "></div>
			</div>
			<div class="col-md-12 mb-3" style="text-align: center;">
				<p><?= lang('Home.Mis competencias');?></p>
				<div id="chart-competencias"></div>
			</div>
			<div class="col-md-6 mb-3" style="text-align: center;">
				<p><?= lang('Home.Yo esta semana');?></p>
				<div id="chart-desempeño-semanal" style="height: 375px!important;"></div>
			</div>
			<div class="col-md-6 mb-3" style="text-align: center;">
				<p><?= lang('Home.Desempeño');?></p>
				<div id="chart-desempeño" style="height: 375px!important;"></div>
			</div>
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
	var label_servicios_funciones_ponderadas = '<?= lang('Home.Servicios o Funciones ponderadas') ?>';

	get_servicios();

	function precise_round(value, decPlaces) {
	   var val = value * Math.pow(10, decPlaces);
	   var fraction = (Math.round((val - parseInt(val)) * 10) / 10);

	   if (fraction == -0.5) fraction = -0.6;

	   val = Math.round(parseInt(val) + fraction) / Math.pow(10, decPlaces);
	   return val;
	}
</script>               
