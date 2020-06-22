<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: ../../");
}
?>
<link rel="stylesheet" type="text/css" href="CSS/index.css" media="screen"/>

<html>
<head>

<title> </title>

</head>
<body>



</body>
</html>
  <a href="../index.php" target="_self"><img src="IMAGENES/logo.png" class="logoprinc" alt="Logo" width=50 height=50></a>

