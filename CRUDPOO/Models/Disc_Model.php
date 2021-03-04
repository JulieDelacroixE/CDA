<?php 
require '../entities/disc.php';

class DiscModel extends Disc {

    public function __construct() {
        $database = Connexion::getInstance();
        $this->pdo = $database->pdo;
    }
//Méthode de récupération de la liste des disques
    public function getAllDisc() {
        $req = "SELECT * FROM disc";
        $list = $this->pdo->query($req);
        $result = $list->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
//Méthode de récupération du détail d'un disque
    public function getDiscDetail($id) {
        $req = "SELECT disc_id, disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist.artist_id, artist_name FROM disc JOIN artist ON disc.artist_id = artist.artist_id WHERE disc_id = :disc_id";
        $details = $this->pdo->prepare($req);
        $details->bindValue(':disc_id', $id, PDO::PARAM_INT);
        $details->execute();
        $result = $details->fetch(PDO::FETCH_OBJ);
        return $result;
    }
//Méthode de récupération des disques d'un artiste
    public function getArtistDiscList($id) {
            $req = "SELECT disc_id, disc_title FROM disc JOIN artist ON artist.artist_id = disc.artist_id WHERE artist.artist_id = :artist_id";
            $artdisc = $this->pdo->prepare($req);
            $artdisc->bindValue(':artist_id', $id, PDO::PARAM_INT);
            $artdisc->execute();
            $result = $artdisc->fetchAll(PDO::FETCH_OBJ);
            return $result;
    }
//Méthode d'ajout d'un nouveau disque en bdd
    public function addDisc($disc) {
        $req = "INSERT INTO disc(disc_title, disc_year, disc_label, disc_price, disc_genre, disc_picture, artist_id) VALUES (:disc_title, :disc_year, :disc_label, :disc_price, :disc_genre, :disc_picture, :artist_id)";
        $addDisc = $this->pdo->prepare($req);
        $addDisc->bindValue(':disc_title', $disc->getDiscTitle());
        $addDisc->bindValue(':disc_year', $disc->getDiscYear());
        $addDisc->bindValue(':disc_label', $disc->getDiscLabel());
        $addDisc->bindValue(':disc_price', $disc->getDiscPrice());
        $addDisc->bindValue(':disc_genre', $disc->getDiscGenre());
        $addDisc->bindValue(':disc_picture', $disc->getDiscPicture());
        $addDisc->bindValue(':artist_id', $disc->getArtistId(), PDO::PARAM_INT);
        return $addDisc->execute();
    }
//Méthode de modification d'un disque
    public function updateDisc($disc) {
        $req = "UPDATE disc SET disc_title = :disc_title, disc_year = :disc_year, disc_label = :disc_label, disc_price = :disc_price, disc_genre = :disc_genre, artist_id = :artist_id, disc_picture = :disc_picture WHERE disc_id = :disc_id";
        $updateDisc = $this->pdo->prepare($req);
        $updateDisc->bindValue(':disc_title', $disc->getDiscTitle());
        $updateDisc->bindValue(':disc_year', $disc->getDiscYear());
        $updateDisc->bindValue(':disc_label', $disc->getDiscLabel());
        $updateDisc->bindValue(':disc_price', $disc->getDiscPrice());
        $updateDisc->bindValue(':disc_genre', $disc->getDiscGenre());
        $updateDisc->bindValue(':disc_picture', $disc->getDiscPicture());
        $updateDisc->bindValue(':artist_id', $disc->getArtistId(), PDO::PARAM_INT);
        $updateDisc->bindValue(':disc_id', $disc->getDiscId());
        return $updateDisc->execute();
    }
    //Méthode de suppression d'un disque
    public function deleteDisc($id) {
        $req = "DELETE FROM disc WHERE disc_id = :disc_id";
        $del = $this->pdo->prepare($req);
        $del->bindValue(':disc_id', $id, PDO::PARAM_INT);
        $del->execute();
    }
}

?>
