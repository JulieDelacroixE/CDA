<?php
require_once '../src/connexion_db.php';

// Requête pour afficher la liste des artistes.
$requeteAff = 'SELECT artist_id, artist_name, artist_url FROM artist';
$result = $db->prepare($requeteAff);
$result->execute();

if ($result->rowCount() == 0) 
{
    // Pas d'artiste
    die("La table est vide");
}
?>