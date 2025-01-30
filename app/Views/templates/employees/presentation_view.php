<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="shortcut icon" href="<?= PATH_ASSETS ?>images/favicon.ico" />
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?= PATH_ASSETS ?>css/bootstrap.min.css">
<!-- Typography CSS -->
<link rel="stylesheet" href="<?= PATH_ASSETS ?>css/typography.css">
<!-- Style CSS -->
<link rel="stylesheet" href="<?= PATH_ASSETS ?>css/style.css">
<!-- Responsive CSS -->
<link rel="stylesheet" href="<?= PATH_ASSETS ?>css/responsive.css">
<!-- LightBox Image CSS -->
<link rel="stylesheet" href="<?= PATH_ASSETS ?>lightbox2-master/dist/css/lightbox.min.css">
<!-- Select2 CSS -->
<link rel="stylesheet" href="<?= PATH_ASSETS ?>select2/dist/css/select2.min.css">
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<link rel="stylesheet" href="<?= PATH_ASSETS ?>glide/dist/css/glide.core.min.css">
<link rel="stylesheet" href="<?= PATH_ASSETS ?>glide/dist/css/glide.theme.min.css">
<link rel="stylesheet" href="<?= PATH_ASSETS ?>slick/slick/slick.css">
<link rel="stylesheet" href="<?= PATH_ASSETS ?>slick/slick/slick-theme.css">
<link rel="stylesheet" href="<?= PATH_ASSETS ?>flipster/dist/jquery.flipster.min.css">

<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Pragati+Narrow&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">

<link rel="stylesheet" href="<?= PATH_ASSETS ?>banner-video/dist/jquery.vidbacking.css" type="text/css">

<link rel="stylesheet" href="<?= PATH_PUBLIC ?>css/presentation_view.css?v=<?php echo (rand()); ?>">

<script>
    var base_url = "<?= base_url(); ?>";
    var path_image = "<?= base_url(); ?>assets/images/";
    listar = '';
    agregar = '';
    eliminar = '';
    actualizar = '';
    cambiar_estatus = '';

    function finalizar_carga() {
        $('#loading').hide();
    }
</script>

<script src="<?= PATH_ASSETS ?>js/jquery.min.js"></script>

