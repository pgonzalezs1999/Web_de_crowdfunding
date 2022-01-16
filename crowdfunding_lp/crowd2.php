<?php
    session_start();
    $_SESSION['paginaActual'] = "crowd2"; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="images/icono.jpg">
    <meta proprty="twitter:card" content="summary">
    <meta name="author" content="Pablo Gonzalez y Leticia Gruneiro">
    <title>Crowdfunding Bohol</title>
    <link rel="stylesheet" href="css/styleCrowd1.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <link href='https://css.gg/chevron-up.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
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
        <h1>Recaudación de fondos para Bohol</h1>
        <h2>Después de este del tifón, quisimos aportar nuestro pequeño grano de arena para porder ayudar a la gente que se ha quedado sin casa. </h2>
    </header> 
        <nav class="navPrincipal">
            <ul>
                <?php
                    if(!isset($_SESSION['username']))
                    {
                        echo '<li class="ratonMano"><a href="#login">Iniciar sesión</a></li>';
                    }
                ?>
                <li class="ratonMano"><a href="#Contacto">Contacto</a></li>
            </ul>
        </nav>
      
    <div class="informacion_principal">

        <div class= "columnas_informacion">
            <img class="foto_principal" src="images/Bohol_desastre.jpeg" alt="Desastre de bohol" width="500px" height="300px">
        </div>

        <div id="texto_informacion">
            
            <h3>Erupción de la Palma</h3>

            <p>Tras "Rai", el impresionante tifón que atravesó la ciudad de Bohol, FIlipinas, muchos habitantes se han visto obligados a dejar su casa debido al destrozo que provocó en gran parte de la ciudad. 
                Por esto, hemos visto como una necesidad humana hacer una recaudación de fondos a tráves de un crowfounding para ayudar a estos ciudadanos</p>

            <p class="recaudacion"></p>
            <div class="cont">
                <div class="loader">
                    <label class="counter"><span class="porcentaje">63%</span> complete</label>
                </div>
            </div>
            <P class="personas_apoyo">42 personas han apoyado esta causa</P>
            

            <div class="botones">
                <button class="button"><a id="enlace_donar" href="donacion.php">Donar</a></button>
            </div>          
            
        </div>
    </div>

    <div class="imagenes_secundarias">

        <div class="imagenes_desastre"> 
            <img src="images/filipinas1.jpg" alt="Desastre de Bohol"> 
        </div>

        <div class="imagenes_desastre"> 
            <img src="images/filipinas2.jpg" alt="Desastre de Bohol">
        </div>

        <div class="imagenes_desastre"> 
            <img src="images/filipinas3.jpg" alt="Desastre de Bohol">
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
                        if($i>=0 && $listaComentarios[$i][1] == "Bohol")
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
</body>
<footer id="footer">
    <p>Trabajo realizado por:</p>
    <p>Pablo González - Github: <a href="https://github.com/pgonzalezs1999">pgonzalezs1999</a></p>
    <p>Leticia Gruñeiro - Github: <a href="https://github.com/lgruneirodem">lgruneirodem</a></p>
    <button class="regreso ratonMano"><i class="gg-chevron-up" onclick="regresar()"></i></button>
</footer>
<script src="js/principal.js"></script>
<script src="js/crowd1.js"></script>
</html>