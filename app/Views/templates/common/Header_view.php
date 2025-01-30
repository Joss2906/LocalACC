<div class="iq-top-navbar">
   <div class="iq-navbar-custom d-flex align-items-center justify-content-between">
      <div class="iq-sidebar-logo" style="background: #162430;">
         <div class="top-logo" style="background: #162430; margin-right: 10px !important;">
            <a href="<?= base_url().'/Employees/profile_view/'.$_SESSION['user_id'].'/'.$_SESSION['position_id'] ?>" class="logo">
            <img src="<?=PATH_ASSETS?>images/logo.gif" class="img-fluid" alt="" style=" height: 75px;">
            <span style="color: white; font-size: 14px!important; line-height: 20px!important; padding-top: 15px;">Business & Education Consulting Group</span>
            </a>
         </div>
      </div>
      <div class="iq-menu-horizontal">
         <nav class="iq-sidebar-menu">                     
         <ul id="iq-sidebar-toggle" class="iq-menu d-flex">
            <li class="active">
               <a href="<?= base_url().'/Employees/profile_view/'.$_SESSION['user_id'].'/'.$_SESSION['position_id'] ?>">
                  <i class="ri-home-4-line"></i><?= lang('Home.Inicio');?>
               </a>
            </li>
            <li>
               <a href="#organization" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><i class="ri-building-line"></i><span><?= lang('Home.Administración');?></span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
               <ul id="organization" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                  <?php if($_SESSION['credential_id'] == 1){ ?>
                  <li><a href="<?= base_url().'/Organizations' ?>"><?= lang('Home.Organización');?></a></li>
                  <li><a href="<?= base_url().'/Departments' ?>"><?= lang('Home.Departamentos');?></a></li>
                  <li><a href="<?= base_url().'/Positions' ?>"><?= lang('Home.Puestos');?></a></li>
                  <li><a href="<?= base_url().'/Chiefs'; ?>"><?= lang('Home.Jefe/Empleados');?></a></li>
                  <?php } ?>
                  <li><a href="<?= base_url().'/Employees' ?>"><?= lang('Home.Recursos humanos');?></a></li>
                  <?php if($_SESSION['user_id'] == 1){ ?>
                  <li><a href="<?= base_url().'/Loads'; ?>"><?= lang('Home.Cargar formato de empleados');?></a></li>
                  <li><a href="<?= base_url().'/Categories'; ?>"><?= lang('Home.Categorías cuestionario');?></a></li>
                  <?php } ?>
               </ul>
            </li>
            <li>
               <a href="#services" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><i class="ri-article-line"></i><span><?= lang('Home.Servicios y Funciones');?></span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
               <ul id="services" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                  <li><a href="<?= base_url().'/Services'; ?>"><?= lang('Home.Clientes y competidores');?></a></li>
                  <li><a href="<?= base_url().'/Providers'; ?>"><?= lang('Home.Proveedores');?></a></li>
                  <?php if($_SESSION['credential_id'] == 1 || $_SESSION['credential_id'] == 3){ ?>
                  <li><a href="<?= base_url().'/Services/classify_view'; ?>"><?= lang('Home.Clasificar');?></a></li>
                  <?php } ?>
                  <?php if($_SESSION['credential_id'] == 1 || $_SESSION['credential_id'] == 2){ ?>
                  <li><a href="<?= base_url().'/Services/approve_view'; ?>"><?= lang('Home.Aprobar');?></a></li>
                  <?php } ?>
               </ul>
            </li>
            <li>
               <a href="#tasks" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><i class="ri-chat-settings-line"></i><span><?= lang('Home.Productividad');?></span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
               <ul id="tasks" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                  <li><a href="<?= base_url().'/Tasks'; ?>"><?= lang('Home.Servicios que he pedido');?></a></li>
                  <li><a href="<?= base_url().'/Tasks/requested_view'; ?>"><?= lang('Home.Servicios que me han pedido');?></a></li>
                  <li><a href="<?= base_url().'/Tasks/register_view'; ?>"><?= lang('Home.Registrar mi productividad');?></a></li>
                  <li><a href="<?= base_url().'/Tasks/evaluation_view'; ?>"><?= lang('Home.Evaluar a otros');?></a></li>
                  <li><a href="<?= base_url().'/Tasks/comment_view'; ?>"><?= lang('Home.Felicitaciones y sugerencias');?></a></li>
                  <li><a href="<?= base_url().'/Statistics'; ?>"><?= lang('Home.Estadísticas');?></a></li>
               </ul>
            </li>
            <li>
               <a href="#complaints" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="false"><i class="ri-coupon-line"></i><span><?= lang('Home.Quejas');?></span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
               <ul id="complaints" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                  <li><a href="<?= base_url().'/Complaints'; ?>"><?= lang('Home.Mis quejas');?></a></li>
                  <li><a href="<?= base_url().'/Complaints/complaints_towards_me_view'; ?>"><?= lang('Home.Quejas hacia mí');?></a></li>
                  <?php if($_SESSION['credential_id'] == 1 || $_SESSION['credential_id'] == 2){ ?>
                  <li><a href="<?= base_url().'/Complaints/complaints_my_employees_view'; ?>"><?= lang('Home.Quejas de mis empleados');?></a></li>
                  <?php } ?>
               </ul>
            </li>
            <li>
              <?php 
                  $background_es = ''; $background_en = '';
                  
                  if($_SESSION['language'] == 'es'){ 
                      $background_es = 'background: #eef3f9'; 
                  }else{ 
                      $background_en = 'background: #eef3f9'; 
                  } 
              ?>                       
              <div class="btn-group btn-group-toggle mt-3" data-toggle="buttons">
                  <label class="btn btn-lg btn-link" onclick="change_language('es');" style="<?= $background_es; ?>">
                      <img src="<?=PATH_ASSETS?>images/español.png" style="width: 30px; height: 20px;">
                      <input type="radio">
                  </label>
                  <label class="btn btn-lg btn-link" onclick="change_language('en');" style="<?= $background_en; ?>">
                      <img src="<?=PATH_ASSETS?>images/ingles.png" style="width: 30px; height: 20px;">
                      <input type="radio">
                  </label>
              </div>
            </li>
         </ul>
         </nav>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light p-0">
