<?php
    session_start();
    include "VerifySession.php";
    include "Connect.php";
    $IDL = $_POST['Libro'];
    $IDU = $_SESSION['user_id'];
    $OldST = 'SOLICITADO';
    $NewSt = 'CANCELADO';
    $Status = 'DISPONIBLE';
	
    $stmt = $conn->prepare("UPDATE prestamo SET ESTADOPR=? WHERE ID_L=? AND ID_U=? AND ESTADOPR=?");
    $stmt->bind_param('ssss', $NewSt, $IDL, $IDU, $OldST);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE libros SET STATUS=? WHERE ID_L=?");
    $stmt->bind_param('ss', $Status, $IDL);
    $stmt->execute();
    
    header("Location: ../PRINCIPAL/SOLICITUDES");

?>
