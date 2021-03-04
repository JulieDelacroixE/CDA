<?php

include 'header.php';
require_once '../Controllers/disques_update_controller.php';

?>

<!-- debut background-->
<div class="bg-wrap">
    <div id="bg-img">
    </div>
</div>
<!-- fin background-->

<!-- Contenu -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small  class="text-uppercase font-weight-bold">Toggle</small></button>
    <h1 class="display-4 text-white pb-3">Modifier un disque</h1>
    <div class="row justify-content-center">
        <div class="add-form col-6 bg-form p-5">
        <h2 class="text-white pb-3 text-center">Modifier le disque</h2>
                <?php if(!empty($tabResult['updateDiscFail'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $tabResult['updateDiscFail']?>
                </div>
                <?php } else if (!empty($tabResult['updateDiscOk'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?= $tabResult['updateDiscOk']?>
                </div>
                <?php } ?>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title-input">Titre</label>
                    <input type="text" class="form-control" id="title-input" name="title-input" value="<?= $titleValue?>">
                    <span class="text-danger" id="titleErr"><?php if (!empty($tabError['title-error'])) { echo $tabError['title-error']; }?></span>
                </div>
                <div class="form-group">
                    <label for="year-input">Année : </label>
                    <input type="text" class="form-control" id="year-input" name="year-input" value="<?= $yearValue?>">
                    <span class="text-danger" id="yearError"><?php if (!empty($tabError['year-error'])) { echo $tabError['year-error']; }?></span>
                </div>
                <div class="form-group">
                    <label for="label-input">Description</label>
                    <textarea class="form-control" id="label-input" name="label-input" rows="3" value="<?= $labelValue?>"><?= $labelValue?></textarea>
                    <span class="text-danger" id="labelError"><?php if (!empty($tabError['label-error'])) { echo $tabError['label-error']; }?></span>
                </div>
                <div class="form-group">
                    <label for="genre-input">Genre</label>
                    <input type="text" class="form-control" id="genre-input" name="genre-input" value="<?= $genreValue?>">
                    <span class="text-danger" id="genreError"><?php if (!empty($tabError['genre-error'])) { echo $tabError['genre-error']; }?></span>
                </div>
                <div class="form-group">
                    <label for="artist-select">Artiste :</label><br>
                    <select class="form-control" name="artist-select" id="artist-select">
                    
                    <option value="<?= $artistValue?>" selected><?=$artistNameValue?></option>
                    <?php foreach($artistsList as $artist) {
                    ?>
                    <option value="<?=$artist->artist_id?>"><?= $artist->artist_name?></option>
                    <?php }
                    ?>
                    </select>
                    <span class="text-danger" id="artistErr"><?php if (!empty($tabError['artist-error'])) { echo $tabError['artist-error']; }?></span>
                </div>
                <div class="from-group">
                    <label for="price-input">Prix</label>
                    <input type="text" class="form-control" id="price-input" name ="price-input" value="<?= $priceValue?>">
                    <span class="text-danger" id="priceError"><?php if (!empty($tabError['price-error'])) { echo $tabError['price-error']; }?></span>
                </div>
                <div class="form-group">
                    <label for="photo">Ajouter une photo</label><br>
                    <input type="file" name="photo" id="photo"><br>
                    <img src="#" alt="image aperçu" id="newimg" class="img-fluid" width="150" height="auto">
                    <span class="text-danger" id="errorPho"></span>
                    <input type="hidden" name="MAX_FILE_SIZE" value="400000">
                </div>
                <input type="submit" name="submit" class="btn btn-warning" value="modifier">
            </form>
        </div>
    </div>
</div>
<script src="../assets/js/disque_add_validation.js"></script>
<?php
include 'footer.php';
?>