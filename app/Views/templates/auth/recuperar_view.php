<!doctype html>
<html lang="en">
   
<!-- Mirrored from iqonic.design/themes/sofbox-admin/html/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 23 Nov 2020 02:04:39 GMT -->
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Accele-rate</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="<?=PATH_ASSETS?>images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="<?=PATH_ASSETS?>css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="<?=PATH_ASSETS?>css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="<?=PATH_ASSETS?>css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="<?=PATH_ASSETS?>css/responsive.css">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
            <div class="loader">
               <div class="cube">
                  <div class="sides">
                     <div class="top"></div>
                     <div class="right"></div>
                     <div class="bottom"></div>
                     <div class="left"></div>
                     <div class="front"></div>
                     <div class="back"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page bg-white">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        <div class="sign-in-from">
                            <center>
                                <?php 
                                    $background_es = ''; $background_en = '';
                                    
                                    if($_SESSION['language'] == 'es'){ 
                                        $background_es = 'background: #eef3f9'; 
                                    }else{ 
                                        $background_en = 'background: #eef3f9'; 
                                    } 
                                ?>                           
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-lg btn-outline-light" onclick="change_language('es');" style="<?= $background_es; ?>">
                                        <img src="<?=PATH_ASSETS?>images/español.png" style="width: 30px; height: 20px;">
                                        <input type="radio">
                                    </label>
                                    <label class="btn btn-lg btn-outline-light" onclick="change_language('en');" style="<?= $background_en; ?>">
                                        <img src="<?=PATH_ASSETS?>images/ingles.png" style="width: 30px; height: 20px;">
                                        <input type="radio">
                                    </label>
                                </div>
                            </center>
                            <h1 class="mb-0"><?= lang('Home.Actualizar contraseña'); ?></h1>
                            <p><?= lang('Home.Ingrese su nueva contraseña.'); ?></p>
					        <form class="form-datos mt-4" autocomplete="off">
					             <div class="form-group">
					               <label for="maturity_id"><?= lang('Home.Contraseña'); ?></label>
					               <input type="text" class="form-control password" name="password">
					             </div>
                                <div class="d-inline-block w-100">
                                    <button type="button" class="btn btn-success float-right btn-cons" onclick="actualizar_password(<?= $employee[0]['user_id'] ?>);"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Actualizar'); ?></button>
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
					        </form>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="sign-in-detail text-white" style="background: url(<?=PATH_ASSETS?>images/login/2.jpg) no-repeat 0 0; background-size: cover;">
                            <h1 class="sign-in-logo mb-5 text-center text-white">
                                ACCELE-RATE
                            </h1>
                            <div class="owl-carousel" data-autoplay="false" data-loop="false" data-nav="false" data-dots="false" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                <div class="item">
                                    <img src="<?=PATH_ASSETS?>images/logo.png" class="img-fluid mb-5" alt="logo">
                                    <span class="text-white"><?= lang('Home.Acelerador de Competitividad y Productividad'); ?></span>
                                    <p class="text-white">Business & Education Consulting Group © <?= date('Y'); ?> <?= lang('Home.Todos los derechos reservados.') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->

      <script src="<?=PATH_ASSETS?>js/jquery.min.js"></script>
      <script src="<?=PATH_ASSETS?>js/popper.min.js"></script>
      <script src="<?=PATH_ASSETS?>js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="<?=PATH_ASSETS?>js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="<?=PATH_ASSETS?>js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="<?=PATH_ASSETS?>js/waypoints.min.js"></script>
      <script src="<?=PATH_ASSETS?>js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="<?=PATH_ASSETS?>js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="<?=PATH_ASSETS?>js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="<?=PATH_ASSETS?>js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="<?=PATH_ASSETS?>js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="<?=PATH_ASSETS?>js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="<?=PATH_ASSETS?>js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="<?=PATH_ASSETS?>js/smooth-scrollbar.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="<?=PATH_ASSETS?>js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="<?=PATH_ASSETS?>js/custom.js"></script>
      <!-- js Validation -->
      <script src="<?=PATH_ASSETS?>jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>

      <script type="text/javascript">
        var base_url = "<?=base_url()?>/";
      </script>
      <script src="<?=PATH_PUBLIC?>js/auth.js"></script>
      <script>
		function actualizar_password(user_id){
		    $.ajax({
		        type: "POST",
		        url: base_url + "auth/actualizar_password",
		        data: {user_id: user_id, password: $('.password').val()},
		        dataType: 'json',
		        success: function(res){
		        	console.log(res);

		            if(res.status == "OK"){
		                alert(res.message);
		                window.location = base_url + 'auth/logout';
		            }else{
						$('.alert-text-error').html(res.message);
						$('.alert-danger').show();
		                setTimeout(function(){ $('.alert').hide(); }, 2000);
		            }
		        }
		    });
		}
        function change_language(language){
            $.ajax({
                type: "POST",
                url: base_url+'auth/change_language',
                data: {language: language},
                dataType: 'json',
                success: function(res){
                    location.reload();
                }
            });
        }
      </script>
   </body>

<!-- Mirrored from iqonic.design/themes/sofbox-admin/html/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 23 Nov 2020 02:04:45 GMT -->
</html>