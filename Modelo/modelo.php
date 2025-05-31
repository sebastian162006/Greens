<?php session_start(); ?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/greens/control/control.php';

switch ($_REQUEST['opcion']) {
    case 0:
        $correo = $_POST["correo"];
        $contra = $_POST["contra"];
        Registro::acceso($correo, $contra);
        break;

    case 1: // Insertar nuevo cliente
        $tipo_documento = $_POST["tipo_documento"];
        $numero_documento = $_POST["numero_documento"];
        $nombre1 = $_POST["nombre1"];
        $nombre2 = $_POST["nombre2"] ?? '';
        $apellido1 = $_POST["apellido1"];
        $apellido2 = $_POST["apellido2"] ?? '';
        $telefono = $_POST["telefono"] ?? '';
        $correo = $_POST["correo"] ?? '';
        $contra = $_POST["contra"];
        $estado = $_POST["estado"] ?? 'A';
        $rol = $_POST["rol"];

        // Validar que los campos obligatorios no estén vacíos
        if (empty($numero_documento) || empty($nombre1) || empty($apellido1) || empty($correo) || empty($contra)) {
            die(json_encode(['error' => 'Campos obligatorios faltantes']));
        }

        // Validar formato del correo
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            die(json_encode(['error' => 'Formato de correo inválido']));
        }

        // Validar que el teléfono sea numérico y tenga 7-10 dígitos
        if (!empty($telefono) && !preg_match('/^\d{7,10}$/', $telefono)) {
            die(json_encode(['error' => 'Teléfono debe tener 7-10 dígitos']));
        }

        Cliente::insertar($tipo_documento, $numero_documento, $nombre1, $nombre2, $apellido1, $apellido2, $telefono, $correo, $contra, $estado, $rol);
        break;

    case 2: // Listar todos los clientes
        $arregloClientes = Cliente::listar(2);
        include "../vista/cliente.php";
        break;

    case 3: // Eliminar cliente (soft delete)
        $tipo_documento = $_REQUEST["tipo_documento"];
        $numero_documento = $_REQUEST["numero_documento"];
        Cliente::eliminar($tipo_documento, $numero_documento);
        break;

    case 4: // Obtener datos de cliente para editar
        $tipo_documento = $_REQUEST["tipo_documento"];
        $numero_documento = $_REQUEST["numero_documento"];
        $arregloClientes = Cliente::listar(4, $tipo_documento, $numero_documento);
        include "../vista/clienteEditar.php";
        break;

    case 5: // Actualizar cliente
        $tipo_documento = $_POST["tipo_documento"];
        $numero_documento = $_POST["numero_documento"];
        $nombre1 = $_POST["nombre1"];
        $nombre2 = $_POST["nombre2"] ?? '';
        $apellido1 = $_POST["apellido1"];
        $apellido2 = $_POST["apellido2"] ?? '';
        $telefono = $_POST["telefono"] ?? '';
        $correo = $_POST["correo"] ?? '';
        $contra = $_POST["contra"] ?? '';
        $estado = $_POST["estado"] ?? 'A';
        $tipo_documento_original = $_POST["tipo_documento_original"];
        $numero_documento_original = $_POST["numero_documento_original"];

        Cliente::modificar(
            $tipo_documento,
            $numero_documento,
            $nombre1,
            $nombre2,
            $apellido1,
            $apellido2,
            $telefono,
            $correo,
            $contra,
            $estado,
            $tipo_documento_original,
            $numero_documento_original
        );
        break;

    case 6: // Verificar correo existente
        $correo = $_GET['correo'] ?? '';
        include "../conexion/conexion.php";
        $sentenciaSQL = mysqli_query($conexion, "SELECT correo FROM clientes WHERE correo = '$correo' AND estado = 'A'");
        header('Content-Type: application/json');
        echo json_encode(['existe' => mysqli_num_rows($sentenciaSQL) > 0]);
        break;

    case 7: // Verificar documento existente
        $documento = $_GET['documento'] ?? '';
        include "../conexion/conexion.php";
        $sentenciaSQL = mysqli_query($conexion, "SELECT numero_documento FROM clientes WHERE numero_documento = '$documento' AND estado = 'A'");
        header('Content-Type: application/json');
        echo json_encode(['existe' => mysqli_num_rows($sentenciaSQL) > 0]);
        break;
    case 8: // Insertar nuevo cliente
        $tipo_documento = $_POST["tipo_documento"];
        $numero_documento = $_POST["numero_documento"];
        $nombre1 = $_POST["nombre1"];
        $nombre2 = $_POST["nombre2"] ?? '';
        $apellido1 = $_POST["apellido1"];
        $apellido2 = $_POST["apellido2"] ?? '';
        $telefono = $_POST["telefono"] ?? '';
        $correo = $_POST["correo"] ?? '';
        $contra = $_POST["contra"];
        $estado = $_POST["estado"] ?? 'A';
        $rol = $_POST["rol"];

        // Validar que los campos obligatorios no estén vacíos
        if (empty($numero_documento) || empty($nombre1) || empty($apellido1) || empty($correo) || empty($contra)) {
            die(json_encode(['error' => 'Campos obligatorios faltantes']));
        }

        // Validar formato del correo
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            die(json_encode(['error' => 'Formato de correo inválido']));
        }

        // Validar que el teléfono sea numérico y tenga 7-10 dígitos
        if (!empty($telefono) && !preg_match('/^\d{7,10}$/', $telefono)) {
            die(json_encode(['error' => 'Teléfono debe tener 7-10 dígitos']));
        }

        Cliente::insertarclientes($tipo_documento, $numero_documento, $nombre1, $nombre2, $apellido1, $apellido2, $telefono, $correo, $contra, $estado, $rol);
        break;
}
?>