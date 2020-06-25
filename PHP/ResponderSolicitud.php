<?php
	session_start();
	include "VerifySession.php";
    include "Connect.php";
    $IDU = $_SESSION['user_id'];
    
    if(!empty($_POST['Presta'])){ //Si dio clic en prestar
		$IDL = $_POST['Presta'];
		$datetime = $_POST['Fecha'].' '.$_POST['Hora'];
		$datetime = date("Y-m-d H:i:s",strtotime($datetime));
		
		$NState = 'PRESTADO';
		$OState = 'SOLICITADO';
		
		$stmt = $conn->prepare("UPDATE prestamo SET ESTADOPR=?, FECHAFIN=? WHERE ID_L=? AND ESTADOPR=?");
		$stmt->bind_param('ssss', $NState, $datetime, $IDL, $OState);
		$stmt->execute();
		
		$stmt = $conn->prepare("UPDATE libros SET STATUS=? WHERE ID_L=?");
		$stmt->bind_param('ss', $NState, $IDL);
		$stmt->execute();
		
    } else { //Si dio clic en no prestar
		$IDL = $_POST['NoPresta'];
		$OldST = 'SOLICITADO';
		$NewSt = 'CANCELADO';
		$Status = 'DISPONIBLE';
		
		$stmt = $conn->prepare("UPDATE prestamo SET ESTADOPR=? WHERE ID_L=? AND ESTADOPR=?");
		$stmt->bind_param('sss', $NewSt, $IDL, $OldST);
		$stmt->execute();
		
		$stmt = $conn->prepare("UPDATE libros SET STATUS=? WHERE ID_L=?");
		$stmt->bind_param('ss', $Status, $IDL);
		$stmt->execute();

    }

    header("Location: ../PRINCIPAL/PRESTAMOS");
    
?>
