<?php 


//Connexion à la base

require_once '../src/connexion_db.php'; 

$disqueAjoute = $discTitle = $discYear = $discLabel = $discPrice = $photo = $discGenre = $artist_id = "";
$discTitle_error = $discYear_error = $discLabel_error = $discPrice_error = $photo_error = $discGenre_error = $artist_error = $photo_error = "";

// Validation des entrées du formulaire avec regex, attribution des valeurs aux variables.

//Fonction filtre
function valid_donnees($donnees){
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

if (!empty($_POST["submit"])) {
    if (!empty($_POST['title-input']) && preg_match("#[ a-zA-Z '-]{1,30}#", $_POST['title-input'])) {     
           $discTitle = valid_donnees($_POST['title-input']);  
    }  
    else {
        $discTitle_error = "Entrez un titre valide.";
    } 
    if (!empty($_POST['year-input']) && preg_match("#[0-9]{4}#", $_POST['year-input'])) 
    {
        $discYear = valid_donnees($_POST['year-input']);
    }
    else {
        $discYear_error = "Entrez une année valide";
    }
    if (!empty($_POST['label-input']) && preg_match("#[a-zA-Z]{1,200}#", $_POST['label-input'])) 
    {
        $discLabel = valid_donnees($_POST['label-input']);
    }
    else {
        $discLabel_error = "Entrez une description valide.";
    }
    if (!empty($_POST['price-input']) && preg_match("#[0-9]{1,6}.*[0-9]{0,3}#", $_POST['price-input'])) 
    {
        $discPrice = $_POST['price-input'];
    }
    else {
        $discPrice_error = "Entrez un prix valide.";
    }
    if (!empty($_POST['genre-input']) && preg_match("#[ a-zA-Z '-]{1,20}#", $_POST['genre-input'])) {     
        $discGenre = valid_donnees($_POST['genre-input']);  
    } 
    else {
        $discGenre_error = "Entrez un genre valide.";
    }  
    if (!empty($_POST['artist-select'])) 
    {
        $artist_id = intval($_POST['artist-select']);
    }
    else {
        $artist_error = "Choisissez un artiste.";
    }
    if (!empty($_FILES["photo"])) {
        // Vérification erreur upload
        if ($_FILES["photo"]["error"] === UPLOAD_ERR_OK) {
            //Extensions valides
            $aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "imagpng", "image/x-png", "image/tiff", "image/png");
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimetype = finfo_file($finfo, $_FILES["photo"]["tmp_name"]);
            finfo_close($finfo);
            //Vérification extension
            if (in_array($mimetype, $aMimeTypes)) 
            {
                $tmp_name = $_FILES["photo"]["tmp_name"];
                $extension = substr(strrchr($_FILES["photo"]["name"], "."), 1);
                //Nouvel emplacement et renommage de l'image.
                move_uploaded_file($_FILES["photo"]["tmp_name"], "../src/pictures/$discTitle.$extension");
                $photo = $discTitle.".".$extension;
            }
            else {
                exit("Type de fichier non autorisé.");    
            }
            
        }
    }
    else {
        $photo = "";
    }
    
// Enregistrement du disque dans la bdd si pas d'erreur
    
    if (!empty($_POST['title-input']) && preg_match("#[ a-zA-Z '-]{1,30}#", $discTitle)
    && !empty($_POST['year-input']) && preg_match("#[0-9]{4}#", $discYear)
    && !empty($_POST['label-input']) && preg_match("#[a-zA-Z]{1,200}#", $discLabel) 
    && !empty($_POST['price-input']) && preg_match("#[0-9]{1,6}.*[0-9]{0,3}#", $discPrice) 
    && !empty($_POST['genre-input']) && preg_match("#[ a-zA-Z '-]{1,20}#", $discGenre) 
    && !empty($_POST['artist-select'])) {

        try {     
            $reqAdd = "INSERT INTO disc(disc_title, disc_year, disc_label, disc_price, disc_genre, disc_picture, artist_id)
        VALUES (:disc_title, :disc_year, :disc_label, :disc_price, :disc_genre, :disc_picture, :artist_id)"; 
        
        $stmt = $db->prepare($reqAdd);
        $stmt->bindValue(':disc_title', $discTitle);
        $stmt->bindValue(':disc_year', $discYear, PDO::PARAM_INT);
        $stmt->bindValue(':disc_label', $discLabel);
        $stmt->bindValue(':disc_price', $discPrice);
        $stmt->bindValue(':disc_genre', $discGenre);
        $stmt->bindValue(':disc_picture', $photo);
        $stmt->bindValue(':artist_id', $artist_id);
        $stmt->execute();
        } 
    
        //Erreur 
        catch(PDOException $e){
        
            echo "Erreur : " . $e->getMessage();
            echo 'N° : ' . $e->getCode() . '<br>';
        }
        
        $disqueAjoute = "Le disque a bien été ajouté !";
    }
    

} 








?>