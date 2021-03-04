<?php 

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once '../src/connexion_db.php'; 

if (isset($_SESSION["id"])) {
    $user_id = $_SESSION["id"];
}
//Vérification formulaire modification mot de passe
if (!empty($_POST["passchange"])) {
    if (!empty($_POST["ancien-mdp-input"])) {
        $aMdp = htmlspecialchars($_POST["ancien-mdp-input"]);
    } else {
        $tabErrorP["ancien-mdp-error"] = "Vous devez entrer votre mot de passe actuel";
    }
    if (!empty($_POST["new-mdp1-input"])) {

        $nMdp1 = htmlspecialchars($_POST["new-mdp1-input"]);

    } else {
        $tabErrorP["new-mdp1-error"] = "Vous devez entrer un nouveau mot de passe";
    }
    if (!empty($_POST["new-mdp2-input"])) {

        $nMdp2 = htmlspecialchars($_POST["new-mdp2-input"]);
        
    } else {
        $tabErrorP["new-mdp2-error"] = "Vous devez resaisir votre nouveau mot de passe";
    }
//On vérifie dans la bdd
    if (!empty($aMdp) && !empty($nMdp1) && !empty($nMdp2)) { 
        $reqU = "SELECT * FROM users WHERE `user_id` = ?";
        $stmt = $db->prepare($reqU);
        $stmt->execute(array($user_id));
        $user = $stmt->fetch(PDO::FETCH_OBJ); 
        $stmt->closeCursor();
    }
    else {
        $error = "tous les champs doivent être remplis.";
    }
//Si pas d'erreur, changement du mot de passe
    if(password_verify($aMdp, $user->user_mdp)) {
        if($nMdp1 == $nMdp2) {
            $nMdpH = password_hash($nMdp2, PASSWORD_DEFAULT);
            $reqUpdate = "UPDATE users SET user_mdp = ? WHERE `user_id` = ?";
            $stmt2 = $db->prepare($reqUpdate);
            $stmt2->execute(array($nMdpH, $user_id));
        }
        else {
            $tabErrorP["new-mdp2-error"] = "Les mots de passe ne sont pas identiques.";
        }
    } else {
        $tabErrorP["ancien-mdp-error"] = "Vous avez entré un mauvais mot de passe.";
    }
}
?>