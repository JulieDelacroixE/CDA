<?php
require_once '../src/connexion_db.php';

$disc_id="";
if(isset($_GET["id"])){
    $disc_id = $_GET["id"];
}

$reqDet = "SELECT disc_id, disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist.artist_id, artist_name FROM disc JOIN artist ON disc.artist_id = artist.artist_id WHERE disc_id = ?";

$result = $db->prepare($reqDet);
$result->execute(array($disc_id));
$disc = $result->fetch(PDO::FETCH_OBJ);
$result->closeCursor();

?>