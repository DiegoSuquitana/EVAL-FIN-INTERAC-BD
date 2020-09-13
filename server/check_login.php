<?php

require('./getEvents.php');

$con = new ConectorBD('localhost','t_general','12345');

$response['conexion'] = $con->initConexion('agenda_db');

if ($response['conexion']=='OK') {
  $resultado_consulta = $con->consultar(['usuario'],
  ['email', 'psw'], 'WHERE email="'.$_POST['username'].'"');

  if ($resultado_consulta->num_rows != 0) {
    $fila = $resultado_consulta->fetch_assoc();
    if (password_verify($_POST['password'], $fila['psw'])) {
      $response['acceso'] = 'concedido';
      session_start();
      $_SESSION['username']=$fila['email'];
    }else {
      $response['motivo'] = 'Contraseña incorrecta';
      $response['acceso'] = 'rechazado';
    }
  }else{
    $response['motivo'] = 'Email incorrecto';
    $response['acceso'] = 'rechazado';
  }
}

echo json_encode($response);

$con->cerrarConexion();

?>
