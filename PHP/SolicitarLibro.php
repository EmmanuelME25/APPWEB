<?php
    session_start();
    include "VerifySession.php";
    echo "Hola";
    include "Connect.php";

    $IDL = $_POST['Libro'];
    $IDU = $_SESSION['user_id'];
    $NewSt = 'SOLICITADO';

    $stmt = $conn->prepare("INSERT into prestamo (ID_U, ID_L) VALUES (?,?)");
    $stmt->bind_param('ss',$IDU, $IDL);
    $stmt->execute();
    
    $stmt = $conn->prepare("UPDATE libros SET STATUS=? WHERE ID_L=?");
    $stmt->bind_param('ss', $NewSt, $IDL);
    $stmt->execute();

    header("Location: ../PRINCIPAL/SOLICITUDES");

    echo $IDL;
?>
