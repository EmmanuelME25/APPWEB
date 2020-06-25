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
		$IDA = $IDD;
	} else {
		$stmt = $conn->prepare("UPDATE prestamo SET COMENTDUENO=?, CALIFDUENO=?, ESTADOPR=? WHERE ID_L=? AND ID_U=? AND ESTADOPR!=? AND CALIFDUENO IS NULL");
		$IDA = $IDP;
	}
	
	$stmt->bind_param("ssssss",$Comment, $Calif, $NewState, $IDL, $IDP, $OldState);
	$stmt->execute();
	
	if($IDP == $IDA){
		$Status = 'DISPONIBLE';
		$stmt = $conn->prepare("UPDATE libros SET STATUS=? WHERE ID_L=?");
		$stmt->bind_param("ss",$Status, $IDL);
		$stmt->execute();
	}
	
	$stmt = $conn->prepare("UPDATE usuarios SET `NUMPRESTAS` = `NUMPRESTAS`+1 WHERE `ID_U`=?");
	$stmt->bind_param("s",$IDA);
	$stmt->execute();
	
	$stmt = $conn->prepare("UPDATE usuarios SET `CALIFUSER` = ((`CALIFUSER`*(`NUMPRESTAS`-1)+5)/`NUMPRESTAS`) WHERE `ID_U`=?");
	$stmt->bind_param("s",$IDA);
	$stmt->execute();
	
	header("Location: ../PRINCIPAL");
	
?>
