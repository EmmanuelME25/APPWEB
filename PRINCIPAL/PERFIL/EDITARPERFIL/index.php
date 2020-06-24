<?php
    // You'd put this code at the top of any "protected" page you create

    // Always start this first
    session_start();
    
    include "../../../PHP/VerifySession.php";
    include "../../../PHP/Connect.php";
    include "../../../PHP/GetSessionData.php";
    
?>

<html>
<head>

<title> Editar perfil </title>

<link rel="stylesheet" type="text/css" href="../../../CSS/REGISTROCSS.css" media="screen"/>
<meta charset="UTF-8">

</head>

<body bgcolor=#659FB6>

<div class="registro">
    <h1>Edita tu perfil</h1>
    <?php
    
    echo "
<form name='formE' action ='EditarPerfil.php' method='POST'>
 <label for='nombre'>Nombre</label>
<input type='text' name='nombre' required='required' placeholder='Ingrese su nombre'  value=$Nombre>
 <label for='apellido1'>Apellido 1</label>
<input type='text' name='apellido1' required='required' placeholder='Ingrese su primer apellido' value=$Ap1> 
 <label for='apellido2'>Apellido 2</label>
<input type='text' name='apellido2' placeholder='Ingrese su segundo apellido' value=$Ap2>
 <label for='telefono'>Telefono</label> 
<input type='text' name='telefono' required='required' placeholder='Ingrese su número de teléfono' value=$Numero>
 <label for='contraseña'>Confirmar contraseña</label>
<input type='password' name='contrasena' required='required' placeholder='Confirme su contraseña'>
<input type='url' name='imagen' placeholder='Cambiar imagen de perfil' value=$FotoPerf>

<input type='submit' value='Editar perfil' class=button3>"
?>

</div>
</form>
</body>
</html>

<a href="../" target="_self"><img src="../../../IMAGENES/logo.png" class="logoprinc" alt="Logo" width=50 height=50></a>
