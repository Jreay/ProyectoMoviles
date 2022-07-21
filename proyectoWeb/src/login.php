<?php
    $alert = '';
    session_start();
if (!empty ($_SESSION['active']))
{
    header('Location: lista.php');
}else{


    if (!empty($_POST))
    {
        
        if (empty($_POST ['user']) || empty($_POST ['password']))
        {
           $alert = 'Ingrese su usuario y clave';
        }else {
            require_once "./src/conexion.php";
            $user = mysqli_escape_string($conexion,$_POST ['user']);
            $pass = mysqli_escape_string($conexion,$_POST ['password']);

            //echo $pass; exit;
            $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$user' and password ='$pass'");
            $result = mysqli_num_rows($query);
            
        if ($result > 0)
        {
            $data = mysqli_fetch_array($query);
           
            $_SESSION ['active'] = true;
            $_SESSION ['usuario'] = $data ['usuario'];
            header('Location: lista.php');
        }else
            {
                echo '<script>';
                echo 'alert("Usuario o clave incorrecto");';
                
                echo '</script>';
                session_destroy();               
            }
        }
    }  
}
?>