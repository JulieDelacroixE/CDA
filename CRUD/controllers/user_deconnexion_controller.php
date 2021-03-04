<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

unset($_SESSION["id"]);
unset($_SESSION["pseudo"]);
unset($_SESSION["mail"]);
header("Location:../views/disques_liste.php");
exit;

?>