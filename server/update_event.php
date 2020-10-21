<?php
 
 include('./conector.php');

 session_start();
 
 if (isset($_SESSION['username'])) {
 
     $data['fk_usuario'] = "'".$_SESSION['id']."'";
     $data['fechaInicio'] = "'".$_POST['start_date']."'";
     $data['fechaFinalizacion'] = "'".$_POST['end_date']."'";
     $data['horaInicio'] = "'".$_POST['start_hour']."'";
     $data['horaFinalizacion'] = "'".$_POST['end_hour']."'";
 
   $data['id'] = $_POST['id'];
   $query = 'id = '.$data['id'];
   $response['query'] = $query;
 
   $con = new ConectorBD('localhost', 'root', '');
   if ($con->initConexion('agenda_db')=='OK') {
       if ($con->actualizarRegistro('evento', $data, $query)) { 
         $response['msg']= 'OK';
     }else {
         $response['msg']= 'No se pudo realizar la inserción de los datos';
     }
   }  
 }
 else {
  $response['msg'] = "No se ha iniciado una sesión";
 }
 
 
   echo json_encode($response);
   //echo json_encode($data); //validar los datos que estoy enviado



 ?>
