<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

include "../PHP/VerifySession.php";
include "../PHP/Connect.php";

$IDU = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * from libros");
$stmt->execute();
$result = $stmt->get_result();

$stmt = $conn->prepare("SELECT * FROM prestamo");
$stmt->execute();
$prestamos = $stmt->get_result();

while($linea = mysqli_fetch_array($prestamos)){
	$fechaa = (new \DateTime())->format('Y-m-d H:i:s');
	$fechaf = $linea['FECHAFIN'];
	if ($fechaa>$fechaf and $linea['ESTADOPR']=='PRESTADO'){
		$Pop = true;
	} else {
		$Pop = false;
	}
	
}

//if(1) header("#popup1");

?>
<html>
    <head>
		<?php
			if($Pop) 
			echo 	"<script>
									function PopStar(){
										document.getElementById('PopStarT').click();
									}
									window.onload = PopStar;
						</script>";
				?>
			
        <meta charset="UTF-8">
        <title>Classmatebooking</title>
        <link rel="stylesheet" href="../CSS/PRINCIPALCSS.css">
    </head>
    
    <body>
        <div id="titulo">
            <b><p id="header">Classmatebooking</p>
        </div>

        <header>
           
            <div class="contenedor" id="dos">
                <a href="SOLICITUDES/"><img class="icon" src="IMAGENES_MENU/logo.png"></a>
                <p class="texto">Solicitudes</p>
            </div>

            <div class="contenedor" id="tres">
                <a href="PERFIL/"><img class="icon" src="IMAGENES_MENU/perfil.png"></a>
                <p class="texto">Perfil</p>
            </div>

            <div class="contenedor" id="cuatro">

                <a href="PRESTAMOS/"><img class="icon" src="IMAGENES_MENU/prestados.png"></a>
                <p class="texto">Préstamos</p>
            </div>

            <div class="contenedor" id="cinco">
                <a href="REGISTRARLIBRO/"><img class="icon" src="IMAGENES_MENU/registro.png"></a>
                <p class="texto">Registro</p>
            </div>
			
			<div class="contenedor" id="uno">
                <a href="../"><img class="icon" src="IMAGENES_MENU/cerrar.png"></a>
                <p class="texto">Cerrar sesión</p>
            </div>

        </header>
        <?php
        echo "  <table style='padding:10px; padding-left:150px'>
                        <form name='Solicitar' action='../PHP/SolicitarLibro.php' method='POST'>
                            <tr>";
        
        $I=0;
        
        while($row = mysqli_fetch_array($result)){
            $I = $I+1;
            $Titulo = $row['TITULO'];
            $Autor = $row['AUTOR'];
            $Imagen = $row['BookPic'];
            $IDLib = $row['ID_L'];
            $Status = $row['STATUS'];
            
            if($Status=='DISPONIBLE'){

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
                
                if($I%7==0) echo "</tr><tr>";
    
                echo "  
                                <td id='tablalibros'>
                                    <img src=$Imagen height=240 width=135 style='object-fit: cover'>
                                    <br><br>
                                    $Titulo
                                    <br><br>
                                    Autor: $Autor
                                    <br><br>
                                    Propietario: $NombreU $AP1U $AP2U
                                    <br><br>";

                //Si el libro no es del usuario actual
                if($IDU != $IDUs){
                    echo "<button type='submit' name='Libro' value=$IDLib>Solicitar</button>";
                }
                echo "</td>";
               }
        }

        echo "</form></tr></table>";

        $stmt->close();
    ?>
    
    
    
    <div id="popup1" class="overlay">
		<div class="popup">
			<h2>Califica al usuario</h2>
			<a class="close" href="#">&times;</a>
			<div class="content">
				<input type='radio'><input type='radio'><input type='radio'><input type='radio'><input type='radio'>
			</div>
		</div>
	</div>
    
		<!-- Este <a> es importante!  -->
		<a href="#popup1" id='PopStarT'></a>

	
    
    </body>
</html>
