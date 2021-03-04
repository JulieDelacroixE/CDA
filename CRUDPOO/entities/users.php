<?php 

class Users {

    private $user_id;
    private $user_email;
    private $user_pseudo;
    private $user_mdp;

    //Getters
    public function getUserId() {
        return $this->user_id;
    }

    public function getUserEmail() {
        return $this->user_email;
    }

    public function getUserPseudo() {
        return $this->user_pseudo;
    }

    public function getUserMdp() {
        return $this->user_mdp;
    }

    //Setters
    public function setUserId($sUserId) {
        $this->user_id = $sUserId;
    }

    public function setUserEmail($sUserEmail) {
        $this->user_email = $sUserEmail;
    }

    public function setUserPseudo($sUserPseudo) {
        $this->user_pseudo = $sUserPseudo;
    }

    public function setUserMdp($sUserMdp) {
        $this->user_mdp = $sUserMdp;
    }
}

?>