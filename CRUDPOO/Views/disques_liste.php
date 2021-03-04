<?php 

include 'header.php';
require_once '../Controllers/disques_liste_controller.php';
?>

 <!-- debut background video-->
    <div class="bg-wrap">
        <div id="bg-img">

        </div>
    </div>
 <!-- fin background video-->
<!-- Page content holder -->
<div class="container-fluid page-content p-5" id="content">
  <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>
    <h1 class="display-4 text-white pb-3">Liste des disques</h1>
    <div class="row text-white">
        <div class="col-lg-7">
            <span id="alerte"></span>
            <table class="text-center">
                <thead class="bg-d">
                    <tr class="table-active">
                        <th scope="col">Selection</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Disque ID</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Artiste</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($liste as $disc) {
                     ?>
                    <tr>  
                        <td><input class="form-check-input" type="checkbox" value="<?= $disc->disc_id?>" id="defaultCheck2"></td>
                        <td><img class ="img-fluid" src='../src/pictures/<?= $disc->disc_picture?>' alt='<?=$disc->disc_picture?>' width="100" height="100"></td>
                        <td><?= $disc->disc_id?></td>
                        <td><button class="details-link btn btn-outline-light" value="<?= $disc->disc_id?>"><?= $disc->disc_title?></button></td>
                        <td><?= $disc->disc_genre?></td>
                        <td><?= $disc->disc_price?></td>
                        <td><?= $disc->artist_id?></td>
                        <td><a id="deleteButton" class="btn" href="../controllers/disques_delete_controller.php?id=<?= $disc->disc_id?>"><i class="text-danger fa    fa-trash" aria-hidden="true"></i></a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Div pour afficher les détails-->
    <div class="details-scroll col-lg-4 text-center " id="details-box">
    </div>
</div>
<!-- Fin contenu -->

<?php
include 'footer.php';
?>