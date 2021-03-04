
    /* Lorsqu'on clique sur le lien, on affiche un message de confirmation. 
Si l'utilisateur clique OK, il est redirigé vers le lien
Si l'utilisateur clique sur annuler, il revient sur la page détail sans appeler le script de suppression */


let lien = document.getElementById('deleteButtonDet');

lien.addEventListener('click', function () {
    let g = this.value;
    var c = confirm("Voulez vous vraiment supprimer cet article ? ");
    if (c == true) {
        alert("Votre disque sera bien supprimé.");
        window.location.assign("../controllers/disques_delete_controller.php?id="+g);
    }
    else {
        alert("Le disque n'a pas été supprimé.");
        window.location;
    }
})

let lienList = document.getElementById('deleteButtonList');

lienList.addEventListener('click', function () {
    let g = this.value;
    var c = confirm("Voulez vous vraiment supprimer cet article ? ");
    if (c == true) {
        alert("Votre disque sera bien supprimé.");
        window.location.assign("../controllers/disques_delete_controller.php?id="+g);
    }
    else {
        alert("Le disque n'a pas été supprimé.");
        window.location;
    }
})   