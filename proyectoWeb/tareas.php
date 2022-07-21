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
    <title>Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@200&family=Signika+Negative&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
    
</head>

<body>


    <header class="site-header">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="lista.php">
                    <img src="img/proyectoLogo.png" alt="logo proyecto">
                </a>


                <nav id="navegacion" class="navegacion">
                    <a style="color: white;">Bienvenido <?php echo utf8_decode($row['usuario']); ?></a>

                    <a href="lista.php">Inicio</a>
                    
                    <a href="./src/salirsesion.php" onclick="return ConfirmSession()">Cerrar Sesión</a>


                </nav>
            </div>
        </div>
    </header>
   
    <h2 style="text-align:center; margin-top:3rem;">Registro de Tareas</h2>
    
    <section class="row" style="margin-top: 3rem;">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <form method="POST" id="formDatos">

                        <div class="form-row">
                            <div class="col-md-6" >
                                <!--//PRIMERA COLUMNA -->
                                <div class="form-group form-row">
                                   
                                    <label for="" class="col-sm-2 col-form-label">Agente:</label>
                                        <div class="col-sm-6">
                                            <select required class="form-control" id="usuarios"></select>
                                        </div>
                            
                                </div>
                                <div class="form-group form-row">
                                        <label for="" style="margin-left: 2" class="col-sm-2">Cod.Vivienda:</label>
                                        <div class="col-sm-6">
                                            <select required class="form-control" id="codvivienda"></select>
                                        </div>
                                
                                </div>
                                

                                <div class="form-group form-row">
                                    <label for="" class="col-sm-2 ">Direccion:</label>
                                    <!-- Tamaño del label -->
                                    <div class="col-sm-6">
                                        <!-- tamaño del input -->
                                        <select class="form-control" id="direccion" disabled></select>
                                       
                                    </div>
                                </div>

                                <div class="form-group form-row">
                                    <label for="" class="col-sm-2 ">Mz:</label>
                                    <!-- Tamaño del label -->
                                    <div class="col-sm-6">
                                        <!-- tamaño del input -->
                                        <select class="form-control" id="mz" disabled></select>
                                        
                                    </div>
                                </div>

                            
                            </div>
                            <div class="col-md-6"> 
                                <!-- SEGUNDA COLUMNA -->
                                <div class="form-group form-row">
                                    <label for="" class="col-sm-4 col-form-label">Fecha:</label>
                                    <div class="col-sm-5">
                                        <select class="form-control" id="fecha" disabled></select>

                                    </div>
                                </div>
                                <div class="form-group form-row">
                                    <label for="" class="col-sm-4 col-form-label">Villa:</label>
                                    <div class="col-sm-5">
                                        <select class="form-control" id="villa" disabled></select>
                                        
                                    </div>
                                </div>

                            </div> 
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Registrarse</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>




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
    <script src="./js/index.js?v=<?= $rand ?>"></script>
    <script src="./js/loadCode.js?v=<?= $rand ?>"></script>
    <script src="./js/modal.js"></script>






</body>

</html>
