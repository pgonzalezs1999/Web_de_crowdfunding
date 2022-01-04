<!DOCTYPE html>
<html lang="es">
<head>
    <!-- http://localhost/Pablo/crowdfunding_lp/crowdfunding_lp/index.php -->
    <meta charset="utf-8">
    <link rel="icon" href="images/icono.jpg">
    <meta proprty="twitter:card" content="summary">
    <meta name="author" content="Pablo Gonzalez y Leticia Gruneiro">
    <title>Crowdfundings Leticia y Pablo</title>
    <link rel="stylesheet" href="css/styleCrowd1.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <link href='https://css.gg/chevron-up.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&display=swap" rel="stylesheet">
<body>
    <header>
        <div class="logo">
            <a href="index.php"><img src="images/crow3.JPG" alt="logo"></a>
        </div>
        <h1>Recaudación de fondos para La Palma </h1>
        <h2>Después de este de la explosión, quisimos aportar nuestro pequeño grano de arena para porder ayudar a la gente que se ha quedado sin casa. </h2>
    </header> 
        <nav class="navPrincipal">
            <ul>
                <li class="ratonMano" ><a href="#login">Iniciar sesión</a></li>
                <li class="ratonMano"><a href="#Contacto">Contacto</a></li>
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

            <div class="dinero">
                <p class="textoPorcentaje">50%</p>
                <div class="barraProgreso">
                    <div class="porcentaje"></div>
                </div>
            </div>
            <P class="personas_apoyo">42 personas han apoyado esta causa</P>
            

            <div class="botones">
                <button class="button"><a id="enlace_donar" href="donacion.html">Donar</a></button>
                <button class="button">Compartir</button>
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
    <div class="comentario_Inicio">
        <section class="comentarios">
            <h3> Dejanos tu comentario: </h3>
            <input type="text" class="comentar" name=""><br><br>
            <input class="botonComents" type="submit" value="Enviar"/>
            
            <h3>Comentarios de nuestros usuarios:</h3>

            <?php
                $comentarios = fopen("database/comentarios.csv", "r");
                if ($comentarios !== FALSE)
                {
                    $numLinea = 1;
                    while (($arrayLinea = fgetcsv($comentarios, 1000, ",")) !== FALSE and $numLinea <= 10)
                    {
                        echo "<div class=\"comentario\">
                                <div class=\"columna_foto\">
                                    <div>
                                        <img class=\"foto_comentador\" src=\"images/default-profile.jpg\">
                                    </div>
                                </div>
                                <div class=\"columna_comentario\">
                                    <p><strong>@".$arrayLinea[0]."</strong>, sobre ".$arrayLinea[1]."</p>
                                    <p>".$arrayLinea[2]."</p>
                                </div>
                            </div>";
                        $numLinea++;               
                    }
                    fclose($comentarios);
                }
            ?>
        </section>
        <section class="login" id="login">
            <h3>Inicia sesión para añadir un comentario</h3>
            <form action="bienvenida.php" method="post">
                Usuario: <br><input class="inputForm" type="text" name="nombre"/>
                <br>
                Contraseña: <br><input class="inputForm" type="text" name="contrasena"/>
                <br><br>
                <input class="botonForm" type="submit" value="Enviar"/>
            </form>
            <h3>¿No tienes cuenta? Registrate ahora</h3>
            <form action="bienvenida.php" method="post">
                Usuario: <br><input class="inputForm" type="text" name="nombre"/>
                <br>
                Contraseña: <br><input class="inputForm" type="text" name="contrasena"/>
                <br><br>
                <input class="botonForm" type="submit" value="Enviar"/>
            </form>
        </section>
    </div>
</body>
<footer id="footer">
    <p>Trabajo realizado por:</p>
    <p>Pablo González - Github: <a href="https://github.com/pgonzalezs1999">pgonzalezs1999</a></p>
    <p>Leticia Gruñeiro - Github: <a href="https://github.com/lgruneirodem">lgruneirodem</a></p>
    <button class="regreso ratonMano"><i class="gg-chevron-up" onclick="regresar()"></i></button>
</footer>
<script src="js/principal.js"></script>
</html>