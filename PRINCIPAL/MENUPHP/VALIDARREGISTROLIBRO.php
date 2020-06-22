<?php
include 'RandomStr.php';
echo "<head>";
echo "<link rel='stylesheet' type='text/css' href='../CSS/REGISTROCSS.css' media='screen'/>";
echo "<meta charset='UTF-8'>";
echo "</head>";

$Titulo = $_POST["titulo"];
$Autor = $_POST["autor"];
$Editorial = $_POST["editorial"];
$Edicion = $_POST["edicion"];
$Estado = $_POST["estado"];
$Foto = $_POST["Imagen"];
$Cero = 0;

if(!empty($Titulo) || !empty($Autor) || !empty($Editorial) || !empty($Edicion) || !empty($Estado)){
    $host = "localhost";
    $usDb = "root";
    $passDb = "";
    $dbName = "CLASSMATEBOOKING";
    
    $conn = new mysqli($host, $usDb, $passDb, $dbName);
    mysqli_set_charset($conn, "utf8");
    
    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    } else {
        $newID = random_str(10);
        $SELID= "SELECT ID_L From libros Where ID_L=? Limit 1";
        
        while(1){
            $stmt = $conn->prepare($SELID);
            $stmt->bind_param("s",$newID);
            $stmt->execute();
            $stmt->bind_result($newID);
            $stmt->store_result();
            $rnum = $stmt->num_rows;
            
            if($rnum==0){
                break;
            } else {
                $newID = random_str(10);
            }
            
        }
        
        $Hash=password_hash($Contrasena, PASSWORD_DEFAULT);
        
        $SELMAI = "SELECT CORREO From usuarios Where CORREO=? Limit 1";
        $INSERT = "INSERT into libros (ID_L, TITULO, EDICION, EDITORIAL, AUTOR, ESTADO, BookPic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($SELMAI);
        $stmt->bind_param("s",$Corr);
        $stmt->execute();
        $stmt->bind_result($Corr);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        
        if($rnum==0){
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssssssssii", $newID, $Titulo, $Edicion, $Editorial, $Autor, $Estado, $Foto);
            $stmt->execute();
            echo '<script type="text/javascript">'; 
            echo 'alert("¡Felicidades! Se ha registrado exitosamente");'; 
            echo 'window.location.href = "../";';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">'; 
            echo 'window.location.href = "../index.php";';
            echo '</script>';
        }
        $stmt->close();
    }
    
} else {
    echo "Registro incorrecto, es necesario llenar todos los campos";
    die();
}

?>