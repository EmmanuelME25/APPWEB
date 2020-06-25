<?php
    // You'd put this code at the top of any "protected" page you create

    // Always start this first
    session_start();
    
    include "../../PHP/VerifySession.php";
    include "../../PHP/Connect.php";
    include "../../PHP/GetSessionData.php";
    
    if(empty($FotoPerf)) $FotoPerf = '../../IMAGENES/NoPhoto.jpeg';
    
    $Calif = round($Calif, 1);
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="CSS/index.css" media="screen"/>
        <title>Mi perfil</title>
    </head>
<body>
		
<div class="container">
  <div class="card">
    <div class="front">
      <div class="logo"> <?php
        echo "<img src='$FotoPerf' height=250 width=250>";
    ?><span></span></div>
    </div>
	
    <div class="back">
	
      <h1><?php
        echo "$Nombre $Ap1 $Ap2";
    ?><span>Usuario</span></h1>
	<br>
	
	
      <ul>
        <li><?php
        echo "$Numero";
    ?></li>
        <li>
		<a href="EDITARPERFIL/">Editar perfil</a>
	</li>
        <li><?php
        echo "Has tenido $NPr intercambios";
        echo "<br>";
        echo "Tu calificación actual es $Calif ★";
    ?></li>
        </ul>
		
    </div>
    </div>
  </div>
  <a href="../" target="_self"><img src="../../IMAGENES/logo.png" class="logoprinc" alt="Logo" width=50 height=50></a>
</body>
</html>
