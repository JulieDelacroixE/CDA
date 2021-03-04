<?php
	if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    require_once '../src/connexion_db.php'; 
    $erreur = "";
    $mail = "";
    $mdp_hash = "";
	 //Vérification formulaire de connexion
	if(isset($_POST['submit'])) {
	   $mail = htmlspecialchars($_POST['email-input']);
	   $mdp = $_POST['mdp-input'];
	   if(!empty($mail) && !empty($mdp)) {

               $requser = $db->prepare("SELECT * FROM users WHERE user_email = ?");
               $requser->execute(array($mail));
               //Recherche de l'utilisateur en bdd
               $userexist = $requser->rowCount();
               //Si l'utilisateur existe
               if($userexist == 1) {
                  $userinfo = $requser->fetch();
                  //Verification mot de passe
                  if(password_verify($mdp, $userinfo->user_mdp)) {
                    //Passage des infos en Session
                      $_SESSION['id'] = $userinfo->user_id;
                      $_SESSION['pseudo'] = $userinfo->user_pseudo;
                      $_SESSION['mail'] = $userinfo->user_email;
                      //Redirection
                      header("Location:../views/disques_liste.php");
                  } else {
                      $erreur = "mauvais mdp";
                  }
                  
               } else {
                  $erreur = "Mauvais mail ou mot de passe !";
               }
           
	   } else {
	      $erreur = "Tous les champs doivent être complétés !";
	   }
    }
	?>