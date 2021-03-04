<?php
require_once '../src/connexion_db.php';
require_once '../Models/Artist_Model.php';
require_once '../Models/Disc_Model.php';

// On récupère la valeur de l'id passé en GET.
if(isset($_GET['id'])) {
    $artist_id = $_GET['id'];
}
$artistdet = new ArtistModel;
$discs = new DiscModel;
$artist = $artistdet->getDetails($artist_id);
$discslist = $discs->getArtistDiscList($artist_id);
?>