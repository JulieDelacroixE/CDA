<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include "../src/header.php";
require "../controllers/user_profil_controller.php";
?>

 <!-- background-->
 <div class="bg-wrap">
        <div id="bg-img">

        </div>
</div>
 <!-- fin background-->

<!-- Page content -->
<div class="page-content p-5" id="content">
  <!-- Toggle button -->
  <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>
    <h1 class="display-4 text-white pb-3">Profil</h1>
    <?= $_SESSION["id"] . " ". $user->user_id;?>
    <div class="row justify-content-center">
        <div class="add-form col-6 bg-form p-5">
        <!-- Formulaire -->
           <div>
                <h2>Vos informations</h2>
                <ul>
                <li><span class="gras">Votre pseudo : </span> <?= $_SESSION["pseudo"] ?></li>
                <li><span class="gras">Votre adresse email : </span> <?= $_SESSION['mail'] ?></li>
                </ul>
                <h2>Changer de mot de passe : </h2>
                <form action="#" method="post">
                <?php if (!empty($error)) { ?>
                <div class="alert alert-secondary" role="alert">
                   <?= $error ?>
                </div> 
                <?php } ?>
                    <div class="form-group">
                        <label for="ancien-mdp-input">Mot de passe actuel : </label>
                        <input type="text" class="form-control" id="ancien-mdp-input" name="ancien-mdp-input">
                        <span class="text-danger" id="a-mdp-Error"><?php if (!empty($tabErrorP["ancien-mdp-error"])) { echo $tabErrorP["ancien-mdp-error"]; }?></span>
                    </div>
                    <div class="form-group">
                        <label for="new-mdp1-input">Nouveau mot de passe : </label>
                        <input type="text" class="form-control" id="new-mdp1-input" name="new-mdp1-input">
                        <span class="text-danger" id="n-mdp1-Error"><?php if (!empty($tabErrorP["new-mdp1-error"])) { echo $tabErrorP["new-mdp1-error"]; }?></span>
                    </div>
                    <div class="form-group">
                        <label for="new-mdp2-input">Retapez votre nouveau mot de passe : </label>
                        <input type="text" class="form-control" id="new-mdp2-input" name="new-mdp2-input">
                        <span class="text-danger" id="n-mdp2-Error"><?php if (!empty($tabErrorP["new-mdp2-error"])) { echo $tabErrorP["new-mdp2-error"]; }?></span>
                    </div>
                    <input type="submit" class="btn btn-light" name="passchange" value="Valider">
                </form>
           </div>
        </div>
    </div>
</div>
<script src="../assets/js/disque_add_validation.js"></script>
<?php
include "../src/footer.php";
?>