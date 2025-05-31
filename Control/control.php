<?php
class Registro
{
    public static function acceso($correo, $contra)
    {
        include '../conexion/conexion.php';
        $sentenciaSQL = mysqli_query($conexion, "SELECT correo, contra, rol FROM clientes 
            WHERE correo = '$correo' AND contra = sha1('$contra') AND estado = 'A'");

        if (mysqli_num_rows($sentenciaSQL) == 0) {
            echo "<script> alert('Usuario y/o contraseña incorrectos'); history.back(); </script>";
        } else {
            $user = mysqli_fetch_assoc($sentenciaSQL);

            $_SESSION["user"] = $correo;
            $_SESSION["rol"] = $user["rol"];

            // Redirige según el rol
            if ($user["rol"] === 'admin') {
                echo "<script> window.location.href='../modelo/modelo.php?opcion=2'; </script>";
            } else {
                echo "<script> window.location.href='../Vista/principal.php'; </script>";
            }
        }
        mysqli_close($conexion);
    }
}

class Cliente
{
    function __construct($tipo_documento, $numero_documento, $nombre1, $nombre2, $apellido1, $apellido2, $telefono, $correo, $contra, $estado, $rol)
    {
        $this->tipo_documento = $tipo_documento;
        $this->numero_documento = $numero_documento;
        $this->nombre1 = $nombre1;
        $this->nombre2 = $nombre2;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->contra = $contra;
        $this->estado = $estado;
        $this->rol = $rol;
    }

    public static function insertar($tipo_documento, $numero_documento, $nombre1, $nombre2, $apellido1, $apellido2, $telefono, $correo, $contra, $estado, $rol)
    {
        include "../conexion/conexion.php";

        // Verificar si el cliente ya existe
        $sentenciaSQL = mysqli_query($conexion, "SELECT numero_documento FROM clientes WHERE numero_documento = '$numero_documento' AND estado = 'A'");
        $totalFilas = mysqli_num_rows($sentenciaSQL);

        if ($totalFilas == 0) {
            // Hashear la contraseña antes de almacenarla
            $contra_hashed = sha1($contra);

            $sentenciaSQL = mysqli_query(
                $conexion,
                "INSERT INTO clientes (tipo_documento, numero_documento, nombre1, nombre2, apellido1, apellido2, telefono, correo, contra, estado, rol) 
                 VALUES ('$tipo_documento', '$numero_documento', '$nombre1', '$nombre2', '$apellido1', '$apellido2', '$telefono', '$correo', '$contra_hashed', '$estado', '$rol')"
            );

            if ($sentenciaSQL) {
                echo "<script> window.location.href='../index.php'; </script>";
                exit();
            } else {
                echo "<script>alert('Error al registrar el cliente: " . mysqli_error($conexion) . "');
                history.back();</script>";
            }
        } else {
            echo "<script>alert('Ya existe un cliente con este número de documento');
            history.back();</script>";
        }
    }
    public static function insertarclientes($tipo_documento, $numero_documento, $nombre1, $nombre2, $apellido1, $apellido2, $telefono, $correo, $contra, $estado, $rol)
    {
        include "../conexion/conexion.php";

        // Verificar si el cliente ya existe
        $sentenciaSQL = mysqli_query($conexion, "SELECT numero_documento FROM clientes WHERE numero_documento = '$numero_documento' AND estado = 'A'");
        $totalFilas = mysqli_num_rows($sentenciaSQL);

        if ($totalFilas == 0) {
            $contra_hashed = sha1($contra);

            $sentenciaSQL = mysqli_query(
                $conexion,
                "INSERT INTO clientes (tipo_documento, numero_documento, nombre1, nombre2, apellido1, apellido2, telefono, correo, contra, estado, rol) 
                 VALUES ('$tipo_documento', '$numero_documento', '$nombre1', '$nombre2', '$apellido1', '$apellido2', '$telefono', '$correo', '$contra_hashed', '$estado', '$rol')"
            );

            if ($sentenciaSQL) {
                echo "<script> window.location.href='../modelo/modelo.php?opcion=2'; </script>";
                exit();
            } else {
                echo "<script>alert('Error al registrar el cliente: " . mysqli_error($conexion) . "');
                history.back();</script>";
            }
        } else {
            echo "<script>alert('Ya existe un cliente con este número de documento');
            history.back();</script>";
        }
    }

