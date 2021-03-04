<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once '../src/connexion_db.php'; 

$regexChar = "#[ a-zA-Z '-]{1,30}#";
$regexEmail ="#([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})#";
$tabError = array();
$email = "";
$pseudo = "";
$mdp = "";

//Fonction filtre
function valid_donnees($donnees){
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}
//Vérification formulaire
if (!empty($_POST["submit"])) { 

    if(!empty($_POST["email-input"]) && preg_match("#([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})#", $_POST["email-input"])) {
        $email = htmlspecialchars($_POST["email-input"]);
    }
    else {
        $tabError["email_error"] = "Entrez un email valide.";  

    }
    if (!empty($_POST["pseudo-input"]) && preg_match("#[ a-zA-Z '-]{1,30}#", $_POST["pseudo-input"])) {
        $pseudo = $_POST["pseudo-input"];
    }
    else {
        $tabError["pseudo_error"] = "Entrez un pseudo valide.";  
    }
    if (!empty($_POST["mdp-input"])) {
        $mdp = password_hash($_POST["mdp-input"], PASSWORD_DEFAULT);
    }
    else {
        $tabError["mdp_error"] = "Entrez un mot de passe valide.";
    }
    //Si pas d'erreur
    if (count($tabError) === 0) {
        try {
            $reqUser = "INSERT INTO users (user_email, user_pseudo, user_mdp) VALUES (:user_email, :user_pseudo, :user_mdp)";
            $stmt = $db->prepare($reqUser);
            $stmt->bindValue(':user_email', $email);
            $stmt->bindValue(':user_pseudo', $pseudo);
            $stmt->bindValue(':user_mdp', $mdp);
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