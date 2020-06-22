<html>
<head>

<title> Editar perfil </title>

<link rel="stylesheet" type="text/css" href="../../../CSS/REGISTROCSS.css" media="screen"/>
<meta charset="UTF-8">

</head>

<body bgcolor=#659FB6>

<div class="registro">
    <h1>Edita tu perfil</h1>
<form name="formE" action ="" method="POST">
 <label for="nombre">Nombre</label>
<input type="text" name="nombre" required="required" placeholder="Ingrese su nombre">
 <label for="apellido1">Apellido 1</label>
<input type="text" name="apellido1" required="required" placeholder="Ingrese su primer apellido"> 
 <label for="apellido2">Apellido 2</label>
<input type="text" name="apellido2" placeholder="Ingrese su segundo apellido">
 <label for="telefono">Telefono</label> 
<input type="text" name="telefono" required="required" placeholder="Ingrese su número de teléfono">
 <label for="ccontraseña">Confirmar contraseña</label>
<input type="password" name="confirmarcontrasena" required="required" placeholder="Confirme su contraseña">
<input type="url" name="imagen" placeholder="Cambiar imagen de perfil">

<input type="submit" value="Registrarse" class=button3>

<a href="../APPWEB" target="_self"> ¿Ya tienes un usuario?</a>
</div>
</form>
</body>
</html>
