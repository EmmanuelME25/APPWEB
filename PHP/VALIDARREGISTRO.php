<?php
include 'RandomStr.php';
$Nombre = $_POST["nombre"];
$Papellido = $_POST["apellido1"];
$Sapellido = $_POST["apellido2"];
$Corr = $_POST["correo"];
$Contrasena = $_POST["contrasena"];
$Numero = $_POST["telefono"];

if(!empty($Nombre) || !empty($Papellido) || !empty($Sapellido) || !empty($Corr) || !empty($Contrasena) || !empty($Numero)){
    $host = "localhost";
    $usDb = "root";
    $passDb = "";
    $dbName = "CLASSMATEBOOKING";
    
    $conn = new mysqli($host, $usDb, $passDb, $dbName);
    
    if(mysqli_connect_error()){
        die('Connect Error('mysqli_connect_errno().')'.mysqli_connect_error());
    } else {
        $Hash=password_hash($Contrasena, PASSWORD_ARGON2I);
        $newID = random_str(10);
        $SELID= "SELECT ID_U From usuarios Where ID_U=? Limit 1"
        
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
        
        $SELMAI = "SELECT CORREO From usuarios Where CORREO=? Limit 1"
        $INSERT = "INSERT into usuarios (ID_U, NOMBRE, APELLIDO1, APELLIDO2, CORREO, TELEFONO, PASSHASH, NUMPRESTAS, CALIFUSER) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($SELMAI);
        $stmt->bind_param("s",$Corr);
        $stmt->execute();
        $stmt->bind_result($Corr);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        
        if($rum==0){
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssssssss", $newID, $Nombre, $Papellido, $Sapellido, $Corr, $Numero, $Hash, 0,0);
            $stmt->execute();
            echo "Felicidades! Has creado tu cuenta!";
        } else {
            echo "Este correo electrónico ya se encuentra registrado. Prueba ingresar una dirección nueva";
        }
        $stmt->close();
    }
    
} else {
    echo "Registro incorrecto, es necesario llenar todos los campos";
    die();
}

?>
