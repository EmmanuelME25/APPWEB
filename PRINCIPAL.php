<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: index.html");
}
?>

<head>
    <link rel="stylesheet" type="text/css" href="CSS/PRINCIPALCSS.css" media="screen" />
    <title> Clasmatebooking </title>
</head>
<nav class="menu">
   <input type="checkbox" href="#" class="menu-open" name="menu-open" id="menu-open" />
   <label class="menu-open-button" for="menu-open">
    <span class="lines line-1"></span>
    <span class="lines line-2"></span>
    <span class="lines line-3"></span>
  </label>

   <a href="MENUPRINCIPAL/PETICIONES.php" class="menu-item blue"> <i class="fa fa-anchor"></i> </a>
   <a href="MENUPRINCIPAL/REGISTRARLIBRO.php" class="menu-item green"> <i class="fa fa-coffee"></i> </a>
   <a href="MENUPRINCIPAL/LIBROSPRESTADOS/" class="menu-item red"> <i class="fa fa-heart"></i> </a>
   <a href="MENUPRINCIPAL/PERFIL.php" class="menu-item purple"> <i class="fa fa-microphone"></i> </a>
   <a href="#" class="menu-item orange"> <i class="fa fa-star"></i> </a>
   <a href="#" class="menu-item lightblue"> <i class="fa fa-diamond"></i> </a>
</nav>
