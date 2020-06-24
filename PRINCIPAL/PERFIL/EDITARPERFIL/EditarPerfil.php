<?php
    session_start();

    include "../../../PHP/VerifySession.php";

    $Nombre = $_POST["nombre"];
    $Papellido = $_POST["apellido1"];
    $Sapellido = $_POST["apellido2"];
    $Contrasena = $_POST["contrasena"];
    $Numero = $_POST["telefono"];
    $Foto = $_POST["imagen"];

    if(!empty($Nombre) || !empty($Papellido) || !empty($Sapellido) || !empty($Corr) || !empty($Contrasena)){
            include "../../../PHP/Connect.php";
            $ID = $_SESSION['user_id'];
            
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE ID_U = ?");
            $stmt->bind_param('s', $ID);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_object();
        
            if(password_verify($Contrasena, $user->PASSHASH)){
                $sSQL=$conn->prepare("UPDATE usuarios SET NOMBRE=?, APELLIDO1=?, APELLIDO2=?, TELEFONO=?, ProfPic=? Where ID_U= ?");
                $sSQL->bind_param('ssssss', $Nombre, $Papellido, $Sapellido,$Numero,$Foto , $ID);
                $sSQL->execute();
                header("Location: ../");
            } else {
                header("Location: index.php");
            }
            
            $stmt->close();
        
    } else {
        echo "Todos los campos deben estar completos";
        die();
    }

?>
