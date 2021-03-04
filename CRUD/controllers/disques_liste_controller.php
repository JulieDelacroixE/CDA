<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once '../src/connexion_db.php';
//Requête pour affichage de la liste des disques
$requeteAff = 'SELECT disc_id, disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id FROM disc';
$result = $db->prepare($requeteAff);
$result->execute();
//Si aucune ligne
if ($result->rowCount() == 0)
{
    // Pas d'enregistrement
    die("La table est vide");
}
?>