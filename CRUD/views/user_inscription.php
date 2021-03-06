<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include "../src/header.php";
require "../controllers/user_inscription_controller.php";
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
    <h1 class="display-4 text-white pb-3">Inscription</h1>
    <div class="row justify-content-center">
        <div class="add-form col-6 bg-form p-5">
        <!-- Formulaire -->
            <form action="#" method="POST" enctype="multipart/form-data">
                <h2 class="text-white pb-3 text-center">Inscription</h2>
                <div class="form-group">
                    <label for="email-input">Email</label>
                    <input type="text" class="form-control" id="email-input" name="email-input" value="<?=$email ?>">
                    <span class="text-danger" id="mailErr"><?php if(!empty($tabError["email_error"])) {
                        echo $tabError["email_error"];
                    } ?></span>
                </div>
                <div class="form-group">
                    <label for="pseudo-input">Pseudo : </label>
                    <input type="text" class="form-control" id="pseudo-input" name="pseudo-input" value="<?=$pseudo?>">
                    <span class="text-danger" id="pseudoError"><?php if(!empty($tabError["pseudo_error"])) {
                        echo $tabError["pseudo_error"];
                    }?></span>
                </div>
                <div class="form-group">
                    <label for="mdp-input">Mot de passe : </label>
                    <input type="password" class="form-control" id="mdp-input" name="mdp-input" value="<?=$mdp?>">
                    <span class="text-danger" id="mdpError"><?php if(!empty($tabError["mdp_error"])) {
                        echo $tabError["mdp_error"];
                    }?></span>
                </div>
                <input type="submit" name="submit" class="btn btn-warning" value="ajouter">
            </form>
        </div>
    </div>
</div>

<?php
include "../src/footer.php";
?>

