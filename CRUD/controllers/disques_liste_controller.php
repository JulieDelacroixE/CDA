<?php
require_once '../src/connexion_db.php';

$requeteAff = 'SELECT disc_id, disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id FROM disc';
$result = $db->prepare($requeteAff);
$result->execute();

if ($result->rowCount() == 0)
{
    // Pas d'enregistrement
    die("La table est vide");
}
?>