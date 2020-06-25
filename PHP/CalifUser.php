<?php
	
	session_start();
	include "VerifySession.php";
	include "Connect.php";
	
	$UsCal = $_SESSION["Uscal"];
	$IDL = $_SESSION["LibC"];
	$IDP = $_SESSION["IDP"];
	$IDD = $_SESSION["IDD"];
	
	$Calif = $_POST['rating'];
	$Comment = $_POST['Comment'];
	$SttsC = $_POST['Calificar'];
	
	$NewState = 'DEVUELTO';
	$OldState = 'CANCELADO';
	
	if($SttsC){
		$stmt = $conn->prepare("UPDATE prestamo SET COMENTPREST=?, CALIFPREST=?, ESTADOPR=? WHERE ID_L=? AND ID_U=? AND ESTADOPR!=? AND CALIFPREST IS NULL");
	} else {
		$stmt = $conn->prepare("UPDATE prestamo SET COMENTDUENO=?, CALIFDUENO=?, ESTADOPR=? WHERE ID_L=? AND ID_U=? AND ESTADOPR!=? AND CALIFDUENO IS NULL");
	}
	
	$stmt->bind_param("ssssss",$Comment, $Calif, $NewState, $IDL, $IDP, $OldState);
	$stmt->execute();
	
	if($IDP == $UsCal){
		$Status = 'DISPONIBLE';
		$stmt = $conn->prepare("UPDATE libros SET STATUS=? WHERE ID_L=?");
		$stmt->bind_param("ss",$Status, $IDL);
		$stmt->execute();
	}
	
	$stmt = $conn->prepare("SELECT * FROM usuarios WHERE ID_U=?");
	$stmt->bind_param("s",$UsCal);
	$stmt->execute();
	$DataU = $stmt->get_result();
	$DataU = $DataU->fetch_object();
	
	$OldC = $DataU->CALIFUSER;
	$NPr = $DataU->NUMPRESTAS;
	$NPr = $NPr + 1;
	$NewC = ($OldC*($NPr-1)+$Calif)/$NPr;
	
	$stmt = $conn->prepare("UPDATE usuarios SET CALIFUSER=?, NUMPRESTAS=? WHERE ID_U=?");
	$stmt->bind_param("sss",$NewC, $NPr, $UsCal);
	$stmt->execute();
	
	header("Location: ../PRINCIPAL");
	
?>
