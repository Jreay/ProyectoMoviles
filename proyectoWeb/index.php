<?php
include("./src/login.php");
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="css/styles.css">
    <title>Proyecto</title>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type='text/javascript'>
    </script>
    <style>
        body {
            /*webgradients/*/
            background-image: linear-gradient(to top, #4fb576 0%, #44c489 30%, #28a9ae 46%, #28a2b7 59%, #4c7788 71%, #6c4f63 86%, #432c39 100%);
        }
        
        label {
            text-align: center;
            color: white;
        }
        
        button {
            /* margin-left: 1.9rem;   */
            width: 100%;
        }
        
        a {
            font-size: 13px;
            text-decoration: none;
        }
        
        .card {
            /* background-color: rgb(111, 186, 247); */
            background-color: #21232A;
            margin-top: 2.5rem;
            height: 28rem;
        }
        
        .logo {
            margin-top: 2rem;
            height: 90px;
            width: 190px;
            margin-left: 36rem;
        }
        
        .login {
            width: 40%;
            height: 20%;
            margin: 0;
            display: flex;
            margin-left: 5.5rem;
        }
    </style>

</head>

<body>

    <div class="container">


        <section class="main row">
            <!--poner en el centro la ventana de login-->
            <article class="col-md-4">
            </article>

            <article class="col-md-4" style="margin-top: 6rem;">
                <div class="card" data-aos="fade-up" data-aos-duration="2000" style="width: 20rem">

                    <div class="card-body">
                        <img class="login" src="./img/login.svg" alt="">


                        <h5 class="card-title">Login Here</h5>
                        <form name="iniciarsesion" method="POST">
                            <div class="form-group">

                                <label for="User">Usuario</label>
                                <input type="user" class="form-control" name="user" placeholder="Ingrese su usuario" required>
                                <br>
                                <label for="Password">Contraseña</label>
                                <input type="password" class="form-control" maxlength="20" name="password" placeholder="Ingrese su contraseña" required>
                                <br>
                                <button style="font-size: 17px; border-radius: 25px; margin-bottom:14px" class=" btn btn-primary"><a style="color: white; ">Ingresar</a></button>
                                <a href="#">¿Olvidaste tu contraseña?</a><br>

                                <a href="#">¿No tienes cuenta?</a>


                            </div>
                        </form>
                    </div>

                </div>
            </article>

            <article class="col-md-4 ">
            </article>
        </section>
    </div>
    <script>
        AOS.init();
    </script>

</body>


</html>