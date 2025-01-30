

<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Accele-rate <?= $_SESSION['language']; ?></title>
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
      <!-- LightBox Image CSS -->
      <link rel="stylesheet" href="<?=PATH_ASSETS?>lightbox2-master/dist/css/lightbox.min.css">
      <!-- Select2 CSS -->
      <link rel="stylesheet" href="<?=PATH_ASSETS?>select2/dist/css/select2.min.css">
      <!-- include summernote css/js -->
      <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">

      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

      <link rel="stylesheet" href="<?=PATH_ASSETS?>toast/demos/css/jquery.toast.css">

      <script>
        var base_url = "<?=base_url();?>";
        var path_image = "<?=base_url();?>assets/images/";
         listar = '';
         agregar = '';
         eliminar = '';
         actualizar = '';
         cambiar_estatus = '';
      </script>
      <!-- Jquery -->
      <script src="<?=PATH_ASSETS?>js/jquery.min.js"></script>

      <script src="<?=PATH_PUBLIC?>js/<?=$custom?>.js?v=<?php echo(rand()); ?>" type="text/javascript"></script>
   </head>
   <style>
      table{
         font-size: 13px !important;
      }
   </style>
   <body class="iq-page-menu-horizontal right-column-fixed">
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
      <!-- Wrapper Start -->
      <div class="wrapper">
         
         <?= view('templates/common/Header_view'); ?>

         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="iq-card">
                  <?= view('templates/' . $content); ?>
               </div>
            </div>
         </div>

      </div>
      <!-- Wrapper END -->

      <?= view('templates/common/Footer_view'); ?>

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
      <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
      <!-- lottie JavaScript -->
      <script src="<?=PATH_ASSETS?>js/lottie.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="<?=PATH_ASSETS?>js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="<?=PATH_ASSETS?>js/custom.js"></script>
      <!-- Script lightbox JS -->
      <script src="<?=PATH_ASSETS?>lightbox2-master/dist/js/lightbox.js"></script>
      <!-- Script Select2 JS -->
      <script src="<?=PATH_ASSETS?>select2/dist/js/select2.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
      
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
      <script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>

      <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/themes/Micro.js"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>

      <link rel="stylesheet" href="<?=PATH_ASSETS?>datetimepicker-master/jquery.datetimepicker.css">
      <script src="<?=PATH_ASSETS?>datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>

      <script src="<?=PATH_ASSETS?>toast/demos/js/jquery.toast.js"></script>

      <script src="<?=PATH_ASSETS?>html2canvas/html2canvas.min.js"></script>

      <script>
        // window.onload = function() {
        //   $("input").on('paste', function(e){
        //     e.preventDefault();
        //     console.log('Esta acción está prohibida');
        //   })
          
        //   $("input").on('copy', function(e){
        //     e.preventDefault();
        //     console.log('Esta acción está prohibida');
        //   })

        //   $("textarea").on('paste', function(e){
        //     e.preventDefault();
        //     console.log('Esta acción está prohibida');
        //   })
          
        //   $("textarea").on('copy', function(e){
        //     e.preventDefault();
        //     console.log('Esta acción está prohibida');
        //   })
        // }
        
         <?php if($_SESSION['language'] == 'es'){ ?>

            jQuery.datetimepicker.setLocale('es');

            $.extend( true, $.fn.dataTable.defaults, {
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
                        "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
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
            } );
         <?php } ?>

         function caracteres_validos(string){
             var out = '';
             //Se añaden las letras validas
             var filtro = ' abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚáéíóú.(),';//Caracteres validos
           
             for (var i=0; i<string.length; i++)
                if (filtro.indexOf(string.charAt(i)) != -1) 
                out += string.charAt(i);
             return out;
         }

         function caracteres_numeros_validos(string){
             var out = '';
             //Se añaden las letras validas
             var filtro = ' abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚáéíóú1234567890';//Caracteres validos
           
             for (var i=0; i<string.length; i++)
                if (filtro.indexOf(string.charAt(i)) != -1) 
                out += string.charAt(i);
             return out;
         }

         function caracteres_signos_numeros_validos(string){
             var out = '';
             //Se añaden las letras validas
             var filtro = ' abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890.%#&/-(),:;ÁÉÍÓÚáéíóú';//Caracteres validos
           
             for (var i=0; i<string.length; i++)
                if (filtro.indexOf(string.charAt(i)) != -1) 
                out += string.charAt(i);
             return out;
         }

         function justIntegers(evt,input){
            // var charCode = (evt.which) ? evt.which : evt.keyCode
            // if (charCode > 31 && (charCode < 48 || charCode > 56)){
            //    return false;
            // }else{
            //    return true;
            // }
            
            var key = evt.charCode;
            console.log(key);
            return key >= 48 && key <= 57;
         }

         function justDecimals(e){
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
            return true;
            return /\d/.test(String.fromCharCode(keynum));
         }

         function precise_round(value, decPlaces) {
            var val = value * Math.pow(10, decPlaces);
            var fraction = (Math.round((val - parseInt(val)) * 10) / 10);

            if (fraction == -0.5) fraction = -0.6;

            val = Math.round(parseInt(val) + fraction) / Math.pow(10, decPlaces);
            return val;
         }

         get_tareas_solicitadas();

         function get_tareas_evaluacion(){
            $.ajax({
               url: base_url+'/tasks/get_tareas_evaluacion',
               type: 'POST',
               dataType: 'JSON',
               data: {user_id: <?= $_SESSION['user_id']; ?>, position_id: <?= $_SESSION['position_id']; ?>},
               success: function(res){
                  $('.tareas_evaluacion').text(res['total']);

                  if(res['total'] > 0){                  
                     $.toast({
                         heading: '<?= lang('Home.Tarea(s) Finalizada(s)'); ?>',
                         text: '<a href="<?= base_url().'/Tasks/evaluation_view'; ?>"><?= lang('Home.Total de evaluaciones pendientes');?> ('+res['total']+')</a>',
                         showHideTransition: 'slide',
                         loaderBg: '#162430',
                         hideAfter: 5000,
                         position: 'top-right',
                         bgColor: '#00ca00',
                     });
                  }
               }
            });
         }

         function get_tareas_solicitadas(){
            $.ajax({
               url: base_url+'/tasks/get_tareas_solicitadas',
               type: 'POST',
               dataType: 'JSON',
               data: {user_id: <?= $_SESSION['user_id']; ?>, position_id: <?= $_SESSION['position_id']; ?>},
               success: function(res){
                  $('.tareas_solicitadas').text(res['total']);

                  if(res['total'] > 0){                  
                     $.toast({
                         heading: '<?= lang('Home.Servicios(s) pendiente(s)'); ?>',
                         text: '<a href="<?= base_url().'/Tasks/requested_view'; ?>"><?= lang('Home.Total de servicios pendientes');?> ('+res['total']+')</a>',
                         showHideTransition: 'slide',
                         loaderBg: '#162430',
                         hideAfter: 5000,
                         position: 'top-right',
                         bgColor: '#e64141',
                     });
                  }

                  setTimeout(function(){ get_tareas_evaluacion(); }, 5000);
               }
            }); 
         }

        function change_language(language){
            $.ajax({
                type: "POST",
                url: base_url+'/auth/change_language',
                data: {language: language, user_id: <?= $_SESSION['user_id'] ?>},
                dataType: 'json',
                success: function(res){
                    location.reload();
                }
            });
        }
      </script>
   </body>
</html>
