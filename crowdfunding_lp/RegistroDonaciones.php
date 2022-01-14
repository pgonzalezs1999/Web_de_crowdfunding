<!DOCTYPE html>
<html lang="es">
<head>
    <!-- http://localhost/Pablo/crowdfunding_lp/crowdfunding_lp/validarLogin.php -->
    <meta charset="utf-8">
    <link rel="icon" href="images/icono.jpg">
    <meta proprty="twitter:card" content="summary">
    <meta name="author" content="Pablo Gonzalez y Leticia Gruneiro">
    <title>Registro PL</title>
    <link rel="stylesheet" href="css/styleLogIn.css?version=51">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <link href='https://css.gg/chevron-up.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&display=swap" rel="stylesheet">
</head>
<header>
<a href="index.php"><img class="logo" src="images/crow3.JPG" alt="Logo PL"><a>
    <h1>Pantalla de Registro</h1>
</header>
<body>
    <?php
        if(isset($_POST['botonDonacion']))
        {
            
            $ficheroComentarios = fopen("database/donaciones.csv", "a");
            $lineaNueva = [$_POST['username'],"LaPalma", $_POST['Dinero']];
            fputcsv($ficheroComentarios, $lineaNueva);
            fclose($ficheroComentarios);
        }
        
        $ficheroUsuarios = fopen("database/donaciones.csv", "r");
        if ($ficheroUsuarios !== FALSE)
            {
                $numLinea = 1;
                while (($arrayLinea = fgetcsv($ficheroUsuarios, 1000, ",")))
                {
                    $numLinea++;
                }
                fclose($ficheroUsuarios);
                echo '<p>Gracias'.$arrayLinea[0].'por donar '.$arrayLinea[2].' €</p>';
            }
            if ($esCorrector = TRUE){
                echo '<p>Usuario creado correctamente</p>';

            }
            else
            {
                echo 'No se ha podido leer el fichero';
            }
        
        echo
        '<p class="explicacion">Pulsa el botón para regresar a la pantalla anterior</p><br>
        <button class="botonVolver"><a href="index.php">Regresar</a></button>';
    ?>
</body>
<footer id="footer">
    <p>Trabajo realizado por:</p>
    <p>Pablo González - Github: <a href="https://github.com/pgonzalezs1999">pgonzalezs1999</a></p>
    <p>Leticia Gruñeiro - Github: <a href="https://github.com/lgruneirodem">lgruneirodem</a></p>
    </footer>
</html>

