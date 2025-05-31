<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Green Mantenimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/registro.css">
    <style>
        .valid-feedback,
        .invalid-feedback {
            display: none;
        }

        .was-validated .form-control:valid~.valid-feedback,
        .form-control.is-valid~.valid-feedback,
        .was-validated .form-control:invalid~.invalid-feedback,
        .form-control.is-invalid~.invalid-feedback {
            display: block;
        }

        .password-strength {
            height: 5px;
            margin-top: 5px;
            background-color: #e9ecef;
            border-radius: 3px;
        }

        .password-strength-bar {
            height: 100%;
            border-radius: 3px;
            transition: width 0.3s;
        }
    </style>
</head>

<body>
    <div class="container">
        <main>
            <div class="text-center">
                <img class="mb-4" src="../img/LogoGreen.png" alt="Logo de Green" width="100" height="97">
                <h2>Registro</h2>
                <p class="lead">Bienvenido a Green Mantenimiento.</p>
            </div>

            <div class="col-md-7 col-lg-8 mx-auto">
                <form class="needs-validation" action="../modelo/modelo.php?opcion=1" method="post" novalidate>
                    <div class="row g-3">

                        <!-- Tipo Documento -->
                        <div class="col-md-6">
                            <label for="tipo_documento" class="form-label">*Tipo Documento</label>
                            <select class="form-select" name="tipo_documento" id="tipo_documento" required>
                                <option value="">Seleccione...</option>
                                <option value="CC">C.C</option>
                                <option value="TI">T.I</option>
                                <option value="CE">C.E</option>
                                <option value="PA">P.A</option>
                            </select>
                            <div class="invalid-feedback">
                                Selecciona un tipo de documento válido.
                            </div>
                        </div>

                        <!-- Número de Documento -->
                        <div class="col-6">
                            <label for="numero_documento" class="form-label">*Número de documento</label>
                            <input type="text" name="numero_documento" id="numero_documento" class="form-control"
                                placeholder="numero de documento" required pattern="[0-9]{7,10}" maxlength="10">
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                                El documento debe tener entre 7 y 10 dígitos numéricos.
                            </div>
                        </div>

                        <!-- Nombre 1 -->
                        <div class="col-sm-6">
                            <label for="nombre1" class="form-label">*Primer Nombre</label>
                            <input type="text" class="form-control" name="nombre1" id="nombre1"
                                placeholder="Primer Nombre" required pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+">
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Solo se permiten letras y espacios.
                            </div>
                        </div>

                        <!-- Nombre 2 -->
                        <div class="col-sm-6">
                            <label for="nombre2" class="form-label">Segundo Nombre</label>
                            <input type="text" class="form-control" id="nombre2" name="nombre2"
                                placeholder="Segundo nombre (opcional)" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]*">
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Solo se permiten letras y espacios.
                            </div>
                        </div>

                        <!-- Apellido 1 -->
                        <div class="col-sm-6">
                            <label for="apellido1" class="form-label">*Primer Apellido</label>
                            <input type="text" class="form-control" id="apellido1" name="apellido1"
                                placeholder="Primer apellido" required pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+">
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Solo se permiten letras y espacios.
                            </div>
                        </div>

                        <!-- Apellido 2 -->
                        <div class="col-sm-6">
                            <label for="apellido2" class="form-label">*Segundo Apellido</label>
                            <input type="text" class="form-control" id="apellido2" name="apellido2"
                                placeholder="Segundo apellido" required pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+">
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Solo se permiten letras y espacios.
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="col-12">
                            <label for="telefono" class="form-label">*Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono"
                                placeholder="3001234567" required pattern="[0-9]{10}" maxlength="10">
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">
                                El teléfono debe tener exactamente 10 dígitos numéricos.
                            </div>
                        </div>

                        <!-- Correo -->
                        <div class="col-12">
                            <label for="correo" class="form-label">*Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo"
                                placeholder="tucorreo@ejemplo.com" required
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                            <div class="valid-feedback">
                                ¡Correo válido!
                            </div>
                            <div class="invalid-feedback">
                                Por favor ingresa un correo electrónico válido (ejemplo@dominio.com).
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="col-12">
                            <label for="contra" class="form-label">*Contraseña</label>
                            <input type="password" class="form-control" id="contra" name="contra" required minlength="8"
                                maxlength="8" pattern="^(?=.*[A-Z])(?=.*\d)[A-Za-z\d$%&!?@#*+.-]{8}$">
                            <div class="password-strength mt-2">
                                <div class="password-strength-bar" id="password-strength-bar"></div>
                            </div>
                            <div class="valid-feedback">
                                ¡Contraseña segura! (8 caracteres con mayúscula, número y puede incluir caracteres
                                especiales)
                            </div>
                            <div class="invalid-feedback">
                                La contraseña debe tener exactamente 8 caracteres, incluyendo al menos 1 mayúscula y 1
                                número. Puede contener caracteres especiales ($%&!?@#*+.-).
                            </div>
                            <small class="form-text text-muted">
                                Requisitos: Exactamente 8 caracteres, 1 mayúscula, 1 número y puede incluir caracteres
                                especiales ($%&!?@#*+.-).
                            </small>
                        </div>
                        <input type="text" name="rol" id="rol" value="usuario" hidden>

                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="../index.php" class="btn btn-secondary btn-lg">Regresar</a>
                        <button class="btn btn-primary btn-lg" type="submit">Registrarse</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <footer class="my-4 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2017–2022 Green Mantenimiento</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Validación en tiempo real para todos los campos
            const inputs = document.querySelectorAll('input, select');

            inputs.forEach(input => {
                // Validar al perder el foco
                input.addEventListener('blur', function () {
                    validateField(this);
                });

                // Validar mientras se escribe (para algunos campos)
                if (input.type !== 'select-one') {
                    input.addEventListener('input', function () {
                        // Validación especial para campos numéricos
                        if (this.id === 'numero_documento' || this.id === 'telefono') {
                            this.value = this.value.replace(/\D/g, '');
                            if (this.value.length > 10) {
                                this.value = this.value.substring(0, 10);
                            }
                        }

                        // Validación especial para nombres y apellidos
                        if (['nombre1', 'nombre2', 'apellido1', 'apellido2'].includes(this.id)) {
                            this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚñÑ\s]/g, '');
                        }

                        // Validación especial para contraseña
                        if (this.id === 'contra') {
                            if (this.value.length > 8) {
                                this.value = this.value.substring(0, 8);
                            }
                            updatePasswordStrength(this.value);
                        }

                        validateField(this);
                    });
                }
            });

            // Función para validar un campo
            function validateField(field) {
                if (field.checkValidity()) {
                    field.classList.remove('is-invalid');
                    field.classList.add('is-valid');
                } else {
                    field.classList.remove('is-valid');
                    field.classList.add('is-invalid');
                }
            }

            // Función para medir la fortaleza de la contraseña
            function updatePasswordStrength(password) {
                const strengthBar = document.getElementById('password-strength-bar');
                let strength = 0;

                // Longitud exacta
                if (password.length === 8) strength += 50;

                // Contiene mayúscula
                if (/[A-Z]/.test(password)) strength += 25;

                // Contiene número
                if (/\d/.test(password)) strength += 25;

                // Actualizar barra de progreso
                strengthBar.style.width = strength + '%';

                // Cambiar color según fortaleza
                if (strength < 50) {
                    strengthBar.style.backgroundColor = '#dc3545'; // Rojo
                } else if (strength < 100) {
                    strengthBar.style.backgroundColor = '#ffc107'; // Amarillo
                } else {
                    strengthBar.style.backgroundColor = '#28a745'; // Verde
                }
            }

            // Validar formulario al enviar
            const form = document.querySelector('form');
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();

                    // Forzar validación de todos los campos
                    inputs.forEach(input => {
                        validateField(input);
                    });
                }

                form.classList.add('was-validated');
            }, false);
        });
    </script>
</body>

</html>