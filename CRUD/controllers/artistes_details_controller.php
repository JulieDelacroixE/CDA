<?php
require_once '../src/connexion_db.php';
// On récupère la valeur de l'id passé en GET.
if(isset($_GET["id"])) {
    $artist_id = $_GET["id"];
}

// Requête pour les détails de l'artiste séléctionné
$requeteDet = "SELECT artist.artist_id, artist_name, artist_url FROM artist WHERE artist.artist_id =:artist_id";
$stmt = $db->prepare($requeteDet);
$stmt->bindValue(':artist_id',$artist_id, PDO::PARAM_INT);
$stmt->execute();
$artist = $stmt->fetch(PDO::FETCH_OBJ);
$stmt->closeCursor();

// Requête pour l'affichage de la liste des disques de l'artiste selectionné
$requeteDisc = "SELECT disc_title, disc_id FROM disc JOIN artist ON artist.artist_id = disc.artist_id WHERE artist.artist_id =:artist_id";
$stmt2 = $db->prepare($requeteDisc);
$stmt2->bindValue(':artist_id',$artist_id, PDO::PARAM_INT);
$stmt2->execute();
?>