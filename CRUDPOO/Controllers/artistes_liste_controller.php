<?php 
require '../src/connexion_db.php';
require '../Models/Artist_Model.php';

$artist = new ArtistModel;
$list = $artist->getAllArtist();
?>