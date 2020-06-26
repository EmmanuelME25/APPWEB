<?php
    // You'd put this code at the top of any "protected" page you create

    // Always start this first
    session_start();

    include "../../PHP/VerifySession.php";
    include "../../PHP/Connect.php";
    
    $IDU = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM prestamo WHERE ID_U=?");
    $stmt->bind_param("s",$IDU);
    $stmt->execute();
    $result = $stmt->get_result();

?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../CSS/pages.css" media="screen"/>
        <title>Solicitudes</title>
    </head>
    <body>
		<div id="left">
			<h1 class="1">Solicitudes</h1><hr>
			<table>
					<form name='solicitados' action='../../PHP/CancelarSolicitud.php' method='POST'>
				<?php
					while($row = mysqli_fetch_array($result)){
						$IDL = $row['ID_L'];

						if($row['ESTADOPR'] == 'SOLICITADO'){

							$stmt = $conn->prepare("SELECT * FROM libros WHERE ID_L=?");
							$stmt->bind_param("s",$IDL);
							$stmt->execute();
							$Libro = $stmt->get_result();
							$Libro = $Libro->fetch_object();

							$stmt = $conn->prepare("SELECT * FROM lib_us WHERE ID_L=?");
							$stmt->bind_param("s",$IDL);
							$stmt->execute();
							$Dueno = $stmt->get_result();
							$Dueno = $Dueno->fetch_object();

							$stmt = $conn->prepare("SELECT * FROM usuarios WHERE ID_U=?");
							$stmt->bind_param("s",$Dueno->ID_U);
							$stmt->execute();
							$Dueno = $stmt->get_result();
							$Dueno = $Dueno->fetch_object();

							$Imagen = $Libro->BookPic;
							$Titulo = $Libro->TITULO;
							$Autor = $Libro->AUTOR;
							$NombreU = $Dueno->NOMBRE;
							$AP1U = $Dueno->APELLIDO1;
							$AP2U = $Dueno->APELLIDO2;
					
								echo "  
												<tr><td>
													<div style='padding: 10; align-content: center;'>
														<img src=$Imagen height=240 width=135 style='object-fit: cover;'>
														</td><td>
														$Titulo
														<br>
														Autor: $Autor
														<br><br>
														Propietario: $NombreU $AP1U $AP2U
													</div>
												</td><td>
													<div style='padding: 20; align-content: center; position:relative;'>
														<button type='submit' name='Libro' value=$IDL>Cancelar solicitud</button>
													</div>
												</td>";
							
					}
					echo "</tr>";
				}
				?>
					</form>
				</table>
		</div>
		<div id="right"><h1 class="2">Aceptadas</h1><hr>
		
			<table>
				<?php
					$stmt = $conn->prepare("SELECT * FROM prestamo WHERE ID_U=?");
					$stmt->bind_param("s",$IDU);
					$stmt->execute();
					$result = $stmt->get_result();
					while($row = mysqli_fetch_array($result)){
						$IDL = $row['ID_L'];

						if($row['ESTADOPR'] == 'PRESTADO' || $row['ESTADOPR'] == 'DEVUELTO'){
							$EstadoTP = $row['ESTADOPR'];
							$YC = $row['COMENTDUENO'];
							
							$stmt = $conn->prepare("SELECT * FROM libros WHERE ID_L=?");
							$stmt->bind_param("s",$IDL);
							$stmt->execute();
							$Libro = $stmt->get_result();
							$Libro = $Libro->fetch_object();

							$stmt = $conn->prepare("SELECT * FROM lib_us WHERE ID_L=?");
							$stmt->bind_param("s",$IDL);
							$stmt->execute();
							$Dueno = $stmt->get_result();
							$Dueno = $Dueno->fetch_object();

							$stmt = $conn->prepare("SELECT * FROM usuarios WHERE ID_U=?");
							$stmt->bind_param("s",$Dueno->ID_U);
							$stmt->execute();
							$Dueno = $stmt->get_result();
							$Dueno = $Dueno->fetch_object();

							$Imagen = $Libro->BookPic;
							$Titulo = $Libro->TITULO;
							$Autor = $Libro->AUTOR;
							$NombreU = $Dueno->NOMBRE;
							$AP1U = $Dueno->APELLIDO1;
							$AP2U = $Dueno->APELLIDO2;
					
								echo "  
												<tr><td>
													<div style='padding: 10; align-content: center;'>
														<img src=$Imagen height=240 width=135 style='object-fit: cover;'>
														</td><td></div><div style='padding: 10; align-content: center;'>
														$Titulo
														<br>
														Autor: $Autor
														<br><br>
														Propietario: $NombreU $AP1U $AP2U
														<br><br>
														$EstadoTP
													</div>
												</td><td>
													<div style='padding: 20; align-content: center; position:relative;'>
														Comentario del dueño:<br><i> $YC </i>
													</div>
												</td>";
							
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
	<a href="../" target="_self"><img src="../../IMAGENES/logo.png" class="logoprinc" alt="Logo" width=50 height=50></a>
</html>
