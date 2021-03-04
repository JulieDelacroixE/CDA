<?php
require_once '../Controllers/artistes_details_controller.php';
?>

<div class="p-3" id="details">
    <h2><?=$artist->artist_name?></h2>
    <ul class="p-0 offset-4 text-left">
        <li><strong>ID : </strong><?= $artist->artist_id?></li>
        <li><strong>Nom :</strong><?= $artist->artist_name?> </li>
        <li><strong>URL :</strong> <?= $artist->artist_url?></li>
        <li><strong>Disques : </strong> 
            <ul>
                <?php 
                foreach($discslist as $discs) {
                    ?>
                        <li><?= $discs->disc_id." : ".$discs->disc_title ?></li>
                    <?php
                } ?>
            </ul>  
        </li>
    </ul>
    
</div>
