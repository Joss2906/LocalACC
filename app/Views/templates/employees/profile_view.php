<style>
	#chart-graficas{
		width: 70%;
		height: 400px;
	}
	#chart-competencias{
		width: 100%;
		/*height: 1100px!important;*/
	}
	.texto-vertical {
		width:20px;
	 	word-wrap: break-word;
		text-align:center;
		vertical-align: center;
	}
</style>
<div class="iq-card iq-card-block iq-card-stretch">                
	<div class="iq-card-body row" style="width: 100% !important;">
		<div class="col-md-12 row">
			<div class="col-md-5">
				<div class="col-md-12" style="font-size: 14px!important;">
					<input type="hidden" class="user_id" value="<?= $user_id; ?>">		
					<input type="hidden" class="position_id" value="<?= $position_id; ?>">		
					<span><span class="font-weight-bold"><?= lang('Home.Nombre');?>:</span> <?= $employee['first_name'].' '.$employee['second_name'].' '.$employee['last_name'].' '.$employee['second_last_name']; ?></span>
					<!-- <br> -->
					<span>| <span class="font-weight-bold"><?= lang('Home.Departamento');?>:</span> <?= $employee['department']; ?></span>
					<br>
					<span><span class="font-weight-bold"><?= lang('Home.Puesto');?>:</span> <?= $employee['position']; ?></span>
					<span>| <span class="font-weight-bold"><?= lang('Home.Promedio');?>:</span> <?= $employee['average']; ?></span>
					<span>| <span class="font-weight-bold"><?= lang('Home.Roi');?>:</span> <?= $employee['roi']; ?></span>
				</div>
			</div>
			<div class="col-md-7">			
				<a href="<?= base_url().'/Tasks/requested_view'; ?>" type="button" class="btn mb-1 btn-danger">
				 	<i class="fa fa-external-link" aria-hidden="true"></i> <?= lang('Home.Servicios pendientes');?> <span class="badge badge-light ml-2 tareas_solicitadas"></span>
				</a>
				<a href="<?= base_url().'/Tasks/evaluation_view'; ?>" type="button" class="btn mb-1 btn-success">
				 	<i class="fa fa-external-link" aria-hidden="true"></i> <?= lang('Home.Evaluaciones pendientes');?> <span class="badge badge-light ml-2 tareas_evaluacion"></span>
				</a>
				<div class="btn-group" role="group">
				   <button id="btnGroupDrop1" type="button" class="btn mb-1 btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				   <?= lang('Home.Acciones');?>
				   </button>
				   <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
						<?php if($employee['user_id'] == $_SESSION['user_id']){ ?>
						<a class="dropdown-item text-primary" href="javascript:void(0);" onclick="modal_foto(<?= $employee['user_id']; ?>);">
							<i class="fa fa-file-image-o" aria-hidden="true"></i> <?= lang('Home.Actualizar fotografía de presentación');?>
						</a>
						<a class="dropdown-item text-info" href="javascript:void(0);" onclick="modal_video(<?= $employee['user_id']; ?>);">
							<i class="fa fa-file-video-o" aria-hidden="true"></i> <?= lang('Home.Actualizar video de presentación');?>
						</a>
						<a class="dropdown-item text-danger" href="javascript:void(0);" onclick="email_recuperar_password(<?= '`'.$employee['email'].'`'; ?>);">
							<i class="fa fa-key" aria-hidden="true"></i> <?= lang('Home.Actualizar contraseña');?>
						</a>
						<?php } ?>
				   </div>
				</div>
				<a href="<?= base_url().'/Tasks/form_view/0'; ?>" type="button" class="btn mb-1 btn-info">
				 	&nbsp; <i class="fa fa-shopping-cart" aria-hidden="true"></i>
				</a>
			</div>
			<div class="col-md-12">
				<hr>
			</div>
			<div class="col-md-4">
				<div class="col-md-12" style="height: 80vh">
					<?php if(empty($employee['profile_picture'])){ ?>
						<img src="<?=base_url().'/public/fotos/foto_perfil.jpg';?>" class="img-thumbnail" style="widt: 100%; height: 100%;">
					<?php }else{ ?>
			            <?php $extension = substr($employee['profile_picture'], -3); ?>
			            <?php if($extension == 'mp4' || $extension == 'avi'){ ?>
			              <video class="vidbacking" autoplay loop style="width: 100%; height: 100%;">
			                <source src="<?=base_url().'/public/fotos/'.$employee['user_id'].'/'.$employee['profile_picture'];?>" type="video/mp4">
			              </video>
			            <?php }else{ ?>
			              <img src="<?=base_url().'/public/fotos/'.$employee['user_id'].'/'.$employee['profile_picture'];?>" class="img-thumbnail col-md-12" style="widt: 100%; height: 100%;">
			            <?php } ?>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-8">
				<div class="col-md-12 mb-3">
					<span>
						<?= lang('Home.Bienvenidos a mi página de servicios. En esta pantalla usted podrá visualizar los servicios que proporciono, las garantías de Producción, Calidad, Servicio, e Innovación y con el carrito de compras en la parte de abajo podrá pedirme alguno de los servicios que están enlistados más abajo o algún servicio nuevo. También puede ver como me han calificado mis clientes internos y externos. Gracias por solicitar mis servicios, estoy para servirle.'); ?>
					</span>
				</div>
				<div class="col-md-8 offset-md-2">
      				<div class="slider-graficas" style="height: 450px!important;">
						<div class="col-md-12" style="text-align: center;">
							<p><?= lang('Home.Desempeño general'); ?></p>
							<div id="chart-desempeño-general" style="height: 375px!important;"></div>
						</div>
						<div class="col-md-12" style="text-align: center;">
							<p><?= lang('Home.Yo esta semana'); ?></p>
							<div id="chart-desempeño-semanal" style="height: 375px!important;"></div>
						</div>
						<div class="col-md-12" style="text-align: center;">
							<p><?= lang('Home.Desempeño'); ?></p>
							<div id="chart-desempeño" style="height: 375px!important;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="iq-card-body row" style="width: 100% !important;">
			<div class="col-md-12">
				<ul class="nav nav-tabs" id="myTab-three" role="tablist">
					<li class="nav-item">
					 	<a class="nav-link active" id="competencias-tab-three" data-toggle="tab" href="#competencias-three" role="tab" aria-controls="competencias" aria-selected="false">
					 		<?= lang('Home.Mis competencias');?>
					 	</a>
					</li>
					<li class="nav-item">
					 	<a class="nav-link" id="mision-tab-three" data-toggle="tab" href="#mision-three" role="tab" aria-controls="mision" aria-selected="false"><?= lang('Home.Misión');?></a>
					</li>
					<li class="nav-item">
					 	<a class="nav-link" id="vision-tab-three" data-toggle="tab" href="#vision-three" role="tab" aria-controls="vision" aria-selected="false"><?= lang('Home.Visión');?></a>
					</li>
					<li class="nav-item">
					 	<a class="nav-link" id="competitivas-tab-three" data-toggle="tab" href="#competitivas-three" role="tab" aria-controls="competitivas" aria-selected="false"><?= lang('Home.Ventajas competitivas');?></a>
					</li>
					<li class="nav-item">
					 	<a class="nav-link" id="comparativas-tab-three" data-toggle="tab" href="#comparativas-three" role="tab" aria-controls="comparativas" aria-selected="false"><?= lang('Home.Ventajas comparativas');?></a>
					</li>
					<li class="nav-item">
					 	<a class="nav-link" id="resoluciones-tab-three" data-toggle="tab" href="#resoluciones-three" role="tab" aria-controls="resoluciones" aria-selected="false"><?= lang('Home.Resoluciones');?></a>
					</li>
					<li class="nav-item">
					 	<a class="nav-link" id="innovaciones-tab-three" data-toggle="tab" href="#innovaciones-three" role="tab" aria-controls="innovaciones" aria-selected="false"><?= lang('Home.Innovaciones');?></a>
					</li>
					<li class="nav-item">
					 	<a class="nav-link" id="servicios-tab-three" data-toggle="tab" href="#servicios-three" role="tab" aria-controls="servicios" aria-selected="true"><?= lang('Home.Servicios');?></a>
					</li>
					<li class="nav-item">
					 	<a class="nav-link" id="servicios-ponderados-tab-three" data-toggle="tab" href="#servicios-ponderados-three" role="tab" aria-controls="servicios-ponderados" aria-selected="true"><?= lang('Home.Ponderación de servicios');?></a>
					</li>
					<li class="nav-item">
					 	<a class="nav-link" id="clientes-tab-three" data-toggle="tab" href="#clientes-three" role="tab" aria-controls="clientes" aria-selected="false"><?= lang('Home.Clientes');?></a>
					</li>
					<li class="nav-item">
					 	<a class="nav-link" id="testimonios-tab-three" data-toggle="tab" href="#testimonios-three" role="tab" aria-controls="testimonios" aria-selected="false"><?= lang('Home.Felicitaciones y sugerencias');?></a>
					</li>
					<li class="nav-item">
					 	<a class="nav-link" id="quejas-tab-three" data-toggle="tab" href="#quejas-three" role="tab" aria-controls="quejas" aria-selected="false"><?= lang('Home.Quejas');?></a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent-4">
					<!-- competencias -->
					<div class="tab-pane fade active show" id="competencias-three" role="tabpanel" aria-labelledby="competencias-tab-three">
						<div id="chart-competencias"></div>
					</div>
					<!-- misión -->
					<div class="tab-pane fade" id="mision-three" role="tabpanel" aria-labelledby="mision-tab-three">
						<form class="form-mision">
							<div class="form-group">
								<textarea class="form-control" name="mission" rows="5" maxlength="999"><?php if($employee['mission'] != 'null'){ $employee['mission']; } ?></textarea>
							</div>
							<div class="form-group">
								<?php if($employee['user_id'] == $_SESSION['user_id']){ ?>
								<button type="button" class="btn btn-success" onclick="actualizar_datos(1)"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Actualizar');?></button>
								<?php } ?>
							</div>
						</form>
					</div>
					<!-- visión -->
					<div class="tab-pane fade" id="vision-three" role="tabpanel" aria-labelledby="vision-tab-three">
						<form class="form-vision">
							<div class="form-group">
								<textarea class="form-control" name="vision" rows="5" maxlength="999"><?php if($employee['vision'] != 'null'){ $employee['vision']; } ?></textarea>
							</div>
							<div class="form-group">
								<?php if($employee['user_id'] == $_SESSION['user_id']){ ?>
								<button type="button" class="btn btn-success" onclick="actualizar_datos(2)"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Actualizar');?></button>
								<?php } ?>
							</div>
						</form>
					</div>
					<!-- ventajas comparativas -->
					<div class="tab-pane fade" id="competitivas-three" role="tabpanel" aria-labelledby="competitivas-tab-three">
						<form class="form-competitivas">
							<div class="form-group">
								<textarea class="form-control" name="competitive_advantages" rows="5" maxlength="999"><?php if($employee['competitive_advantages'] != 'null'){ $employee['competitive_advantages']; } ?></textarea>
							</div>
							<div class="form-group">
								<?php if($employee['user_id'] == $_SESSION['user_id']){ ?>
								<button type="button" class="btn btn-success" onclick="actualizar_datos(3)"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Actualizar');?></button>
								<?php } ?>
							</div>
						</form>
					</div>
					<!-- ventajas competitivas -->
					<div class="tab-pane fade" id="comparativas-three" role="tabpanel" aria-labelledby="comparativas-tab-three">
						<form class="form-comparativas">
							<div class="form-group">
								<textarea class="form-control" name="comparative_advantages" rows="5" maxlength="999"><?php if($employee['comparative_advantages'] != 'null'){ $employee['comparative_advantages']; } ?></textarea>
							</div>
							<div class="form-group">
								<?php if($employee['user_id'] == $_SESSION['user_id']){ ?>
								<button type="button" class="btn btn-success" onclick="actualizar_datos(4)"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Actualizar');?></button>
								<?php } ?>
							</div>
						</form>
					</div>
					<!-- resoluciones -->
					<div class="tab-pane fade" id="resoluciones-three" role="tabpanel" aria-labelledby="resoluciones-tab-three">
						<div class="col-md-12 mb-3">						
							<div class="list-group">
								<a href="javascript:void(0);" class="list-group-item list-group-item-action active"><?= lang('Home.Listado de resoluciones');?></a>
								<?php foreach ($resolutions as $r) { ?>
									<a href="javascript: void(0);" class="list-group-item list-group-item-action">
										<div class="d-flex w-100 justify-content-between">
											<h5 class="mb-1"><?= $r['resolution']; ?></h5>
											<small class="text-muted">
												<?= $r['created_at']; ?> &nbsp;
												<?php if($employee['user_id'] == $_SESSION['user_id']){ ?>
												<button type="button" class="btn btn-danger btn-sm" onclick="delete_dato(1, <?= $r['resolution_id']; ?>);">
													<i class="fa fa-ban" aria-hidden="true"></i>
												</button>
												<button type="button" class="btn btn-info btn-sm" onclick="update_dato(1, <?= $r['resolution_id']; ?>, `<?= $r['resolution']; ?>`, `<?= $r['description']; ?>`);">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												</button>
												<?php } ?>	
											</small>
										</div>
										<p class="mb-1">
											<?= $r['description']; ?>
										</p>
									</a>
								<?php } ?>
							</div>
						</div>
						<div class="col-md-12 mb-3"><hr></div>						
						<div class="col-md-12 mb-3">						
							<form class="form-resoluciones row">
								<div class="form-group col-md-8">
									<label for=""><?= lang('Home.Resolución');?></label>
									<input type="hidden" class="form-control resolution_id " name="resolution_id " value="">
									<input type="text" class="form-control resolution" name="resolution" maxlength="250">
								</div>
								<div class="form-group col-md-4">
									<label for=""><?= lang('Home.Imagen');?></label>
									<input type="file" class="form-control-file imagen_resolucion" name="imagen_resolucion">
								</div>
								<div class="form-group col-md-12">
									<label for=""><?= lang('Home.Descripción');?></label>
									<textarea class="form-control description" name="description" rows="5" maxlength="999"></textarea>
								</div>
								<div class="form-group col-md-12">
								<?php if($employee['user_id'] == $_SESSION['user_id']){ ?>
									<button type="button" class="btn btn-success" onclick="actualizar_datos(5)"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Actualizar');?></button>
								<?php } ?>
								</div>
							</form>
						</div>
					</div>
					<!-- innovaciones -->
					<div class="tab-pane fade" id="innovaciones-three" role="tabpanel" aria-labelledby="innovaciones-tab-three">
						<div class="col-md-12 mb-3">						
							<div class="list-group">
								<a href="javascript:void(0);" class="list-group-item list-group-item-action active"><?= lang('Home.Listado de innovaciones'); ?></a>
								<?php foreach ($innovations as $i) { ?>
									<a href="javascript: void(0);" class="list-group-item list-group-item-action">
										<div class="d-flex w-100 justify-content-between">
											<h5 class="mb-1"><?= $i['innovation']; ?></h5>
											<small class="text-muted">
												<?= $i['created_at']; ?> &nbsp;
												<?php if($employee['user_id'] == $_SESSION['user_id']){ ?>
												<button type="button" class="btn btn-danger btn-sm" onclick="delete_dato(2, <?= $i['innovation_id']; ?>);">
													<i class="fa fa-ban" aria-hidden="true"></i>
												</button>
<!-- 												<button type="button" class="btn btn-primary btn-sm" onclick="image_dato(2, <?= $i['innovation_id']; ?>);">
													<i class="fa fa-picture-o" aria-hidden="true"></i>
												</button> -->
												<button type="button" class="btn btn-info btn-sm" onclick="update_dato(2, <?= $i['innovation_id']; ?>, `<?= $i['innovation']; ?>`, `<?= $i['description']; ?>`, `<?= $i['annual_value']; ?>`);">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												</button>
												<?php } ?>	
											</small>
										</div>
										<p class="mb-1"><?= $i['description']; ?></p>
										<h5 class="text-muted text-black">
											<!-- <?= lang('Home.Valor anual');?> -->
											$<?= $i['annual_value']; ?> USD
										</h5>
									</a>
								<?php } ?>
							</div>
						</div>
						<div class="col-md-12 mb-3"><hr></div>						
						<div class="col-md-12 mb-3">
							<form class="form-innovaciones row">
								<div class="form-group col-md-6">
									<label for=""><?= lang('Home.Innovación');?></label>
									<input type="hidden" class="form-control innovation_id " name="innovation_id " value="">
									<input type="text" class="form-control innovation" name="innovation" maxlength="250">
								</div>
								<div class="form-group col-md-2">
									<label for=""><?= lang('Home.Valor Anual');?></label>
									<input type="text" class="form-control annual_value" name="annual_value" onkeypress="return justDecimals(event);" maxlength="250">
								</div>
								<div class="form-group col-md-4">
									<label for=""><?= lang('Home.Imagen');?></label>
									<input type="file" class="form-control-file imagen_innovacion" name="imagen_innovacion">
								</div>
								<div class="form-group col-md-12">
									<label for=""><?= lang('Home.Descripción');?></label>
									<textarea class="form-control description_innovacion" name="description" rows="3" maxlength="999"></textarea>
								</div>
								<div class="form-group col-md-12">
								<?php if($employee['user_id'] == $_SESSION['user_id']){ ?>
									<button type="button" class="btn btn-success" onclick="actualizar_datos(6)"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Actualizar');?></button>
								<?php } ?>
								</div>
							</form>
						</div>
					</div>
					<!-- servicios -->
					<div class="tab-pane fade" id="servicios-three" role="tabpanel" aria-labelledby="servicios-tab-three">
						<?php if(empty($services)){ ?>
							<div class="form-group col-md-12 row">						
								<p><?= lang('Home.No cuenta con servicios o funciones registradas.');?></p>
							</div>
						<?php }else{ ?>
						<?php $i = 1; foreach ($services as $s) { ?>
							<div class="col-md-12 row">						
								<div class="col-md-1" style="border: 1px #e7e7e7 solid;">
									<div class="col-md-12" style="height: 10%"></div>
									<div class="col-md-12">
										<h2 class="texto-vertical" style="height: 90%"><?= lang('Home.Función');?> # <?= $i++; ?></h2>
									</div>
									<div class="col-md-12" style="height: 10%"></div>
								</div>
								<div class="col-md-11" style="border: 1px #e7e7e7 solid;">						
									<div class="iq-card">
									   <div class="iq-card-header d-flex justify-content-between">
									      <div class="iq-header-title">
									         <h5 class="card-title"><?= lang('Home.Descripción');?></h5>
									         <span><?= $s['description']; ?></span>
									      </div>
									   </div>
									   <div class="iq-card-body">
									      <ul class="iq-timeline">
									      	<li>
									            <div class="timeline-dots border-success"></div>
									            <h6 class="float-left mb-1"><?= lang('Home.Estatus');?></h6>
									            <div class="d-inline-block w-100">
									               <div class="badge badge-pill badge-success"><?= $s['service_status']; ?></div>
									               <!-- <div class="badge badge-pill badge-info">Moving</div> -->
									            </div>
									         </li>
									         <li>
									            <div class="timeline-dots border-info"></div>
									            <h6 class="float-left mb-1"><?= lang('Home.Productividad');?></h6>
									            <div class="d-inline-block w-100">
									               <p><?= $s['productivity']; ?></p>
									            </div>
									         </li>
									         <li>
									            <div class="timeline-dots border-danger"></div>
									            <h6 class="float-left mb-1"><?= lang('Home.Calidad');?></h6>
									            <div class="d-inline-block w-100">
									               <p><?= $s['quality']; ?></p>
									            </div>
									         </li>
									         <li>
									            <div class="timeline-dots border-primary"></div>
									            <h6 class="float-left mb-1"><?= lang('Home.Innovación');?></h6>
									            <div class="d-inline-block w-100">
									               <p><?= $s['innovation']; ?></p>
									            </div>
									         </li>
									         <li>
									            <div class="timeline-dots border-warning"></div>
									            <h6 class="float-left mb-1"><?= lang('Home.Servicio');?></h6>
									            <div class="d-inline-block w-100">
									               <p><?= $s['service']; ?></p>
									            </div>
									         </li>
									         <li>
									            <div class="timeline-dots border-secondary"></div>
									            <h6 class="float-left mb-1"><?= lang('Home.Acciones');?></h6>
									            <div class="d-inline-block w-100">
									            	<div class="col-md-12 row">
									            		<div class="col-md-4">
									               		<a href="<?= base_url().'/providers/details_view/'.$s['service_id']; ?>" class="btn btn-sm btn-success col-md-12">
									               			<i class="fa fa-info-circle" aria-hidden="true"></i> <?= lang('Home.Recursos');?>
									               		</a>
									            		</div>
									            		<div class="col-md-4">
									               		<button type="button" class="btn btn-sm btn-info col-md-12" onclick="modal_formulario(<?= $s['service_id']; ?>);">
									               			<i class="fa fa-upload" aria-hidden="true"></i> <?= lang('Home.Cargar Formulario');?>
									               		</button>
									            		</div>
									            		<?php if(!empty($s['file_pdf'])){ ?>
									            		<div class="col-md-4">
									               		<a href="<?= base_url().'/public/formularios/'.$s['service_id'].'/'.$s['file_pdf']; ?>" class="btn btn-sm btn-primary col-md-12" target="_blank">
									               			<i class="fa fa-download" aria-hidden="true"></i> <?= lang('Home.Descargar Formulario');?>
									               		</a>
									            		</div>
									            		<?php } ?>
									            	</div>
									            </div>
									         </li>
									      </ul>
									   </div>
									</div>
								</div>
							</div>
						<?php } ?>
						<?php } ?>
					</div>
					<!-- servicios-ponderados -->
					<div class="tab-pane fade" id="servicios-ponderados-three" role="tabpanel" aria-labelledby="servicios-ponderados-tab-three">
						<div class="col-md-12 div-graficas row"></div>
					</div>
					<!-- clientes -->
					<div class="tab-pane fade" id="clientes-three" role="tabpanel" aria-labelledby="clientes-tab-three">
						<div class="col-md-12 row">
							<?php foreach ($providers as $p) { ?>
							<div class="col-md-3">
								<div class="col-md-12">								
									<?php if(empty($p['profile_picture'])){ ?>
									<img src="<?=base_url().'/public/fotos/foto_perfil.jpg';?>" class="img-thumbnail rounded-circle ml-3" alt="Responsive image" style="width: 130px; height: 130px;">
									<?php }else{ ?>
									<img src="<?=base_url().'/public/fotos/'.$p['user_id'].'/'.$p['profile_picture'];?>" class="img-thumbnail rounded-circle ml-3" alt="Responsive image" style="width: 130px; height: 130px;">
									<?php } ?>
								</div>
								<div class="col-md-12">								
									<p><?= $p['customer']; ?></p>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- testimonios -->
					<div class="tab-pane fade" id="testimonios-three" role="tabpanel" aria-labelledby="testimonios-tab-three">
						<ul class="iq-timeline">
							<?php foreach ($comments as $c) { ?>
								<?php if(!empty($c['commentary_productivity'])){ ?>
									<li>
										<div class="timeline-dots border-info"></div>
										<h6 class="float-left mb-1"><?= $c['name']; ?></h6>
										<small class="float-right mt-1"><?= $c['updated_at']; ?></small>
										<div class="d-inline-block w-100">
											<p><?= $c['commentary_productivity']; ?></p>
										</div>
									</li>
								<?php } ?>
								<?php if(!empty($c['commentary_quality'])){ ?>
									<li>
										<div class="timeline-dots border-info"></div>
										<h6 class="float-left mb-1"><?= $c['name']; ?></h6>
										<small class="float-right mt-1"><?= $c['updated_at']; ?></small>
										<div class="d-inline-block w-100">
											<p><?= $c['commentary_quality']; ?></p>
										</div>
									</li>
								<?php } ?>
								<?php if(!empty($c['commentary_innovation'])){ ?>
									<li>
										<div class="timeline-dots border-info"></div>
										<h6 class="float-left mb-1"><?= $c['name']; ?></h6>
										<small class="float-right mt-1"><?= $c['updated_at']; ?></small>
										<div class="d-inline-block w-100">
											<p><?= $c['commentary_innovation']; ?></p>
										</div>
									</li>
								<?php } ?>
								<?php if(!empty($c['commentary_service'])){ ?>
									<li>
										<div class="timeline-dots border-info"></div>
										<h6 class="float-left mb-1"><?= $c['name']; ?></h6>
										<small class="float-right mt-1"><?= $c['updated_at']; ?></small>
										<div class="d-inline-block w-100">
											<p><?= $c['commentary_service']; ?></p>
										</div>
									</li>
								<?php } ?>
							<?php } ?>
                        </ul>
					</div>
					<!-- quejas -->
					<div class="tab-pane fade" id="quejas-three" role="tabpanel" aria-labelledby="quejas-tab-three">
				      <div class="table-responsive">
				         <table id="datatable" class="table table-bordered">
				            <thead class="table-dark">
				               <tr>
				                  <th style="width: 5%">#</th>
				                  <th><?= lang('Home.Tipo de queja');?></th>
				                  <th><?= lang('Home.Autor');?></th>
				                  <th><?= lang('Home.Categoría');?></th>
				                  <th><?= lang('Home.Queja');?></th>
				                  <th><?= lang('Home.Responsable');?></th>
				                  <th><?= lang('Home.Estatus');?></th>
				               </tr>
				            </thead>
				            <tbody class="tbody-datos">
				            <?php if($complaints){ ?>
				               <?php $i = 1; foreach($complaints as $c){ ?>
				                  <tr>
				                     <td><?= $i++; ?></td>
				                     <?php if($c['complaint_type_id'] == 1){ ?>
				                     <td><span class="badge badge-primary"><?= lang('Home.'.$c['type'].''); ?></span></td>
				                     <?php }else{ ?>
				                     <td><span class="badge badge-success"><?= lang('Home.'.$c['type'].''); ?></span></td>
				                     <?php } ?>
				                     <td><?= $c['author']; ?></td>
				                     <td><?= lang('Home.'.$c['category'].''); ?></td>
				                     <td><?= $c['complaint']; ?></td>
				                     <td><?= $c['responsible']; ?></td>
				                     <?php if($c['complaint_status_id'] == 1){ ?>
				                     <td><span class="badge badge-danger"><?= lang('Home.'.$c['status'].''); ?></span></td>
				                     <?php } ?>
				                     <?php if($c['complaint_status_id'] == 2){ ?>
				                     <td><span class="badge badge-warning"><?= lang('Home.'.$c['status'].''); ?></span></td>
				                     <?php } ?>
				                     <?php if($c['complaint_status_id'] == 3){ ?>
				                     <td><span class="badge badge-primary"><?= lang('Home.'.$c['status'].''); ?></span></td>
				                     <?php } ?>
				                     <?php if($c['complaint_status_id'] == 4){ ?>
				                     <td><span class="badge badge-info"><?= lang('Home.'.$c['status'].''); ?></span></td>
				                     <?php } ?>
				                     <?php if($c['complaint_status_id'] == 5){ ?>
				                     <td><span class="badge badge-success"><?= lang('Home.'.$c['status'].''); ?></span></td>
				                     <?php } ?>
				                  </tr>
				               <?php } ?>
				            <?php } ?>
				            </tbody>
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
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-formulario" id="myModal">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title"><?= lang('Home.Cargar Formulario');?></h4>
         </div>
         <div class="modal-body">
            <div class="panel panel-default">
               <div class="panel-body panel-datos">
                  <form class="form-formulario">
                  	<label for=""><?= lang('Home.Formulario');?></label>
                     <input type="hidden" class="form-control service_id" name="service_id">
                     <input type="hidden" class="form-control txt_csrfname_formulario" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                     <input type="file" class="form-control-file file_pdf" id="file_pdf" name="file_pdf">
                     <p>*<?= lang('Home.El tamaño máximo del documento es de 2MB');?> <br> *<?= lang('Home.Las extenciones permitidas son PDF.');?></p>
                  </form>
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
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="add_formulario();"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Actualizar');?></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ri-close-circle-fill"></i> <?= lang('Home.Cerrar');?></button>
         </div>
      </div>
   </div>
</div> 

<div class="modal modal-foto" id="myModal">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title"><?= lang('Home.Actualizar foto de perfil');?></h4>
         </div>
         <div class="modal-body">
            <div class="panel panel-default">
               <div class="panel-body panel-datos">
                  <form class="form-foto">
                  	<label for=""><?= lang('Home.Foto de perfil');?></label>
                     <input type="hidden" class="form-control user_id_foto" name="user_id">
                     <input type="hidden" class="form-control txt_csrfname_foto" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                     <input type="file" class="form-control-file profile_picture" id="profile_picture" name="profile_picture">
                     <p>*<?= lang('Home.El tamaño máximo del archivo es de 10MB.');?> <br> *<?= lang('Home.Las extenciones permitidas son jpg, jpeg, gif, png, webp, mp4, avi.');?></p>
                  </form>
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
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="add_foto();"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Actualizar');?></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ri-close-circle-fill"></i> <?= lang('Home.Cerrar');?></button>
         </div>
      </div>
   </div>
</div> 

<div class="modal modal-video" id="myModal">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title"><?= lang('Home.Actualizar video de perfil');?></h4>
         </div>
         <div class="modal-body">
            <div class="panel panel-default">
               <div class="panel-body panel-datos">
                  <form class="form-video">
                  	<label for=""><?= lang('Home.Video de perfil');?></label>
                     <input type="hidden" class="form-control user_id_video" name="user_id">
                     <input type="hidden" class="form-control txt_csrfname_video" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                     <input type="file" class="form-control-file profile_video" id="profile_video" name="profile_video">
                     <p>*<?= lang('Home.El tamaño máximo del video es de 2MB');?> <br> *<?= lang('Home.Las extenciones permitidas son mp4, mkv.');?></p>
                  </form>
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
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="add_video();"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Actualizar');?></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ri-close-circle-fill"></i> <?= lang('Home.Cerrar');?></button>
         </div>
      </div>
   </div>
</div> 

<script>
    var label_favor_registrar = '<?= lang('Home.Favor de registrar los datos del usuario.'); ?>';
    var label_error_nuevamente = '<?= lang('Home.Error, Intente nuevamente'); ?>';
    var label_guardaron_correctamente = '<?= lang('Home.Se guardaron correctamente los datos.'); ?>';
    var label_deshabilitar = '<?= lang('Home.¿Desea deshabilitar el registro?'); ?>';
    var label_habilitar = '<?= lang('Home.¿Desea habilitar el registro?'); ?>';
    var label_200 = '<?= lang('Home.La calificación no puede ser mayor a 200') ?>';
    var label_100 = '<?= lang('Home.La calificación no puede ser mayor a 100') ?>';
    var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
    var label_no_se_encontraron = '<?= lang('Home.No se encontraron registro de tus competencias.'); ?>';
    // var label_no_se_encontraron = '<?= lang('Home.No se encontraron registro de tus competencias'); ?>';
    var label_yo = '<?= lang('Yo'); ?>';
    var label_otros = '<?= lang('Otros'); ?>';
    var label_favor_cargar = '<?= lang('Home.Favor de esperar la carga de la imagen, puede tardar según la velocidad del internet. El sistema le mostrará un mensaje cuando la carga haya finalizado.'); ?>';
    var label_validar_archivo = '<?= lang('Home.Validar que el archivo no excede el tamaño permitido'); ?>';
    var label_favor_cargar_video = '<?= lang('Home.Favor de esperar la carga del video, puede tardar según la velocidad del internet. El sistema le mostrará un mensaje cuando la carga haya finalizado.'); ?>';
    var label_favor_cargar_documento = '<?= lang('Home.Favor de esperar la carga del documento, puede tardar según la velocidad del internet. El sistema le mostrará un mensaje cuando la carga haya finalizado.'); ?>';

	var label_productividad = '<?= lang('Home.Productividad') ?>';
	var label_calidad = '<?= lang('Home.Calidad') ?>';
	var label_servicio = '<?= lang('Home.Servicio') ?>';
	var label_innovacion = '<?= lang('Home.Innovación') ?>';
	var label_promedio = '<?= lang('Home.Promedio') ?>';
	var label_obtenido = '<?= lang('Home.Obtenido') ?>';
	var label_faltante = '<?= lang('Home.Faltante') ?>';
	var label_yo = '<?= lang('Home.Yo') ?>';
	var label_otros = '<?= lang('Home.Otros') ?>';
	var label_eliminar = '<?= lang('Home.¿Desea eliminar el registro?') ?>';
</script>