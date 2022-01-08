<?php
$user= fopen("database/usuarios.csv", "w")
try{
    if(isset($_POST['enviar'])) { 
        if($_POST['username'] == '' or $_POST['password'] == '' or $_POST['repassword'] == '') { 
            echo 'Por favor llene todos los campos.'; 
        } else { 
            $lectura=fopen("database/usuarios.csv", "r");
            //$rec = mysql_query($sql); 
            $verificar_usuario = 0; 
            while($result = $lectura/*mysql_fetch_object($rec)*/) { 
                if($result->usuario == $_POST['username']) { 
                    $verificar_usuario = 1; 
                } 
            } 
            if($verificar_usuario) { 
                if($_POST['password'] == $_POST['repassword']) { 
                    $usuario = $_POST['username']; 
                    $password = $_POST['password']; 
                    fwrite ($user, "username, password");
                    echo 'Usted se ha registrado correctamente.'; 
                } else { 
                    echo 'Las claves no son iguales, intente nuevamente.'; 
                } 
            } else {
                echo 'Este usuario ya ha sido registrado anteriormente.'; 
            }
       
        } 
    }
    
} catch (Exception $e) {
    echo 'Exception: ',  $e->getMessage(), "\n";
}


?>