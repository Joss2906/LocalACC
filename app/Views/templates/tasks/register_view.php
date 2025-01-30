<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title">
      <div class="row">
      		<div class="col-sm-12 col-md-12 mb-3">
      			<br>
      			<span>
					<?= lang('Home.Pantalla para Registrar la Productividad Periódica. Esta es una pantalla para registrar la productividad mensual que usted tuvo y que no le fue solicitada vía su portal de servicios. Le recomendamos que es sugerido que usted registre todas las actividades que realizó para que se contabilicen en su productividad. Le recordamos que estos servicios serán incluidos en la productividad por departamento y serán sujetos de auditoría al azar y serán enviados a los clientes externos, internos o proveedores externos con los que usted haya realizado algún servicio.');?>
					<br><br>
					<?= lang('Home.Yo');?> <span style="font-weight: bold;"><?= $_SESSION['nombre']; ?></span> <?= lang('Home.declaro que lo registrado en esta pantalla son datos legítimos, fidedignos y actuales y que la única persona que tiene las claves para registrar estos servicios es quien suscribe. Para los efectos legales que haya lugar.');?>
      			</span>

				<?php 
				    $meses = ['01' => lang('Home.Enero'),
				              '02' => lang('Home.Febrero'),
				              '03' => lang('Home.Marzo'),
				              '04' => lang('Home.Abril'),
				              '05' => lang('Home.Mayo'),
				              '06' => lang('Home.Junio'),
				              '07' => lang('Home.Julio'),
				              '08' => lang('Home.Agosto'),
				              '09' => lang('Home.Septiembre'),
				              '10' => lang('Home.Octubre'),
				              '11' => lang('Home.Noviembre'),
				              '12' => lang('Home.Diciembre')];
				    $mesactual = $meses[date('m')]
				?>
				<br><br>
      			<!-- <span style="font-weight: bold;">Nombre del jefe:</span> <span>Sol Alvarez Fernández</span> -->
      			<!-- <br> -->
				<span style="font-weight: bold;"><?= lang('Home.Periodo de Evaluación');?>:</span> <span><?= $mesactual.' '.date('Y'); ?></span>
      		</div>
          	<div class="col-sm-12 col-md-12 mb-3">
            	<a href="<?= base_url().'/Tasks/form_register_view/0'; ?>" class="btn mb-6 btn-success"><i class="fa fa-plus" aria-hidden="true"></i> <?= lang('Home.Nueva solicitud de función o servicio');?></a>
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
                  <th style="width: 5%">#</th>
                  <th style="width: 20%"><?= lang('Home.Servicio');?></th>
                  <th style="width: 20%"><?= lang('Home.Cliente');?></th>
                  <th style="width: 20%"><?= lang('Home.Fecha de petición');?></th>
                  <th style="width: 20%"><?= lang('Home.Cantidad de servicios');?></th>
                  <th style="width: 15%"><?= lang('Home.Acciones');?></th>
               </tr>
            </thead>
            <tbody class="tbody-datos">
            <?php if($tasks){ ?>
               <?php foreach($tasks as $t){ ?>
                  <tr>
                     <td><?= $t['task_id']; ?></td>
                     <td><?= $t['description']; ?></td>
                     <td><?= $t['customer']; ?></td>
                     <td><?= $t['delivery_date']; ?></td>
                     <td><?= $t['amount']; ?></td>
                     <td>
                        <div class="btn-group" role="group">
                           <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?= lang('Home.Desplegar');?>
                           </button>
                           <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                           		<a class="dropdown-item text-primary" href="javascript:void(0);" onclick="get_detalles(<?= $t['task_id']; ?>);">
                                	<i class="fa fa-info-circle" aria-hidden="true"></i> <?= lang('Home.Detalles');?>
                              	</a>
                           </div>
                        </div>
                     </td>
                  </tr>
               <?php } ?>
            <?php } ?>
            </tbody>
         </table>
      </div>
   </div>
</div>

<div class="modal modal-detalles">
   	<div class="modal-dialog modal-lg">
      	<div class="modal-content">
         	<div class="modal-header">
            	<h4 class="modal-title"><?= lang('Home.Detalle del servicio');?></h4>
         	</div>
         	<div class="modal-body">
            	<div class="panel panel-default">
               		<div class="panel-body panel-datos table-responsive">
                  		<table class="table table-bordered">
                     		<thead>
                        		<tr>
	                           		<th scope="col"><?= lang('Home.Productividad');?></th>
	                           		<th scope="col"><?= lang('Home.Calidad');?></th>
	                           		<th scope="col"><?= lang('Home.Innovación');?></th>
	                           		<th scope="col"><?= lang('Home.Servicio');?></th>
                        		</tr>
                     		</thead>
                     		<tbody class="tbody-detalles"></tbody>
                  		</table>
               		</div>
            	</div>
         	</div>
         	<div class="modal-footer">
            	<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ri-close-circle-fill"></i> <?= lang('Home.Cerrar');?></button>
         	</div>
      	</div>
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