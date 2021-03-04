<?php
require_once '../controllers/disques_details_controller.php';
?>

<div class="p-3" id="details">
    
    <img class ="img-fluid text-center mb-2" src='../src/pictures/<?= $disc->disc_picture?>' alt='<?=$disc->disc_title?>' width="250" height="auto">
    <h3><?=$disc->disc_title?></h3>
    <ul class="p-0 offset-4 text-left">
        <li><strong>ID : </strong><?= $disc->disc_id?></li>
        <li><strong>Titre :</strong><?= $disc->disc_title?> </li>
        <li><strong>Année :</strong> <?= $disc->disc_year?></li>
        <li><strong>Label :</strong> <?= $disc->disc_label?></li>
        <li><strong>Genre :</strong> <?= $disc->disc_genre?></li>
        <li><strong>Prix :</strong> <?= $disc->disc_price?></li>
        <li><strong>Artiste :</strong> <?= $disc->artist_name?></li>
        <li><strong>Artiste ID :</strong> <?= $disc->artist_id?></li>
    </ul>
    <a class="modif-link btn btn-dark m-2" role="button" href="disques_update_form.php?id=<?= $disc->disc_id?>">Modifier</button>
    <a id="deleteButton" class="btn btn-danger m-2" href="../controllers/disques_delete_controller.php?id=<?= $disc->disc_id?>">Supprimer</a>
</div>
