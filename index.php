<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Mantenimiento - Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <style>
        /* Para que el icono del ojo no tape el texto */
        .form-floating .toggle-password {
            background: transparent;
            border: none;
            box-shadow: none;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .form-floating input[type="password"] {
            padding-right: 2.5rem;
        }
    </style>
</head>

<body class="text-center">
    <main class="form-signin m-auto">
        <div class="text-center mb-4">
            <img src="img/LogoGreen.png" alt="Logo Green Mantenimiento"
                style="height: 90px; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,128,0,0.10); padding: 8px;">
            <h2 class="mt-3" style="font-weight: bold; color: #218838; letter-spacing: 1px;">Green Mantenimiento</h2>
        </div>

        <form id="loginForm" action="modelo/modelo.php?opcion=0" method="post">
            <!-- Correo electrónico -->
            <div class="form-floating mb-3">
                <input type="email" id="correo" name="correo" class="form-control" placeholder="name@example.com"
                    required>
                <label for="correo">Correo electrónico</label>
                <div id="emailHelp" class="form-text text-danger d-none">Formato de correo inválido
                    Example:"nombredeusuario@dominio.com"</div>
            </div>

            <!-- Contraseña -->
            <div class="form-floating mb-3">
                <input type="password" id="contra" name="contra" class="form-control" placeholder="Contraseña" required>
                <label for="contra">Contraseña</label>
                <span class="input-group-text toggle-password"
                    style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); z-index: 2;">
                    <i class="fa fa-eye"></i>
                </span>
                <div id="passwordHelp" class="form-text text-danger d-none">
                    La contraseña debe tener al menos 8 caracteres, una mayúscula y un número
                </div>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Iniciar Sesión</button>

                <a href="./recuperar.php" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
            </div>

            <div class="mt-3">
                <a href="./vista/registro.php" class="btn btn-outline-secondary">Registrarse</a>

            </div>


            <div id="loginError" class="alert alert-danger mt-3 d-none"></div>

            <p class="mt-5 mb-3 text-muted">© 2017–2025</p>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para mostrar/ocultar contraseña
        document.querySelector('.toggle-password').addEventListener('click', function () {
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

        // Validación en tiempo real
        document.getElementById('correo').addEventListener('input', function () {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const helpText = document.getElementById('emailHelp');
            if (!emailRegex.test(this.value)) {
                helpText.classList.remove('d-none');
            } else {
                helpText.classList.add('d-none');
            }
        });

        document.getElementById('contra').addEventListener('input', function () {
            // Limitar a 8 caracteres máximo
            if (this.value.length > 8) {
                this.value = this.value.substring(0, 8);
                return;
            }
            // Validar el formato (al menos 1 mayúscula y 1 número)
            const passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,8}$/;
            const helpText = document.getElementById('passwordHelp');
            if (!passwordRegex.test(this.value)) {
                helpText.classList.remove('d-none');
                helpText.textContent = "La contraseña debe tener exactamente 8 caracteres, incluyendo al menos una mayúscula y un número";
            } else {
                helpText.classList.add('d-none');
            }
        });



    </script>
</body>

</html>