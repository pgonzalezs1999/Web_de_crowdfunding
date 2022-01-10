<!DOCTYPE html>
<?php
    //header('Content-Type: text/html; charset=UTF-8');
    //Iniciar una nueva sesión o reanudar la existente.
    session_start();
    //Si existe la sesión "cliente"..., la guardamos en una variable.
    //if (isset($_SESSION['username'])){
    //    $cliente = $_SESSION['username'];
    //}else{
    //    echo "Debes iniciar sesión"
    //    header('Location: index.php');//Aqui lo redireccionas al lugar que quieras.
    //   die() ;

    //}
?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icono.jpg">
    <meta proprty="twitter:card" content="summary">
    <meta name="author" content="Pablo Gonzalez y Leticia Gruneiro">
    <title>Deja tu comentario</title>
    <link rel="stylesheet" href="css/styleComentarios.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <link href='https://css.gg/chevron-up.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<header> 
    <a href="index.php"><img class="logo" src="images/crow3.JPG" alt="Desastre de la palma"></a>
</header>
<body>
    <div id="sesion_cliente">
        <?php 
        //Si existe la sesión "cliente"...
        if(isset($_SESSION['cliente'])){
            echo "<p class='negrita'>Bienvenido ".$cliente."&nbsp;&nbsp;";
            //Si existe y hemos pulsado el link "Salir"...
            if(isset($_REQUEST["salir"])){
                //Borramos o destruimos la sesión "cliente".
                unset($_SESSION["cliente"]);
            }
        }
        ?>
    </div>
    
    <div class="container-comments">
        <h3>Dejanos tu comentario</h3>
        Usuario <input class="UsuarioText" type="text" name="UsuarioText"/>
        <br>
        <br><input class="textfield" type="text" name="TextoComentario"/>
        <br>
        <input class="botonForm" type="submit" value="Enviar" name="Publicar"/>
        <?php
            if(isset($_POST['Publicar'])) { 
                $CrearComments = fopen("database/comentarios.csv", "w");
                if ($CrearComments !== FALSE){
                    $numLinea = 1;
                    $comentario= $_POST['TextoComentario'];
                    foreach ($comentario as $comment) {
                        fputcsv($file, $$comment);
                    }   


                }fclose($CrearComments);



            
            }
            /*
             $comentarios = fopen("database/comentarios.csv", "r");
             if ($comentarios !== FALSE)
             {
                 $numLinea = 1;
                 while (($arrayLinea = fgetcsv($comentarios, 1000, ",")) !== FALSE and $numLinea <= 10)
                 {
                     echo '<div class="comentario">
                             <div class="columna_foto">
                                 <div>
                                     <img class="foto_comentador" src="images/default-profile.jpg">
                                 </div>
                             </div>
                             <div class="columna_comentario">
                                 <p><strong>@'.$arrayLinea[0].'</strong>, sobre <b>'.$arrayLinea[1].'</b></p>
                                 <p>'.$arrayLinea[2].'</p>
                             </div>
                         </div>';
                     $numLinea++;               
                 }
                 fclose($comentarios);
            }else{

            }*/
        ?>
        


        
    </div>

</body>
<footer id="footer">
    <p>Trabajo realizado por:</p>
    <p>Pablo González - Github: <a href="https://github.com/pgonzalezs1999">pgonzalezs1999</a></p>
    <p>Leticia Gruñeiro - Github: <a href="https://github.com/lgruneirodem">lgruneirodem</a></p>
   
</footer>
</html>