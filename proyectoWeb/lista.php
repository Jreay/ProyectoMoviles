<?php
require_once("./src/conexion.php");
session_start();
if (!isset($_SESSION['usuario'])){
    header("Location: index.php");
} 
$usuario = $_SESSION['usuario'];


$sql = "SELECT * from usuarios where usuario = '$usuario'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();   
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@200&family=Signika+Negative&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Inicio</title>
    <style>
        /**Modal*/
        .modal-container {
            opacity: 0;
            visibility: hidden;
            position: fixed;
            z-index: 1000;
            width: 100%;
            height: 160%;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .ventana {
            width: 40%;
            height: 50%;
            background: #fff;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            position: relative;
            border-radius: 10px;
            transition: transform 1s;
            transform: translateY(-35%);
            border-radius: 10px;
            /*overflow: hidden*/;
        }

        .close {
            position: absolute;
            top: 5px;
            right: 5px;
            display: inline-block;
            width: 25px;
            height: 25px;
            background: red;
            color: white;
            line-height: 25px;
            cursor: pointer;
            border-radius: 50%;
        }

        .ventana-close {
            transform: translateY(-200%);
        }

        .ventana  img {
            height: 100%;
        }
        .navegacion a {
            text-decoration: none;
        }
        
        table {
            height: 10rem;
            background-color: rgb(211, 208, 208);
            border-collapse: collapse;
            font-size: 12pt;
            font-family: arial;
            width: 100%;
                
        }
                
        table th {
            text-align: center;
            padding: 10;
            background: #3d7ba8;
            color: #fff;
            height: 3rem
        }

        table tr:nth-child(odd) {
            background: #fff;
        }

        table td{
            text-align: center;
            padding: 10px;
        }
    </style>
    
</head>

<body>
           
    <header class="site-header">
        <div class="contenedor contenido-header">
            <div class="barra">
                
                <img src="img/proyectoLogo.png" alt="logo proyecto">
                


                <nav id="navegacion" class="navegacion">
                    <a style="color: white;">Bienvenido <?php echo utf8_decode($row['usuario']); ?></a>
                    
                    <a href="./src/salirsesion.php" onclick="return ConfirmSession()">Cerrar Sesión</a>


                </nav>
            </div>
        </div>
    </header>

    <h2 style="text-align:center; margin-top:3rem;">Lista de Lecturas</h2>
    <br>
    <a href="tareas.php"><input class="btn btn-info" type="button" value="Asignar Tarea"></a>        
    <a href="registro.php"><input class="btn btn-info" type="button" value="Nuevo registro"></a>
    <input class= "btn btn-success sign-in" id="mostrar" type="button" value="Mostrar">


    
    <div class="modal-container">
        <div class="ventana ventana-close">
            <p class="close">X</p>
                
            <?php        
                $id= $_GET ["id"];
                $sql="SELECT * from lecturas WHERE id='$id'";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result)){	
				
		    ?>
                <img src="data:image/jpg;base64, <?php echo base64_encode($mostrar['imagen']);?>"/>
                <?php } ?>
               

        </div>
    </div>
    

    <section>
        <br>
        <table>


            <tr>
                <th>Fecha</th>
                <!-- style="width: 20%;" -->
                <th>Codigo de Vivienda</th>
                <th>Direccion</th>
                <th>Mz</th>
                <th>Villa</th>
                <th>Acciones</th>
            </tr>
            <?php
                
                $sql="SELECT * from lecturas ORDER BY fecha DESC";
                $result=mysqli_query($conexion,$sql);
                while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                
                <td><?php echo $mostrar['fecha']?></td>

                <td><?php echo $mostrar['codvivienda']?></td>
                
                <td><?php echo $mostrar['direccion']?></td>
                <td><?php echo $mostrar['mz']?></td>
                <td><?php echo $mostrar['villa']?></td>
                <td style="width: 20%;"> 
                    <a href="lista.php?id=<?php echo $mostrar ["id"]; ?>"><input class= "btn btn-primary sign-in" type="button" id="seleccionar" value="Seleccionar"></a>
                    
                    <a href="?id=<?php echo $mostrar ["id"]; ?>"><input class= "btn btn-danger " type="button" onclick="return ConfirmDelete()" value="Eliminar"></a>
                </td>
            </tr>

            <?php
            }

            ?>
        </table>
    </section>

    <br>
    <br>
    <br>

    <footer class="site-footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="#">¿Quienes somos?</a>
                <a href="#">Terminos y Condiciones</a>
                <a href="#">Contacto</a>
            </nav>
            <p class="copyright">Todos los Derechos Reservados 2022 &copy; </p>
        </div>
    </footer>


<script src="./js/modal.js?v=<?= $rand ?>"></script>



</body>

</html>
