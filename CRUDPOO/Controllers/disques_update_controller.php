<?php 

require_once '../src/connexion_db.php';
require_once '../Models/Disc_Model.php';
require_once '../Models/Artist_Model.php';


if (isset($_GET['id'])) {
    $disc_id = $_GET['id'];
}

//Instanciation du disque
$disc = new Disc;
$disc->setDiscId($disc_id);

//On récupère les valeurs de base du disque
$olddisc = new DiscModel;
$oldDiscDet = $olddisc->getDiscDetail($disc_id);
$artist = new ArtistModel;
$artistsList = $artist->getAllArtist();

//Tableau pour afficache des erreurs
$tabError = array();
$tabResult = array();

//Expressions régulières
$regExName = "#[ a-zA-Z '-]{1,30}#";
$regExYear = "#[0-9]{4}#";
$regExLabel = "#.{1,200}#";
$regExPrice = "#[0-9]{1,6}.*[0-9]{0,3}#";


// Valeurs pour affichage sur la view
if (isset($_POST['title-input'])) {
    $titleValue = $_POST['title-input'];
} else {
    $titleValue = $oldDiscDet->disc_title;
}
if (isset($_POST['year-input'])) {
    $yearValue = $_POST['year-input'];
} else {
    $yearValue = $oldDiscDet->disc_year;
}
if (isset($_POST['label-input'])) {
    $labelValue = $_POST['label-input'];
} else {
    $labelValue = $oldDiscDet->disc_label;
}
if (isset($_POST['genre-input'])) {
    $genreValue = $_POST['genre-input'];
} else {
    $genreValue = $oldDiscDet->disc_genre;
}
if (isset($_POST['price-input'])) {
    $priceValue = $_POST['price-input'];
} else {
    $priceValue = $oldDiscDet->disc_price;
}
if (isset($_POST['artist-select'])) {
    $artistValue = $_POST['artist-select'];
    
} else {
    $artistValue = $oldDiscDet->artist_id;
    $artistNameValue = $oldDiscDet->artist_name;
}


//Fonction filtre
function valid_donnees($donnees){
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}


//Vérification formulaire
if (isset($_POST['submit'])) {
    
    if (isset($_POST['title-input']) && preg_match($regExName, $_POST['title-input'])) {
        $disc->setDiscTitle(valid_donnees($_POST['title-input']));
    } else if (!empty($_POST['title-input']) && !preg_match($regExName, $_POST['title-input'])) {
        $tabError['title-error'] = 'Veuillez entrer un titre valide.';
    } else {
        $tabError['title-error'] = 'Ce champs doit être renseigné.';
        $disc->setDiscTitle($oldDiscDet->disc_title);
    }

    if (isset($_POST['year-input']) && preg_match($regExYear, $_POST['year-input'])) {
        $disc->setDiscYear(valid_donnees($_POST['year-input']));
    } else if (!empty($_POST['year-input']) && !preg_match($regExYear, $_POST['year-input'])) {
        $tabError['year-error'] = 'Veuillez entrer une année valide.';
    } else {
        $tabError['year-error'] = 'Ce champs doit être renseigné.';
        $disc->setDiscYear($oldDiscDet->disc_year);
    }

    if (isset($_POST['label-input']) && preg_match($regExLabel, $_POST['label-input'])) {
        $disc->setDiscLabel(valid_donnees($_POST['label-input']));
    } else if (!empty($_POST['label-input']) && !preg_match($regExLabel, $_POST['label-input'])) {
        $tabError['label-error'] = 'Veuillez entrer une description valide.';
    } else {
        $tabError['label-error'] = 'Ce champs doit être renseigné.';
        $disc->setDiscLabel($oldDiscDet->disc_label);
    }

    if (isset($_POST['genre-input']) && preg_match($regExName, $_POST['genre-input'])) {
        $disc->setDiscGenre(valid_donnees($_POST['genre-input']));
    } else if (!empty($_POST['genre-input']) && !preg_match($regExName, $_POST['genre-input'])) {
        $tabError['genre-error'] = 'Veuillez entrer un genre valide.';
    } else {
        $tabError['genre-error'] = 'Ce champs doit être renseigné.';
        $disc->setDiscGenre($oldDiscDet->disc_genre);
    }

    if (isset($_POST['artist-select']) && $_POST['artist-select'] != 'Choisissez un artiste') {
        $disc->setArtistId($_POST['artist-select']);
    } else {
        $tabError['artist-error'] = 'Vous devez choisir un artiste.';
        $disc->setArtistId($oldDiscDet->artist_id);
    }

    if (isset($_POST['price-input']) && preg_match($regExPrice, $_POST['price-input'])) {
        $disc->setDiscPrice(valid_donnees($_POST['price-input']));
    } else if (!empty($_POST['price-input']) && !preg_match($regExPrice, $_POST['price-input'])) {
        $tabError['price-error'] = 'Veuillez entrer un prix valide.';
    } else {
        $tabError['price-error'] = 'Ce champs doit être renseigné.';
        $disc->setDiscPrice($oldDiscDet->disc_price);
    }
    
    if (!empty($_FILES["photo"])) {
        if ($_FILES["photo"]["error"] === UPLOAD_ERR_OK) 
        {
                $aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/x-png", "image/tiff", "image/png");
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimetype = finfo_file($finfo, $_FILES["photo"]["tmp_name"]);
                    finfo_close($finfo);
                    if (in_array($mimetype, $aMimeTypes)) 
                    {
                        $tmp_name = $_FILES["photo"]["tmp_name"];
                        $extension = substr(strrchr($_FILES["photo"]["name"], "."), 1);
                        if (file_exists("../src/pictures/".$disc->getDiscTitle().".".$extension)) {
                            unlink("../src/pictures/".$disc->getDiscTitle().".".$extension);
                        }
                        move_uploaded_file($_FILES["photo"]["tmp_name"], "../src/pictures/".$disc->getDiscTitle().".".$extension);
                        $disc->setDiscPicture($disc->getDiscTitle().".".$extension);
                    }
                    else {
                        exit("Type de fichier non autorisé");
                    }
                        

        } else {
            $disc->setDiscPicture($oldDiscDet->disc_picture);
        }  
    } else {
        $disc->setDiscPicture($oldDiscDet->disc_picture);
    }

    if(count($tabError) === 0) {
       $discUpdate = new DiscModel;
        if($discUpdate->updateDisc($disc) == true) { 
            $tabResult['updateDiscOk'] = "Le disque a bien été modifié";
        } else {
            $tabResult['updateDiscFail'] = "Le disque n'a pas pu être modifié.";
        }
    } else {
        $tabResult['updateDiscFail'] = "Le disque n'a pas pu être modifié.";
    }
}

?>