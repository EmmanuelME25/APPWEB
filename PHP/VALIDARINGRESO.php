<?PHP
 session_start();
 
$host = "localhost";
$usDb = "root";
$passDb = "";
$dbName = "CLASSMATEBOOKING";
    
$conn = new mysqli($host, $usDb, $passDb, $dbName);

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$Mail = $_POST["correo"];
$Contrasena = $_POST["contrasena"];

$query = mysqli_query($conn,"SELECT * FROM usuarios WHERE CORREO = '".$Mail."'");
$nr = mysqli_num_rows($query);

if($nr == 1){
    
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE CORREO = ?");
    $stmt->bind_param('s', $Mail);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_object();
    
    if(password_verify($Contrasena, $user->PASSHASH)){
        $_SESSION['user_id'] = $user->ID_U;
        header("Location: ../PRINCIPAL");
    } else {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}

?>
