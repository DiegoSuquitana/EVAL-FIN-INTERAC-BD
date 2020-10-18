<?php

require('../server/conector.php');

$ingreso = 1;

if($ingreso == 1)
{
    $data['nombreCompleto'] = "'DIEGO S 1'";
    $data['fechaNacimiento'] = "'1989/05/15'";
    $data['email'] = "'DiegoR1@hotmail.com'";
    $data['psw'] = "'".password_hash("12345",PASSWORD_DEFAULT)."'";

    $con = new ConectorBD('localhost', 't_create_user', '12345');
    $response['conexion'] = $con->initConexion('agenda_db');
    if ($response['conexion'] == 'OK') {
        
        if ($con->insertData('usuario', $data)) {

            echo "exito en la inserción - USUARIO 1";
            $ingreso = 2;

        } else {
            echo "Hubo un error y los datos no han sido cargados";
        }
    } else {
        echo "No se pudo conectar a la base de datos";
    }
}

if($ingreso == 2)
{
    $data['nombreCompleto'] = "'DIEGO R 2'";
    $data['fechaNacimiento'] = "'2011/11/11'";
    $data['email'] = "'DiegoR2@hotmail.com'";
    $data['psw'] = "'" . password_hash("12345", PASSWORD_DEFAULT) . "'";

    $con = new ConectorBD('localhost', 't_create_user', '12345');
    $response['conexion'] = $con->initConexion('agenda_db');

    if ($response['conexion'] == 'OK') {
        if ($con->insertData('usuario', $data)) {

            echo "exito en la inserción  - USUARIO 2";
            $ingreso = 3;

        } else {
            echo "Hubo un error y los datos no han sido cargados";
        }
    } else {
        echo "No se pudo conectar a la base de datos";
    }
}

if($ingreso == 3)
{
    $data['nombreCompleto'] = "'DIEGO G 3'";
    $data['fechaNacimiento'] = "'2020/12/20'";
    $data['email'] = "'DiegoG3@hotmail.com'";
    $data['psw'] = "'" . password_hash("12345", PASSWORD_DEFAULT) . "'";

    $con = new ConectorBD('localhost', 't_create_user', '12345');
    $response['conexion'] = $con->initConexion('agenda_db');

    if ($response['conexion'] == 'OK') {
        if ($con->insertData('usuario', $data)) {

            echo "exito en la inserción  - USUARIO 3";
            $ingreso ++;

        } else {
            echo "Hubo un error y los datos no han sido cargados";
        }
    } else {
        echo "No se pudo conectar a la base de datos";
    }
}

 ?>
