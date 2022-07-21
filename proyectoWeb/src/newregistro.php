<?php

use function PHPSTORM_META\type;

include ("conexion.php");

$direccion = $_POST["direccion"];
$mz = $_POST ["mz"];
$villa = $_POST["villa"];
$fecha = $_POST["fecha"];
$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
$typeImage = $_FILES['image']['tmp_name'];
$comando = "tesseract " . escapeshellarg($typeImage) . " stdout -l spa -c debug_file=/dev/null";
exec($comando, $textoDetectado, $codigoSalida);

if ($codigoSalida === 0) {
	
	$textoComoCadena = join("\n",$textoDetectado);
    
} else {
	echo "Error detectando texto. Por favor verifique que la imagen existe y que el programa de detección está instalado y es accesible desde PHP. El código de salida es: " . $codigoSalida;
}
$codvivienda = $textoComoCadena;

$insertar = "INSERT INTO  lecturas (codvivienda, direccion, mz, villa, fecha, imagen) VALUES 
('$codvivienda', '$direccion', '$mz', '$villa', '$fecha', '$image')";

$verificarcodigo = mysqli_query($conexion, "SELECT * FROM lecturas where codvivienda = '$codvivienda'");

if (mysqli_num_rows($verificarcodigo) > 0){
    echo '<script type="text/javascript">';
    echo 'alert("Lectura ya existe");';
    
    echo 'window.location.href="../registro.php";';
   
    echo '</script>';
    exit();
}

$resultado = mysqli_query($conexion, $insertar);

if ($resultado){
    echo '<script>';
    echo 'alert("Lectura Registrada!");';
    echo 'window.location.href="../registro.php";';
    echo '</script>';
    
    
}
 
?>
