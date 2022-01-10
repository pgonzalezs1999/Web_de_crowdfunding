<!DOCTYPE html>
<?php
    session_start();
    $_SESSION['paginaActual'] = "index";
    echo "Antes: " . $_POST["textoComentario"];
    if(isset($_POST['textoComentario']))
    {
        $ficheroComentarios = fopen("database/comentarios.csv", "a");
        $lineaNueva = [$_SESSION['username'], "CrowdfundingLP", $_POST['textoComentario']];
        fputcsv($ficheroComentarios, $lineaNueva);
        fclose($ficheroComentarios);
        unset($_POST);
    }
?>
<html lang="es">
    <head>
        <!-- http://localhost/Pablo/crowdfunding_lp/crowdfunding_lp/index.php -->
        <meta charset="utf-8">
        <link rel="icon" href="images/icono.jpg">
        <meta proprty="twitter:card" content="summary">
        <meta name="author" content="Pablo Gonzalez y Leticia Gruneiro">
        <title>Crowdfundings Leticia y Pablo</title>
        <link rel="stylesheet" href="css/styleIndex.css?version=52">
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <link href='https://css.gg/chevron-up.css' rel='stylesheet'>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&display=swap" rel="stylesheet">
    </head>
    <header>
    <?php
        if(isset($_SESSION['username']))
        {
            echo
            '<div class="estadoSesion">
                <p class="textoSesion">Sesión iniciada como: '.$_SESSION['username'].'</p>
            </div>
            <br>';
        }
    ?>
    <a href="index.php"><img class="logo" src="images/crow3.JPG" alt="Logo PL"><a>
    <h1>Crowdfundings González-Gruñeiro</h1>
    <h2>Somos dos alumnos de la Universidad Europea de Madrid. Nuestro objetivo es concienciar a la población de problemas en el mundo y, mediante recaudación colectiva, conseguir los fondos suficientes para aportarles solución</h2>
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
</header>
<body>
    <img src="images/index-banner.jpg" class="banner">
    <h3 class="tituloProyectos">Causas en las que colaboramos</h3>
    <div class="proyectos">
        <div class="proyecto">
            <img src="images/image1.jpg">
            <p>Hace unas semanas el volcán de La Palma de Gran Canaria entró en erupción, dejando sin hogar a decenas de familias</p>
            <button class="botonForm"><a href="crowd1.php">Volcán de La Palma</a></button>
        </div>
        <div class="proyecto">
            <img src="images/Filipinas_desastre.jpg">
            <p>El 19 de diciembre de 2021, el supertifón Rai arrasó por Bohol, Filipinas, destrozando gran parte de la ciudad</p>
            <button class="botonForm"><a href="crowd2.html">Crowdfunding 2</a></button>
        </div>
        <div class="proyecto">
            <img src="images/coming_soon.jpg">
            <p>Aquí una breve descripción del proyecto 3, para animar a la gente a que se interese por el proyecto y pulse el botón</p>
            <button class="botonForm"><a href="crowd3.html">Crowdfunding 3</a></button>
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
                    <button class="botonComentar ratonMano" type="submit">Iniciar sesión</button>
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
                for($i=count($listaComentarios)-1; $i>=count($listaComentarios)-10; $i=$i-1)
                {
                    if($i>=0)
                    {
                        echo '
                        <div class="comentario">
                            <div class="columna_foto">
                                <div>
                                    <img class="foto_comentador" src="images/default-profile.jpg">
                                </div>
                            </div>
                            <div class="columna_comentario">
                                <p><strong>@'.$listaComentarios[$i][0].'</strong>, sobre <b>'.$listaComentarios[$i][1].'</b></p>
                                <p>'.$listaComentarios[$i][2].'</p>
                            </div>
                        </div>';
                    }
                }
            }
        ?>
    </div>
    <?php
        if(!isset($_SESSION['username']))
        {
            $_SESSION['cerrarSesion'] = FALSE;
            echo '
            <div class="login" id="login">
                <h3>Inicia sesión para añadir un comentario</h3>
                <form action="validarLogin.php" method="post">
                    Nombre de usuario:<br><input class="inputForm inputUsername" type="text" name="username"/>
                    <br><br>
                    Contraseña:<br><input class="inputForm inputPassword" type="text" name="password"/>
                    <br><br>
                    <button class="botonForm ratonMano" type="submit">Iniciar sesión</button>
                </form>
                <!-- <h3>¿No tienes cuenta? Registrate ahora</h3>
                <form action="index.php" method="post">
                    Usuario: <br><input class="inputForm" type="text" name="nombre"/>
                    <br>
                    Contraseña: <br><input class="inputForm" type="text" name="contrasena"/>
                    <br><br>
                    <input class="botonForm ratonMano" type="submit" value="Registrarse"/>
                </form> -->
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