<?php
    
    if ( isset( $_SESSION['user_id'] ) ) {
        
    } else {
        // Redirect them to the login page
        header("Location: ../");
    }
    
?>
