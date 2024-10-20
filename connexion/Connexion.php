<?php

Class Connexion {
    private $connexion;
    
    public function __construct() {
        $host = 'localhost';
        $dbname= 'frameworksdb';
        $login= 'root';
        $password = '';
        
        try{
           $this->connexion = new PDO("mysql:host=$host;dbname=$dbname",$login,$password);
            $this->connexion->query("SET NAMES UTF8");
            
        } catch (Exception $ex) {
            die('Erreur : '.$ex->getMessage());
        }
        
    }
    
    public function getConnexion() {
        return $this->connexion;
    }

    
    
}

