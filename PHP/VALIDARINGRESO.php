<?PHP
 
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

$Hash=password_hash($Contrasena, PASSWORD_DEFAULT);

$query = mysqli_query($conn,"SELECT * FROM usuarios WHERE CORREO = '".$Mail."' and PASSHASH = '".$Hash."'");
$nr = mysqli_num_rows($query);

if($nr == 1){
    $_SESSION['user_id'] = "SELECT ID_U FROM usuarios WHERE CORREO = '".$Mail."'";
    header("Location: ../PRINCIPAL.html");
} else {
    header("Location: ../index.html");
}

?>
