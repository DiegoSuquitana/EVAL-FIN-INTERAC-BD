<?php

require('./conector.php');

$data['nombreCompleto'] = "'" . $_POST['nombre'] . "'";
$data['fechaNacimiento'] = "'" . $_POST['fechaNacimiento'] . "'";
$data['email'] = "'" . $_POST['email'] . "'";
$data['psw'] = "'" . password_hash($_POST['contrasena'], PASSWORD_DEFAULT) . "'";

$con = new ConectorBD('localhost', 't_create_user', '12345');
$response['conexion'] = $con->initConexion('agenda_db');

if ($response['conexion'] == 'OK') {
    if ($con->insertData('usuario', $data)) {

        $resultado_consulta = $con->consultar(['usuario'],
        ['email', 'psw', 'id'], 'WHERE email="'.$_POST['email'].'"');

        if ($resultado_consulta->num_rows != 0) {
            $fila = $resultado_consulta->fetch_assoc();
            if (password_verify($_POST['contrasena'], $fila['psw'])) {
            $response['acceso'] = 'concedido';
            session_start();
            $_SESSION['username']=$fila['email'];
            $_SESSION['id']=$fila['id'];
            }else {
            $response['motivo'] = 'Contraseña incorrecta';
            $response['acceso'] = 'rechazado';
            }
        }else{
            $response['motivo'] = 'Email incorrecto';
            $response['acceso'] = 'rechazado';
        }

        $response['msg'] = "exito en la inserción";

    } else {
        $response['msg'] = "Hubo un error y los datos no han sido cargados";
    }
} else {
    $response['msg'] = "No se pudo conectar a la base de datos";
}

echo json_encode($response);



 ?>
