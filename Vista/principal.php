<?php
// Inicia la sesión para verificar si el usuario ha iniciado sesión
@session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Menu Principal</title>
</head>

<body>
	<?php
	// Verifica si la sesión del usuario está activa
	if (isset($_SESSION["user"])) {
		// Si el usuario está autenticado, incluye el menú principal
		?>
		<br>
		<br>
		<br>
		<?php include '../vista/menu.php'; ?>
	<?php
	} else {
		// Si no hay sesión activa, muestra un mensaje de error y redirige al usuario al inicio de sesión
		echo "<script> alert('ingreso incorrecto');window.location.href='../index.php';</script>";
	}
	?>
</body>

</html>