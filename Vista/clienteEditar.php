<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente - Green</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            padding-top: 60px;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .is-valid {
            border-color: #28a745;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
            display: none;
            width: 100%;
            margin-top: 0.25rem;
        }

        .is-invalid~.invalid-feedback {
            display: block;
        }

        .password-strength {
            height: 5px;
            margin-top: 5px;
            background-color: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
        }

        .password-requirements {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 5px;
        }

        .requirement {
            display: flex;
            align-items: center;
            margin-bottom: 2px;
        }

        .requirement i {
            margin-right: 5px;
            font-size: 0.7rem;
        }

        .valid {
            color: #28a745;
        }

        .invalid {
            color: #dc3545;
        }

        .form-section {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1100;
        }
    </style>
</head>

<body>
    <!-- Toast para mensajes -->
    <div class="toast-container">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto" id="toast-title">Notificación</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toast-message"></div>
        </div>
    </div>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-success"><i class="fas fa-user-edit me-2"></i>Editar Cliente</h1>
        </div>

        <!-- Formulario de Edición -->
        <div class="form-section">
            <form method="post" action="../modelo/modelo.php?opcion=5" id="clienteForm" novalidate>
                <?php foreach ($arregloClientes as $cliente) { ?>
                    <input type="hidden" name="tipo_documento_original" value="<?php echo $cliente->tipo_documento; ?>">
                    <input type="hidden" name="numero_documento_original" value="<?php echo $cliente->numero_documento; ?>">

                    <div class="row g-3">
                        <!-- Tipo Documento y Número -->
                        <div class="col-md-3">
                            <label for="tipo_documento" class="form-label">Tipo Documento <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" name="tipo_documento" id="tipo_documento" required>
                                <option value="">Seleccione...</option>
                                <option value="cc" <?php echo $cliente->tipo_documento == 'cc' ? 'selected' : ''; ?>>Cédula
                                </option>
                                <option value="ce" <?php echo $cliente->tipo_documento == 'ce' ? 'selected' : ''; ?>>Cédula
                                    Extranjería</option>
                                <option value="ti" <?php echo $cliente->tipo_documento == 'ti' ? 'selected' : ''; ?>>Tarjeta
                                    Identidad</option>
                                <option value="pasaporte" <?php echo $cliente->tipo_documento == 'pasaporte' ? 'selected' : ''; ?>>Pasaporte</option>
                            </select>
                            <div class="invalid-feedback">Por favor seleccione un tipo de documento</div>
                        </div>
                        <div class="col-md-3">
                            <label for="numero_documento" class="form-label">Número Documento <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="numero_documento" id="numero_documento"
                                value="<?php echo $cliente->numero_documento; ?>" maxlength="10" pattern="\d{1,10}"
                                required>
                            <div class="invalid-feedback">El número de documento debe contener solo números (máximo 10
                                dígitos)</div>
                        </div>

                        <!-- Nombres -->
                        <div class="col-md-3">
                            <label for="nombre1" class="form-label">Primer Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nombre1" id="nombre1"
                                value="<?php echo $cliente->nombre1; ?>" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" maxlength="50"
                                required>
                            <div class="invalid-feedback">Por favor ingrese un primer nombre válido (solo letras, máximo 50
                                caracteres)</div>
                        </div>
                        <div class="col-md-3">
                            <label for="nombre2" class="form-label">Segundo Nombre</label>
                            <input type="text" class="form-control" name="nombre2" id="nombre2"
                                value="<?php echo $cliente->nombre2; ?>" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]*" maxlength="50">
                            <div class="invalid-feedback">Por favor ingrese solo letras (máximo 50 caracteres)</div>
                        </div>

                        <!-- Apellidos -->
                        <div class="col-md-3">
                            <label for="apellido1" class="form-label">Primer Apellido <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="apellido1" id="apellido1"
                                value="<?php echo $cliente->apellido1; ?>" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" maxlength="50"
                                required>
                            <div class="invalid-feedback">Por favor ingrese un primer apellido válido (solo letras, máximo
                                50 caracteres)</div>
                        </div>
                        <div class="col-md-3">
                            <label for="apellido2" class="form-label">Segundo Apellido</label>
                            <input type="text" class="form-control" name="apellido2" id="apellido2"
                                value="<?php echo $cliente->apellido2; ?>" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]*" maxlength="50">
                            <div class="invalid-feedback">Por favor ingrese solo letras (máximo 50 caracteres)</div>
                        </div>

                        <!-- Contacto -->
                        <div class="col-md-3">
                            <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="telefono" id="telefono"
                                value="<?php echo $cliente->telefono; ?>" maxlength="10" pattern="\d{7,10}" required>
                            <div class="invalid-feedback">El teléfono debe contener solo números (7-10 dígitos)</div>
                        </div>
                        <div class="col-md-3">
                            <label for="correo" class="form-label">Correo Electrónico <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="correo" id="correo"
                                value="<?php echo $cliente->correo; ?>"
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" maxlength="100" required>
                            <div class="invalid-feedback">Por favor ingrese un correo válido (ejemplo: usuario@dominio.com,
                                máximo 100 caracteres)</div>
                        </div>

                        <!-- Credenciales -->
                        <div class="col-md-3">
                            <label for="contra" class="form-label">Nueva Contraseña (opcional)</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="contra" id="contra"
                                    pattern="^(?=.[A-Z])(?=.\d).{8}$|^$" maxlength="8">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="password-strength">
                                <div class="password-strength-bar" id="passwordStrengthBar"></div>
                            </div>
                            <div class="password-requirements">
                                <div class="requirement" id="lengthReq">
                                    <i class="fas fa-circle"></i>
                                    <span>8 caracteres (si se cambia)</span>
                                </div>
                                <div class="requirement" id="uppercaseReq">
                                    <i class="fas fa-circle"></i>
                                    <span>1 mayúscula (si se cambia)</span>
                                </div>
                                <div class="requirement" id="numberReq">
                                    <i class="fas fa-circle"></i>
                                    <span>1 número (si se cambia)</span>
                                </div>
                            </div>
                            <div class="invalid-feedback">Si cambia la contraseña, debe tener exactamente 8 caracteres,
                                incluyendo al menos una mayúscula y un número</div>
                        </div>

                        <!-- Estado -->
                        <div class="col-md-3">
                            <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                            <select class="form-select" name="estado" id="estado" required>
                                <option value="A" <?php echo $cliente->estado == 'A' ? 'selected' : ''; ?>>Activo</option>
                                <option value="I" <?php echo $cliente->estado == 'I' ? 'selected' : ''; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>
                <?php } ?>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-3 px-4">
                        <i class="fas fa-save me-2"></i>Guardar Cambios
                    </button>
                    <a href="../modelo/modelo.php?opcion=2" class="btn btn-outline-secondary px-4">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toast de Bootstrap
        const toastLiveExample = document.getElementById('liveToast');
        const toastBootstrap = bootstrap.Toast ? new bootstrap.Toast(toastLiveExample) : null;

        function showToast(title, message, type = 'success') {
            document.getElementById('toast-title').textContent = title;
            document.getElementById('toast-message').textContent = message;

            // Limpiar clases previas
            toastLiveExample.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'bg-info');

            // Añadir clase según el tipo
            if (type === 'success') toastLiveExample.classList.add('bg-success');
            else if (type === 'danger') toastLiveExample.classList.add('bg-danger');
            else if (type === 'warning') toastLiveExample.classList.add('bg-warning');
            else if (type === 'info') toastLiveExample.classList.add('bg-info');

            if (toastBootstrap) toastBootstrap.show();
        }

        // Función para mostrar/ocultar contraseña
        document.getElementById('togglePassword')?.addEventListener('click', function () {
            const passwordInput = document.getElementById('contra');
            const icon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });

        // Validación en tiempo real para campos numéricos (documento y teléfono)
        document.getElementById('numero_documento')?.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 10) {
                this.value = this.value.slice(0, 10);
            }
            validateField(this);
        });

        document.getElementById('telefono')?.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 10) {
                this.value = this.value.slice(0, 10);
            }
            validateField(this);
        });

        // Validación en tiempo real para el correo electrónico
        document.getElementById('correo')?.addEventListener('input', function () {
            validateField(this);
        });

        // Validación en tiempo real para la contraseña
        document.getElementById('contra')?.addEventListener('input', function () {
            validatePassword(this.value);
            validateField(this);
        });

        // Validación en tiempo real para correo existente (excepto el actual)
        document.getElementById('correo')?.addEventListener('blur', async function () {
            const correo = this.value;
            const correoOriginal = "<?php echo $cliente->correo; ?>";

            if (!correo || !this.checkValidity() || correo === correoOriginal) return;

            try {
                const response = await fetch(`../modelo/modelo.php?opcion=6&correo=${encodeURIComponent(correo)}`);
                const data = await response.json();

                if (data.existe) {
                    this.classList.add('is-invalid');
                    let errorDiv = this.nextElementSibling;
                    if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
                        errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        this.parentNode.appendChild(errorDiv);
                    }
                    errorDiv.textContent = 'Este correo electrónico ya está registrado';
                }
            } catch (error) {
                console.error('Error al validar correo:', error);
            }
        });

        // Validación en tiempo real para documento existente (excepto el actual)
        document.getElementById('numero_documento')?.addEventListener('blur', async function () {
            const doc = this.value;
            const docOriginal = "<?php echo $cliente->numero_documento; ?>";

            if (!doc || !this.checkValidity() || doc === docOriginal) return;

            try {
                const response = await fetch(`../modelo/modelo.php?opcion=7&documento=${encodeURIComponent(doc)}`);
                const data = await response.json();

                if (data.existe) {
                    this.classList.add('is-invalid');
                    let errorDiv = this.nextElementSibling;
                    if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
                        errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        this.parentNode.appendChild(errorDiv);
                    }
                    errorDiv.textContent = 'Este número de documento ya está registrado';
                }
            } catch (error) {
                console.error('Error al validar documento:', error);
            }
        });

        // Función para validar la contraseña y mostrar requisitos
        function validatePassword(password) {
            const lengthReq = document.getElementById('lengthReq');
            const uppercaseReq = document.getElementById('uppercaseReq');
            const numberReq = document.getElementById('numberReq');
            const strengthBar = document.getElementById('passwordStrengthBar');

            // Validar longitud
            const hasLength = password.length === 8;
            lengthReq.querySelector('i').className = hasLength ? 'fas fa-check-circle valid' : 'fas fa-circle invalid';

            // Validar mayúscula
            const hasUppercase = /[A-Z]/.test(password);
            uppercaseReq.querySelector('i').className = hasUppercase ? 'fas fa-check-circle valid' : 'fas fa-circle invalid';

            // Validar número
            const hasNumber = /\d/.test(password);
            numberReq.querySelector('i').className = hasNumber ? 'fas fa-check-circle valid' : 'fas fa-circle invalid';

            // Calcular fortaleza de la contraseña
            let strength = 0;
            if (password.length >= 8) strength += 1;
            if (password.length > 0) strength += 20;
            if (password.length >= 4) strength += 20;
            if (hasUppercase) strength += 30;
            if (hasNumber) strength += 30;

            strengthBar.style.width = strength + '%';
            strengthBar.style.backgroundColor = strength < 50 ? '#dc3545' : strength < 80 ? '#ffc107' : '#28a745';
        }

        // Función para resetear los indicadores de contraseña
        function resetPasswordRequirements() {
            const strengthBar = document.getElementById('passwordStrengthBar');
            strengthBar.style.width = '0%';

            const requirements = document.querySelectorAll('.password-requirements i');
            requirements.forEach(icon => {
                icon.className = 'fas fa-circle invalid';
            });
        }

        // Función para validar un campo individual
        function validateField(field) {
            // Para la contraseña, solo validar si tiene contenido
            if (field.id === 'contra' && field.value.length === 0) {
                field.classList.remove('is-invalid');
                field.classList.remove('is-valid');
                return;
            }

            if (field.checkValidity()) {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
            } else {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
            }
        }

        // Validar todos los campos al enviar el formulario
        document.getElementById('clienteForm')?.addEventListener('submit', async function (e) {
            // Validar todos los campos requeridos
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                validateField(field);
                if (!field.checkValidity()) {
                    isValid = false;
                }
            });

            // Validar contraseña solo si tiene contenido
            const passwordField = document.getElementById('contra');
            if (passwordField.value.length > 0) {
                validateField(passwordField);
                if (!passwordField.checkValidity()) {
                    isValid = false;
                }
            }

            if (!isValid) {
                e.preventDefault();
                e.stopPropagation();
                showToast('Error', 'Por favor complete todos los campos correctamente', 'danger');

                // Mostrar el primer campo no válido
                const firstInvalid = this.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.focus();
                }
                return;
            }

            // Verificar correo y documento existente (excepto los actuales)
            try {
                const correo = document.getElementById('correo').value;
                const correoOriginal = "<?php echo $cliente->correo; ?>";
                const documento = document.getElementById('numero_documento').value;
                const documentoOriginal = "<?php echo $cliente->numero_documento; ?>";

                // Solo verificar si han cambiado
                if (correo !== correoOriginal) {
                    const response = await fetch(`../modelo/modelo.php?opcion=6&correo=${encodeURIComponent(correo)}`);
                    const data = await response.json();

                    if (data.existe) {
                        e.preventDefault();
                        document.getElementById('correo').classList.add('is-invalid');
                        showToast('Error', 'El correo electrónico ya está registrado', 'danger');
                        return;
                    }
                }

                if (documento !== documentoOriginal) {
                    const response = await fetch(`../modelo/modelo.php?opcion=7&documento=${encodeURIComponent(documento)}`);
                    const data = await response.json();

                    if (data.existe) {
                        e.preventDefault();
                        document.getElementById('numero_documento').classList.add('is-invalid');
                        showToast('Error', 'El número de documento ya está registrado', 'danger');
                        return;
                    }
                }

                // Si todo está bien, enviar el formulario
                showToast('Éxito', 'Cliente actualizado correctamente', 'success');

                // Enviar el formulario después de mostrar el mensaje
                setTimeout(() => {
                    this.submit();
                }, 1500);

            } catch (error) {
                showToast('Error', 'Error de conexión: ' + error.message, 'danger');
            }
        });

        // Validar campos cuando pierden el foco
        const formFields = document.querySelectorAll('#clienteForm input, #clienteForm select');
        formFields.forEach(field => {
            field.addEventListener('blur', function () {
                validateField(this);
            });
        });

        // Validar campos numéricos al cargar la página (valores precargados)
        document.addEventListener('DOMContentLoaded', function () {
            const docNumber = document.getElementById('numero_documento');
            if (docNumber && docNumber.value) {
                docNumber.value = docNumber.value.replace(/[^0-9]/g, '');
                if (docNumber.value.length > 10) {
                    docNumber.value = docNumber.value.slice(0, 10);
                }
            }

            const phone = document.getElementById('telefono');
            if (phone && phone.value) {
                phone.value = phone.value.replace(/[^0-9]/g, '');
                if (phone.value.length > 10) {
                    phone.value = phone.value.slice(0, 10);
                }
            }

            // Validar todos los campos precargados
            formFields.forEach(field => {
                validateField(field);
            });
        });
    </script>
</body>

</html>

<?php
?>