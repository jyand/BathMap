<?php
# Ends the http session and redirects to login page
if (isset($_SESSION["UID"])) {
session_destroy() ;
}
header("Location: signin.php") ; 
die() ;
?>
