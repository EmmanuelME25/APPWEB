<?php
include 'RandomStr.php';
echo "<head>";
echo "<link rel='stylesheet' type='text/css' href='../CSS/REGISTROCSS.css' media='screen'/>";
echo "<meta charset='UTF-8'>";
echo "</head>";
$Nombre = $_POST["nombre"];
$Papellido = $_POST["apellido1"];
$Sapellido = $_POST["apellido2"];
$Corr = $_POST["correo"];
$Contrasena = $_POST["contrasena"];
$Numero = $_POST["telefono"];
$Foto = $_POST["imagen"];
$Cero = 0;

if(!empty($Nombre) || !empty($Papellido) || !empty($Sapellido) || !empty($Corr) || !empty($Contrasena)){
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
        $SELID= "SELECT ID_U From usuarios Where ID_U=? Limit 1";
        
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
        $INSERT = "INSERT into usuarios (ID_U, NOMBRE, APELLIDO1, APELLIDO2, CORREO, TELEFONO, PASSHASH, ProfPic, NUMPRESTAS, CALIFUSER) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($SELMAI);
        $stmt->bind_param("s",$Corr);
        $stmt->execute();
        $stmt->bind_result($Corr);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        
        if($rnum==0){
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssssssssii", $newID, $Nombre, $Papellido, $Sapellido, $Corr, $Numero, $Hash, $Foto, $Cero, $Cero);
            $stmt->execute();
            echo '<script type="text/javascript">'; 
            echo 'alert("¡Felicidades! Tu cuenta se ha registrado exitosamente");'; 
            echo 'window.location.href = "../";';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">'; 
            echo 'alert("Este correo ya se encuentra registrado. Intentalo de nuevo con una dirección distinta.");'; 
            echo 'window.location.href = "../REGISTRO.html";';
            echo '</script>';
        }
        $stmt->close();
    }
    
} else {
    echo "Registro incorrecto, es necesario llenar todos los campos";
    die();
}

?>
