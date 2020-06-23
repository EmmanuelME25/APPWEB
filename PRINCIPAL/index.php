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
        <link rel="stylesheet" type="text/css" href="../CSS/PRINCIPALCSS.css" media="screen" />
        <title> Clasmatebooking </title>
    </head>
    <nav class="menu"> <!-- Me parece que este es el menu circular del que hay que deshacerse -->
    <input type="checkbox" href="#" class="menu-open" name="menu-open" id="menu-open" />
    <label class="menu-open-button" for="menu-open">
        <span class="lines line-1"></span>
        <span class="lines line-2"></span>
        <span class="lines line-3"></span>
    </label>

    <a href="PETICIONES/" class="menu-item blue"> <i class="fa fa-anchor"></i> </a>
    <a href="REGISTRARLIBRO/" class="menu-item green"> <i class="fa fa-coffee"></i> </a>
    <a href="LIBROSPRESTADOS/" class="menu-item red"> <i class="fa fa-heart"></i> </a>
    <a href="PERFIL/" class="menu-item purple"> <i class="fa fa-microphone"></i> </a>
    <a href="#" class="menu-item orange"> <i class="fa fa-star"></i> </a>
    <a href="#" class="menu-item lightblue"> <i class="fa fa-diamond"></i> </a>
    </nav>
    <body>
    <?php
        echo "<table style='padding:10px;'><tr>";

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
