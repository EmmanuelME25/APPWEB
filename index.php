<?php
// Always start this first
session_start();

// Destroying the session clears the $_SESSION variable, thus "logging" the user
// out. This also happens automatically when the browser is closed
session_destroy();
?>

<html>
<head>
<title>Classmatebooking</title>
<link rel="stylesheet" type="text/css" href="CSS/INDEXCSS.css" media="screen"/>
<meta charset="UTF-8">

</head>

<body bgcolor=A3D58C>
<div class="iniciosesion">

<img src="IMAGENES/logo.png" class="logoprinc" alt="Logo">
 <h1>Inicie sesión</h1>

<form name="formI" method="POST" action="PHP/VALIDARINGRESO.php" name="initialpage">

	<label for="username">Usuario</label>
	<input type="email" name="correo" placeholder="Ingrese correo" required="Campo obligatorio">

	<label for="password">Constraseña</label>
	<input type="password" name="contrasena" placeholder="Ingrese contraseña" required="Campo obligatorio">
	
	<input type="submit" value="Inicia Sesión" class=button1>
	
<a href="REGISTRO.html" target="_self"> ¿No tienes un usuario?</a></center>
</font>
</form>





</body>
</html>
