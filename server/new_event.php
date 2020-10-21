<?php
  
  require('./conector.php');

  session_start();

  if (isset($_SESSION['username'])) {
    $con = new ConectorBD('localhost', 'root', '');
    if ($con->initConexion('agenda_db')=='OK') {
      $data['titulo'] = "'".$_POST['titulo']."'";
      $data['fechaInicio'] = "'".$_POST['start_date']."'";
     
      if($_POST["allDay"]=="true"){    
        $allDay  = 1; 
        $data['horaInicio'] = "'5:00:00'";
        $data['fechaFinalizacion'] = "'".$_POST['start_date']."'";  
        $data['horaFinalizacion'] = "'23:30:00'";  
        $data['diaCompleto'] = "'".$allDay."'";
        
      }else{
        $allDay = 0;
        $data['horaInicio'] = "'".$_POST['start_hour']."'";
        $data['fechaFinalizacion'] = "'".$_POST['end_date']."'";    
        $data['horaFinalizacion'] = "'".$_POST['end_hour']."'";
        $data['diaCompleto'] = "'".$allDay."'";
        
      }
      
      $data['fk_usuario'] = "'".$_SESSION['id']."'";      
      
      if ($con->insertData('evento', $data)) {
        $response['msg']= 'OK';
      }else {
        $response['msg']= 'No se pudo realizar la inserción de los datos';
      }
    }else {
      $response['msg']= 'No se pudo conectar a la base de datos';
    }
  }else {
    $response['msg']= 'No se ha iniciado una sesión';
  }

  //echo json_encode($data); //validar los datos que estoy enviado
  echo json_encode($response);

 ?>
