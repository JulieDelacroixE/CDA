<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once '../src/connexion_db.php';
if(isset($_GET["id"])){
    $disc_id = $_GET["id"];
}

//Affichage données actuelles
$requeteAffichage = "SELECT disc_id, disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, disc.artist_id, artist_name FROM disc 
JOIN artist ON artist.artist_id = disc.artist_id
WHERE disc_id = ?";

$result = $db->prepare($requeteAffichage);
$result->execute(array($disc_id));
$disque = $result->fetch(PDO::FETCH_OBJ);
$result->closeCursor();




// Verif données + redefinition variables

$discTitle = $discYear = $discLabel = $discPrice = $discArtist = $discGenre = $photo = "";
$discTitle_error = $discYear_error = $discLabel_error = $discPrice_error = $photo_error = $discGenre_error = $artist_error = $photo_error = "";

//Fonction filtre
function valid_donnees($donnees){
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}


if (!empty($_POST["submit"])) {
    if (!empty($_FILES["photo"])) {
        if ($_FILES["photo"]["error"] === UPLOAD_ERR_OK) 
        {
            //Vérification extension du fichier
                $aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/x-png", "image/tiff", "image/png");
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimetype = finfo_file($finfo, $_FILES["photo"]["tmp_name"]);
                    finfo_close($finfo);
                    if (in_array($mimetype, $aMimeTypes)) 
                    {
                        //Suppression de l'ancienne image si existante
                        unlink('../src/pictures/'.$discTitle.".".$extension);
                        $tmp_name = $_FILES["photo"]["tmp_name"];
                        $extension = substr(strrchr($_FILES["photo"]["name"], "."), 1);
                        move_uploaded_file($_FILES["photo"]["tmp_name"], "../src/pictures/".$discTitle.".".$extension);
                        $photo = $discTitle.".".$extension;
                    }
                    else {
                        exit("Type de fichier non autorisé");
                    }
                        
        }   
    }
    else {
    $photo = $disque->disc_picture;
    }

    if (!empty($_POST['title-input']) && preg_match("#[a-zA-Z]{1,10}#", $_POST['title-input']))
    {     
        $discTitle = valid_donnees($_POST['title-input']);
    }
    else if (empty($_POST['title-input'])) {

        $discTitle = $disque->disc_title;
    }
    else if (!preg_match("#[a-zA-Z]{1,10}#", $_POST['title-input'])) {
        $discTitle_error = "Entrez un titre valide";
    }
    if (!empty($_POST['year-input']) && preg_match("#[0-9]{4}#", $_POST['year-input'])) 
    {
        $discYear = valid_donnees($_POST['year-input']);
    }
    else if (empty($_POST['year-input'])) {  
        $discYear = $disque->disc_year;
    }
    else if (!preg_match("#[0-9]{4}#", $_POST['year-input'])) {
        $discYear_error = "Entrez une année valide";
    }
    if (!empty($_POST['label-input']) && preg_match("#[a-zA-Z]{1,200}#", $_POST['label-input'])) 
    {
        $discLabel = valid_donnees($_POST['label-input']);
    }
    else if (empty($_POST['label-input'])) {   
        $discLabel = $disque->disc_label;
    }
    else if (!preg_match("#[a-zA-Z]{1,200}#", $_POST['label-input'])) {
        $discLabel_error = "Entrez une description valide";
    }
    if (!empty($_POST['price-input']) && preg_match("#[0-9]{1,6}[.]*[0-9]{0,2}#", $_POST['price-input'])) 
    {
        $discPrice = valid_donnees($_POST['price-input']);
    }
    else if (empty($_POST['price-input'])){
        $discPrice = $disque->disc_price;
    }
    else if (!preg_match("#[0-9]{1,6}[.]*[0-9]{0,2}#", $_POST['price-input'])) {
        $discPrice_error = "Entrez un prix valide.";
    }
    if (!empty($_POST['genre-input']) && preg_match("#[a-zA-Z]{0,30}#", $_POST['genre-input'])) 
    {
        $discGenre = valid_donnees($_POST['genre-input']);
    }
    else if (empty($_POST['genre-input'])) {
       
        $discGenre = $disque->disc_genre;
    }
    else if (!preg_match("#[a-zA-Z]{0,30}#", $_POST['genre-input'])) {
        $discGenre_error = "Entrez un prix valide.";
    }
    if (!empty($_POST['artist-select'])) 
    {
        $discArtist = intval($_POST['artist-select']);
    }
    else {

        $discArtist = $disque->artist_id;
    }
    //Si pas d'erreur
    if (preg_match("#[ a-zA-Z '-]{1,30}#", $discTitle)
    && preg_match("#[0-9]{4}#", $discYear)
    && preg_match("#[a-zA-Z]{1,200}#", $discLabel) 
    && preg_match("#[0-9]{1,6}.*[0-9]{0,3}#", $discPrice) 
    && preg_match("#[ a-zA-Z '-]{1,20}#", $discGenre)) {
        
        //Modification du produit dans la bdd
        //Requete
        $reqUp = "UPDATE disc SET disc_title = ?, disc_year = ?, disc_label = ?, disc_price = ?, disc_genre = ?, artist_id = ?, disc_picture = ? WHERE disc_id = ?;";
        
        // Execution de la requete de modification 
        
        try {
            $stmt = $db->prepare($reqUp);
            
            $stmt->execute(array($discTitle, $discYear, $discLabel, $discPrice, $discGenre, $discArtist, $photo, $disc_id));
        }
        
        catch (Exception $e) {
            print "Erreur ! " . $e->getMessage() . "<br/>";
        }  
        //Redirection
        header("Location:../views/disques_liste.php");
        exit;
    }
}

?>