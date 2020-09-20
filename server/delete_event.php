<?php

include('./conector.php');

session_start();

if (isset($_SESSION['username'])) {

	$data['id'] = $_POST['id'];
	$query = 'id = '.$data['id'];

	$response['query'] = $query; 

  $con = new ConectorBD('localhost', 't_delete_event', '12345');
  if ($con->initConexion('agenda_db')=='OK') {
  	if ($con->eliminarRegistro('evento', $query )) { 
        $response['msg']= 'OK';
    }else {
        $response['msg']= 'No se pudo realizar el borrado de los datos';
    }
  }  
}
else {
 $response['msg'] = "No se ha iniciado una sesión";
}


  echo json_encode($response);
  

 ?>
