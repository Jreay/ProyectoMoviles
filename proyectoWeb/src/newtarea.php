<?php
include ("conexion.php");

$agente=$_POST["usuarios"];
$codvivienda = $_POST["codvivienda"];
$direccion = $_POST["direccion"];
$mz = $_POST ["mz"];
$villa = $_POST["villa"];
$fecha = $_POST["fecha"];


$insertar = "INSERT INTO  actividades (agente, codvivienda, direccion, mz, villa, fecha) VALUES 
('$agente','$codvivienda', '$direccion', '$mz', '$villa', '$fecha')";

$resultado = mysqli_query($conexion, $insertar);

if ($resultado){
    echo '<script>';
    echo 'alert("Tarea Registrada!");';
    echo 'window.location.href="../registro.php";';
    echo '</script>';
    
    
}
?>
