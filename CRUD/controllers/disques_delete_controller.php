<?php

require_once '../src/connexion_db.php'; 

$disc_id = "";
if(isset($_GET["id"])){
    $disc_id = $_GET["id"];
}

$requeteDel = "DELETE FROM disc WHERE disc_id = ?";
try {
    $stmt = $db->prepare($requeteDel);
    $stmt->execute(array($disc_id));
}
catch (Exception $e) {
   print "Erreur ! " . $e->getMessage() . "<br/>";
}

header("Location:../views/disques_liste.php");
     exit;
?>