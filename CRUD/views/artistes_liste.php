<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include "../src/header.php";
require_once "../controllers/artistes_liste_controller.php";
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
  <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>
  <h1 class="display-4 text-white pb-3">Liste des artistes</h1>
  <div class="row text-white">
    <div class="col-lg-7">
        <span id="alerte"></span>
        <table class="text-center">
            <thead class="bg-d">
                <tr class="table-active">
                    <th scope="col">Selection</th>
                    <th scope="col">Artiste ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while ($row = $result->fetch(PDO::FETCH_OBJ))
                 { ?>
                <tr>
                    <td><input class="form-check-input" type="checkbox" value="<?= $row->artist_id?>" id="defaultCheck2"></td>
                    <td><?= $row->artist_id?></td>
                    <td><button class="details-artist-link btn btn-outline-light" value="<?= $row->artist_id?>"><?= $row->artist_name ?></button></td>
                    <td><a id="deleteArtistButton" class="btn" href="../controllers/artistes_delete_controller.php?id=<?= $row->artist_id?>"><i class="text-danger fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
            <?php 
                }
            ?>
            </tbody>
        </table>
    </div>
    <!-- div pour afficher les détails -->
    <div class="col-lg-5 text-center" id="details-artist-box">
    </div>
</div>
<!-- Fin contenu -->

<?php
include "../src/footer.php";
?>