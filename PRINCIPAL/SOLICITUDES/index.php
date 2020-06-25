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
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="CSS_INDICE/index.css" media="screen"/>
        <title>Solicitudes</title>
    </head>
    <body>
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
                                            <img src=$Imagen height=240 width=135 style='object-fit: cover'>
                                            </td><td>
                                            $Titulo
                                            <br>
                                            Autor: $Autor
                                            <br><br>
                                            Propietario: $NombreU $AP1U $AP2U
                                        </td><td>
                                            <button type='submit' name='Libro' value=$IDL>Cancelar solicitud</button>
                                        </td>";
                    
            }
            echo "</tr>";
        }
        ?>
            </form>
        </table>
    </body>
    </html>
    <a href="../" target="_self"><img src="../../IMAGENES/logo.png" class="logoprinc" alt="Logo" width=50 height=50></a>
	<div class='Cuadrado'></div>
	<div class='Cuadrado1'></div>
	<h1 class="1">En proceso de aceptación</h1>
	<h1 class="2">Aceptados</h1>
</html>
