<?php 
require_once '../src/connexion_db.php';
require_once '../Models/Artist_Model.php';

$regExName = "#[ a-zA-Z '-]{1,30}#";
$regExUrl = "#[a-zA-Z0-9-.]{1,100}#";
$artist = new Artist;
$tabError = array();
$tabResult = array();

//Fonction filtre
function valid_donnees($donnees){
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}
//Vérification formulaire
if (isset($_POST['submit'])) {
    if(isset($_POST['name-input']) && preg_match($regExName, $_POST['name-input'])) {
        $artist->setArtistName(valid_donnees($_POST['name-input']));
    } else if (!empty($_POST['name-input']) && !preg_match($regExName, $_POST['name-input'])) {
        $tabError['name_error'] = "Entrez un nom valide.";
    } else {
        $tabError['name_error'] = "Ce champ doit être renseigné.";
    }

    if(isset($_POST['url-input']) && preg_match($regExUrl, $_POST['url-input'])) {
        $artist->setArtistUrl(valid_donnees($_POST['url-input']));
    } else if (!empty($_POST['url-input']) &&!preg_match($regExUrl, $_POST['url-input'])) {
        $tabError['url_error'] = "Entrez un nom valide.";
    } else {
        $tabError['url_error'] = "Ce champ doit être renseigné.";
    }

    if(count($tabError) === 0) {
        $artistadd = new ArtistModel;
        if($artistadd->addArtist($artist) == true) { 
            $tabResult['addArtist'] = "L'artiste a bien été ajouté";
        } else {
            $tabResult['addArtist'] = "L'artiste n'a pas pu être ajouté.";
        }
    } else {
        $tabResult['addArtist'] = "L'artiste n'a pas pu être ajouté.";
    }
}
?>