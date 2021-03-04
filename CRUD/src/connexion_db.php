<?php

try
{
    $db = new PDO("mysql:host=localhost;dbname=record;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $db;
}
catch (Exception $e)
{
    echo 'Erreur : ' . $e->getMessage() . '<br>';
    echo 'N° : ' . $e->getCode() . '<br>';
    die('Connexion au serveur impossible.');
}

?>