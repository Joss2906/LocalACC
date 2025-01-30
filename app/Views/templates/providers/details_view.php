<div class="iq-card iq-card-block iq-card-stretch">                
	<div class="iq-card-body row" style="width: 100% !important;">
		<div class="col-md-12 row">
			<div class="iq-card iq-card-block iq-card-stretch">
				<div class="iq-card-header d-flex justify-content-between">
					<div class="iq-header-title">
						<?php if(!empty($services_providers)){ ?>
						<h5><i class="fa fa-file-text-o" aria-hidden="true"></i> <?= $services_providers[0]['service']; ?></h5>
						<p class="pull-right"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $services_providers[0]['date_service']; ?></p>
						<?php }else{ ?>
						<h5><i class="fa fa-file-text-o" aria-hidden="true"></i> <?= lang('Home.No se encontraron resultados'); ?></h5>
						<?php } ?>
					</div>
				</div>
				<div class="iq-card-body">
					<ul class="m-0 p-0 col-md-12">
						<?php if(!empty($services_providers)){ ?>
						<?php foreach ($services_providers[0]['supplies'] as $sp){ ?>
							<li class="d-flex mb-2 col-md-12">
								<div class="news-icon" style="color: #00a884;"><i class="fa fa-cubes" aria-hidden="true"></i></div>
								<h5 class="news-detail mb-0"> <?= $sp['type'].'-'.$sp['supply']; ?></h5>
								&nbsp;&nbsp;
								<a href="javascript:void(0);" class="text-danger" onclick="details_delete_supply(<?= $sp['supply_id']; ?>);">
									<i class="fa fa-trash-o" aria-hidden="true"></i>
								</a>
							</li>
							<div class="col-md-12">
								<hr>
								<?php foreach ($sp['providers'] as $p) { ?>
									<div class="iq-card-header d-flex justify-content-between">
										<div class="iq-header-title">
											<h7 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> <?= $p['user']; ?></h7>
											&nbsp;
											<a href="javascript:void(0);" class="text-danger" onclick="details_delete_provider(<?= $p['provider_id']; ?>);"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</div>
									</div>
									<div class="iq-card-body">										
										<ul class="iq-timeline">
										   	<li>
										      	<div class="timeline-dots border-primary"></div>
										      	<span class="float-left mb-1"><?= lang('Home.Productividad');?></span>
										      	<div class="d-inline-block w-100">
										         	<p><?= $p['productivity']; ?></p>
										      	</div>
										   	</li>
										   	<li>
										      	<div class="timeline-dots border-success"></div>
										      	<span class="float-left mb-1"><?= lang('Home.Calidad');?></span>
										      	<div class="d-inline-block w-100">
										         	<p><?= $p['quality']; ?></p>
										      	</div>
										   	</li>
										   	<li>
										      	<div class="timeline-dots border-info"></div>
										      	<span class="float-left mb-1"><?= lang('Home.Innovación');?></span>
										      	<div class="d-inline-block w-100">
										         	<p><?= $p['innovation']; ?></p>
										      	</div>
										   	</li>
										   	<li>
										      	<div class="timeline-dots border-danger"></div>
										      	<span class="float-left mb-1"><?= lang('Home.Servicio');?></span>
										      	<div class="d-inline-block w-100">
										         	<p><?= $p['service']; ?></p>
										      	</div>
										   	</li>
										</ul>
									</div>
								<?php } ?>
								<hr>
							</div>
						<?php } ?>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
   var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
   var label_eliminar = '<?= lang('Home.¿Desea eliminar el registro?'); ?>';
   var label_tipo_suministro = '<?= lang('Tipo de suministro'); ?>';
   var label_acciones = '<?= lang('Acciones'); ?>';
   var label_desplegar = '<?= lang('Desplegar'); ?>';
   var label_agregar_proveedor = '<?= lang('Agregar proveedor'); ?>';
   var label_eliminar_button = '<?= lang('Eliminar'); ?>';
   var label_proveedor = '<?= lang('Proveedor'); ?>';
   var label_productividad = '<?= lang('Productividad'); ?>';
   var label_calidad = '<?= lang('Calidad'); ?>';
   var label_innovacion = '<?= lang('Innovación '); ?>';
   var label_servicio = '<?= lang('Servicio'); ?>';
</script>  