<body onload="finalizar_carga();">
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

    <div class="col-md-12 p-0">
        <div class="video_perfil col-md-12" style="height: 130vh;  ">

            <video class="vidbacking" autoplay muted loop playsinline>
                <?php if ($employee['profile_video'] == '' || $employee['profile_video'] == null || $employee['profile_video'] == 'null') { ?>
                    <source src="<?= base_url() . '/public/videos/burbujas.mp4'; ?>" type="video/mp4">
                <?php } else { ?>
                    <source src="<?= base_url() . '/public/videos/' . $employee['user_id'] . '/' . $employee['profile_video']; ?>" type="video/mp4">
                <?php } ?>
            </video>


            <input type="hidden" class="user_id_presentation" value="<?= $employee['user_id']; ?>">
            <input type="hidden" class="position_id_presentation" value="<?= $employee['position_id']; ?>">

            <div class="col-md-5 mx-auto" style="height: 130vh; background: #fcf8ed; opacity: 0.9;">
                <div class="col-md-12" style="height: 25vh;">
                    <div class="col-md-12 text-center">

                        <!--Aqui inicia el card principal-->
                        <div class="card-block text-center text-white">


                            <h1 style="color: #bc9b5d; font-weight: bold;"><?= $employee['position']; ?></h1>
                            <span style="color: #bc9b5d; font-weight: bold; font-size: 20px;"><?= $employee['first_name'] . ' ' . $employee['second_name'] . ' ' . $employee['last_name'] . ' ' . $employee['second_last_name']; ?></span>
                            <p>
                                <a href="<?= base_url() . '/Employees/profile_view/' . $_SESSION['user_id'] . '/' . $_SESSION['position_id'] ?>" class="btn btn-info"><?= lang('Home.Regresar al sistema'); ?></a>
                            </p>
                        </div>
                    </div>
                    <div class="0" style="height: 80vh; background-color: #15151f;">
                        <?php if (empty($employee['profile_picture'])) { ?>
                            <img src="<?= base_url() . '/public/fotos/foto_perfil.jpg'; ?>" class="img-thumbnail col-md-12" style="widt: 100%; height: 100%;">
                        <?php } else { ?>
                            <?php $extension = substr($employee['profile_picture'], -3); ?>
                            <?php if ($extension == 'mp4' || $extension == 'avi') { ?>
                                

                            <?php } else { ?>
                                <img src="<?= base_url() . '/public/fotos/' . $employee['user_id'] . '/' . $employee['profile_picture']; ?>" class="img-thumbnail col-md-12" style="widt: 100%; height: 100%;">
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col-md-12 mt-2" style="height: 30vh;">
                        <h2 class="text-center" style="color: #bc9b5d; font-weight: bold; font-size: 35px;"><?= lang('Home.Misión'); ?></h2>
                        <p style="color: black; font-size: 16px;  text-align: justify; text-justify: inter-word;">
                            <?php if ($employee['mission'] != 'null') {
                                $employee['mission'] = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $employee['mission']);
                                echo $employee['mission'];
                            } ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="contenedor col-md-12" style="background-color: #15151f;">

            <!--video
              <video class="vidbacking" autoplay muted loop>
      <source src="<?= base_url() . '/public/videos/burbujas.mp4'; ?>" type="video/mp4">
    </video> 
            
            -->

            <div class="clientes col-md-12 mt-3">
                <div class="col-md-12 text-center">
                    <h3 style="color: #bc9b5d; font-weight: bold; font-size: 35px;"><?= lang('Home.Clientes'); ?></h3>
                </div>
                <div class="col-md-12" style="padding-top: 20px;">
                    <div class="slider-clientes">
                        <?php foreach ($providers as $p) { ?>
                            <div class="cliente autor" style="margin-left: 5px; margin-right: 5px;">
                                <?php if (empty($p['profile_picture'])) { ?>
                                    <div class="img_foto img-thumbnail" style="background: url('<?= base_url() . '/public/fotos/foto_perfil.jpg'; ?>'); background-repeat: no-repeat; background-size: cover;"></div>
                                <?php } else { ?>
                                    <div class="img_foto img-thumbnail" style="background: url('<?= base_url() . '/public/fotos/' . $p['user_id'] . '/' . $p['profile_picture']; ?>'); background-repeat: no-repeat; background-size: cover;"></div>
                                <?php } ?>
                                <h5 class="text-center">
                                    <a href="#" class="text-white" style="color: white;" title="nombre"><?= $p['customer']; ?></a>
                                </h5>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>

            <div class="mision_ventajas col-md-12 mt-3">
                <div class="col-md-12 col-sm-12 hacia_donde_voy">
                    <h3 class="text-center" style="color: #bc9b5d; font-weight: bold; font-size: 35px;"><?= lang('Home.Hacia dónde voy'); ?></h3>
                </div>

                <div class="slider-valores col-md-12" style="padding-left: 0px; padding-right: 0px;">
                    <div class="col-md-4 col-sm-4 mision d-flex" style="background: url('<?= base_url() . '/public/img/vision.jpg'; ?>'); background-repeat: repeat-y; background-size: cover; padding: 20px 20px 20px 20px; height: 60vh;">
                        <div class="col-md-12 div_mision" style="background: rgba(255,255,255, 0.9); padding: 10px 10px 10px 10px; overflow-y: auto;">
                            <h3 class="title text-center" style="font-weight: bold;"><?= lang('Home.Visión'); ?></h3>
                            <span style="font-weight: normal !important; color: black !important; font-size: 18px; text-align: justify; text-justify: inter-word;">
                                <?php if ($employee['vision'] != 'null') {
                                    $employee['vision'] = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $employee['vision']);
                                    echo $employee['vision'];
                                } else {
                                    echo 'S/D';
                                } ?>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 ventaja_competitiva d-flex" style="background: url('<?= base_url() . '/public/img/ventaja_competitivas.jpg'; ?>'); background-repeat: repeat-y; background-size: cover; padding: 20px 20px 20px 20px; height: 60vh;">
                        <div class="col-md-12 div_ventaja_competitiva" style="background: rgba(255,255,255, 0.9); padding: 10px 10px 10px 10px; overflow-y: auto;">
                            <h3 class="subheader text-center" style="font-weight: bold;"><?= lang('Home.Ventajas competitivas') ?></h3>
                            <span style="font-weight: normal !important; color: black !important; font-size: 18px;  text-align: justify; text-justify: inter-word;">
                                <?php if ($employee['competitive_advantages'] != 'null') {
                                    $employee['competitive_advantages'] = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $employee['competitive_advantages']);
                                    echo $employee['competitive_advantages'];
                                } else {
                                    echo 'S/D';
                                } ?>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 ventaja_comparativa d-flex" style="background: url('<?= base_url() . '/public/img/ventaja_comparativas.jpg'; ?>'); background-repeat: repeat-y; background-size: cover; padding: 20px 20px 20px 20px; height: 60vh;">
                        <div class="col-md-12 div_ventaja_comparativa" style="background: rgba(255,255,255, 0.9); padding: 10px 10px 10px 10px; overflow-y: auto;">
                            <h3 class="subheader text-center" style="font-weight: bold;"><?= lang('Home.Ventajas comparativas'); ?></h3>
                            <span style="font-weight: normal !important; color: black !important; font-size: 18px;  text-align: justify; text-justify: inter-word;">
                                <?php if ($employee['comparative_advantages'] != 'null') {
                                    $employee['comparative_advantages'] = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $employee['comparative_advantages']);
                                    echo $employee['comparative_advantages'];
                                } else {
                                    echo 'S/D';
                                } ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 mt-3" style="margin-top: 40px;">
                <h3 class="text-center" style="color: #bc9b5d; font-weight: bold; font-size: 35px;"><?= lang('Home.Valor de mis acciones'); ?></h3>

                <div class="col-md-12 mt-3">
                    <div class="col-md-4 offset-md-4" style="background: white;">
                        <h4 class="text-center" style="color: #bc9b5d; font-weight: bold;">ROI: <?= $employee['roi']; ?></h4>
                        <p class="text-center numero_total total_evaluaciones" style="color: #bc9b5d; font-weight: bold;"></p>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="col-md-12 col-sm-12 mx-auto slider-graficas" style="height: 50vh;">
                    <div class="col-md-4 slider_grafica" style="text-align: center; background: white; margin-left: 5px!important; margin-right: 5px!important;">
                        <p><?= lang('Home.Desempeño general'); ?></p>
                        <div id="chart-desempeño-general" style="height: 50vh;"></div>
                    </div>
                    <div class="col-md-4 slider_grafica" style="text-align: center; background: white; margin-left: 5px!important; margin-right: 5px!important;">
                        <p><?= lang('Home.Yo esta semana'); ?></p>
                        <div id="chart-desempeño-semanal" style="height: 50vh;"></div>
                    </div>
                    <div class="col-md-4 slider_grafica" style="text-align: center; background: white; margin-left: 5px!important; margin-right: 5px!important;">
                        <p><?= lang('Home.Desempeño'); ?></p>
                        <div id="chart-desempeño" style="height: 50vh;"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3 servicios_garantias">
                <h3 class="text-center" style="color: #bc9b5d; font-weight: bold; font-size: 35px;"><?= lang('Home.Servicios y garantías a mis Clientes'); ?></h3>
            </div>

            <div class="col-md-12 mt-3">
                <div class="col-md-12 botones">
                    <div class="col-md-8 offset-md-2 col-sm-12 row" style="padding-top: 20px;">
                        <form method="get" class="col-md-6 col-sm-12 col-xs-12" accept-charset="utf-8" action="">
                            <a href="<?= base_url() . '/Tasks/requested_view'; ?>" class="btn btn-link col-sm-12 col-xs-12" style="margin-bottom: 10px; background: white; color: #bc9b5d;">
                                <?= lang('Home.Servicios pendientes'); ?> <span class="badge badge-light tareas_solicitadas" style="background: #bc9b5d;"></span>
                            </a>
                        </form>
                        <form method="get" class="col-md-6 col-sm-12 col-xs-12" accept-charset="utf-8" action="">
                            <a href="<?= base_url() . '/Tasks/evaluation_view'; ?>" class="btn btn-link col-sm-12 col-xs-12" style="margin-bottom: 10px; background: white; color: #bc9b5d;">
                                <?= lang('Home.Evaluaciones pendientes'); ?> <span class="badge badge-light tareas_evaluacion" style="background: #bc9b5d;"></span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>

            <input type="hidden" class="div_service" value="0">
            <div class="col-md-12 contenedor_funciones">
                <?php $i = 1;
                foreach ($services as $s) { ?>
                    <?php if ($i != 1) {
                        $collapse = 'collapse';
                    } else {
                        $collapse = '';
                    } ?>
                    <center>
                        <div class="col-md-10 <?= $collapse; ?>" style="background: white; margin-bottom: 10px;" id="<?= $collapse; ?>">
                            <div class="col-md-12 container" style="overflow-y: auto;">
                                <div class="row">
                                    <div class="col-md-7 col-12" style="padding-left: 0px; padding-right: 0px;">
                                        <div class="col-md-12" style="margin-top: 10px; margin-bottom: 10px;">
                                            <img src="<?= base_url() . '/public/servicios/' . $s['service_id'] . '/' . $s['profile_picture']; ?>" alt="" style="max-width: 100%; height: auto;">
                                        </div>
                                        <div class="col-md-12 row" style="margin-top: 20px;">

                                            <div class="col-md-4 col-12">
                                                <span style="color: #bc9b5d; text-align: left !important; font-weight: bold; font-family: 'Great Vibes', cursive; font-size: 25px;"><?= lang('Home.Función'); ?> #<?= $i; ?></span>
                                            </div>

                                            <div class="col-md-8 col-12 row">
                                                <div class="col-md-3 col-12 mb-3">
                                                    <a href="<?= base_url() . '/Services/form_view/0' ?>" class="btn col-md-12 col-12 mb-3" style="background: #bc9b5d; color: white;">
                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp;
                                                    </a>
                                                </div>

                                                <div class="col-md-9 col-12 mb-3">
                                                    <button type="button" class="btn col-md-12 col-12 mb-3" style="background: #bc9b5d; color: white;" onclick="ver_funciones();">
                                                        <?= lang('Home.Ver todas las funciones'); ?>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12" style="text-align: left; padding-bottom: 35px;">
                                                <span style="font-size: 14px; text-align: justify !important; text-justify: inter-word;"><?= $s['description']; ?></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-5 col-12" style="padding-left: 0px; padding-right: 0px;">
                                        <div class="col-md-12" style="text-align: left;">
                                            <span style="color: #bc9b5d; font-weight: bold; font-family: 'Great Vibes', cursive; font-size: 25px;"><?= lang('Home.Productividad'); ?></span>
                                            <p style="font-size: 14px; text-align: justify; text-justify: inter-word;"><?= $s['productivity']; ?></p>
                                        </div>
                                        <div class="col-md-12" style="text-align: left;">
                                            <span style="color: #bc9b5d; font-weight: bold; font-family: 'Great Vibes', cursive; font-size: 25px;"><?= lang('Home.Calidad'); ?></span>
                                            <p style="font-size: 14px; text-align: justify; text-justify: inter-word;"><?= $s['quality']; ?></p>
                                        </div>
                                        <div class="col-md-12" style="text-align: left;">
                                            <span style="color: #bc9b5d; font-weight: bold; font-family: 'Great Vibes', cursive; font-size: 25px;"><?= lang('Home.Servicio'); ?></span>
                                            <p style="font-size: 14px; text-align: justify; text-justify: inter-word;"><?= $s['service']; ?></p>
                                        </div>
                                        <div class="col-md-12" style="text-align: left;">
                                            <span style="color: #bc9b5d; font-weight: bold; font-family: 'Great Vibes', cursive; font-size: 25px;"><?= lang('Home.Innovación'); ?></span>
                                            <p style="font-size: 14px; text-align: justify; text-justify: inter-word;"><?= $s['innovation']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>
                <?php $i++;
                } ?>
            </div>

            <div class="col-md-12 mt-3 testimonios">
                <h3 class="text-center" style="color: #bc9b5d; font-weight: bold; font-size: 35px;"><?= lang('Home.Felicitaciones y sugerencias'); ?></h3>
            </div>

            <div class="col-md-12 mt-3">
                <div class="col-md-10 slider-testimonios mx-auto" style="height: 120vh;">
                    <?php foreach ($comments as $c) { ?>

                        <?php if (empty($c['profile_picture'])) { ?>
                            <?php $img = base_url() . '/public/fotos/foto_perfil.jpg'; ?>
                        <?php } else { ?>
                            <?php $img = base_url() . '/public/fotos/' . $c['user_id'] . '/' . $c['profile_picture']; ?>
                        <?php } ?>

                        <?php if (!empty($c['commentary_productivity'])) { ?>
                            <div class="col-md-4 slider_testimonio">
                                <div class="col-md-12 slider_testimonio_imagen" style="background: url(<?php echo $img; ?>); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                </div>
                                <div class="col-md-12 slider_testimonio_descripcion" style="overflow-y: scroll;">
                                    <h6 class="text-center" style="font-weight: bold; font-family: 'Pragati Narrow', sans-serif; font-size: 25px;"><?= $c['name']; ?></h6>
                                    <p style="font-size: 16px; text-align: justify; text-justify: inter-word; padding: 20px 20px 20px 20px;">
                                        <?= $c['commentary_productivity']; ?>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (!empty($c['commentary_quality'])) { ?>
                            <div class="col-md-4 slider_testimonio">
                                <div class="col-md-12 slider_testimonio_imagen" style="background: url(<?php echo $img; ?>); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                </div>
                                <div class="col-md-12 slider_testimonio_descripcion" style="overflow-y: scroll;">
                                    <h6 class="text-center" style="font-weight: bold; font-family: 'Pragati Narrow', sans-serif; font-size: 25px;"><?= $c['name']; ?></h6>
                                    <p style="font-size: 16px; text-align: justify; text-justify: inter-word; padding: 20px 20px 20px 20px;">
                                        <?= $c['commentary_quality']; ?>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (!empty($c['commentary_innovation'])) { ?>
                            <div class="col-md-4 slider_testimonio">
                                <div class="col-md-12 slider_testimonio_imagen" style="background: url(<?php echo $img; ?>); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                </div>
                                <div class="col-md-12 slider_testimonio_descripcion" style="overflow-y: scroll;">
                                    <h6 class="text-center" style="font-weight: bold; font-family: 'Pragati Narrow', sans-serif; font-size: 25px;"><?= $c['name']; ?></h6>
                                    <p style="font-size: 16px; text-align: justify; text-justify: inter-word; padding: 20px 20px 20px 20px;">
                                        <?= $c['commentary_innovation']; ?>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (!empty($c['commentary_service'])) { ?>
                            <div class="col-md-4 slider_testimonio">
                                <div class="col-md-12 slider_testimonio_imagen" style="background: url(<?php echo $img; ?>); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                </div>
                                <div class="col-md-12 slider_testimonio_descripcion" style="overflow-y: scroll;">
                                    <h6 class="text-center" style="font-weight: bold; font-family: 'Pragati Narrow', sans-serif; font-size: 25px;"><?= $c['name']; ?></h6>
                                    <p style="font-size: 16px; text-align: justify; text-justify: inter-word; padding: 20px 20px 20px 20px;">
                                        <?= $c['commentary_service']; ?>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>

                    <?php } ?>
                </div>
            </div>

            <div class="col-md-12 mt-3 mi_huella">
                <h3 class="text-center" style="color: #bc9b5d; font-weight: bold; font-size: 35px;"><?= lang('Home.Mi Huella digital de talento'); ?></h3>
            </div>

            <!-- graficas -->
            <div class="col-md-12 mt-3">
                <div class="col-md-8 offset-md-2" style="background: white;">
                    <h3 class="text-center" style="color: #bc9b5d; font-weight: bold;"><?= lang('Home.Mis 10 competencias mas fuertes'); ?></h3>
                    <div id="competencies_chart_me"></div>
                </div>
            </div>

            <div class="col-md-12 mt-3 innovaciones">
                <h3 class="text-center" style="color: #bc9b5d; font-weight: bold; font-size: 35px;"><?= lang('Home.Innovaciones que he aportado'); ?></h3>
            </div>

            <div class="col-md-12 mt-3">
                <div class="col-md-12 slider-innovaciones">
                    <?php foreach ($innovations as $i): ?>
                        <div class="col-md-6 slider_innovacion">
                            <?php
                            if (empty($i['imagen_innovacion'])) {
                                $imagen_innovacion = base_url() . '/public/img/innovacion.jpg';
                            } else {
                                $imagen_innovacion = base_url() . '/public/innovacion/' . $i['innovation_id'] . '/' . $i['imagen_innovacion'];
                            }
                            ?>
                            <div class="col-md-12 slider_innovacion_imagen" style="background: url('<?= $imagen_innovacion; ?>'); background-repeat: no-repeat; background-size: cover;">
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-12 slider_innovacion_descripcion" style="overflow-y: scroll;">
                                <h6 class="text-center" style="font-weight: bold; font-family: 'Pragati Narrow', sans-serif; font-size: 25px;"><?= $i['innovation']; ?></h6>
                                <p style="font-size: 14px; text-align: justify; text-justify: inter-word; padding: 20px 20px 20px 20px;"><?= $i['description']; ?></p>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <span style="font-weight: bold;">$<?= number_format($i['annual_value']); ?> <label class="label label-info pull-right"><?= lang('Home.Valor Anual'); ?></label></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-12 mt-3 resolucion">
                <h3 class="text-center" style="color: #bc9b5d; font-weight: bold; font-size: 35px;"><?= lang('Home.Resolución de Problemas en el Puesto'); ?></h3>
            </div>

            <div class="col-md-12">
                <div class="col-md-12 slider-resolucion">
                    <?php foreach ($resolutions as $r): ?>
                        <?php
                        if (empty($r['imagen_resolucion'])) {
                            $imagen_resolucion = base_url() . '/public/img/resolucion.jpg';
                        } else {
                            $imagen_resolucion = base_url() . '/public/resolucion/' . $r['resolution_id'] . '/' . $r['imagen_resolucion'];
                        }
                        ?>
                        <div class="col-md-6 slider_resolucion">
                            <div class="col-md-12 slider_resolucion_imagen" style="background: url('<?= $imagen_resolucion; ?>'); background-repeat: no-repeat; background-size: cover;"></div>
                            <div class="col-md-12 slider_resolucion_descripcion" style="overflow-y: scroll;">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                                <h6 class="text-center" style="font-weight: bold; font-family: 'Pragati Narrow', sans-serif; font-size: 25px;"><?= $r['resolution']; ?></h6>
                                <div class="col-md-12">
                                    <hr>
                                </div>
                                <p style="font-size: 16px; text-align: justify; text-justify: inter-word; padding: 20px 20px 20px 20px;">
                                    <?= $r['description']; ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-12 mt-3 comentarios">
                <h3 class="text-center" style="color: #bc9b5d; font-weight: bold; font-size: 35px;"><?= lang('Home.Resolución de quejas'); ?></h3>
            </div>

            <div class="col-md-12">
                <div class="col-md-12 slider-quejas" style="height: 80vh;">
                    <?php $num = 1; ?>
                    <?php foreach ($complaints as $c): ?>
                        <div class="col-md-6">
                            <div style="background: white; border: 4px #bc9b5d solid; border-radius: 8px; text-align: justify; text-justify: inter-word;">
                                <div style="background: rgba(255,255,255, 0.9); font-weight: bold !important;">

                                    <div class="col-md-6 mx-auto mt-3">
                                        <?php if (empty($c['profile_picture'])) { ?>
                                            <?php $img = base_url() . '/public/fotos/foto_perfil.jpg'; ?>
                                        <?php } else { ?>
                                            <?php $img = base_url() . '/public/fotos/' . $c['user_id'] . '/' . $c['profile_picture']; ?>
                                        <?php } ?>
                                        <div class="slider_comentarios_imagen img-thumbnail mx-auto" style="background: url('<?php echo $img; ?>'); background-repeat: no-repeat; background-size: cover; border-radius: 50%;">
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <span style=" font-weight: normal !important; font-size: 22px !important;">
                                            <text style="font-size: 20px; color: black; font-weight: normal !important; word-spacing: 0.1em;">
                                                <?= $c['author']; ?>
                                            </text>
                                        </span>
                                    </div>

                                    <div class="col-md-12">
                                        <p class="card-title" style="font-weight: normal !important; font-size: 22px !important;"><?= lang('Home.Tipo') ?>: &nbsp;
                                            <text style="font-size: 20px; color: black; font-weight: normal !important;">
                                                <?php if ($c['complaint_type_id'] == 1) { ?>
                                                    <?= lang('Home.' . $c['type'] . ''); ?>
                                                <?php } else { ?>
                                                    <?= lang('Home.' . $c['type'] . ''); ?>
                                                <?php } ?>
                                            </text>
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p style="font-weight: normal !important; font-size: 22px !important;"><?= lang('Home.Categoría'); ?>: &nbsp;
                                            <text style="font-size: 20px; color: black; font-weight: normal !important;"><?= $c['category']; ?></text>
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p style="font-weight: normal !important; font-size: 22px !important;"><?= lang('Home.Estatus'); ?>: &nbsp;
                                            <text style="font-size: 20px; color: black; font-weight: normal !important;">
                                                <?php if ($c['complaint_status_id'] == 1) { ?>
                                                    <?= lang('Home.' . $c['status'] . ''); ?>
                                                <?php } ?>
                                                <?php if ($c['complaint_status_id'] == 2) { ?>
                                                    <?= lang('Home.' . $c['status'] . ''); ?>
                                                <?php } ?>
                                                <?php if ($c['complaint_status_id'] == 3) { ?>
                                                    <?= lang('Home.' . $c['status'] . ''); ?>
                                                <?php } ?>
                                                <?php if ($c['complaint_status_id'] == 4) { ?>
                                                    <?= lang('Home.' . $c['status'] . ''); ?>
                                                <?php } ?>
                                                <?php if ($c['complaint_status_id'] == 5) { ?>
                                                    <?= lang('Home.' . $c['status'] . ''); ?>
                                                <?php } ?>
                                            </text>
                                        </p>
                                    </div>
                                    <div class="col-md-12" style="overflow-y: scroll;">
                                        <p style="font-weight: normal !important; font-size: 22px !important; overflow-y: scroll;"><?= lang('Home.Queja'); ?>:
                                            <text style="font-size: 22px; color: black; font-weight: normal !important; word-spacing: 0.1em;">
                                                <?= $c['complaint']; ?>
                                            </text>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if ($employee['quiz'] == 1) { ?>
                <?php if ($employee['user_id'] == $_SESSION['user_id'] && $_SESSION['credential_id'] < 4) { ?>
                    <div class="col-md-12 comentarios">
                        <h3 class="text-center" style="color: #bc9b5d; font-weight: bold; font-size: 35px;"><?= lang('Home.Satisfacción de mis Colaboradores'); ?></h3>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-10 mx-auto slider-mecanismos">
                            <?php $i = 1;
                            foreach ($satisfaction_categories as $sc) { ?>
                                <?php $num_total = 0; ?>
                                <?php $total_average = 0; ?>
                                <div class="col-md-12 slider-pregunta-respuesta" style="padding: 0px!important;">
                                    <div class="col-md-12 row slider-pregunta">
                                        <table class="table table-bordered col-md-8">
                                            <tr>
                                                <td style="width: 5%; padding-top: 20%; background: <?= $sc['color']; ?>;" rowspan="<?= count($sc['satisfaction_mechanisms']) + (count($sc['satisfaction_mechanisms']) * 7); ?>">
                                                    <span style="display: inline-block; writing-mode: vertical-lr; transform: rotate(180deg); font-size: 16px; font-weight: bold; position: -webkit-sticky; position: sticky; top: 0; color: white;">
                                                        <?= lang('Home.' . $sc['category'] . ''); ?>
                                                    </span>
                                                </td>
                                                <td style="width: 90%;"><?= lang('Home.Cuestionario'); ?></td>
                                                <td style="width: 5%;"><?= lang('Home.Calificación'); ?></td>
                                            </tr>
                                            <?php foreach ($sc['satisfaction_mechanisms'] as $sm) {
                                                $label_question = lang('Home.' . $sm['question'] . ''); ?>
                                                <tr>
                                                    <td>
                                                        <div class="col-md-12 row">
                                                            <div class="col-md-11">
                                                                <span><?= $sm['satisfaction_id'] . '-' . lang('Home.' . $sm['question'] . ''); ?></span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button type="button" class="btn btn-link" onclick="collapse(<?= $sm['satisfaction_id']; ?>);">
                                                                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 collapse collapse-<?= $sm['satisfaction_id']; ?> row">
                                                            <?php if (!empty($sm['satisfaction_responses'])) { ?>
                                                                <?php foreach ($sm['satisfaction_responses'] as $sr) { ?>
                                                                    <div class="col-md-12">
                                                                        <hr>
                                                                    </div>
                                                                    <div class="col-md-9 mb-3">
                                                                        <p><?= $sr['response']; ?></p>
                                                                    </div>
                                                                    <div class="col-md-2 mb-3">
                                                                        <span><?= $sr['rating']; ?></span>
                                                                    </div>
                                                                    <div class="col-md-1 mb-3">
                                                                        <button type="button" class="btn btn-link col-md-1" onclick="ver_respuestas_empleados(<?= $sr['satisfaction_response_id']; ?>, <?= '`' . $sm['satisfaction_id'] . '-' . $label_question . '`'; ?>);">
                                                                            <i class="fa fa-commenting-o" aria-hidden="true"></i>
                                                                        </button>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <?php $sm['average'][0]['average_rating'] = 0; ?>
                                                                <div class="col-md-12">
                                                                    <hr>
                                                                </div>
                                                                <div class="col-md-10 mb-3">
                                                                    <p><?= lang('Home.No se subio respuesta'); ?></p>
                                                                </div>
                                                                <div class="col-md-2 mb-3">
                                                                    <span>0</span>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                    <td colspan="2">
                                                        <?php $total_average = $sm['average'][0]['average_rating'] + $total_average;
                                                        $num_total++;  ?>
                                                        <span><?= round($sm['average'][0]['average_rating'], 2); ?></span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                        <div class="col-md-4">
                                            <div class="col-md-12 slider-imagen img-thumbnail" style="background: url(<?= base_url() . '/public/cuestionarios/' . $sc['image'] . ''; ?>); background-repeat: no-repeat; background-size: cover; position: -webkit-sticky; position: sticky; top: 0;"></div>
                                        </div>
                                        <div class="col-md-2 offset-md-5" style="font-weight: bold; margin-bottom: 22px; font-size: 20px;">
                                            <span><?= lang('Home.Promedio') ?>: <?= round($total_average / $num_total, 2); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php $i++;
                            } ?>
                        </div>
                    </div>

                    <div class="col-md-10 row mx-auto">
                        <div class="form-group col-md-6">
                            <label style="color: #bc9b5d; font-size: 14px;"><?= lang('Home.Descargar archivo para contestar'); ?></label>
                            <?php if ($_SESSION['language'] == 'es') { ?>
                                <a class="btn btn-link form-control" href="<?= base_url() . '/public/formatos/plantilla_cuestionario.xlsx'; ?>" style="font-weight: bold; background: white; color: #bc9b5d;">
                                    <?= lang('Home.Descargar'); ?>
                                </a>
                            <?php } else { ?>
                                <a class="btn btn-link form-control" href="<?= base_url() . '/public/formatos/plantilla_cuestionario_ingles.xlsx'; ?>" style="font-weight: bold; background: white; color: #bc9b5d;">
                                    <?= lang('Home.Descargar'); ?>
                                </a>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label style="color: #bc9b5d; font-size: 14px;"><?= lang('Home.Cargar archivo del cuestionario y respuestas'); ?></label>
                            <button class="btn btn-link form-control" onclick="modal_cuestionario();" style="font-weight: bold; background: white; color: #bc9b5d;">
                                <?= lang('Home.Cargar'); ?>
                            </button>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($_SESSION['credential_id'] < 5) { ?>

                    <div class="col-md-12 comentarios">
                        <h3 class="text-center" style="color: #bc9b5d; font-weight: bold; font-size: 35px;"><?= lang('Home.Garantías de Satisfacción a mis Colaboradores'); ?></h3>
                    </div>

                    <div class="col-md-12">
                        <?php foreach ($chiefs as $ch) { ?>
                            <div class="col-md-10 mx-auto slider-mecanismos-dos">
                                <?php $i = 1;
                                foreach ($ch['satisfaction_categories'] as $sc) { ?>
                                    <?php $num_total = 0; ?>
                                    <?php $total_average = 0; ?>
                                    <div class="col-md-12 slider-pregunta-respuesta" style="padding: 0px!important;">
                                        <div class="col-md-12 row slider-pregunta">
                                            <table class="table table-bordered col-md-8">
                                                <tr>
                                                    <td style="background: <?= $sc['color']; ?>;"></td>
                                                    <td class="<?= $ch['name']; ?>" colspan="2"><?= $ch['name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 5%; padding-top: 20%; background: <?= $sc['color']; ?>;" rowspan="<?= count($sc['satisfaction_mechanisms']) + (count($sc['satisfaction_mechanisms']) * 7); ?>">
                                                        <span style="display: inline-block; writing-mode: vertical-lr; transform: rotate(180deg); font-size: 16px; font-weight: bold; position: -webkit-sticky; position: sticky; top: 0; color: white;">
                                                            <?= lang('Home.' . $sc['category'] . ''); ?>
                                                        </span>
                                                    </td>
                                                    <td style="width: 90%;"><?= lang('Home.Cuestionario'); ?></td>
                                                    <td style="width: 5%;"><?= lang('Home.Calificación'); ?></td>
                                                </tr>
                                                <?php foreach ($sc['satisfaction_mechanisms'] as $sm) { ?>
                                                    <tr>
                                                        <td>
                                                            <div class="col-md-12 row">
                                                                <div class="col-md-11">
                                                                    <span><?= $sm['satisfaction_id'] . '-' . lang('Home.' . $sm['question'] . ''); ?></span>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button type="button" class="btn btn-link" onclick="collapse_chiefs(<?= $sm['satisfaction_id']; ?>, <?= $ch['chief_id']; ?>);">
                                                                        <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 collapse collapse_<?= $sm['satisfaction_id']; ?>_<?= $ch['chief_id']; ?> row">
                                                                <?php foreach ($sm['satisfaction_responses'] as $sr) { ?>
                                                                    <form class="col-md-12 row form-response-<?= $ch['chief_id']; ?>">
                                                                        <div class="col-md-12">
                                                                            <hr>
                                                                        </div>
                                                                        <div class="col-md-10 mb-3">
                                                                            <p><?= $sr['response']; ?></p>
                                                                        </div>
                                                                        <div class="col-md-2 mb-3">
                                                                            <input type="hidden" class="form-control col-md-12 satisfaction_response_rating_id" name="satisfaction_response_rating_id" value="<?= $sr['satisfaction_response_rating_id']; ?>">
                                                                            <input type="hidden" class="form-control col-md-12 satisfaction_response_id" name="satisfaction_response_id" value="<?= $sr['satisfaction_response_id']; ?>">
                                                                            <input type="hidden" class="form-control col-md-12 satisfaction_id" name="satisfaction_id" value="<?= $sm['satisfaction_id']; ?>">
                                                                            <input type="hidden" class="form-control col-md-12 user_id" name="user_id" value="<?= $ch['chief_user_id']; ?>">
                                                                            <input type="hidden" class="form-control col-md-12 satisfaction_response_id" name="satisfaction_response_id" value="<?= $sr['satisfaction_response_id']; ?>">
                                                                            <input type="text" class="form-control col-md-12 rating" name="rating" maxlength="3" onkeypress="return justIntegers(event);" value="<?= $sr['rating']; ?>">
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <textarea class="form-control col-md-12" name="description" cols="30" rows="3" maxlength="999"><?= $sr['description']; ?></textarea>
                                                                        </div>
                                                                        <!-- alert success -->
                                                                        <div class="col-md-12 alert bg-white alert-success-<?= $sr['satisfaction_response_id']; ?>-<?= $ch['chief_user_id']; ?>" role="alert" style="display: none;">
                                                                            <div class="iq-alert-icon">
                                                                                <i class="ri-information-line"></i>
                                                                            </div>
                                                                            <div class="iq-alert-text alert-text-exito-<?= $sr['satisfaction_response_id']; ?>-<?= $ch['chief_user_id']; ?>"></div>
                                                                            <button type="button" class="close text-muted" data-dismiss="alert" aria-label="Close">
                                                                                <i class="ri-close-line"></i>
                                                                            </button>
                                                                        </div>
                                                                        <!-- alert danger -->
                                                                        <div class="col-md-12 alert bg-white alert-danger-<?= $sr['satisfaction_response_id']; ?>-<?= $ch['chief_user_id']; ?>" role="alert" style="display: none;">
                                                                            <div class="iq-alert-icon">
                                                                                <i class="ri-information-line"></i>
                                                                            </div>
                                                                            <div class="iq-alert-text alert-text-error-<?= $sr['satisfaction_response_id']; ?>-<?= $ch['chief_user_id']; ?>"></div>
                                                                            <button type="button" class="close text-muted" data-dismiss="alert" aria-label="Close">
                                                                                <i class="ri-close-line"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <br>
                                                                            <button type="button" class="btn btn-success" onclick="guardar_calificacion(this, <?= $sr['satisfaction_response_id']; ?>, <?= $ch['chief_user_id']; ?>);"><i class="ri-add-circle-fill"></i> <?= lang('Home.Guardar'); ?></button>
                                                                        </div>
                                                                    </form>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                        <td colspan="2">
                                                            <?php if (isset($sm['average'][0]['average_rating'])) { ?>
                                                                <?php $total_average = $sm['average'][0]['average_rating'] + $total_average;
                                                                $num_total++;  ?>
                                                                <span><?= round($sm['average'][0]['average_rating'], 2); ?></span>
                                                            <?php } else { ?>
                                                                <span>0</span>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                            <div class="col-md-4">
                                                <div class="col-md-12 slider-imagen img-thumbnail" style="background: url(<?= base_url() . '/public/cuestionarios/' . $sc['image'] . ''; ?>); background-repeat: no-repeat; background-size: cover; position: -webkit-sticky; position: sticky; top: 0;"></div>
                                            </div>
                                            <div class="col-md-2 offset-md-5" style="font-weight: bold; margin-bottom: 22px; font-size: 20px;">
                                                <?php if ($total_average > 0) { ?>
                                                    <span><?= lang('Home.Promedio'); ?>: <?= round($total_average / $num_total, 2); ?></span>
                                                <?php } else { ?>
                                                    <span><?= lang('Home.Promedio'); ?>: 0</span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php $i++;
                                } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="col-md-12 pie_pagina" style="color: white; background: #15151f; padding: 20px 20px 20px 20px;">
            <span>Business & Education Consulting Group © <?= date('Y'); ?> <?= lang('Home.Todos los derechos reservados.'); ?></span>

            <p><?= lang('Home.Sitio optimizado para Internet Explorer 11, Firefox 38, Google Chrome 43 y Safari 8 o posteriores. Favor de verificar que su navegador está actualizado y la última versión de Java está instalada.') ?></p>
        </div>

        <div class="modal modal_cuestionario" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang('Home.Subir respuestas'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-excel2">
                            <p><?= lang('Home.El tipo de archivo debe ser un excel con extensión xlsx'); ?></p>
                            <input type="hidden" class="user_id2" value="<?= $employee['user_id']; ?>" name="user_id">
                            <input type="hidden" class="form-control txt_csrfname_file" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                            <label for=""><?= lang('Home.Archivo de mecanismos de satisfacción'); ?></label>
                            <input type="file" class="form-control-file archivo_excel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="archivo_excel">
                            <br><br><br>
                            <div class="col-md-12 mb-3 progress">
                                <div class="progress-bar progress-bar-mecanismos" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
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
                        <button type="button" class="btn btn-success btn-masivos-excel" onclick="cargar_excel_mecanismos();"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Guardar'); ?></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> <?= lang('Home.Cerrar'); ?></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-respuestas-empleados fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-respuesta" id="exampleModalLabel"></h5>
                    </div>
                    <div class="modal-body">
                        <table id="" class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th><?= lang('Home.Respuesta'); ?></th>
                                    <th><?= lang('Home.Calificación'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="tbody-datos"></tbody>
                        </table>
                    </div>
                    <div class="modal-footer" style="background-color: #004f8c !important;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> <?= lang('Home.Cerrar'); ?></button>
                    </div>
                </div>
            </div>
        </div>

</body>


<script src="<?= PATH_ASSETS ?>js/popper.min.js"></script>
<script src="<?= PATH_ASSETS ?>js/bootstrap.min.js"></script>
<!-- Appear JavaScript -->
<script src="<?= PATH_ASSETS ?>js/jquery.appear.js"></script>
<!-- Countdown JavaScript -->
<script src="<?= PATH_ASSETS ?>js/countdown.min.js"></script>
<!-- Counterup JavaScript -->
<script src="<?= PATH_ASSETS ?>js/waypoints.min.js"></script>
<script src="<?= PATH_ASSETS ?>js/jquery.counterup.min.js"></script>
<!-- Wow JavaScript -->
<script src="<?= PATH_ASSETS ?>js/wow.min.js"></script>
<!-- Apexcharts JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!-- Slick JavaScript -->
<script src="<?= PATH_ASSETS ?>slick/slick/slick.min.js"></script>
<!-- Select2 JavaScript -->
<script src="<?= PATH_ASSETS ?>js/select2.min.js"></script>
<!-- Owl Carousel JavaScript -->
<script src="<?= PATH_ASSETS ?>js/owl.carousel.min.js"></script>
<!-- Magnific Popup JavaScript -->
<script src="<?= PATH_ASSETS ?>js/jquery.magnific-popup.min.js"></script>
<!-- Smooth Scrollbar JavaScript -->
<script src="<?= PATH_ASSETS ?>js/smooth-scrollbar.js"></script>
<!-- lottie JavaScript -->
<script src="<?= PATH_ASSETS ?>js/lottie.js"></script>
<!-- Chart Custom JavaScript -->
<script src="<?= PATH_ASSETS ?>js/chart-custom.js"></script>
<!-- Custom JavaScript -->
<script src="<?= PATH_ASSETS ?>js/custom.js"></script>
<!-- Script lightbox JS -->
<script src="<?= PATH_ASSETS ?>lightbox2-master/dist/js/lightbox.js"></script>
<!-- Script Select2 JS -->
<script src="<?= PATH_ASSETS ?>select2/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>

<script src="<?= PATH_ASSETS ?>glide/dist/glide.min.js"></script>
<script src="<?= PATH_ASSETS ?>flipster/dist/jquery.flipster.min.js"></script>
<script src="<?= PATH_ASSETS ?>banner-video/dist/jquery.vidbacking.js"></script>

<script src="<?= PATH_PUBLIC ?>js/presentation_view.js?v=<?php echo (rand()); ?>"></script>

<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<script>
    $('.contenedor').vidbacking({
        'masked': true
    });

    $('.video_perfil').vidbacking({
        'masked': true
    });

    // $('.div-video').vidbacking({
    //     'masked': true
    // });

    window.onload = function() {
        $("input").on('paste', function(e) {
            e.preventDefault();
            console.log('Esta acción está prohibida');
        })

        $("input").on('copy', function(e) {
            e.preventDefault();
            console.log('Esta acción está prohibida');
        })

        $("textarea").on('paste', function(e) {
            e.preventDefault();
            console.log('Esta acción está prohibida');
        })

        $("textarea").on('copy', function(e) {
            e.preventDefault();
            console.log('Esta acción está prohibida');
        })
    }

    <?php if ($_SESSION['language'] == 'es') { ?>
        $.extend(true, $.fn.dataTable.defaults, {
            "language": {
                "decimal": ",",
                "thousands": ".",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoPostFix": "",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "loadingRecords": "Cargando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "processing": "Procesando...",
                "search": "Buscar:",
                "searchPlaceholder": "Término de búsqueda",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "aria": {
                    "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                //only works for built-in buttons, not for custom buttons
                "buttons": {
                    "create": "Nuevo",
                    "edit": "Cambiar",
                    "remove": "Borrar",
                    "copy": "Copiar",
                    "csv": "fichero CSV",
                    "excel": "tabla Excel",
                    "pdf": "documento PDF",
                    "print": "Imprimir",
                    "colvis": "Visibilidad columnas",
                    "collection": "Colección",
                    "upload": "Seleccione fichero...."
                },
                "select": {
                    "rows": {
                        _: '%d filas seleccionadas',
                        0: 'clic fila para seleccionar',
                        1: 'una fila seleccionada'
                    }
                }
            }
        });
    <?php } ?>

    var list_competencias = [];

    <?php
    $i = 1;
    foreach ($competencies as $c) {
        $c['competency'] =  lang('Home.' . $c['competency'] . '');

        if ($i <= 10) {
            echo 'list_competencias.push([ "' . $c['competency'] . '", ' . $c['qualification'] . ']);';
        }
        $i++;
    }
    ?>

    graficar_competencias(list_competencias);

    get_tareas_evaluacion();
    get_tareas_solicitadas();

    function get_tareas_evaluacion() {
        $.ajax({
            url: base_url + '/tasks/get_tareas_evaluacion',
            type: 'POST',
            dataType: 'JSON',
            data: {
                user_id: <?= $_SESSION['user_id']; ?>,
                position_id: <?= $_SESSION['position_id']; ?>
            },
            success: function(res) {
                // console.log(res);
                $('.tareas_evaluacion').text(res['total']);
            }
        });
    }

    function get_tareas_solicitadas() {
        $.ajax({
            url: base_url + '/tasks/get_tareas_solicitadas',
            type: 'POST',
            dataType: 'JSON',
            data: {
                user_id: <?= $_SESSION['user_id']; ?>,
                position_id: <?= $_SESSION['position_id']; ?>
            },
            success: function(res) {
                // console.log(res);
                $('.tareas_solicitadas').text(res['total']);
            }
        });
    }

    var label_favor_registrar = '<?= lang('Home.Favor de registrar los datos del usuario.'); ?>';
    var label_error_nuevamente = '<?= lang('Home.Error, Intente nuevamente'); ?>';
    var label_guardaron_correctamente = '<?= lang('Home.Se guardaron correctamente los datos.'); ?>';
    var label_deshabilitar = '<?= lang('Home.¿Desea deshabilitar el registro?'); ?>';
    var label_habilitar = '<?= lang('Home.¿Desea habilitar el registro?'); ?>';
    var label_200 = '<?= lang('Home.La calificación no puede ser mayor a 200') ?>';
    var label_100 = '<?= lang('Home.La calificación no puede ser mayor a 100') ?>';
    var label_seleccionar = '<?= lang('Home.Seleccione una opción'); ?>';
    var label_evaluaciones = '<?= lang('Home.Evaluaciones'); ?>';

    var label_productividad = '<?= lang('Home.Productividad') ?>';
    var label_calidad = '<?= lang('Home.Calidad') ?>';
    var label_servicio = '<?= lang('Home.Servicio') ?>';
    var label_innovacion = '<?= lang('Home.Innovación') ?>';
    var label_promedio = '<?= lang('Home.Promedio') ?>';
    var label_obtenido = '<?= lang('Home.Obtenido') ?>';
    var label_faltante = '<?= lang('Home.Faltante') ?>';
    var label_yo = '<?= lang('Home.Yo') ?>';
    var label_otros = '<?= lang('Home.Otros') ?>';
</script>