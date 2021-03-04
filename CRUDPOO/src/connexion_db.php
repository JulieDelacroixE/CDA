<?php 

class Connexion {

    public $pdo;
    private $host;
    private $login;
    private $password;
    private $dbName;
    private static $_instance;


    public function __construct($host = 'localhost', $login = 'root', $password = '', $dbName = 'record') {

        $this->host = $host;
        $this->login = $login;
        $this->password = $password;
        $this->dbName = $dbName;

        try {

            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName . ";charset=utf8", $this->login , $this->password);

        } catch (Exception $ex) {

            $message = 'Erreur P.D.O dans ' . $ex->getFile() . ' ligne ' . $ex->getLine() . ' : ' . $ex->getMessage();
            die($message);
        }   
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __destruct() {
        $this->pdo = NULL;
    }
}

?>

