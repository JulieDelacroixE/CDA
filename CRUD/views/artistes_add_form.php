<?php
include "../src/header.php";
require "../controllers/artistes_add_form_controller.php";
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
    <h2 class="display-4 text-white pb-3">Ajout d'un artiste</h2>
    <div class="row justify-content-center">
        <div class="add-form col-6 bg-form p-5">
        <!-- Formulaire -->
            <form action="#" method="POST" enctype="multipart/form-data">
                <h3 class="text-white pb-3 text-center">Ajout d'un artiste</h3>
                <div class="form-group">
                    <label for="name-input">Nom</label>
                    <input type="text" class="form-control" id="name-input" name="name-input" value="<?=$artistName ?>">
                    <span class="text-danger" id="nameErr"><?= $artistname_error?></span>
                </div>
                <div class="form-group">
                    <label for="url-input">URL : </label>
                    <input type="text" class="form-control" id="url-input" name="url-input" value="<?=$artistUrl?>">
                    <span class="text-danger" id="urlError"><?= $artistUrl_error ?></span>
                </div>
                <input type="submit" name="submit" class="btn btn-warning" value="ajouter">
            </form>
        </div>
    </div>
</div>

<?php
include "../src/footer.php";
?>