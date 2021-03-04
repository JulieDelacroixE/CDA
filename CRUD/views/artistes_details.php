<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once '../controllers/artistes_details_controller.php';
?>

<div class="p-3" id="details">
    <h2><?=$artist->artist_name?></h2>
    <ul class="p-0 offset-4 text-left">
        <li><strong>ID : </strong><?= $artist->artist_id?></li>
        <li><strong>Nom :</strong><?= $artist->artist_name?> </li>
        <li><strong>URL :</strong> <?= $artist->artist_url?></li>
        <li><strong>Disques :</strong> 
            <ul>
                <?php
                if ($stmt2->rowCount() > 0) {
                    while ($rowDA = $stmt2->fetch(PDO::FETCH_OBJ))
                    { ?>
                        <li><?= $rowDA->disc_title ?></li>
                    <?php 
                    } 
                }
                else {
                    ?>
                    <li>Pas de disque pour cet artiste</li>
                <?php 
                    }
                  ?>
            </ul>
        </li>
    </ul>
</div>