<!--          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <i class="ri-menu-3-line"></i>
         </button> -->
         <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu" style="width: 50px !important; height: 45px !important;">
               <div class="line-menu half start"></div>
               <div class="line-menu"></div>
               <div class="line-menu half end"></div>
            </div>
         </div>
         <ul class="navbar-list">
            <li>
               <a href="#" class="search-toggle iq-waves-effect bg-primary text-white"><i class="ri-menu-line"></i></a>
               <div class="iq-sub-dropdown iq-user-dropdown">
                  <div class="iq-card shadow-none m-0">
                     <div class="iq-card-body p-0 ">
                        <div class="bg-primary p-3">
                           <span class="mb-0 text-white font-size-18"><?= lang('Home.Bienvenido:');?> <?= $_SESSION['nombre']; ?></span>
                           <br>
                           <span class="text-white"><?= lang('Home.Credencial');?>: <?= lang('Home.'.$_SESSION['credential'].''); ?></span>
                           <br>
                           <span class="text-white"><?= lang('Home.Departamento');?>: <?= $_SESSION['department']; ?></span>
                           <br>
                           <span class="text-white"><?= lang('Home.Puesto');?>: <?= $_SESSION['position']; ?></span>
                        </div>
                        <a href="<?= base_url().'/Employees/profile_view/'.$_SESSION['user_id'].'/'.$_SESSION['position_id'] ?>" class="iq-sub-card iq-bg-success-hover">
                           <div class="media align-items-center">
                              <div class="rounded iq-card-icon iq-bg-success">
                                 <i class="ri-file-user-line"></i>
                              </div>
                              <div class="media-body ml-3">
                                 <h6 class="mb-0 "><?= lang('Home.Mi perfil');?></h6>
                                 <p class="mb-0 font-size-12"><?= lang('Home.Ver mis datos personales.');?></p>
                              </div>
                           </div>
                        </a>
                        <a href="<?= base_url().'/Employees/presentation_view/'.$_SESSION['user_id'].'/'.$_SESSION['position_id'] ?>" class="iq-sub-card iq-bg-info-hover">
                           <div class="media align-items-center">
                              <div class="rounded iq-card-icon iq-bg-info">
                                 <i class="ri-file-user-line"></i>
                              </div>
                              <div class="media-body ml-3">
                                 <h6 class="mb-0 "><?= lang('Home.Mi presentación');?></h6>
                                 <p class="mb-0 font-size-12"><?= lang('Home.Ver mi pantalla de presentación.');?></p>
                              </div>
                           </div>
                        </a>
                        <div class="d-inline-block w-100 text-center p-3">
                           <a class="iq-bg-danger iq-sign-btn" href="<?=base_url()?>/auth/logout" role="button"><?= lang('Home.Cerrar sesión');?><i class="ri-login-box-line ml-2"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
            </li>
         </ul>
      </nav>
   </div>
</div>
