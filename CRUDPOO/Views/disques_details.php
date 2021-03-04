<?php 
require_once '../Controllers/disques_details_controller.php';
?>

<div class="p-3" id="details">
    
    <img class ="img-fluid text-center mb-2" src='../src/pictures/<?= $details->disc_picture?>' alt='<?=$details->disc_title?>' width="250" height="auto">
    <h2><?=$details->disc_title?></h2>
    <ul class="p-0 offset-4 text-left">
        <li><strong>ID : </strong><?= $details->disc_id?></li>
        <li><strong>Titre :</strong><?= $details->disc_title?> </li>
        <li><strong>Année :</strong> <?= $details->disc_year?></li>
        <li><strong>Label :</strong> <?= $details->disc_label?></li>
        <li><strong>Genre :</strong> <?= $details->disc_genre?></li>
        <li><strong>Prix :</strong> <?= $details->disc_price?></li>
        <li><strong>Artiste :</strong> <?= $details->artist_name?></li>
        <li><strong>Artiste ID :</strong> <?= $details->artist_id?></li>
    </ul>
    <a class="modif-link btn btn-dark m-2" role="button" href="disques_update.php?id=<?= $details->disc_id?>">Modifier</a>
    <button class="btn btn-danger" role="button" id="deleteButtonDet" value="<?= $details->disc_id?>">Supprimer</button>

<script src="../assets/js/delete_confirm.js"></script>