<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"]) || !isset($_SESSION["rol"])) {
    echo "<script> alert('Acceso no autorizado. Por favor inicia sesión.'); window.location.href='../index.php';</script>";
    exit();
}

// Verifica que el usuario sea administrador
if ($_SESSION["rol"] !== 'admin') {
    echo "<script> alert('Acceso denegado. Solo los administradores pueden acceder a esta página.'); window.location.href = 'index.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes - Green</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            padding-top: 60px;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 240px;
            background-color: #198754;
            color: white;
            padding-top: 1rem;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 0.75rem 1rem;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #157347;
        }

        .main-content {
            margin-left: 240px;
            padding: 2rem;
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

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1100;
        }

        .modal-confirm {
            color: #636363;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
            background-color: #f8f9fa;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
        }

        .modal-confirm .icon-box {
            color: #fff;
            position: absolute;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: -70px;
            width: 95px;
            height: 95px;
            border-radius: 50%;
            z-index: 9;
            background: #f44336;
            padding: 15px;
            text-align: center;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        }

        .modal-confirm .icon-box i {
            font-size: 58px;
            position: relative;
            top: 3px;
        }

        .modal-confirm .btn {
            color: #fff;
            border-radius: 4px;
            background: #198754;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            outline: none !important;
        }

        .modal-confirm .btn:hover,
        .modal-confirm .btn:focus {
            background: #157347;
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

    <div class="sidebar">
        <h4 class="text-center mb-4"><i class="fas fa-leaf"></i> Green</h4>
        <a href="#registro"><i class="fas fa-user-plus me-2"></i> Registrar Cliente</a>
        <a href="#listado"><i class="fas fa-list me-2"></i> Ver Clientes</a>
        <a href="../index.php"><i class="fa-solid fa-person-through-window"></i> Salir</a>
    </div>

    <div class="main-content">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-success"><i class="fas fa-users me-2"></i>Gestión de Clientes</h1>
            <p class="lead text-muted">Administra los clientes de Green</p>
        </div>

        <!-- Formulario de Registro -->
        <div class="form-section mb-5" id="registro">
            <h3 class="mb-4 text-success"><i class="fas fa-user-plus me-2"></i>Registrar Cliente</h3>
            <form method="post" action="../modelo/modelo.php?opcion=8" id="clienteForm" novalidate>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="tipo_documento" class="form-label">Tipo Documento <span
                                class="text-danger">*</span></label>
                        <select class="form-select" name="tipo_documento" id="tipo_documento" required>
                            <option value="">Seleccione...</option>
                            <option value="cc">Cédula</option>
                            <option value="ce">Cédula Extranjería</option>
                            <option value="ti">Tarjeta Identidad</option>
                            <option value="pasaporte">Pasaporte</option>
                        </select>
                        <div class="invalid-feedback">Por favor seleccione un tipo de documento</div>
                    </div>
                    <div class="col-md-3">
                        <label for="numero_documento" class="form-label">Número Documento <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="numero_documento" id="numero_documento"
                            maxlength="10" pattern="\d{1,10}" required>
                        <div class="invalid-feedback">El número de documento debe contener solo números (máximo 10
                            dígitos)</div>
                    </div>
                    <div class="col-md-3">
                        <label for="nombre1" class="form-label">Primer Nombre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nombre1" id="nombre1"
                            pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" maxlength="50" required>
                        <div class="invalid-feedback">Por favor ingrese un primer nombre válido (solo letras, máximo 50
                            caracteres)</div>
                    </div>
                    <div class="col-md-3">
                        <label for="nombre2" class="form-label">Segundo Nombre</label>
                        <input type="text" class="form-control" name="nombre2" id="nombre2"
                            pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]*" maxlength="50">
                        <div class="invalid-feedback">Por favor ingrese solo letras (máximo 50 caracteres)</div>
                    </div>
                    <div class="col-md-3">
                        <label for="apellido1" class="form-label">Primer Apellido <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="apellido1" id="apellido1"
                            pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" maxlength="50" required>
                        <div class="invalid-feedback">Por favor ingrese un primer apellido válido (solo letras, máximo
                            50 caracteres)</div>
                    </div>
                    <div class="col-md-3">
                        <label for="apellido2" class="form-label">Segundo Apellido</label>
                        <input type="text" class="form-control" name="apellido2" id="apellido2"
                            pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]*" maxlength="50">
                        <div class="invalid-feedback">Por favor ingrese solo letras (máximo 50 caracteres)</div>
                    </div>
                    <div class="col-md-3">
                        <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="telefono" id="telefono" maxlength="10"
                            pattern="\d{7,10}" required>
                        <div class="invalid-feedback">El teléfono debe contener solo números (7-10 dígitos)</div>
                    </div>
                    <div class="col-md-3">
                        <label for="correo" class="form-label">Correo Electrónico <span
                                class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="correo" id="correo"
                            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" maxlength="100" required>
                        <div class="invalid-feedback">Por favor ingrese un correo válido (ejemplo: usuario@dominio.com,
                            máximo 100 caracteres)</div>
                    </div>
                    <div class="col-md-3">
                        <label for="contra" class="form-label">Contraseña <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="contra" id="contra"
                                pattern="^(?=.*[A-Z])(?=.*\d).{8}$" required>
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
                                <span>8 caracteres</span>
                            </div>
                            <div class="requirement" id="uppercaseReq">
                                <i class="fas fa-circle"></i>
                                <span>1 mayúscula</span>
                            </div>
                            <div class="requirement" id="numberReq">
                                <i class="fas fa-circle"></i>
                                <span>1 número</span>
                            </div>
                        </div>
                        <div class="invalid-feedback">La contraseña debe tener exactamente 8 caracteres, incluyendo al
                            menos una mayúscula y un número</div>
                    </div>
                    <div class="col-md-3">
                        <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                        <select class="form-select" name="estado" id="estado" required>
                            <option value="A" selected>Activo</option>
                            <option value="I">Inactivo</option>
                        </select>
                    </div>
                    <input type="text" name="rol" id="rol" value="usuario" hidden>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-3 px-4">
                        <i class="fas fa-save me-2"></i>Guardar
                    </button>
                    <button type="reset" class="btn btn-outline-secondary px-4" id="resetBtn">
                        <i class="fas fa-eraser me-2"></i>Limpiar
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabla de Clientes -->
        <div class="card shadow" id="listado">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="fas fa-list me-2"></i>Listado de Clientes</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Documento</th>
                                <th>Nombre Completo</th>
                                <th>Contacto</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($arregloClientes as $cliente) { ?>
                                <tr>
                                    <td>
                                        <span
                                            class="text-muted text-uppercase small"><?php echo $cliente->tipo_documento; ?></span><br>
                                        <strong><?php echo $cliente->numero_documento; ?></strong>
                                    </td>
                                    <td>
                                        <?php echo $cliente->nombre1 . ' ' . ($cliente->nombre2 ? $cliente->nombre2 . ' ' : '') .
                                            $cliente->apellido1 . ' ' . ($cliente->apellido2 ? $cliente->apellido2 : ''); ?>
                                    </td>
                                    <td>
                                        <?php if ($cliente->telefono) { ?>
                                            <i class="fas fa-phone me-2 text-muted"></i><?php echo $cliente->telefono; ?><br>
                                        <?php } ?>
                                        <?php if ($cliente->correo) { ?>
                                            <i class="fas fa-envelope me-2 text-muted"></i><?php echo $cliente->correo; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <span
                                            class="<?php echo $cliente->estado == 'A' ? 'text-success' : 'text-danger'; ?>">
                                            <?php echo $cliente->estado == 'A' ? 'Activo' : 'Inactivo'; ?>
                                        </span>
                                        <?php if ($cliente->estado == 'I'): ?>
                                            <br><small class="text-muted">(Inactivo)</small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="../modelo/modelo.php?opcion=4&tipo_documento=<?php echo $cliente->tipo_documento; ?>&numero_documento=<?php echo $cliente->numero_documento; ?>"
                                                class="btn btn-sm btn-outline-primary me-2" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="../modelo/modelo.php?opcion=3&tipo_documento=<?php echo $cliente->tipo_documento; ?>&numero_documento=<?php echo $cliente->numero_documento; ?>"
                                                class="btn btn-sm btn-outline-danger btn-inactivar" title="Inactivar">
                                                <i class="fas fa-user-slash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación para Inactivar -->
    <div class="modal fade" id="confirmInactivateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Confirmar Inactivación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="inactivateMessage"></p>
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        El cliente ya no podrá acceder al sistema pero su información se mantendrá.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning text-white"
                        id="confirmInactivateBtn">Inactivar</button>
                </div>
            </div>
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

        // Validación en tiempo real para correo existente
        document.getElementById('correo')?.addEventListener('blur', async function () {
            const correo = this.value;
            if (!correo || !this.checkValidity()) return;

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

        // Validación en tiempo real para documento existente
        document.getElementById('numero_documento')?.addEventListener('blur', async function () {
            const doc = this.value;
            if (!doc || !this.checkValidity()) return;

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
            const passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,8}$/;

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
            if (password.length > 0) strength += 20;
            if (password.length >= 4) strength += 20;
            if (hasUppercase) strength += 30;
            if (hasNumber) strength += 30;

            strengthBar.style.width = strength + '%';
            strengthBar.style.backgroundColor = strength < 50 ? '#dc3545' : strength < 80 ? '#ffc107' : '#28a745';
        }

        // Función para validar un campo individual
        function validateField(field) {
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

            // Verificar correo y documento existente antes de enviar
            try {
                const correo = document.getElementById('correo').value;
                const documento = document.getElementById('numero_documento').value;

                const [correoResponse, docResponse] = await Promise.all([
                    fetch(`../modelo/modelo.php?opcion=6&correo=${encodeURIComponent(correo)}`),
                    fetch(`../modelo/modelo.php?opcion=7&documento=${encodeURIComponent(documento)}`)
                ]);

                const [correoData, docData] = await Promise.all([
                    correoResponse.json(),
                    docResponse.json()
                ]);

                if (correoData.existe || docData.existe) {
                    e.preventDefault();
                    if (correoData.existe) {
                        document.getElementById('correo').classList.add('is-invalid');
                        showToast('Error', 'El correo electrónico ya está registrado', 'danger');
                    }
                    if (docData.existe) {
                        document.getElementById('numero_documento').classList.add('is-invalid');
                        showToast('Error', 'El número de documento ya está registrado', 'danger');
                    }
                    return;
                }

                // Si todo está bien, enviar el formulario
                const formData = new FormData(this);
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData
                });

                if (response.redirected) {
                    showToast('Éxito', 'Cliente guardado correctamente', 'success');
                    setTimeout(() => {
                        window.location.href = response.url;
                    }, 1500);
                } else {
                    const result = await response.text();
                    showToast('Error', 'Error al guardar el cliente: ' + result, 'danger');
                }
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

        // Restablecer estilos de validación al limpiar el formulario
        document.getElementById('resetBtn')?.addEventListener('click', function () {
            const form = document.getElementById('clienteForm');
            form.querySelectorAll('.is-invalid, .is-valid').forEach(el => {
                el.classList.remove('is-invalid', 'is-valid');
            });

            // Restablecer indicadores de contraseña
            document.getElementById('passwordStrengthBar').style.width = '0%';
            const requirements = document.querySelectorAll('.password-requirements i');
            requirements.forEach(icon => {
                icon.className = 'fas fa-circle invalid';
            });
        });

        // Configurar modal de confirmación para inactivar clientes
        const confirmModal = new bootstrap.Modal(document.getElementById('confirmInactivateModal'));
        let currentInactivateUrl = '';

        document.querySelectorAll('.btn-inactivar').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const row = this.closest('tr');
                const nombreCliente = row.querySelector('td:nth-child(2)').textContent.trim();
                const estadoCliente = row.querySelector('td:nth-child(4) span').textContent.trim();
                currentInactivateUrl = this.getAttribute('href');

                if (estadoCliente === 'Inactivo') {
                    showToast('Información', 'Este cliente ya se encuentra inactivo', 'info');
                    return;
                }

                document.getElementById('inactivateMessage').textContent =
                    `¿Está seguro que desea inactivar al cliente ${nombreCliente}?`;
                confirmModal.show();
            });
        });

        document.getElementById('confirmInactivateBtn').addEventListener('click', function () {
            window.location.href = currentInactivateUrl;
            confirmModal.hide();
        });

        // Validar campos numéricos al cargar la página (por si hay valores precargados)
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

            // Validar contraseña si hay valor precargado
            const password = document.getElementById('contra');
            if (password && password.value) {
                validatePassword(password.value);
            }
        });
    </script>
</body>

</html>