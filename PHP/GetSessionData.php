<?php
    
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE ID_U = ?");
    $stmt->bind_param('s', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_object();
        
    $FotoPerf = $user->ProfPic;
    $Nombre = $user->NOMBRE;
    $Ap1 = $user->APELLIDO1;
    $Ap2 = $user->APELLIDO2;
    $NPr = $user->NUMPRESTAS;
    $Calif = $user->CALIFUSER;
    $Numero = $user->TELEFONO;

?>
