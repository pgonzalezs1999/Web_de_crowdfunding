<?php
    session_start();
    $_SESSION['paginaActual'] = "crowd1.php";   
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="images/icono.jpg">
    <meta proprty="twitter:card" content="summary">
    <meta name="author" content="Pablo Gonzalez y Leticia Gruneiro">
    <title>Crowdfunding La Palma</title>
    <link rel="stylesheet" href="css/styleCrowd1.css"> <!-- ?version=51 -->
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <link href='https://css.gg/chevron-up.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<header>
    <?php
        if(isset($_SESSION['username']))
        {
            echo
            '<div class="estadoSesion">
                <p>Sesión iniciada como: '.$_SESSION['username'].'</p>
            </div>
            <br>';
        }
    ?>
    <div class="logo">
        <a href="index.php"><img src="images/crow3.JPG" alt="logo"></a>
    </div>
    <div class="texto_header">
        <h1>Recaudación de fondos para La Palma </h1>
        <h2>Después de este de la explosión, quisimos aportar nuestro pequeño grano de arena para porder ayudar a la gente que se ha quedado sin casa. </h2>
    </div>
</header> 
<body>
    
        <nav class="navPrincipal">
            <ul>
                <?php
                    if(!isset($_SESSION['username']))
                    {
                        echo '<li class="ratonMano"><a href="#login">Iniciar sesión</a></li>';
                    }
                ?>
                <li class="ratonMano"><a href="#footer">Contacto</a></li>
            </ul>
        </nav>
      
    <div class="informacion_principal">

        <div class= "columnas_informacion">
            <img class="foto_principal" src="images/LaPalma_desatre.jpeg" alt="Desastre de la palma" width="500px" height="300px">
        </div>

        <div id="texto_informacion">
            
            <h3>Erupción de la Palma</h3>

            <p>Tras la impresionante erupción del volcán ubicado en la isla de La Palma, muchos habitantes se han visto obligados a dejar su casa debido a que la lava iba en direccción de sus respectivas casas. 
                Por esto, hemos visto como una necesidad humana hacer una recaudación de fondos a tráves de un crowfounding para ayudar a estos ciudadanos</p>

            <p class="recaudacion"></p>
            <!--
            <div class="cont">
                <div class="loader">
                    <label class="counter"><span>0%</span> complete</label>
                </div>
            </div> -->
            <?php 
                $total= 5000;
                $sumDonaciones=0;
                $ficheroUsuarios = fopen("database/donaciones.csv", "r");
                if ($ficheroUsuarios !== FALSE){   
                    while (($arrayLinea = fgetcsv($ficheroUsuarios, 1000, ","))){
                        $sumDonaciones += $arrayLinea[2];
                        $porcentajeTotal = ($sumDonaciones * 100)/$total;
                    }
                    fclose($ficheroUsuarios);
                    echo '
                        <div class="cont">
                            <div class="loader" style="width:'.$porcentajeTotal.'%">
                                <label class="counter"><span class="porcentaje">'. $porcentajeTotal.'%</span> complete</label>
                            </div>
                        </div>';
                    
                }
                
            ?>
            <p class="personas_apoyo"> <span class="Apoyo">42</span> personas han apoyado esta causa</P>
            
            <div class="botones">
                <?php
                if(!isset($_SESSION['username'])){
                    echo'<button class="button" name="enlaceDonacion"><a id="enlace_donar" href=#login >Donar</a></button>';
                }else{
                    echo'<button class="button" name="enlaceDonacion"><a id="enlace_donar" href="donacion.php" >Donar</a></button>';
                }
                ?>
            </div>          
            
        </div>
    </div>

    <div class="imagenes_secundarias">

        <div class="imagenes_desastre"> 
            <img src="images/image1.jpg" alt="Desastre de La Palma"> 
        </div>

        <div class="imagenes_desastre"> 
            <img src="images/image2.jpg" alt="Desastre de La Palma">
        </div>

        <div class="imagenes_desastre"> 
            <img src="images/image3.jpg" alt="Desastre de La Palma">
        </div>
    </div>
    <div class="comentarios">
    <h3>Comentarios de nuestros usuarios:</h3>
        <?php
            if(isset($_SESSION['username']))
            {
                echo '
                <h3>Déjanos tu comentario:</h3>
                <form class="nuevoComentario action="index.php" method="post">
                    <input type="text" class="comentar" name="textoComentario"/>
                    <button class="botonComentar ratonMano" type="submit">Añadir comentario</button>
                </form>';
            }
            $comentarios = fopen("database/comentarios.csv", "r");
            $listaComentarios;
            if ($comentarios !== FALSE)
            {
                $numLinea = 1;
                while (($arrayLinea = fgetcsv($comentarios, 1000, ",")))
                {
                    $listaComentarios[$numLinea-1] = $arrayLinea;
                    $numLinea++;
                }
                fclose($comentarios);
                $ultimos = [];
                $numUltimos = 0;
                for($i=count($listaComentarios)-1; $i>=count($listaComentarios)-10; $i=$i-1)
                {
                    $ultimos[$numUltimos] = $listaComentarios[$i][2];
                    $numUltimos++;
                }
                if(isset($_POST['textoComentario']) && $ultimos[0] != $_POST['textoComentario'] && $_POST['textoComentario'] != "")
                {
                    $ficheroComentarios = fopen("database/comentarios.csv", "a");
                    $lineaNueva = [$_SESSION['username'], "CrowdfundingLP", $_POST['textoComentario']];
                    fputcsv($ficheroComentarios, $lineaNueva);
                    fclose($ficheroComentarios);
                    unset($_POST);
                }
                $comentarios = fopen("database/comentarios.csv", "r");
                $numLinea = 1;
                while (($arrayLinea = fgetcsv($comentarios, 1000, ",")))
                {
                    $listaComentarios[$numLinea-1] = $arrayLinea;
                    $numLinea++;
                }
                fclose($comentarios);
                $mostrados = 0;
                for($i=count($listaComentarios)-1; $i>0; $i--)
                {
                    if($i>=0 && $listaComentarios[$i][1] == "LaPalma")
                    {
                        echo '
                        <div class="comentario">
                            <div class="columna_foto">
                                <div>
                                    <img class="foto_comentador" src="images/default-profile.jpg">
                                </div>
                            </div>
                            <div class="columna_comentario">
                                <p><strong>@'.$listaComentarios[$i][0].'</strong></b></p>
                                <p>'.$listaComentarios[$i][2].'</p>
                            </div>
                        </div>';                           
                    }
                }
            }
        ?>   
    </div>
    <?php
        if(!isset($_SESSION['username'])){
            $_SESSION['cerrarSesion'] = FALSE;
            echo '
            <div class=sistemaLogin>
                <div class="login" id="login">
                    <h3>Inicia sesión para añadir un comentario</h3>
                    <form action="validarLogin.php" method="post">
                        Nombre de usuario:<br><input class="inputForm inputUsername" type="text" name="username"/>
                        <br><br>
                        Contraseña:<br><input class="inputForm inputPassword" type="password" name="password"/>
                        <br><br>
                        <button class="botonForm ratonMano" type="submit">Iniciar sesión</button>
                    </form>
                </div>
                <div class ="registro" id="registro">
                    <h3>¿No tienes cuenta? Registrate ahora</h3>
                    <form action="registroUsers.php" method="post">
                        Nombre de usuario: <br><input class="inputForm" type="text" name="username"/>
                        <br>
                        Contraseña: <br><input class="inputForm" type="password" name="password"/>
                        <br><br>
                        Repetir contraseña: <br><input class="inputForm" type="password" name="repassword"/>
                        <br><br>
                        <input class="botonForm ratonMano" type="submit" value="Registrarse" name="RegistrarUser"/>
                    </form>
                </div>
            </div>';
        }
    ?>
     
</body>
<footer id="footer">
    <?php
    if(isset($_SESSION['username']))
    {
        $_SESSION['cerrarSesion'] = TRUE;
        echo '<p><a href="validarLogin.php">Cerrar sesión</a></p>';
    }
    ?>
    <p>Trabajo realizado por:</p>
    <p>Pablo González - Github: <a href="https://github.com/pgonzalezs1999">pgonzalezs1999</a></p>
    <p>Leticia Gruñeiro - Github: <a href="https://github.com/lgruneirodem">lgruneirodem</a></p>
    <button class="regreso ratonMano"><i class="gg-chevron-up" onclick="regresar()"></i></button>
</footer>
<script src="js/principal.js"></script>
</html>