<?php 
require '../entities/Artist.php';

class ArtistModel extends Artist {

    public function __construct() {
        $database = Connexion::getInstance();
        $this->pdo = $database->pdo;
    }
//Méthode de récupération de la liste des artistes
    public function getAllArtist() {
        $req = 'SELECT * FROM artist';
        $list = $this->pdo->query($req);
        $result = $list->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
//Méthode de récupération des détails d'un artiste
    public function getDetails($id) {
        $req = 'SELECT * FROM artist WHERE artist_id = :artist_id';
        $details = $this->pdo->prepare($req);
        $details->bindValue(':artist_id', $id, PDO::PARAM_INT);
        $details->execute();
        $result = $details->fetch(PDO::FETCH_OBJ);
        return $result;
    }
//Méthode de d'ajout d'un nouvel artiste
    public function addArtist($artist) {   
            $req = "INSERT INTO artist(artist_name, artist_url) VALUES (:artist_name, :artist_url)"; 
            $add = $this->pdo->prepare($req);
            $add->bindValue(':artist_name', $artist->getArtistName());
            $add->bindValue(':artist_url', $artist->getArtistUrl());
            return $add->execute();
    }
}
?>