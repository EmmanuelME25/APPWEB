<?php
    // You'd put this code at the top of any "protected" page you create

    // Always start this first
    session_start();

    include "../../PHP/VerifySession.php";
    include "../../PHP/Connect.php";
    
    $IDU = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM lib_us WHERE ID_U=?");
    $stmt->bind_param("s",$IDU);
    $stmt->execute();
    $result = $stmt->get_result();

?>
<html>

    

    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../CSS/pages.css" media="screen"/>
        <title>Préstamos</title>
    </head>
    <body>
		<div class='Cuadrado'></div>
		<div id="left">
			<h1 class="1">En proceso de aceptación</h1><hr>
			<table>
				<form name='respuesta' action='../../PHP/ResponderSolicitud.php' method='POST'>
			<?php
				//Mostrar los libros del usuario actual que esten en solicitud
				while($row = mysqli_fetch_array($result)){
					$IDL = $row['ID_L'];
					
					//Pedir información del libro
					$stmt = $conn->prepare("SELECT * FROM libros WHERE ID_L=?");
					$stmt->bind_param("s",$IDL);
					$stmt->execute();
					$Libro = $stmt->get_result();
					$Libro = $Libro->fetch_object();
					
					//Si el libro está en solicitud
					if($Libro->STATUS=='SOLICITADO'){
						
						//Obtener ID del usuario que solicita el libro
						$stmt = $conn->prepare("SELECT * FROM prestamo WHERE ID_L=?");
						$stmt->bind_param("s",$IDL);
						$stmt->execute();
						$IDUP = $stmt->get_result();
						$IDUP = $IDUP->fetch_object();
						$IDUP = $IDUP->ID_U;
						
						//Obtener información del usuario que solicita el libro
						$stmt = $conn->prepare("SELECT * FROM usuarios WHERE ID_U=?");
						$stmt->bind_param("s",$IDUP);
						$stmt->execute();
						$UP = $stmt->get_result();
						$UP = $UP->fetch_object();

						$Imagen = $Libro->BookPic;
						$Titulo = $Libro->TITULO;
						$Autor = $Libro->AUTOR;
						$NombreUP = $UP->NOMBRE;
						$AP1UP = $UP->APELLIDO1;
						$AP2UP = $UP->APELLIDO2;
				
							echo "  
											<tr><td><div style='padding: 10; align-content: center;'>
												<img src=$Imagen height=240 width=135 style='object-fit: cover'>
											</div></td><td><div style='padding: 10; align-content: center;'>
												$Titulo
												<br>
												Autor: $Autor
												<br><br>
												Solicitado por: $NombreUP $AP1UP $AP2UP
											</div></td><td><div style='padding: 10; align-content: center;'>
												Establece una fecha de devolución: <br>
												<input type='date' name='Fecha'><input type='time' name='Hora'>
												<button type='submit' name='Presta' value=$IDL>Prestar libro</button>
											</div></td><td><div style='padding: 10; align-content: center;'>
												<button type='submit' name='NoPresta' value=$IDL>No prestar libro</button>
											</div></td>
										";
						
				}
				echo "</tr>";
			}
			?>
				</form>
			</table>
        </div>
        
        <div id="right">
			<h1 class="1">Previamente aceptados</h1><hr>
			<table>
				<form name='respuesta' action='../../PHP/ResponderSolicitud.php' method='POST'>
			<?php
				$stmt = $conn->prepare("SELECT * FROM lib_us WHERE ID_U=?");
				$stmt->bind_param("s",$IDU);
				$stmt->execute();
				$result = $stmt->get_result();
				
				while($row = mysqli_fetch_array($result)){
					$IDL = $row['ID_L'];
					
					//Pedir información del libro
					$stmt = $conn->prepare("SELECT * FROM libros WHERE ID_L=?");
					$stmt->bind_param("s",$IDL);
					$stmt->execute();
					$Libro = $stmt->get_result();
					$Libro = $Libro->fetch_object();
					
					$Cancel = 'CANCELADO';
					
					$stmt = $conn->prepare("SELECT * FROM prestamo WHERE ID_L=? AND ESTADOPR!=?");
					$stmt->bind_param("ss",$IDL, $Cancel);
					$stmt->execute();
					$LibroP = $stmt->get_result();
					$LibroP = $LibroP->fetch_object();
					$YC = $LibroP->COMENTPREST;
					
					//Si el libro está en solicitud
					if($LibroP->ESTADOPR=='PRESTADO' || $LibroP->ESTADOPR=='DEVUELTO'){
						
						$PEs = $LibroP->ESTADOPR;
						
						//Obtener ID del usuario que solicita el libro
						$stmt = $conn->prepare("SELECT * FROM prestamo WHERE ID_L=?");
						$stmt->bind_param("s",$IDL);
						$stmt->execute();
						$IDUP = $stmt->get_result();
						$IDUP = $IDUP->fetch_object();
						$IDUP = $IDUP->ID_U;
						
						//Obtener información del usuario que solicita el libro
						$stmt = $conn->prepare("SELECT * FROM usuarios WHERE ID_U=?");
						$stmt->bind_param("s",$IDUP);
						$stmt->execute();
						$UP = $stmt->get_result();
						$UP = $UP->fetch_object();

						$Imagen = $Libro->BookPic;
						$Titulo = $Libro->TITULO;
						$Autor = $Libro->AUTOR;
						$NombreUP = $UP->NOMBRE;
						$AP1UP = $UP->APELLIDO1;
						$AP2UP = $UP->APELLIDO2;
				
							echo "  
											<tr><td><div style='padding: 10; align-content: center;'>
												<img src=$Imagen height=240 width=135 style='object-fit: cover'>
											</div></td><td><div style='padding: 10; align-content: center;'>
												$Titulo
												<br>
												Autor: $Autor
												<br><br>
												Solicitado por: $NombreUP $AP1UP $AP2UP
												<br><br>
												$PEs
											</div></td><td><div style='padding: 10; align-content: center;'>
												Comentarios del usuario: <br><i> $YC </i>
											</div></td>
										";
						
				}
				echo "</tr>";
			}
			?>
				</form>
			</table>
        </div>
		<div class='Cuadrado'></div>
	<div class='Cuadrado1'></div>
    </body>
    </html>
    <a href="../" target="_self"><img src="../../IMAGENES/logo.png" class="logoprinc" alt="Logo" width=50 height=50></a>
</html>
