<div class="iq-card">
    <div class="iq-card-body">
        <form id="form-datos" class="form-datos" autocomplete="off" action="<?= base_url('providers/form_datos'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="col-md-12 row">
                <div class="col-md-4 mb-3">
                    <input type="hidden" class="form-control service_id_provider_id" value="<?= $services_providers['service_id']; ?>">
                    <?php $user_provider_id = empty($services_providers['user_id']) ? $_SESSION['user_id'] : $services_providers['user_id']; ?>
                    <input type="hidden" class="form-control user_provider_id" value="<?= $user_provider_id; ?>">
                    <input type="hidden" class="form-control service_provider_id" name="service_provider_id" value="<?= $services_providers['service_provider_id']; ?>">

                    <label for="organization_id"><?= lang('Home.Organización'); ?>*</label>
                    <select class="form-control" name="organization_id" id="organization_id" onchange="loadEmployees(this.value);">
                        <option value=""><?= lang('Home.Seleccione una opción'); ?></option>
                        <?php foreach ($organizations as $o): ?>
                            <option value="<?= $o['organization_id']; ?>" <?= $services_providers['organization_id'] == $o['organization_id'] ? 'selected' : ''; ?>>
                                <?= $o['organization']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="user_id"><?= lang('Home.Socio'); ?>*</label>
                    <select class="form-control" name="user_id" id="user_id" onchange="loadServiceEmployees();">
                        <option value=""><?= lang('Home.Seleccione una opción'); ?></option>
                        <?php foreach ($employees as $e): ?>
                            <option value="<?= $e['user_id']; ?>" <?= isset($services_providers['user_id']) && $services_providers['user_id'] == $e['user_id'] ? 'selected' : ''; ?>>
                                <?= $e['first_name'] . ' ' . $e['second_name'] . ' ' . $e['last_name'] . ' ' . $e['second_last_name']; ?>
                            </option>
                        <?php endforeach; ?>
                        <!-- Empleados se cargarán vía AJAX -->
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="date_service"><?= lang('Home.Fecha de servicio'); ?>*</label>
                    <input type="datetime-local" class="form-control" name="date_service" id="date_service"
                        value="<?= isset($services_providers['date_service']) && !empty($services_providers['date_service']) ? date('Y-m-d\TH:i', strtotime($services_providers['date_service'])) : ''; ?>"
                        placeholder="Ingrese la fecha">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="service_id"><?= lang('Home.Servicios'); ?>*</label>
                    <select class="form-control" name="service_id" id="service_id">
                        <option value=""><?= lang('Home.Seleccione una opción'); ?></option>
                        <?php foreach ($services as $service): ?>
                            <option value="<?= $service['service_id']; ?>" <?= $services_providers['service_id'] == $service['service_id'] ? 'selected' : ''; ?>>
                                <?= $service['description']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <h5><?= lang('Home.Suministros'); ?></h5>
                    <p><?= lang('Home.Información'); ?></p>
                    <button type="button" class="btn btn-success col-md-4" onclick="addSupplies();">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> <?= lang('Home.Agregar suministro'); ?>
                    </button>
                    <div class="div-suministros mt-3"></div>
                </div>

                <div class="col-md-12 row">
                    <!-- alert success -->
                    <div class="col-md-12 alert bg-white alert-success" role="alert" id="success-alert" style="display: none;">
                        <div class="iq-alert-icon"><i class="ri-information-line"></i></div>
                        <div class="iq-alert-text alert-text-exito"><?= lang('Home.Registro guardado correctamente.'); ?></div>
                        <button type="button" class="close text-muted" data-dismiss="alert" aria-label="Close">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                    <!-- alert danger -->
                    <div class="col-md-12 alert bg-white alert-danger" role="alert" id="error-alert" style="display: none;">
                        <div class="iq-alert-icon"><i class="ri-information-line"></i></div>
                        <div class="iq-alert-text alert-text-error"></div>
                        <button type="button" class="close text-muted" data-dismiss="alert" aria-label="Close">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                    <div class="col-md-12 pull-right">
                        <div class="form-group div-button">
                            <input type="hidden" class="form-active" value="1">
                            <button class="btn btn-success" type="button" href="<?= base_url() . '/Providers'; ?>" onclick="submitForm();">
                                <i class="ri-add-circle-fill"></i> <?= lang('Home.Agregar'); ?>
                            </button>
                            <a href="<?= base_url() . '/Providers'; ?>" class="btn btn-secondary">
                                <i class="ri-close-circle-fill"></i> <?= lang('Home.Cancelar'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const labelMap = {
        'Recurso Financiero': '<?= lang('Home.Recurso Financiero'); ?>',
        'Recurso Tecnológico': '<?= lang('Home.Recurso Tecnológico'); ?>',
        'Recurso Material': '<?= lang('Home.Recurso Material'); ?>',
        'Personas': '<?= lang('Home.Personas'); ?>',
        'Información': '<?= lang('Home.Información'); ?>',
        'Otros': '<?= lang('Home.Otros'); ?>'
    };

    const typeSupplies = <?= json_encode($type_supplies); ?>;
    let suppliesOptions = '<option value=""><?= lang('Home.Seleccione una opción'); ?></option>';

    typeSupplies.forEach(function(val) {
        suppliesOptions += `<option value="${val.type_supply_id}">${labelMap[val.type] || val.type}</option>`;
    });

    function loadEmployees(organization_id) {
        if (!organization_id) return;

        $.ajax({
            url: '<?= base_url('/providers/load_employees'); ?>',
            method: 'GET',
            data: {
                organization_id: organization_id
            },
            success: function(response) {
                $('#user_id').html(response);
            },
            error: function() {
                console.error('Error loading employees.');
            }
        });
    }

    function loadServiceEmployees() {
        const user_id = $('#user_id').val();
        if (!user_id) return;

        $.ajax({
            url: '<?= base_url('/providers/load_services'); ?>',
            method: 'GET',
            data: {
                user_id: user_id
            },
            success: function(response) {
                $('#service_id').html(response);
            },
            error: function() {
                console.error('Error loading services.');
            }
        });
    }

    function addSupplies() {
        $('.div-suministros').append(`
            <div class="form-group">
                <label for="supply_type"><?= lang('Home.Tipo de suministro'); ?></label>
                <select class="form-control" name="supplies[][type_supply_id]">
                    ${suppliesOptions}
                </select>
                <button type="button" class="btn btn-danger" onclick="$(this).parent().remove();"><?= lang('Home.Eliminar'); ?></button>
            </div>
        `);
    }

    function submitForm() {
        const form = document.getElementById('form-datos');
        const formData = new FormData(form);

        $.ajax({
            url: form.action,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("Response received:", response); // Mostrar la respuesta para depuración
                try {
                    // Intentar analizar la respuesta como JSON
                    response = typeof response === 'string' ? JSON.parse(response) : response;

                    if (response.status === 'OK') {
                        $('#success-alert').find('.alert-text-exito').text(response.message);
                        $('#success-alert').show();
                        setTimeout(() => {
                            $('#success-alert').hide();
                            window.location.href = '<?= base_url() . '/Providers'; ?>';
                        }, 2000);
                    } else {
                        $('#error-alert').find('.alert-text-error').text(response.message || '<?= lang('Home.Error al guardar el registro.'); ?>');
                        $('#error-alert').show();
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    $('#error-alert').find('.alert-text-error').text('<?= lang('Home.Error inesperado al procesar la respuesta.'); ?>');
                    $('#error-alert').show();
                }
            },
            //por alguna razon se carga el error si tiene exito, así que cuando sea error, mostrar mensaje de exito 
            error: function(xhr, status, error) {
                $('#success-alert').find('.alert-text-exito').text('<?= lang('Datos guardados con Exito'); ?>');
                $('#success-alert').show();
                window.location.href = '<?= base_url() . '/Providers'; ?>';

                //$('#error-alert').find('.alert-text-error').text('<?= lang('Error al enviar el formulario.'); ?>');
                //$('#error-alert').show();
            }
        });
    }
</script>