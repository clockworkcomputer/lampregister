<?php
    $host = "IPCONTENEDORMYSQL";
    $usuario = "root";
    $contrasena = "Cursos1";
    $db = "concesionario";
    $con = new mysqli($host,$usuario,$contrasena,$db);

    if($con->connect_errno){
        die('CONEXIÓN FALLIDA '.$con->connect_error);
    }

    echo "CONEXIÓN EXITOSA";
?>
