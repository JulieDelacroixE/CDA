<?php 

require_once '../src/connexion_db.php';
require_once '../Models/Disc_Model.php';

$disc = new DiscModel;
$liste = $disc->getAllDisc();
?>