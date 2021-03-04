<?php 

Class Artist {
    private $artist_id;
    private $artist_name;
    private $artist_url;
//Getters
    public function getArtistId() {
        return $this->artist_id;
    }

    public function getArtistName() {
        return $this->artist_name;
    }

    public function getArtistUrl() {
        return $this->artist_url;
    }
//Setters
    public function setArtistId($sArtistId) {
        $this->artist_id = $sArtistId;
    }

    public function setArtistName($sArtistName) {
        $this->artist_name = $sArtistName;
    }

    public function setArtistUrl($sArtistUrl) {
        $this->artist_url = $sArtistUrl;
    }
}

?>