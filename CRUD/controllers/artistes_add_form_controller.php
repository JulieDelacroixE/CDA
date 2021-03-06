<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

//Connexion à la base

require_once '../src/connexion_db.php'; 

// Validation des entrées du formulaire avec regex, attribution des valeurs aux variables.

$artistName = "";
$artistUrl = "";
$tabError = array();

//Fonction filtre
function valid_donnees($donnees){
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

if (!empty($_POST["submit"])) {

    if (!empty($_POST['name-input']) && preg_match("#[ a-zA-Z '-]{1,30}#", $_POST['name-input'])) {     
        $artistName = valid_donnees($_POST['name-input']);  
    }  
    else {
        $tabError["artistname_error"] = "Entrez un titre valide.";  
    } 
    if (!empty($_POST['url-input']) && preg_match("#[ a-zA-Z '-]{1,30}#", $_POST['url-input'])) {     
        $artistUrl = valid_donnees($_POST['url-input']);  
    }  
    else {
        $tabError["artistUrl_error"] = "Entrez un titre valide.";
    } 
    
    
    // Enregistrement du disque dans la bdd si pas d'erreur
    
    if (count($tabError) === 0) {
        try {     
            $reqAdd = "INSERT INTO artist(artist_name, artist_url) VALUES (:artist_name, :artist_url)"; 
            
            $stmt = $db->prepare($reqAdd);
            $stmt->bindValue(':artist_name', $artistName);
            $stmt->bindValue(':artist_url', $artistUrl);
            $stmt->execute();
        } 
        //Gestion Erreur 
        catch(PDOException $e){
            
            echo "Erreur : " . $e->getMessage();
            echo 'N° : ' . $e->getCode() . '<br>';
        } 
    }
}
?>