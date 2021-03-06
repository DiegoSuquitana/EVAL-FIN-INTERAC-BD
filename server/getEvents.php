<?php
require('./conector.php');

session_start();


if (isset($_SESSION['username'])) {

    $con = new ConectorBD('localhost', 'root', '');
  if ($con->initConexion('agenda_db')=='OK') {
    $resultado = $con->consultar(['evento'], ['*'], "WHERE fk_usuario ='".$_SESSION['id']."'"); 
    $i=0;
    while ($fila = $resultado->fetch_assoc()) { 
      $response['eventos'][$i]['id']=$fila['id'];
      $response['eventos'][$i]['fk_usuario']=$fila['fk_usuario'];
      $response['eventos'][$i]['title']=$fila['titulo'];
      $response['eventos'][$i]['start']=$fila['fechaInicio']."T".$fila['horaInicio'];
      $response['eventos'][$i]['end']=$fila['fechaFinalizacion']."T".$fila['horaFinalizacion'];
      $response['eventos'][$i]['allDay']=$fila['diaCompleto'];
      $response['eventos'][$i]['horaInicio']=$fila['horaInicio'];
      $response['eventos'][$i]['horaFinalizacion']=$fila['horaFinalizacion'];
    $i++;
    }
    $response['msg'] = "OK";
  } else {
     $response['msg'] = "No se pudo conectar a la Base de Datos";
  }
}  else {
   $response['msg'] = "No se ha iniciado una sesión";
}

  echo json_encode($response);

  
 ?>

