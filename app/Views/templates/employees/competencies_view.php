<div class="iq-card-header d-flex justify-content-between">
   <div class="iq-header-title">
        <h5><?= lang('Home.Calificar competencias');?></h5>
   </div>
</div>
<div class="iq-card iq-card-block iq-card-stretch">                    
    <div class="iq-card-body row" style="width: 100% !important;">
        <form class="form-datos">
            <input type="hidden" name="user_id" value="<?= $user_id; ?>">
            <div class="col-md-12 row">
            <?php foreach ($competencies as $c) { ?>
                <div class="col-md-6">
                    <div class="form-group row">                        
                        <div class="col-md-2">
                            <input type="hidden" class="form-control competency<?= $c['competency_id'] ?>" name="competency_id[]" value="<?= $c['competency_id'] ?>">
                            <input type="text" class="form-control qualification<?= $c['competency_id'] ?>" name="qualification<?= $c['competency_id'] ?>" onkeypress="return justIntegers(event);" onkeyup="validar_calificacion(<?= $c['competency_id'] ?>, this.value)" maxlength="3" value="<?= $c['qualification']; ?>">
                        </div>
                        <label for="inputPassword" class="col-md-10 col-form-label"><?= lang('Home.'.$c['competency'].''); ?></label>
                    </div>
                </div>
            <?php } ?>
            </div>
            <div class="col-md-12 row mb-3">
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
                <div class="col-md-12 pull-right">          
                    <div class="form-group div-button">
                        <input type="hidden" class="form-active" value="1">
                        <button class="btn btn-success btn-form" type="button" onclick="validar_form_competiencies();"><i class="ri-add-circle-fill"></i> <?= lang('Home.Agregar');?></button>
                        <a href="<?= base_url(); ?>/Employees" class="btn btn-secondary"><i class="ri-close-circle-fill"></i> <?= lang('Home.Cancelar');?></a>
                    </div>
                </div>
            </div>
        </form>
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
</script>
