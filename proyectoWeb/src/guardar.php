<?php
include ("./conexion.php");

$objetos =  json_decode($_POST["json"], true);

foreach($objetos['data'] as $objeto){
    $usuario= $objeto["usuario"];
    $codvivienda= $objeto["codvivienda"];
    $direccion= $objeto["direccion"];
    $mz= $objeto["mz"];
    $fecha= $objeto["fecha"];
    $villa= $objeto["villa"];

    $insertar = "INSERT INTO  actividades (agente,codvivienda, direccion, mz, villa, fecha) VALUES 
    ('$usuario', '$codvivienda', '$direccion', '$mz', '$villa', '$fecha')";
    //var_dump($objeto);

    
    
}
$verificarcodigo = mysqli_query($conexion, "SELECT * FROM actividades where codvivienda = '$codvivienda'");


if (mysqli_num_rows($verificarcodigo) > 0){
    $mensaje = "El codigo ya tiene una tarea asignada";
    echo $mensaje;
    exit();
}else{
    $recibido = "Tarea asignada";
    echo $recibido;
    $resultado = mysqli_query($conexion,$insertar);
    
}

?>