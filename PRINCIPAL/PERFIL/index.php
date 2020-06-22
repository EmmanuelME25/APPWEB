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
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE ID_U = ?");
    $stmt->bind_param('s', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_object();
    
    $FotoPerf = $user->ProfPic;
    $Nombre = $user->NOMBRE;
    $Ap1 = $user->APELLIDO1;
    $Ap2 = $user->APELLIDO2;
    $NPr = $user->NUMPRESTAS;
    $Calif = $user->CALIFUSER;
    
} else {
    // Redirect them to the login page
    header("Location: ../../");
}
?>
<html>
<head>
    <title></title>
    <meta charset='UTF-32'>
</head>
<body>
    <?php
        //echo "<img src='$FotoPerf' height=250 width=250>";
        echo "$Nombre $Ap1 $Ap2";
    ?>
    <br><br><br><hr>
    <?php
        echo "Has prestado $NPr libros";
        echo "<br>";
        echo "Tu calificación actual es $Calif";
    ?>
    <br><br><br>
    <a href="EDITARPERFIL/">Editar perfil</a>
    
</body>
</html>
