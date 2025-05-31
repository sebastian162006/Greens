<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recuperar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="text-center">
    <main class="form-signin m-auto">
        <form id="loginForm" action="modelo/modelo.php?opcion=2" method="post">
            <img src="img/LogoGreen.png" alt="Logo Green Mantenimiento"
                style="height: 90px; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,128,0,0.10); background: #fff; padding: 8px;"
                class="mb-4">
            <h1 class="h3 mb-3 fw-normal">🔑 Recuperar Contraseña</h1>
            <br>
            <h1>Restablecer</h1>


            <div class="form-floating mb-3">
                <input type="email" id="correo" name="correo" class="form-control" placeholder="name@example.com"
                    required>
                <label for="correo">✉ Correo electrónico</label>

                <div class="form-text">Recibirás un correo con instrucciones para restablecer tu contraseña.</div>
                <div id="emailHelp" class="form-text text-danger d-none">Formato de correo inválido
                    Example:"nombredeusuario@dominio.com"</div>

                <a href="./index.php" class="text-decoration-none">Enviar instrucciones</a>
            </div>






            <div id="loginError" class="alert alert-danger mt-3 d-none"></div>

            <p class="mt-5 mb-3 text-muted">© 2017–2025</p>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
    </script>

</body>

</html>