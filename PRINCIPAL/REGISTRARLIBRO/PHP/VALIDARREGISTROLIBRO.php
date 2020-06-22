<?php
// Always start this first
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    $IDUser = $_SESSION['user_id'];
} else {
    // Redirect them to the login page
    header("Location: ../../");
}

include 'RandomStr.php';
echo "<head>
        <link rel='stylesheet' type='text/css' href='../CSS/REGISTROCSS.css' media='screen'/>
        <meta charset='UTF-8'>
        </head>";

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
        
        $INSERTL = "INSERT into libros (ID_L, TITULO, EDICION, EDITORIAL, AUTOR, ESTADO, BookPic) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $INSERTR = "INSERT into lib_us (ID_U, ID_L) VALUES (?,?)";
       
        $stmt = $conn->prepare($INSERTL);
        $stmt->bind_param("sssssss", $newID, $Titulo, $Edicion, $Editorial, $Autor, $Estado, $Foto);
        $stmt->execute();
        
        $stmt = $conn->prepare($INSERTR);
        $stmt->bind_param("ss", $IDUser, $newID);
        $stmt->execute();
        
        echo '<script type="text/javascript">
                alert("¡Felicidades! Se ha registrado exitosamente")
                window.location.href = "../";;
                </script>';
        
        $stmt->close();
    }
    
} else {
    echo "Registro incorrecto, es necesario llenar todos los campos";
    die();
}

?>
