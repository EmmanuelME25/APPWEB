<?php
    // You'd put this code at the top of any "protected" page you create

    // Always start this first
    session_start();

    include "../../PHP/VerifySession.php";

?>
<html>
<head>

<title>Registro de libro</title>
<link rel="stylesheet" type="text/css" href="../MENUCSS/REGISTROLIBROCSS.css" media="screen"/>
<meta charset="UTF-8">

	
</head>

<div class="regislibro">
<body bgcolor=#D5F8CD>

<img src="../IMAGENES_MENU/registro.png" class="registro" alt="Imagen_registro">

<h1>Registro de libro</h1>

<form method="POST"  action ="PHP/VALIDARREGISTROLIBRO.php" onsubmit="return validateform()">

<hr color=000000><br>
Título:<br>
<input type="text" name="titulo" required="required" placeholder="Titulo del libro">

Autor:<br>
<input type="text" name="autor" required="required" placeholder="Nombre del autor">

Editorial:<br>
<input type="text" name="editorial" required="required" placeholder="Editorial">

Edicion:<br>
<input type="text" name="edicion" required="required" placeholder="Edicion">

Imagen (Opcional):<br>
<input type="url" name="Imagen" placeholder="Link de la imagen">

Estado:<br>
<select name="estado" required="required">
<option value="Bueno">Buen estado</option>
<option value="Regular">Regular</option>
<option value="Malo">Malo</option>
</select>
<br><br>
<input type="submit" value="Registrar" class=button3> <br>

</form>
</div>
</body>
</html>
  <a href="../" target="_self"><img src="../../IMAGENES/logo.png" class="me" alt="Logo" width=50 height=50></a>

