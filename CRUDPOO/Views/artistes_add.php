
<?php

include 'header.php';
require '../Controllers/artistes_add_controller.php';
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
    <h1 class="display-4 text-white pb-3">Ajout d'un artiste</h1>
    <p><?php if(!empty($tabResult['addArtist'])) { echo $tabResult['addArtist']; } ?></p>
    <div class="row justify-content-center">
        <div class="add-form col-6 bg-form p-5">
        <!-- Formulaire -->
            <form action="#" method="POST" enctype="multipart/form-data">
                <h2 class="text-white pb-3 text-center">Ajout d'un artiste</h2>
                <div class="form-group">
                    <label for="name-input">Nom</label>
                    <input type="text" class="form-control" id="name-input" name="name-input" value="<?= $artist->getArtistName(); ?>">
                    <span class="text-danger" id="nameErr"><?php if(!empty($tabError['name_error'])) {
                        echo $tabError['name_error'];
                    } ?></span>
                </div>
                <div class="form-group">
                    <label for="url-input">URL : </label>
                    <input type="text" class="form-control" id="url-input" name="url-input" value="<?=$artist->getArtistUrl();?>">
                    <span class="text-danger" id="urlError"><?php if(!empty($tabError['url_error'])) {
                        echo $tabError['url_error'];
                    }?></span>
                </div>
                <input type="submit" name="submit" class="btn btn-warning" value="ajouter">
            </form>
        </div>
    </div>
</div>
<script src="../assets/js/disque_add_validation.js"></script>
<?php
include 'footer.php';
?>