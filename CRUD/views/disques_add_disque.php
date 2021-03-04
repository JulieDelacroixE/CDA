<?php
include "../src/header.php";
require "../controllers/disques_add_disque_controller.php";
?>

 <!-- debut background-->
 <div class="bg-wrap">
        <div id="bg-img">

        </div>
</div>
 <!-- fin background -->
<!-- contenu -->
<div class="page-content p-5" id="content">
  <!-- Toggle button -->
  <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>
    <p class="h2 text-dark"><strong><?=$disqueAjoute?></strong></p>
    <h2 class="display-4 text-white pb-3">Ajout d'un disque</h2>
    <div class="row justify-content-center">
        <div class="add-form col-6 bg-form p-5">
            <form action="#" method="POST" enctype="multipart/form-data">
                <h3 class="text-white pb-3 text-center">Ajout d'un disque</h3>
                <div class="form-group">
                    <label for="title-input">Titre</label>
                    <input type="text" class="form-control" id="title-input" name="title-input" value="<?=$discTitle?>">
                    <span class="text-danger" id="titleErr"><?= $discTitle_error?></span>
                </div>
                <div class="form-group">
                    <label for="year-input">Année : </label>
                    <input type="text" class="form-control" id="year-input" name="year-input" value="<?=$discYear?>">
                    <span class="text-danger" id="yearError"><?= $discYear_error ?></span>
                </div>
                <div class="form-group">
                    <label for="label-input">Description</label>
                    <textarea class="form-control" id="label-input" name="label-input" rows="3" value="<?=$discLabel?>"><?=$discLabel?></textarea>
                    <span class="text-danger" id="labelError"><?= $discLabel_error ?></span>
                </div>
                <div class="form-group">
                    <label for="genre-input">Genre</label>
                    <input type="text" class="form-control" id="genre-input" name="genre-input" value="<?=$discGenre?>">
                    <span class="text-danger" id="genreError"><?= $discGenre_error ?></span>
                </div>
                <div class="form-group">
                    <label for="artist-select">Artiste :</label><br>
                    <select class="form-control" name="artist-select" id="artist-select" value="<?=$artist_id?>">
                    <?php
                    require "../src/connexion_db.php";
                    $requete = "SELECT artist_name, artist_id FROM artist ORDER BY artist_name";
                    foreach ($db->query($requete) as $row)
                    { ?>
                    <option value='<?=$row->artist_id?>'><?=$row->artist_name?></option>
                    <?php }
                    ?>
                    </select>
                    <span class="text-danger"><?= $artist_error ?></span> 
                </div>
                <div class="from-group">
                    <label for="price-input">Prix</label>
                    <input type="text" class="form-control" id="price-input" name ="price-input" value="<?=$discPrice?>">
                    <span class="text-danger" id="priceError"><?= $discPrice_error ?></span>
                </div>
                <div class="form-group">
                    <label for="photo">Ajouter une photo</label><br>
                    <input type="file" name="photo" id="photo"><br>
                    <span class="text-danger" id="errorPho"><?= $photo_error ?></span>
                    <input type="hidden" name="MAX_FILE_SIZE" value="400000">
                    <img src="#" alt="image aperçu" id="newimg" class="img-fluid" width="150" height="auto">
                </div>
                <input type="submit" name="submit" class="btn btn-warning" value="ajouter">
            </form>
        </div>
    </div>
</div>
<?php
include "../src/footer.php";
?>