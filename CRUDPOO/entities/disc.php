<?php 

class Disc {

    private $disc_id;
    private $disc_title;
    private $disc_year;
    private $disc_picture;
    private $disc_label;
    private $disc_price;
    private $disc_genre;
    private $artist_id;


    //Getters
    public function getDiscId() {
        return $this->disc_id;
    }

    public function getDiscTitle() {
        return $this->disc_title;
    }

    public function getDiscYear() {
        return $this->disc_year;
    }

    public function getDiscPicture() {
        return $this->disc_picture;
    }

    public function getDiscLabel() {
        return $this->disc_label;
    }

    public function getDiscPrice() {
        return $this->disc_price;
    }

    public function getDiscGenre() {
        return $this->disc_genre;
    }

    public function getArtistId() {
        return $this->artist_id;
    }

    // Setters
    public function setDiscId($sDiscId) {
        $this->disc_id = $sDiscId;
    }

    public function setDiscTitle($sDiscTitle) {
        $this->disc_title = $sDiscTitle;
    }

    public function setDiscYear($sDiscYear) {
        $this->disc_year = $sDiscYear;
    }

    public function setDiscPicture($sDiscPicture) {
        $this->disc_picture = $sDiscPicture;
    }

    public function setDiscLabel($sDiscLabel) {
        $this->disc_label = $sDiscLabel;
    }

    public function setDiscPrice($sDiscPrice) {
        $this->disc_price = $sDiscPrice;
    }

    public function setDiscGenre($sDiscGenre) {
        $this->disc_genre = $sDiscGenre;
    }
    public function setArtistId($sArtistId) {
        $this->artist_id = $sArtistId;
    }
}

?>