    public static function listar($opcion, $tipo_documento = '', $numero_documento = '')
    {
        $arregloClientes = array();
        include "../conexion/conexion.php";

        if ($opcion == 2) {
            // Listar todos los clientes (activos e inactivos)
            $sentenciaSQL = mysqli_query($conexion, "SELECT * FROM clientes");
        } else if ($opcion == 4) {
            // Listar un cliente específico para editar
            $sentenciaSQL = mysqli_query(
                $conexion,
                "SELECT * FROM clientes 
                 WHERE tipo_documento = '$tipo_documento' AND numero_documento = '$numero_documento'"
            );
        }

        $totalFilas = mysqli_num_rows($sentenciaSQL);
        for ($i = 0; $i < $totalFilas; $i++) {
            $datos = mysqli_fetch_array($sentenciaSQL);
            array_push($arregloClientes, Cliente::mostrar($datos));
        }
        return $arregloClientes;
    }

    public static function mostrar($datos)
    {
        return new Cliente(
            $datos["tipo_documento"],
            $datos["numero_documento"],
            $datos["nombre1"],
            $datos["nombre2"] ?? '',
            $datos["apellido1"],
            $datos["apellido2"] ?? '',
            $datos["telefono"] ?? '',
            $datos["correo"] ?? '',
            $datos["contra"],
            $datos["estado"],
            $datos["rol"]
        );
    }

    public static function eliminar($tipo_documento, $numero_documento)
    {
        include "../conexion/conexion.php";

        // Actualización suave (soft delete)
        $sentenciaSQL = mysqli_query(
            $conexion,
            "UPDATE clientes SET estado = 'I' 
             WHERE tipo_documento = '$tipo_documento' AND numero_documento = '$numero_documento'"
        );

        $totalFilas = mysqli_affected_rows($conexion);
        if ($totalFilas == 0) {
            echo "<script>alert('No se eliminó el registro.');
            history.back();</script>";
        } else {
            header("Location: ../modelo/modelo.php?opcion=2");
            exit();
        }
    }

    public static function modificar($tipo_documento, $numero_documento, $nombre1, $nombre2, $apellido1, $apellido2, $telefono, $correo, $contra, $estado, $tipo_documento_original, $numero_documento_original)
    {
        include "../conexion/conexion.php";

        // Verificar si se cambió el documento y si el nuevo ya existe
        if ($tipo_documento != $tipo_documento_original || $numero_documento != $numero_documento_original) {
            $checkSQL = mysqli_query($conexion, "SELECT numero_documento FROM clientes WHERE tipo_documento = '$tipo_documento' AND numero_documento = '$numero_documento' AND estado = 'A'");
            if (mysqli_num_rows($checkSQL) > 0) {
                echo "<script>alert('Ya existe un cliente con este número de documento');
                history.back();</script>";
                return;
            }
        }

        // Hashear la nueva contraseña si se proporcionó
        $contra_update = "";
        if (!empty($contra)) {
            $contra_hashed = sha1($contra);
            $contra_update = ", contra = '$contra_hashed'";
        }

        $sentenciaSQL = mysqli_query(
            $conexion,
            "UPDATE clientes SET 
                tipo_documento = '$tipo_documento',
                numero_documento = '$numero_documento',
                nombre1 = '$nombre1',
                nombre2 = '$nombre2',
                apellido1 = '$apellido1',
                apellido2 = '$apellido2',
                telefono = '$telefono',
                correo = '$correo',
                estado = '$estado'
                $contra_update
             WHERE tipo_documento = '$tipo_documento_original' AND numero_documento = '$numero_documento_original'"
        );

        $totalFilas = mysqli_affected_rows($conexion);

        header("Location: ../modelo/modelo.php?opcion=2");
        exit();

    }
}
?>