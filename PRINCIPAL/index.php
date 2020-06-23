<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    $host = "localhost";
    $usDb = "root";
    $passDb = "";
    $dbName = "CLASSMATEBOOKING";
        
    $conn = new mysqli($host, $usDb, $passDb, $dbName);
    mysqli_set_charset($conn, "utf8");

    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    
    $stmt = $conn->prepare("SELECT * from libros");
    $stmt->execute();
    $result = $stmt->get_result();
    
} else {
    // Redirect them to the login page
    header("Location: ../");
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>hover effect</title>
        <link rel="stylesheet" href="../CSS/PRINCIPALCSS.css">
    </head>
    <body>
        
        <div id="titulo">
            <b><p id="header">Classmatebooking</p>
        </div>

        <header>
            
            <div class="contenedor" id="uno">
                <a href="../PRINCIPAL"><img class="icon" src="IMAGENES_MENU/home.png"></a>
                <p class="texto">Inicio</p>
            </div>

            <div class="contenedor" id="dos">
                <a href="LIBROSPRESTADOS/"><img class="icon" src="IMAGENES_MENU/logo.png"></a>
                <p class="texto">Sesión</p>
            </div>

            <div class="contenedor" id="tres">
                <a href="PERFIL/"><img class="icon" src="IMAGENES_MENU/perfil.png"></a>
                <p class="texto">Perfil</p>
            </div>

            <div class="contenedor" id="cuatro">
                <a href="PETICIONES/"><img class="icon" src="IMAGENES_MENU/prestados.png"></a>
                <p class="texto">Peticiones</p>
            </div>

            <div class="contenedor" id="cinco">
                <a href="REGISTRARLIBRO/"><img class="icon" src="IMAGENES_MENU/registro.png"></a>
                <p class="texto">Registro</p>
            </div>

        </header>
        <?php
        echo "<table style='padding:10px; padding-left:150px'><tr>";

        while($row = mysqli_fetch_array($result)){
        $Titulo = $row['TITULO'];
        $Autor = $row['AUTOR'];
        $Imagen = $row['BookPic'];
        $IDLib = $row['ID_L'];
        
        $stmt = $conn->prepare("SELECT * from lib_us WHERE ID_L = ?");
        $stmt->bind_param("s",$IDLib);
        $stmt->execute();
        $resulta = $stmt->get_result();
        $IDUs = $resulta->fetch_object();
        $IDUs = $IDUs->ID_U;
        
        $stmt = $conn->prepare("SELECT * from usuarios WHERE ID_U = ?");
        $stmt->bind_param("s",$IDUs);
        $stmt->execute();
        $resulta = $stmt->get_result();
        $user = $resulta->fetch_object();
        
        $NombreU = $user->NOMBRE;
        $AP1U = $user->APELLIDO1;
        $AP2U = $user->APELLIDO2;
        
        echo "  
                        <td id='tablalibros'>
                            <img src=$Imagen height=240 width=135 style='object-fit: cover'>
                            <br><br>
                            $Titulo
                            <br><br>
                            Autor: $Autor
                            <br><br>
                            Propietario: $NombreU $AP1U $AP2U
                        </td>
                    ";
        }

        echo "</table></tr>";

        $stmt->close();
    ?>
    </body>
</html>
