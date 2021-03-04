<?php 

require_once '../src/connexion_db.php';
require_once '../Models/Disc_Model.php';
//Récupération de l'id en GET
if (isset($_GET['id'])) {
    $disc_id = $_GET['id'];
}
$disc = new DiscModel;
$details = $disc->getDiscDetail($disc_id);
?>